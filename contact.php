<?php
require 'header.php';

?>

<head>
    <link rel="stylesheet" href="Css/login.css">

</head>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="title"><span> Contact Us </span></div>
            <form>
                <div class="row">
                    <h4 id="error"></h4>
                </div>


                <div class="row">


                    <i class="fas fa-user"></i>
                    <input type="text" id="email" placeholder="Email " required>
                </div>
                <div class="row">
                    <i class="far fa-user"></i>
                    <input type="text" id="name" placeholder="Name" required>
                </div>
                <div class="row">
                    <i class="far fa-sticky-note"></i>
                    <input type="text" id="message" placeholder="Enter Message" required>
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

        <div class="row">
          <i class="fas fa-laptop-code"></i>
          <input type="text" style="display:none;" id="botcheck" value="<?php  echo $randomString;?>" >
          <input type="text" id="checkbot" placeholder="Enter the Above Character" required>
        </div>


                <div class="row button">
                    <input type="submit" id="contactus" value="Contact">
                </div>


            </form>
        </div>
    </div>
    <div class="container">
        <div class="wrapper">
            <address style="color:green; text-align:center;">
                Mail at <a style="text-decoration:none; color:red;" href="mailto:support@onlineattendance.tech">Send Mail</a>.<br>
                <br>
                Visit us at:
                <a style="text-decoration:none; color:red;" href="#">Web Wings</a><br>
                <br>
                Kulgam, Jammu and Kashmir<br>
                192231<br>
                <br>
                Contact No: <a style="text-decoration:none; color:red;" href="tel:9622922XXX">Call us</a>
            </address>
        </div>
    </div>

</body>
<pre>
    
    
    
</pre>
<?php
require 'footer.php';
?>
<script src="javascript/jquery-3.6.0.min.js">

</script>
<script>
    $(document).ready(function() {
        $("#contactus").on("click", function(e) {
            e.preventDefault();


            var email = $("#email").val();
            var name = $("#name").val();
             var botcheck = $("#botcheck").val();
            var checkbot = $("#checkbot").val();
            var message = $("#message").val();
            if (email == "" || name == "" || message == "" || checkbot =="" ) {
                $("#error").html("*All Field Required");
                $("#error").css("color", "red");
            }else if( botcheck != checkbot){
                 $("#error").html("*Code not Matched!");
                $("#error").css("color", "red");
            } else {

                $("#error").html("");
                $.ajax({
                    url: "contactus.php",
                    type: "POST",
                    data: {
                        email: email,
                        name: name,
                        message: message
                    },
                    success: function(data) {
                        if (data == 0) {
                            $("#error").html("Thank you for Contacting Us ..Our team will reach you Soon.. ! Redirect in 5 sec..");
                            $("#error").css("color", "green");
                            setTimeout(function() {
                                window.location = "main";
                            }, 5000);

                        } else {
                            $("#error").html("Something went Wrong try Again later.. ");
                            $("#error").css("color", "red");
                        }

                    }



                });

            }

        });




    });
</script>