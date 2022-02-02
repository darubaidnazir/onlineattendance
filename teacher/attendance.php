<?php
require("auth.php");
require 'header.php';
if (!isset($_GET['classname'])) {
    header("Location:https://localhost/onlineattendance/teacher");
}

?>

<head>
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/button.css">
</head>
<table id="table">
    <caption>Student Attendance - <?php echo $_GET['classname'] ?></caption>
    <caption>Attendance Date:
        <?php
        $today = date("Y-m-d");
        echo $today;
        ?>
    </caption>
    <caption><h6 style="color:blue;">*You can Click only Once on Action Button..and can not undo?</h6></caption>




    <thead>

        <tr>
            <th scope="col">Student Roll No</th>


            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($_GET['classid'])) {
            $classid = $_GET['classid'];
        }

       // $limit = 3;

        //if (isset($_GET['page'])) {
          //  $page = $_GET['page'];
        //} else {
         //   $page = 1;
        //}

      //  $offset = ($page - 1) * $limit;
        $mysql2 = "SELECT * FROM `student` NATURAL JOIN `enrolledclass` WHERE enrolledclass.classid1 = '$classid' ORDER BY `studentrollno` ASC";
        $mysql2result = mysqli_query($conn, $mysql2);
        $count = mysqli_num_rows($mysql2result);
        $data = date("Y-m-d");

        $myrecheck1 = "SELECT * FROM `$classid` WHERE `dateofattendance` = '$data'";
        $myrecheckresult = mysqli_query($conn, $myrecheck1);
        $count10 = mysqli_num_rows($myrecheckresult);






        if ($count >  0) {
            while ($row = mysqli_fetch_assoc($mysql2result)) {

                $sid = $row['studentid'];
                $marked = "SELECT * FROM `$classid` WHERE `studentid` ='$sid' and `dateofattendance`='$data'";
                $markedr = mysqli_query($conn, $marked);
                $any = mysqli_num_rows($markedr);
                if ($any > 0) {
                    continue;
                } else {




        ?>
                    <tr id="<?php echo $row['studentid']; ?>">
                        <?php

                        ?>
                        <td data-label="Student Roll No">
                            <?php

                            echo "<span class='button button3'>" . $row['studentrollno'] . "</span>";

                            ?>
                        </td>

                        <td data-label="Action">


                            <button id="present" class="button button1" data-pid="<?php echo $row['studentid']; ?>">Present</button>
                            <button id="absent" class="button button1" data-aid="<?php echo $row['studentid']; ?>">Absent</button>

                        </td>
                    </tr>
        <?php
                }
            }
        } else {
            echo "<tr><td>No Student Found</td></tr>";
        }

        ?>
    </tbody>


</table>

<?php
mysqli_close($conn);
require 'footer.php';
?>

<script src="../javascript/jquery-3.6.0.min.js">

</script>

<script>
    $(document).ready(function() {

        $(document).on("click", "#present", function() {
            var studentid = $(this).data("pid");
            var classid = "<?php echo $classid ?>";

            $.ajax({

                url: "padd.php",
                type: "POST",
                data: {
                    classid: classid,
                    studentid: studentid


                },
                success: function(data) {
                    if (data == 1) {

                        alert("Already Marked");
                        $("#"+studentid).fadeOut();



                    }
                    if (data == 2) {

                        alert("Error try Again");


                    }
                    if (data == 0) {

                        
                        $("#"+studentid).fadeOut();


                    }
                }



            });

        });



        $(document).on("click", "#absent", function() {
            var studentid = $(this).data("aid");
            var classid = "<?php echo $classid ?>";


            $.ajax({

                url: "aadd.php",
                type: "POST",
                data: {
                    classid: classid,
                    studentid: studentid


                },
                success: function(data) {
                    if (data == 1) {

                        alert("Already Marked");
                        $("#"+studentid).fadeOut();



                    }
                    if (data == 2) {

                        alert("Error try Again");


                    }
                    if (data == 0) {

                        $("#"+studentid).fadeOut();
                       


                    }
                }



            });


        });








    });
</script>