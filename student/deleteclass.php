<?php
include '../dbcon.php';
$classid = $_POST['classid'];
$studentid = $_POST['studentid'];

$mydelete = "DELETE FROM `enrolledclass` WHERE classid1='$classid' and studentid='$studentid'";

if (mysqli_query($conn, $mydelete)) {
    echo 1;
} else {

    echo 0;
}
