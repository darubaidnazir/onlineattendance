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


    <title>Student's Profile</title>
</head>

<body>
    <table>
        <caption>Class Joined Details</caption>
        <caption style="color:blue;"></caption>


        <thead>

            <tr>
                <th scope="col">Class Id</th>
                <th scope="col">Class Name</th>
                <th scope="col">Teacher</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            <?php

            $mysql2 = "SELECT * FROM `classes` NATURAL JOIN `enrolledclass` WHERE enrolledclass.studentid ='$studentid'";
            $mysql3 = "SELECT `teachername` FROM `teacher` NATURAL Join `classes` NATURAL join `enrolledclass` WHERE enrolledclass.studentid='$studentid'";

            $mysql2result = mysqli_query($conn, $mysql2);
            $mysql3result = mysqli_query($conn, $mysql3);
            $count = mysqli_num_rows($mysql2result);
            if ($count >  0) {
                while ($row = mysqli_fetch_assoc($mysql2result)) {

                    $row2 = mysqli_fetch_assoc($mysql3result);


            ?>
                    <tr>
                        <td data-label="Class Id">
                            <?php
                            echo "<span class='button button3'>" . $row['classid1'] . "</span>";
                            ?>
                        </td>
                        <td data-label="Class Name">

                            <a class="button button2"><?php
                                                        echo $row['classname'];
                                                        ?></a>
                        </td>
                        <td data-label="Teacher">
                            <?php
                            echo "<span class='button button3'>" . $row2['teachername'] . "</span>";
                            ?>
                        </td>

                        <td data-label="Action">
                            <button id="delete-btn" class="button button1" data-id="<?php echo $row['classid1']; ?>
                ">Delete<i class="fas fa-trash"></i></button>
                            <button id="delete-btn1" style="display:none;" data-sid="<?php echo $studentid; ?>
                ">Delete</button>
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
        $(document).on("click", "#delete-btn", function() {
            var classid = $(this).data("id");
            var studentid = $("#delete-btn1").data("sid");
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
                                studentid: studentid
                            },
                            success: function(data) {
                                if (data == 1) {

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