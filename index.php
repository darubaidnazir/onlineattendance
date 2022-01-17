
<?php

require 'dbcon.php';

session_start();

if(isset($_COOKIE['studentid']) && isset($_COOKIE['studentname']) && isset($_COOKIE['studenttoken'])){
    $_SESSION["studentid"] = $_COOKIE['studentid'];
     $_SESSION["studentname"] = $_COOKIE['studentname'];
     $_SESSION["token"] = $_COOKIE['studenttoken'];
    
}
if(isset($_COOKIE['teacherid']) && isset($_COOKIE['teachername']) && isset($_COOKIE['teachertoken'])){
    $_SESSION["teacherid"] = $_COOKIE['teacherid'];
     $_SESSION["teachername"] = $_COOKIE['teachername'];
     $_SESSION["token"] = $_COOKIE['teachertoken'];
    
}
if (isset($_SESSION["teacherid"])) {
  header("Location: teacher/index.php");
  exit();
}
if (isset($_SESSION["studentid"])) {

  header("Location: student/index.php");
  exit();
}

if (isset($_POST['login'])) {
  $role =  mysqli_real_escape_string($conn, $_POST['userrole']);
  $email = trim(strtolower(mysqli_real_escape_string($conn, $_POST['email'])));
  $password = trim(mysqli_real_escape_string($conn, $_POST['password']));
 
  $show = false;
  
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_msg['email'] = "*Invalid Email Id";
  } else {
    if ($role == 0) {
      $email_query = "Select * From teacher where teacheremail = '$email'";
      $email_query_result = mysqli_query($conn, $email_query);
      if (mysqli_num_rows($email_query_result) > 0) {
        $row = mysqli_fetch_assoc($email_query_result);

        if (password_verify($password, $row['password'])) {
           $token = getToken(10);
            $_SESSION['token'] = $token;
             $_SESSION["teacherid"] =  $row['teacherid'];
          $_SESSION["teachername"] = $row['teachername'];
          $teacherid = $row['teacherid'];
          date_default_timezone_set("Asia/Calcutta");
            $currentDateTime = date('Y-m-d H:i:s');
           $updatetoken ="Update teacher set loginsession = '$token', lastloginsession = '$currentDateTime' WHERE teacherid='$teacherid'";
            $updatetokenresult = mysqli_query($conn,$updatetoken);
             $userid ="teacherid";
            $username ="teachername";
            $usertoken ='teachertoken';
            setcookie($userid, $_SESSION['teacherid'], time() + (2592000), "/","onlineattendance.tech",1); 
            setcookie($username, $_SESSION['teachername'], time() + (2592000), "/","onlineattendance.tech",1); 
            setcookie($usertoken, $_SESSION['token'], time() + (2592000), "/","onlineattendance.tech",1); 
          header("location:teacher/index.php");
        } else {
          $error_msg['fail'] = "Invalid Password/Email";
          
        }
      } else {
        $error_msg['fail'] = "Invalid Password/Email";
        
      }
    } elseif ($role == 1) {
      $email_query = "Select * From student where studentemail = '$email'";
      $email_query_result = mysqli_query($conn, $email_query);
      if (mysqli_num_rows($email_query_result) > 0) {
        $row = mysqli_fetch_assoc($email_query_result);

        if (password_verify($password, $row['password'])) {
            $token = getToken(10);
            $_SESSION['token'] = $token;
            $_SESSION["studentid"] =  $row['studentid'];
            $_SESSION["studentname"] = $row['studentname'];
            $studentid = $row['studentid'];
             date_default_timezone_set("Asia/Calcutta");
            $currentDateTime = date('Y-m-d H:i:s');
            $updatetoken ="Update student set loginsession = '$token' , lastloginsession = '$currentDateTime'  WHERE studentid='$studentid'";
            $updatetokenresult = mysqli_query($conn,$updatetoken);
            $userid ="studentid";
            $username ="studentname";
            $usertoken ='studenttoken';
            setcookie($userid, $_SESSION['studentid'], time() + (2592000), "/","onlineattendance.tech",1); 
            setcookie($username, $_SESSION['studentname'], time() + (2592000), "/","onlineattendance.tech",1); 
            setcookie($usertoken, $_SESSION['token'], time() + (2592000), "/","onlineattendance.tech",1); 
             header("location:student/index.php");
        } else {
          $error_msg['fail'] = "Invalid Password/Email--Click on ForgotPassword,";
        
        }
      } else {
        $error_msg['fail'] = "Invalid Password/Email--Click on ForgotPassword.";
       
      }
    } else {
    }
  }
  
  mysqli_close($conn);
}
function getToken($length){
  $token = "";
  $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
  $codeAlphabet.= "0123456789";
  $max = strlen($codeAlphabet); // edited

  for ($i=0; $i < $length; $i++) {
    $token .= $codeAlphabet[random_int(0, $max-1)];
  }

  return $token;
}

