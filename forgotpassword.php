<?php
require 'header.php';
require 'dbcon.php';

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
        <div class="title"><span> Forgot Password <br><span style="color:white;font-size:10px;">
            
            <?php
                       if(isset($_SESSION['message'])){
                           echo $_SESSION['message'];
                           session_destroy();
                       }
                    ?>
        </span> </span></div>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="row">
           
          </div>
          <?php
           if(isset($_POST["otp"])){
             $email = trim(strtolower(mysqli_real_escape_string($conn, $_POST['email'])));
              $role = $_POST['userrole'];
             $status= true;
             if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error_msg['email'] = "*Invalid Email Id";
                $status = false;
              }
            
              if ($status) {
                
             
               if($role == 1){
                $email_query = "Select * From student where studentemail = '$email'";
                $email_query_result = mysqli_query($conn, $email_query);
                $count = mysqli_num_rows($email_query_result);
                if($count > 0 ){
                    session_start();
                    $_SESSION['userrole'] = $role;
                    $_SESSION['femail'] = $email;
                    $_SESSION['start'] = time();
                    $_SESSION['expire'] = $_SESSION['start'] + (6 * 60);
                    
                    $code = rand(9999,99999);
                    $_SESSION['code'] = $code;
                    $to = $email; 
$from = 'verification@onlineattendance.tech'; 
$fromName = 'Online Attendance Team'; 
 
$subject = " Account Verification Code "; 
 
$htmlContent = ' 
    <html> 
    <head> 
        <title>Welcome to Online Attendance</title> 
    </head> 
    <body> 
        <h4>Thanks you for Using Verification  Service!</h4> 
        <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
             <caption style="color:Blue">User Information</caption>
            <tr style="background-color: #e0e0e0;"> 
                <th>Email:</th><td>'.$email.'</td> 
            </tr> 
            <tr style="background-color: #e0e0e0;"> 
                <th>OTP Code :</th><td>'.$code.'</td> 
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
                    header("Location: verify.php");
                    
                  
                      
                }else{
                    $message['error'] = "Email Not Registered";
                     ?>
                     <script>
                   swal("ohoho!", "Email Not Registered", "error");
                         </script>
                         <?php
                }
               }else{
                $email_query = "Select * From teacher where teacheremail = '$email'";
                $email_query_result = mysqli_query($conn, $email_query);
                $count = mysqli_num_rows($email_query_result);
                if($count > 0 ){
                    session_start();
                    $_SESSION['userrole'] = $role;
                    $_SESSION['femail'] = $email;
                    $code = rand(9999,99999);
                    $_SESSION['code'] = $code;
                     $_SESSION['start'] = time();
                    $_SESSION['expire'] = $_SESSION['start'] + (6 * 60);
                     $to = $email; 
                    $from = 'verification@onlineattendance.tech'; 
$fromName = 'Online Attendance Team'; 
 
$subject = "Account Verification Code"; 
 
$htmlContent = ' 
    <html> 
    <head> 
        <title>Welcome to Online Attendance</title> 
    </head> 
    <body> 
        <h4>Thanks you for Using Verification  Service!</h4> 
        <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
             <caption style="color:Blue">User Infomation</caption>
            <tr style="background-color: #e0e0e0;"> 
                <th>Email:</th><td>'.$email.'</td> 
            </tr> 
            <tr style="background-color: #e0e0e0;"> 
                <th>OTP Code :</th><td>'.$code.'</td> 
            </tr> 
           
        </table> 
        <table cellspacing="0" style="border: 2px dashed #FB4314;margin-top:100%; width: 100%;"> 
            <caption style="color:Green">Online Attendance Team</caption>
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
  //  echo 'Email has sent successfully.'; 
}else{ 
  //echo 'Email sending failed.'; 
}
                    header("Location: verify.php");
                    
                  
                }else{
                    $message['error'] = "Email Not Registered";
                     ?>
                     <script>
                   swal("ohoho!", "Email Not Registered", "error");
                         </script>
                         <?php
                }


               }
            
              }else{

              }
            }
            mysqli_close($conn);
?>

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
            <div class="row">
                    
          </div>
         
          <div class="row">
          <p class="ppp">
          <?php
          if (isset($error_msg['email'])) {
            echo $error_msg['email'] . "<br>";
          }
          ?>

        </p>

            <i class="fas fa-user"></i>
            <input type="text" placeholder="Enter Your Registered Email" name="email" required>
          </div>
          
          <div class="row button">
            <input type="submit" name="otp" value="Send Otp">
          </div>

         
        </form>
      </div>
    </div>



  </div>

</body>
<?php
require 'footer.php';
?>