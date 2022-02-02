<?php
require 'header.php';
if (isset($_POST['joinclass'])) {
    $classcode =  mysqli_real_escape_string($conn, $_POST['classcode']);
    $status = true;
    if ($classcode == "") {
        $errormsg['classcode'] = "*Class Code is Required";
        $status = false;
    }

    if ($status) {

        $mycheck = "Select * From classes where classid1 = '$classcode'";
        $mycheckresult = mysqli_query($conn, $mycheck);
        $count5 = mysqli_num_rows($mycheckresult);
        if ($count5 > 0) {
            $mycheck2 = "Select * From classes Natural Join enrolledclass where classid1 = '$classcode' and studentid='$studentid'";
            $mycheckresult2 = mysqli_query($conn, $mycheck2);
            $count6 = mysqli_num_rows($mycheckresult2);
            if ($count6 > 0) {
                $passmsg['fail1'] = "Class Already Joined";
            } else {



                $mysqlinsert = "INSERT INTO `enrolledclass` (`classid1`, `studentid`) VALUES ('$classcode', '$studentid')";
                $mysqliresult = mysqli_query($conn, $mysqlinsert);
                $passmsg['success'] = "Class Joined-- Redirect in 5 Sec....";
            }
        } else {
            $passmsg['fail'] = "Class Code InValid..";
        }
    }
}

?>

<head>
    <link rel="stylesheet" href="../Css/login.css">
</head>
<div class="container">
    <div class="wrapper">
        <div class="title"><span>Join Class </span></div>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="row">
                <?php
                if (isset($passmsg['success'])) {
                ?>
                    <script>
                        swal("ohoh!", "<?php echo $passmsg['success']; ?>", "success");
                    </script><?php
                                header("refresh:5;index.php");
                                // echo "<span id='message'> " . $passmsg['success'] . "</span>" . "<br>";
                            }
                            if (isset($passmsg['fail'])) {
                                ?>
                    <script>
                        swal("ohoh!", "<?php echo $passmsg['fail']; ?>", "error");
                    </script><?php
                                // echo "<span id='message'> " . $passmsg['fail'] . "</span>" . "<br>";
                            }
                            if (isset($passmsg['fail1'])) {
                                ?>
                    <script>
                        swal("ohoh!", "<?php echo $passmsg['fail1']; ?>", "error");
                    </script><?php
                                //  echo "<span id='message'> " . $passmsg['fail1'] . "</span>" . "<br>";
                            }

                                ?>
            </div>
            <p class="ppp">
                <?php
                if (isset($error_msg['classcode'])) {
                    echo $error_msg['classcode'];
                }


                ?>
            </p>
            <div class="row">
                <i class="far fa-address-book"></i>
                <input type="text" placeholder="Enter Class Code" name="classcode" required>
            </div>


            <div class="row button">
                <input type="submit" name="joinclass" value="Join">
            </div>


        </form>
    </div>


</div>
</div>
<?php
require 'footer.php';
?>