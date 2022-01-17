
<?php

require 'header.php';
require 'dbcon.php';
session_start();

if (!isset($_SESSION["userrole"])) {
  header("Location:index.php");
  exit();
}
          $now = time();
if($now > $_SESSION['expire']){
    session_destroy();
    session_start();
    $_SESSION['message'] = "Session has Expired -- Try Again";
    
     header("Location: forgotpassword.php");
     exit();
     
    
}
$userrole = $_SESSION['userrole'];
$email = $_SESSION['femail'];
 $code = $_SESSION['code'];

if(isset($_POST['verify'])){

   $otp = $_POST['otp'];
   $password =   trim(mysqli_real_escape_string($conn, $_POST['password']));
  $confirmpassword = trim(mysqli_real_escape_string($conn, $_POST['confirmpassword']));
   $status =true; 
   if (!is_numeric($otp)) {
    $error_msg['otp'] = "*Only Number Input";
    $status = false;
  }
  if (strlen($password) < 8 && strlen($confirmpassword) < 8) {
    $error_msg['password'] = "*Password must be more than 8 digits";
    $status = false;
  }
  if ($password != $confirmpassword) {
    $error_msg['password'] = "*Password Does Not Match";
    $status = false;
  }
  if($status == true){
    $newpassword = password_hash($password, PASSWORD_DEFAULT);
    $newconfirmpassword = password_hash($confirmpassword, PASSWORD_DEFAULT);

      if($otp == $code){
          
           if($userrole == 0){
            $changepassword = "UPDATE `teacher` SET `password` = '$newpassword' , `confirmpassword` = '$newconfirmpassword' WHERE `teacheremail` = '$email'";
            $changepasswordresult = mysqli_query($conn,$changepassword);
            if($changepasswordresult){
                $to = $email; 
                $from = 'account@onlineattendance.tech'; 
$fromName = 'Online Attendance Team'; 
 
$subject = "Password Changed "; 
 
$htmlContent = ' 
    <html> 
    <head> 
        <title>Welcome to Online Attendance</title> 
    </head> 
    <body> 
        <h4>Thanks you for Using  our Service!</h4> 
        <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
             <caption style="color:Blue">User Information</caption>
            <tr style="background-color: #e0e0e0;"> 
                <th>Email:</th><td>'.$email.'</td> 
            </tr> 
            <tr style="background-color: #e0e0e0;"> 
                <th>Status:</th><td>Password Changed Successfully</td> 
            </tr> 
           
        </table> 
        <table cellspacing="0" style="border: 2px dashed #FB4314;margin-top:100%; width: 100%;"> 
                 <caption style="color:Green;">Online Attendance Team</caption>
            <tr style="background-color: #e0e0e0;"> 
                <th>Email:</th><td>'.$from.'</td> 
            </tr> 
            <tr> 
                <th>Website:</th><td><a href="https://www.onlineattendance.tech">www.onlineattendance.tech</a></td> 
            </tr> 
            <tr> 
                <th></th><td> &copy; Online Attendance 2021.</td> 
            </tr> 
        </table> 
    </body> 
    </html>'; 
 
// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
// Additional headers 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 

 
// Send email 
if(mail($to, $subject, $htmlContent, $headers)){ 
  // echo 'Email has sent successfully.'; 
}else{ 
  //echo 'Email sending failed.'; 
}
             ?>
             <script>
           swal("ohoho!", "Password Changed Successful! Redirect in 3-Sec to Login Page", "success");
                 </script>
                 <?php
                  header("refresh:3;main");
              session_destroy();
            }else{
             ?>
             <script>
           swal("ohoho!", "Password Could Not Be Changed Something Went Wrong", "error");
                 </script>
                 <?php
                 header("refresh:3;main");
              session_destroy();
            }
           }else if($userrole == 1){
                         $changepassword = "UPDATE `student` SET `password` = '$newpassword' , `confirmpassword` = '$newconfirmpassword' WHERE `studentemail` = '$email'";
                         $changepasswordresult = mysqli_query($conn,$changepassword);
                         if($changepasswordresult){
                             $to = $email; 
                        $from = 'account@onlineattendance.tech'; 
$fromName = 'Online Attendance Team'; 
 
$subject = "Password Changed "; 
 
$htmlContent = ' 
    <html> 
    <head> 
        <title>Welcome to Online Attendance</title> 
    </head> 
    <body> 
        <h4>Thanks you for Using  our Service!</h4> 
        <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
             <caption style="color:Blue">User Information</caption>
            <tr style="background-color: #e0e0e0;"> 
                <th>Email:</th><td>'.$email.'</td> 
            </tr> 
            <tr style="background-color: #e0e0e0;"> 
                <th>Status:</th><td>Password Changed Successfully</td> 
            </tr> 
           
        </table> 
        <table cellspacing="0" style="border: 2px dashed #FB4314;margin-top:100%; width: 100%;"> 
                 <caption style="color:Green;">Online Attendance Team</caption>
            <tr style="background-color: #e0e0e0;"> 
                <th>Email:</th><td>'.$from.'</td> 
            </tr> 
            <tr> 
                <th>Website:</th><td><a href="https://www.onlineattendance.tech">www.onlineattendance.tech</a></td> 
            </tr> 
            <tr> 
                <th></th><td> &copy; Online Attendance 2021.</td> 
            </tr> 
        </table> 
    </body> 
    </html>'; 
 
// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
// Additional headers 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 

 
// Send email 
if(mail($to, $subject, $htmlContent, $headers)){ 
  // echo 'Email has sent successfully.'; 
}else{ 
  //echo 'Email sending failed.'; 
}
                          ?>
                          <script>
                        swal("ohoho!", "Password Changed Successful!  Redirect in 3-Sec to Login Page", "success");
                              </script>
                              <?php
                               header("refresh:3;index.php");
                           session_destroy();
                         }else{
                          ?>
                          <script>
                        swal("ohoho!", "Password Could Not Be Changed Something Went Wrong", "error");
                              </script>
                              <?php
                              header("refresh:3;index.php");
                           session_destroy();
                         }

           }else{
            session_destroy();
           }
          
      }else{
        ?>
        <script>
      swal("ohoho!", "You Entered Wrong OTP Check your Mail box ..!", "error");
            </script>
            <?php
      }
   
  }else{
    ?>
    <script>
  swal("ohoho!", "Validation Error", "error");
        </script>
        <?php
   
  }
  
}

