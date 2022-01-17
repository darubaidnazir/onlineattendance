<!DOCTYPE html>
<html lang="en">

<style>
    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #16a085;
        color: black;
        text-align: center;
        padding: 10px;
         margin-top:150px;
    }
    a{
        text-decoration:none;
        color:white;
    }
</style>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Free Online Student Attendance For School,College and University..">
  <meta name="keywords" content="Free,Online,Attendance,College,Student,School,University,Education,Class">
  <meta name="author" content="Web Wings">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Attendance</title>

    <link rel="stylesheet" href="Css/header.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   
</head>
<style>
    .main .active {
        background-color: grey;
        color: white;
    }
    .main{
        margin-bottom:60px;
    }
</style>

<body>


    <div class="main">
        <nav class="navigation">
            <ul>
               <li class="user"><a style="color:black;background:white;" href="#"><i class="fas fa-book"></i>Online Attendance</a></li>
               <li class="user"><a href="index.php"><i class="fas fa-home"></i>Home</a></li>
                <li class="user"><a href="aboutus.php"><i class="fas fa-address-card"></i>About us</a></li>
                <li class="user"><a href="contact.php"><i class="fas fa-id-badge"></i>Contact us</a></li>
                 


            </ul>
        </nav>
    </div>
    <div class="footer">
    <p class="love">Made with &#10082; By team <span style="color:red">Web Wings</span> <i class="far fa-copyright"></i> 2021 | <a href='privacypolicy.html'>Privacy Policy</a></p>
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