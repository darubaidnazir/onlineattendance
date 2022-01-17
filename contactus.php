<?php
require("dbcon.php");
if(!isset($_POST['email'])){
    header("Location:main.php");
}
$email = $_POST["email"];
$name = $_POST["name"];
$message = $_POST["message"];
$c = "INSERT INTO `contactus` (`email`, `name`, `message`) VALUES ('$email', '$name', '$message')";
$cr = mysqli_query($conn, $c);
if ($cr) {
                             $to = $email; 
                        $from = 'support@onlineattendance.tech'; 
$fromName = 'Online Attendance Team'; 
 
$subject = "Service team "; 
 
$htmlContent = ' 
    <html> 
    <head> 
        <title>Welcome to Online Attendance</title> 
    </head> 
    <body> 
        <h4>Thanks you for Using  our Service! Our Team will Shortly Reply on your Queries</h4> 
        <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
             <caption style="color:Blue">User Information</caption>
            <tr style="background-color: #e0e0e0;"> 
                <th>Name:</th><td>'.$name.'</td> 
            </tr> 
            <tr style="background-color: #e0e0e0;"> 
                <th>Email:</th><td>'.$email.'</td> 
            </tr> 
            <tr style="background-color: #e0e0e0;"> 
                <th>Message:</th><td>'.$message.'</td> 
            </tr> 
           
        </table> 
        <table cellspacing="0" style="border: 2px dashed #FB4314;margin-top:100%; width: 100%;"> 
                 <caption style="color:Green;">Online Attendance Team</caption>
            <tr style="background-color: #e0e0e0;"> 
                <th>Email:</th><td>'.$from.'</td> 
            </tr> 
            <tr> 
                <th>Website:</th><td><a href="http://www.darubaidnazir.com">www.darubaidnazir.com</a></td> 
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
   $to = 'support@onlineattendance.tech'; 
                        $from = $email; 
$fromName = 'Online Attendance Team'; 
 
$subject = "Service team "; 
 
$htmlContent = ' 
    <html> 
    <head> 
        <title>Welcome to Online Attendance</title> 
    </head> 
    <body> 
        <h4>Thanks you for Using  our Service! Our Team will Shortly Reply on your Queries</h4> 
        <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
             <caption style="color:Blue">User Information</caption>
            <tr style="background-color: #e0e0e0;"> 
                <th>Name:</th><td>'.$name.'</td> 
            </tr> 
            <tr style="background-color: #e0e0e0;"> 
                <th>Email:</th><td>'.$email.'</td> 
            </tr> 
            <tr style="background-color: #e0e0e0;"> 
                <th>Message:</th><td>'.$message.'</td> 
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
}else{ 
  //echo 'Email sending failed.'; 
}
    echo '0';
} else {
    echo "1";
}
mysqli_close($conn);
