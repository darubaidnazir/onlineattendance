<?php
require 'header.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/box.css">


    <title>Teacher's Profile</title>
</head>
<style>
    #code1 {
        color: black;
        background-color: #16a085;
        border: 0;
        padding: 5px;
        border-radius: 10px;


    }

    .btn {
        background-color: black;
        color: white;
        padding: 9px;
        font-size: 20px;
        border-radius: 5px;
        text-transform: uppercase;

    }

    .btn1 {
        text-decoration: dashed;
        color: black;
        font-size: 24px;
        font-style: italic;

    }
</style>

<body>
    <table>
        <caption>Class Details</caption>
        <caption style="color:blue">
            <h6>*Click on Class Name to Take Attendance</h6>
            <h6>*Click on Total Roll For Student Reports</h6>
        </caption>


        <thead>

            <tr>
                <th scope="col">Class Id</th>
                <th scope="col" title="Click Here To Take Attendance">Class Name</th>
                <th scope="col">Class No/Sem</th>
                <th scope="col" title="Click Here To See Student Attendance Report">Total Roll</th>
                <th scope="col">Update Attendance</th>
                <th scope="col">Class Report</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $limit = 3;

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            $offset = ($page - 1) * $limit;
            $mysql2 = "Select * FROM classes Where teacherid = '$teacherid' LIMIT {$offset},{$limit}";
            $mysql2result = mysqli_query($conn, $mysql2);
            $count = mysqli_num_rows($mysql2result);

            if ($count >  0) {
                while ($row = mysqli_fetch_assoc($mysql2result)) {




            ?>
                    <tr>
                        <td data-label="Class Id">
                            <?php
                            echo "<span class='btn'>" . $row['classid1'] . "</span>";
                            ?>
                            <span id="copyed"></span>
                            <button id="code1" data-code="<?php echo $row['classid1']; ?>"><i class="far fa-clipboard"></i>Copy Code</button>

                        </td>
                        <td data-label="Class Name" title="Click Here To Take Attendance">

                            <a class="btn1" href="attendance.php?classid=<?php echo $row['classid1']; ?>&classname=<?php echo $row['classname']; ?>"><?php
                                                                                                                                                        echo $row['classname']; ?>
                                <i class="fas fa-mouse"></i>
                            </a>

                        </td>
                        <td data-label="Class No/Sem">
                            <?php
                            echo "<span class='btn1'>" . $row['classno'] . "</span>";
                            ?>
                        </td>
                        <td data-label="Total Roll">
                            <?php
                            $id = $row['classid1'];
                            $myroll = "SELECT * FROM enrolledclass WHERE classid1 = '$id'";
                            $myrollresult = mysqli_query($conn, $myroll);
                            $myrollcount = mysqli_num_rows($myrollresult);
                            ?>


                            <a class="btn1" href="studentdetails.php?classid=<?php echo $row['classid1']; ?>"><?php
                                                                                                                echo $myrollcount;
                                                                                                                ?> <i class="fas fa-mouse"></i>
                            </a>


                        </td>
                        <td data-label="Update">

                            <a style="color:#16a085;" class="btn1" href="update.php?classid=<?php echo $row['classid1']; ?>&classname=<?php echo $row['classname']; ?>">Click Here</a>
                        </td>   <td data-label="Class Report">

                            <a style="color:#16a085;" class="btn1" href="classreport.php?classid=<?php echo $row['classid1']; ?>&classname=<?php echo $row['classname']; ?>">Click Here</a>
                        </td>
                        <td data-label=" Action">
                            <button id="delete-btn" class="button button1" data-id="<?php echo $row['classid1'];
                                                                                    ?>
                ">Delete<i class="fas fa-trash"></i></button>

                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td>No Class Found</td></tr>";
            }

            ?>
        </tbody>


    </table>
    </div>
    </div>

    <div>
        <?php
        $mysql3 = "Select * FROM classes Where teacherid = '$teacherid'";
        $mysql3result = mysqli_query($conn, $mysql3);
        $count1 = mysqli_num_rows($mysql3result);
        $totalpage = ceil($count1 / $limit);
        echo '<div><ul class="pagination">';
        for ($i = 1; $i <= $totalpage; $i++) {
            echo '<li class="active"><a href="index.php?page=' . $i . '">' . $i . '</a></li>';
        }
        echo '</ul></div>';
        ?>

        <pre>






   </pre>
        <?php
        require 'footer.php';
        ?>

        <div class="popup_box">
            <i class="fas fa-exclamation"></i>
            <h1>Your Class will be deleted Permanently!</h1>
            <label>Are you sure to proceed?</label>
            <div class="btns">
                <a href="#" class="btn1">Cancel </a>
                <a href="#" class="btn2">Delete </a>
            </div>


</body>
<script src="../javascript/jquery-3.6.0.min.js">

</script>

<script>
    $(document).ready(function() {
        $(document).on("click", "#code1", function() {
            var code = $(this).data("code");
            var dummy = $('<input>').val(code).appendTo('body').select()
            document.execCommand('copy')
            $(dummy).remove();
            swal("Good job!", "Class Code Copyed!", "success");


        });

        $(document).on("click", "#delete-btn", function() {
            var classid = $(this).data("id");

            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this Class file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({

                            url: "deleteclass.php",
                            type: "POST",
                            data: {
                                classid: classid,


                            },
                            success: function(data) {
                                if (data == 1) {
                                    swal("Poof! Your Class  has been deleted!", {
                                        icon: "success",

                                    });
                                    window.location.reload(true);
                                } else {
                                    alert("Deletion Failed");
                                }
                            }



                        });

                        swal("Poof! Your Class  has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your Class  is safe!");
                    }

                });

        });









    });
</script>

</html>