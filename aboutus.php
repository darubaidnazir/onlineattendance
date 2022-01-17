<?php
require 'header.php';

?>
<head><title>About us</title></head>
<style>
    .heading{
            font-size: 30px;
            text-align: center;
            margin: 20px;
            color:green;
        }
        .text{
            font-size: 20px;
            margin: 0 auto;
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
    padding:16px;
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

</style>

<body>
   <div>
       
        <hr>
    <div>    
        <p class="heading">
            About Online Attendence
        <p class="text">
            This website was designed by WEB WINGS with the aim to make the task of taking attendence simpler, time saving and convenient for both teachers and students.
            Here both teachers and students are able to get the details of attendence in a very productive way, and all this is possible only because of  better UI and 
            UX provided by our team after taking the interests of both of the groups in consideration. Our team is continuously working to make the experience better day
            by day by taking feedback from users continuously.
        </p>
        </p>
        <p>
            <h4 style="color:red;text-align:center;">Queries related to Online Attendance Platform..?</h4>
            <h4 style="color:red;text-align:center;"> <a class="glow-on-hover" href="contact.php">Contact us</a></h4>
            
        </p>
    </div>
    <hr>
      <div>
        <p class="heading">
            WEB WINGS
        </p>
        <p class="text">
            We welcome you to the platform 'WEB WINGS' where we consistently strive to offer the best for you. This platform has been designed for every enthusiast who is ready
            to share his/her skills and contribute to our platform. 
        </p>
        <p>
            <h4 style="color:red;text-align:center;">Queries related to Web Wings or Join the team ..?</h4>
            <h4 style="color:red;text-align:center;"> <a class="glow-on-hover" href="http://webwings.tech" target="_BLANK">Visit us</a></h4>
            
        </p>
    </div>   
<pre>
    
    
    
    
    
</pre>
<?php
require 'footer.php';
?>