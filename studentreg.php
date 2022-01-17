<?php
require 'dbcon.php';

if (isset($_POST['register'])) {
  $status = true;
  $firstname =  strtolower(mysqli_real_escape_string($conn, $_POST['firstname']));
  $rollno = strtolower(mysqli_real_escape_string($conn, $_POST['rollno']));
  $email = trim(strtolower(mysqli_real_escape_string($conn, $_POST['email'])));
  $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
  $password =   trim(mysqli_real_escape_string($conn, $_POST['password']));
  $confirmpassword = trim(mysqli_real_escape_string($conn, $_POST['confirmpassword']));
  $checkbot = $_POST['checkbot'];
  $botcheck = $_POST['botcheck'];

if ($checkbot != $botcheck ) {
    $error_msg['checkbot'] = "* Above Code did not Match!";
    $status = false;
  }
if ($checkbot == "") {
    $error_msg['checkbot'] = "* Above Code is Required";
    $status = false;
  }
  
  if ($firstname == "") {
    $error_msg['firstname'] = "* Name is required";
    $status = false;
  }
  if (!preg_match("/^[a-zA-Z -]*$/", $firstname)) {
    $error_msg['firstname'] = "*Only Letter's are allowed";
    $status = false;
  }
  if ($rollno == "") {
    $error_msg['rollno'] = "*Roll no is Required";
    $status = false;
  }
  
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_msg['email'] = "*Invalid Email Id";
    $status = false;
  }
  if (!is_numeric($phonenumber)) {
    $error_msg['phone'] = "*Only Number Input";
    $status = false;
  }
  if (strlen($phonenumber) != 10) {
    $error_msg['phone'] = "10 Digit Number Allowed";
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
  if ($status) {
    $newpassword = password_hash($password, PASSWORD_DEFAULT);
    $newconfirmpassword = password_hash($confirmpassword, PASSWORD_DEFAULT);
    $token = $code = rand(9999,99999);

    $email_query = "Select * From student where studentemail = '$email'";
    $email_query_result = mysqli_query($conn, $email_query);
    $email_query1 = "Select * From teacher where teacheremail = '$email'";
    $email_query_result1 = mysqli_query($conn, $email_query1);
    if (mysqli_num_rows($email_query_result) > 0 OR mysqli_num_rows($email_query_result1) > 0) {
      $error_msg["emailpresent"] = "Email already Registerated n One of our DataBase";
    } else {

      $newinsertquery = "INSERT INTO `student` (`studentrollno`, `studentname`, `studentemail`, `password`, `confirmpassword`, `phonenumber`,`token`, `joindate`) VALUES ( '$rollno', '$firstname', '$email', '$newpassword', '$newconfirmpassword', '$phonenumber','$token', current_timestamp())";
      $newinsertqueryresult  = mysqli_query($conn, $newinsertquery);
      if ($newinsertqueryresult) {
 $to = $email; 
                $from = 'account@onlineattendance.tech'; 
$fromName = 'Online Attendance Team'; 
 
$subject = "Registration Completed ! "; 
 
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
                <th>Status:</th><td>Account Created Successfully - Login</td> 
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
        $error_msg['success'] = "Registration Completed Redirect in 5 sec";
      } else {
        $error_msg['fail'] = "Registration Failed!";
      }
    }
  } else {
    $error_msg['unsafe'] = "Validation error";
  }

  mysqli_close($conn);
}




?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Registration</title>
  <link rel="stylesheet" href="Css/login.css">
  <link rel="stylesheet" href="Css/index.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>
<style>
  header ul li a {
    background-color: #16a085;
    font-size: 20px;
    color: whitesmoke;
    font-style: italic;
    padding: 10px;
    border-radius: 30%;
    text-decoration: none;

  }

  header ul li {
    list-style: none;
  }

  .row #message {
    padding: 20px;
    background-color: green;
    color: black;

  }

  .ppp {
    color: red;
  }
