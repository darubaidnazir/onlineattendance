<?php
require "../dbcon.php";
$classid = $_POST['classid'];
$studentid = $_POST['studentid'];
$date = date("Y-m-d");

$mysql = "SELECT * FROM `$classid` Where dateofattendance = '$date' and studentid ='$studentid'";
$mysqlr = mysqli_query($conn, $mysql);
$count = mysqli_num_rows($mysqlr);
if ($count > 0) {
    echo 1;
} else {
    $mysql1 = "INSERT INTO `$classid` (`dateofattendance`, `studentid`, `status`) VALUES ('$date', '$studentid',  '1')";
    $mysqlr1 = mysqli_query($conn, $mysql1);
    if ($mysqlr1) {
        echo 0;
    } else {
        echo 2;
    }
}
mysqli_close($conn);