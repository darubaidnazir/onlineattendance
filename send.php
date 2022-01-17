
<?php

require("dbcon.php");
?>
<form method="POST" action="send.php">
    <select name="email" id="cars">
        <?php
        $all = "SELECT * FROM student";
        $allr = mysqli_query($conn,$all);
        while($row = mysqli_fetch_assoc($allr)){
            
        
        ?>
  <option value="<?php echo $row['studentemail'] ;?> "><?php echo $row['studentemail'] ;?></option>
  <?php
  }
  ?>
</select>
<input type="submit" name="submit" value="send">
    
    </form>
    
    <form method="POST" action="send.php">
    <select name="email" id="cars">
        <?php
        $all = "SELECT * FROM teacher";
        $allr = mysqli_query($conn,$all);
        while($row = mysqli_fetch_assoc($allr)){
            
        
        ?>
  <option value="<?php echo $row['teacheremail'] ;?> "><?php echo $row['teacheremail'] ;?></option>
  <?php
  }
  ?>
</select>
<input type="submit" name="submit" value="send">
    
    </form>


<?php
if(isset($_POST['submit'])){
    $email = $_POST['email'];

                             $to = $email; 
                        $from = 'onlineat@onlineattendance.tech'; 
$fromName = 'Online Attendance Team'; 
 
$subject = "Service team "; 
 
$htmlContent = ' 
    <html> 
    <head> 
        <title>Welcome to Online Attendance</title> 
    </head> 
    <body> 
        <h4>Thanks you for Using  our Service! </h4> 
        <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
             <caption style="color:Blue">User Information</caption>
            
            <tr style="background-color: #e0e0e0;"> 
                <th>Email:</th><td>'.$email.'</td> 
            </tr> 
            <tr style="background-color: #e0e0e0;"> 
                <th>Contact us:</th><td><a href="mailto:support@onlineattendance.tech">support@onlineattendance.tech</a></td> 
            </tr> 
             <tr style="background-color: #e0e0e0;"><th>Message:</th><td>Dear Tester User,  <hr><br> Developer\'s Team has been Upgrading the Security Feature of Login Session. <br> whole team of Online Attendance will be Appreciating you for your valuable time for finding bugs During the Testing Period of Online Attendance..<br>                                 <br>                                 <br><br><br><span style="color:red;"> Thank you team , Online Attendance..!</span>                 </td>              </tr> 
           
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
   echo 'Email has sent successfully';
   echo $to;
   echo '<br>';
  }
}
  ?>