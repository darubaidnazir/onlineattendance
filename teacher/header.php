<!DOCTYPE html>
<html lang="en">
<?php
require '../dbcon.php';
session_start();
if ($_SESSION['teacherid'] == "") {
    header("Location: https://localhost/onlineattendance");
    exit();
}
$teacherid = $_SESSION["teacherid"];
$teachername = $_SESSION["teachername"];
$teacheremail = $_SESSION['teacheremail'];

?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hi,<?php echo $teachername ?></title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<style>
    .main .active {
        background-color: grey;
        color: white;
    }
</style>

<body>
    <div class="main">
        <nav class="navigation">
            <ul>
                <li class="user"><a style="color:black;background:white;" href="#"><i class="fas fa-user"></i>Hi,<?php echo $teachername; ?></a></li>
                <li><a href=" https://localhost/onlineattendance/teacher"><i class="fas fa-home"></i>Dashboard</a></li>
                <li><a href="addclass.php"><i class="fas fa-plus"></i>Add Class</a></li>
                <li><a href="attendancereport.php"><i class="fas fa-plus"></i>Attendance Report</a></li>

                <li class="user"><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>

            </ul>
        </nav>
    </div>
</body>
<script>
    const currentLoaction = location.href;
    const menuitem = document.querySelectorAll('a');
    const menulength = menuitem.length
    for (let i = 0; i < menulength; i++) {
        if (menuitem[i].href === currentLoaction) {
            menuitem[i].className = "active"
        }
    }
</script>


</html>