</style>

<body>
  <?php
  require 'header.php';
  ?>
  <div class="container">
    <div class="wrapper">
      <div class="title"><span>Student Registration</span></div>
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="row">

          <?php
          if (isset($error_msg['emailpresent'])) {
          ?> <script>
              swal("ohoh!", "<?php echo $error_msg['emailpresent']; ?>", "error");
            </script>
          <?php
            //   echo "<span id='message'> " . $error_msg['emailpresent'] . "</span>" . "<br>";
          }

          if (isset($error_msg['success'])) {
          ?> <script>
              swal("ohoh!", "<?php echo $error_msg['success']; ?>", "success");
            </script>
          <?php
            //   echo "<span id='message'> " . $error_msg['success'] . "</span>" . "<br>";
            header("refresh:5;index.php");
          }
          if (isset($error_msg['fail'])) {
          ?> <script>
              swal("ohoh!", "<?php echo $error_msg['fail']; ?>", "error");
            </script>
          <?php
            //   echo "<span id='message'> " . $error_msg['fail'] . "</span>" . "<br>";
          }
          ?>


        </div>
        <p class="ppp">
          <?php
          if (isset($error_msg['firstname'])) {
            echo $error_msg['firstname'] . "<br>";
          }


          ?>

        </p>
        <div class="row">
          <i class="fas fa-user"></i>
          <input type="text" name="firstname" placeholder="Enter Your  Name" require>

        </div>

        <p class="ppp">
          <?php
          if (isset($error_msg['rollno'])) {
            echo $error_msg['rollno'] . "<br>";
          }
          ?>
        </p class="ppp">
        <div class="row">
          <i class="fas fa-id-card"></i>
          <input type="text" name="rollno" maxlength="30" placeholder="Enter Roll no / Enrolment No" require>
        </div>
        <p class="ppp">
          <?php
          if (isset($error_msg['email'])) {
            echo $error_msg['email'] . "<br>";
          }
          ?>

        </p>
        <div class="row">
          <i class="fas fa-envelope"></i>
          <input type="text" name="email" placeholder="Enter Your Email Id" require>
        </div>
        <p class="ppp">
          <?php
          if (isset($error_msg['phone'])) {
            echo $error_msg['phone'] . "<br>";
          }
          ?>

        </p>
        <div class="row">
          <i class="fas fa-mobile"></i>
          <input type="number" name="phonenumber" maxlength="10" placeholder="Enter Phone Number" require>
        </div>
        <p class="ppp">
          <?php
          if (isset($error_msg['password'])) {

            echo $error_msg['password'] . "<br>";
          }
          ?>

        </p>
        <div class="row">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" placeholder="Enter Password" require>
        </div>

        <div class="row">
          <i class="fas fa-lock"></i>
          <input type="password" name="confirmpassword" placeholder="Enter Confirm Password" require>
        </div>
        
        <div class="row">
          <?php
          $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $randomString = '';
  
    for ($i = 0; $i < 6; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
      }
        echo'Enter The String in below Box:';
           echo '<span style="background-color:black;padding:5px;color:white">'.$randomString.'</span>';
          ?>
          
        </div>
         <p class="ppp">
          <?php
          if (isset($error_msg['checkbot'])) {

            echo $error_msg['checkbot'] . "<br>";
          }
          ?>

        </p>
        <div class="row">
          <i class="fas fa-laptop-code"></i>
          <input style="display:none;" type="text" name="botcheck" value="<?php echo $randomString;?>" >
          <input type="text" name="checkbot" placeholder="Enter the Above Character" required>
        </div>


        <div class="row button">
          <input type="submit" name="register" value=Register>
        </div>
        <div class="signup-link">
          Already a member<a href="index.php">Login</a></div>
      </form>
    </div>
  </div>
 <?php
  require 'footer.php';
  ?>
</body>

</html>