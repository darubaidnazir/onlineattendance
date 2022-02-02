<?php
require "auth.php";
if (!isset($_GET['classname'])) {
    header("Location:https://localhost/onlineattendance/teacher");
    exit();
}
require "header.php";
$classid = $_GET['classid'];
$classname = $_GET['classname'];
$sql = "SELECT DISTINCT `dateofattendance` FROM `$classid`";
$sqlr = mysqli_query($conn, $sql);
$count = mysqli_num_rows($sqlr);

?>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>

    <div>
        <h3 style="text-align:center;">Class Name: <?php echo $classname; ?></h3>
        <h3 style="text-align:center;">Total Class Conducted: <?php echo $count; ?></h3>
        <h5 style="text-align:center; color:blue;">*To Check Present Students Click on Total Student Present</h5>
        <p>
        <table class="table">
            <caption>Date of Class Conducted</caption>
            <tr>
                <th>Date</th>
                <th>Total Students Present</th>

            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($sqlr)) {

                $dateof = $row['dateofattendance'];
                $present = "SELECT * FROM `$classid` WHERE `dateofattendance` ='$dateof' and `status`= 0 ";
                $presentr = mysqli_query($conn, $present);
                $count1 = mysqli_num_rows($presentr);
                echo "<tr><td>" . $row['dateofattendance'] . "</td><td><a href='presentstudents.php?classid=" . $classid . "&date=" . $dateof . "'>" . $count1 . "</a></td></tr>" . "";
            }

            ?>




        </table>

        </p>
    </div>
</body>

<?php
mysqli_close($conn);
require 'footer.php';
?>