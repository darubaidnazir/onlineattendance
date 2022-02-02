<?php
include '../dbcon.php';
$classid = $_POST['classid'];
$myfind = "Select * From classes where classid1='$classid'";
$myfindresult = mysqli_query($conn, $myfind);
$row = mysqli_fetch_assoc($myfindresult);
$cid = $row['classid'];


$deleteclass = "DELETE FROM `classes` WHERE classid='$cid'";
$deleteclassresult = mysqli_query($conn, $deleteclass);
if ($deleteclassresult) {
    $mydelete1 = "DELETE FROM `enrolledclass` WHERE classid1 ='$classid'";
    $mydelete1result = mysqli_query($conn, $mydelete1);
    $mydelete2 = "Drop table $classid";
    $mydelete2result = mysqli_query($conn, $mydelete2);
    echo 1;
} else {
    echo 0;
    // class could not be deleted
}
mysqli_close($conn);