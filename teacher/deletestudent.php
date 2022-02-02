<?php
require '../dbcon.php';
$studentid = $_POST['studentid'];
$classid = $_POST['classid'];

$delete = "DELETE FROM `enrolledclass` WHERE studentid ='$studentid' and classid1 ='$classid'";
$deleter = mysqli_query($conn, $delete);
if ($deleter) {
    echo 1;
} else {
    echo 0;
}
mysqli_close($conn);