?>



<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Online Attendance</title>
 <meta name="description" content="Free Online Student Attendance For School,College and University..">
  <meta name="keywords" content="Free,Online,Attendance,College,Student,School,University,Education,Class">
  <meta name="author" content="Web Wings">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Css/index.css">
  <link rel="stylesheet" href="Css/login.css">
  <link rel="stylesheet" href="Css/check.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
  
</head>
<style>
  .ppp {
    color: red;
  }

  .row #message {
    padding: 20px;
    background-color: green;
    color: black;


  }

.glow-on-hover {
    width: 220px;
    height: 50px;
    border: none;
    outline: none;
    color: #fff;
    background: #111;
    cursor: pointer;
    position: relative;
    z-index: 0;
    border-radius: 10px;
    font-weight:300;
}

.glow-on-hover:before {
    content: '';
    background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
    position: absolute;
    top: -2px;
    left:-2px;
    background-size: 400%;
    z-index: -1;
    filter: blur(5px);
    width: calc(100% + 4px);
    height: calc(100% + 4px);
    animation: glowing 20s linear infinite;
    opacity: 0;
    transition: opacity .3s ease-in-out;
    border-radius: 10px;
}

.glow-on-hover:active {
    color: #000
}

.glow-on-hover:active:after {
    background: transparent;
}

.glow-on-hover:hover:before {
    opacity: 1;
}

.glow-on-hover:after {
    z-index: -1;
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: #111;
    left: 0;
    top: 0;
    border-radius: 10px;
}

@keyframes glowing {
    0% { background-position: 0 0; }
    50% { background-position: 400% 0; }
    100% { background-position: 0 0; }
}



Resources
</style>

<body>
    <?php
    require("logo.php");
    ?>
  
 
  <div>
    <div class="container">
      <div class="wrapper">
        <div class="title"><span> Login <i class='fas fa-sign-in-alt'></i> </span></div>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <!--  <div class="row">-->
         <div>
            <?php
            if (isset($error_msg['fail'])) {
            ?>
             <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal("ohoh!", "<?php echo $error_msg['fail']; ?>", "error");
              </script>
            <?php
               // echo "<span id='message'> " . $error_msg['fail'] . "</span>" . "<br>";
            }
            ?>
           
         </div>

          <div class="row">
            <div class="wrapper1">
              <input type="radio" value="1" name="userrole" id="option-1" checked>
              <input type="radio" value="0" name="userrole" id="option-2">
              <label for="option-1" class="option1 option-1">
                <div class="dot1"></div>
                <span>Student</span>
              </label>
              <label for="option-2" class="option1 option-2">
                <div class="dot1"></div>
                <span>Teacher</span>
              </label>
            </div>
          </div>
          <div class="row"></div>
          <p class="ppp">
            <?php
            if (isset($error_msg['email'])) {
              echo $error_msg['email'];
            }
            ?>

          </p>
          <div class="row">


            <i class="fas fa-user"></i>
            <input type="text" placeholder="Email or Phone" name="email" required>
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" id="pass" placeholder="Password" required>
           
          </div>
          <div class="row">
              <input type="checkbox" onclick="showPassword()">
            <b>Show Password</b>
              
          </div>
           

          <div class="row button">
            <input type="submit" name="login" value="Login">
          </div>

          <div class="row">
              <center>
            <a style="color:red;" href="forgotpassword.php">Forgot Password?</a>
      </center>    </div>
      

        </form>
     <center><button class="glow-on-hover" type="button"> Registration</button></center> 
      </div>
    </div>
     <div id="action" >
    <a href="studentreg.php">Students Register</a>


    <a href="teacherreg.php">Teacher Register</a>


  </div>



  </div>
<?php
  require("indexfooter.php");
?>
<script>
    function showPassword(){
        var x = document.getElementById("pass");
        if(x.type === "password"){
            x.type ="text";
        }else{
            x.type ="password";
        }
    }
    
</script>
  <script type="text/javascript" src="javascript/mobile.js"></script>
  <script src="javascript/jquery-3.6.0.min.js"></script>
 <script>
     $(document).ready(function(){
  $(".glow-on-hover").click(function(e){
     
    $(this).hide();
    $("#action").css("display","flex");
  });
});
     
     
     
 </script>
 
</body>

</html>
<script src="https://cdn.websitepolicies.io/lib/cookieconsent/1.0.3/cookieconsent.min.js" defer></script><script>window.addEventListener("load",function(){window.wpcc.init({"border":"thin","corners":"small","colors":{"popup":{"background":"#222222","text":"#ffffff","border":"#d9baea"},"button":{"background":"#d9baea","text":"#000000"}},"position":"bottom","content":{"href":"https://onlineattendance.tech/privacypolicy.html","message":"We use cookies to ensure you get the best user experience on our website. By continuing to use this site, you agree to the use of these cookies.","link":" Find out more","button":"Agree"}})});</script>