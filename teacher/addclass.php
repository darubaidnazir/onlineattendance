<?php
require 'header.php';
if (isset($_POST['addclass'])) {
    $classname =  mysqli_real_escape_string($conn, $_POST['classname']);
    $classno =  mysqli_real_escape_string($conn, $_POST['classno']);
    $status = true;
    if ($classname == "") {
        $errormsg['classname'] = "*Class Name is Required";
        $status = false;
    }
    if ($classno == "") {
        $errormsg['classno'] = "*Class No/Sem is Required";
        $status = false;
    }
    if ($status) {
        $ch = true;
        while ($ch) {
            $randomclass = rand(5000, 1000000);
            $mycheck = "Select * From classes where classid = '$randomclass'";
            $mycheckresult = mysqli_query($conn, $mycheck);
            $count4 = mysqli_num_rows($mycheckresult);
            if ($count4 > 0) {
                $ch = true;
            } else {
                $ch = false;
            }
        }
        $newclass = "cs";
        $newclass = $newclass . $randomclass;

        $mysql = "INSERT INTO `classes` ( `classid1`, `classname`, `classno`, `teacherid`, `joinclass`) VALUES ('$newclass', '$classname', '$classno', '$teacherid', 'current_timestamp()')";
        $mysqlresult = mysqli_query($conn, $mysql);
        if ($mysqlresult) {
            $passmsg['success'] = "Class Added! ";
            $myclassdatabase = "
        CREATE TABLE `$newclass` (
            `dateofattendance` varchar(20) NOT NULL,
            `studentid` int(100) NOT NULL,
            
            `status` int(100) NOT NULL
        );";
            $myclassdatabaseresult = mysqli_query($conn, $myclassdatabase);
        } else {
            $passmsg['fail'] = "Class Not Added Try Again! ";
        }
    } else {
        //todo
    }
    mysqli_close($conn);
}

?>

<head>
    <link rel="stylesheet" href="../Css/login.css">

</head>
<div class="container">
    <div class="wrapper">
        <div class="title"><span>Add Class </span></div>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="row">
                <?php
                if (isset($passmsg['success'])) {
                ?><script>
                        swal("Good job!", "Class Created!", "success");
                    </script><?php
                                echo 'Redirecting in 3 Sec...';
                                header("refresh:3;index.php");
                            }
                            if (isset($passmsg['fail'])) {
                                ?><script>
                        swal("oohhh!", "Failed try again", "fail");
                    </script><?php
                                //  echo "<span id='message'> " . $passmsg['fail'] . "</span>" . "<br>";
                            }

                                ?>
            </div>
            <p class="ppp">
                <?php
                if (isset($error_msg['classname'])) {
                    echo $error_msg['classname'];
                }


                ?>
            </p>
            <div class="row">
                <i class="far fa-address-book"></i>
                <input type="text" placeholder="Enter Class Name" name="classname" required>
            </div>
            <p class="para">
                <?php
                if (isset($error_msg['classno'])) {
                    echo $error_msg['classno'];
                }


                ?>
            </p>
            <div class="row">
                <i class="far fa-address-book"></i>
                <input type="text" name="classno" placeholder="Enter Class No/Sem" required>
            </div>

            <div class="row button">
                <input type="submit" name="addclass" value="Add">
            </div>


        </form>
    </div>



</div>
</div>
<?php

require 'footer.php';
?>