?>
<head>
<link rel="stylesheet" href="Css/index.css">
  <link rel="stylesheet" href="Css/login.css">
  <link rel="stylesheet" href="Css/check.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<div>
    <div class="container">
      <div class="wrapper">
        <div class="title"><span>Verify OTP </span></div>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; 
       
        ?>">
           
          <div class="row">
              <?php
                 if(isset($time['message'])){
                     echo $time['message'];
                 }
              
              ?>
           <p style="color:White;">  <span style="color:White; background-color:black;padding:3px;border-radius:5px;"><?php
           echo $_SESSION['femail'];
           ?>
           </span>
           <br>
           <span style="color:red;">Check your Mail or Spam folder for OTP<br>
           OTP is Valid for 6 Min Only...
          
          </span>
          
        </p>
          </div>
 
          
          <div class="row">
          </div>
         
          <div class="row">
          <p class="ppp">
          <?php
          if (isset($error_msg['otp'])) {
            echo $error_msg['otp'] . "<br>";
          }
          ?>

        </p>

            <i class="fas fa-user"></i>
            <input type="number" placeholder="Enter Your OTP" name="otp" required>
          </div>

          <div class="row">
          <p class="ppp">
          <?php
          if (isset($error_msg['password'])) {
            echo $error_msg['password'] . "<br>";
          }
          ?>

        </p>

            <i class="fas fa-user"></i>
            <input type="password" placeholder="Enter Your New Password" name="password" required>
          </div>
          <div class="row">
          <p class="ppp">
         
        </p>

            <i class="fas fa-user"></i>
            <input type="password" placeholder="Enter Your New Confirm Password" name="confirmpassword" required>
          </div>
          
          <div class="row button">
            <input type="submit" name="verify" value="Verify">
          </div>

         
        </form>
      </div>
    </div>



  </div>

</body>
<?php
require 'footer.php';

?>
