<head><title>Error Page</title>
<style>
   .center {

	height:200px;
	color:red;
	position: absolute;
	border:2px solid green;
	border-radius:5px;
	padding:5px;
	top:0;
	bottom: 0;
	left: 0;
	right: 0;
  	
	margin: auto;
}
</style>
</head>
<?php
require("header.php");
echo '<div class="center">
  <h1 style="text-align:center;">Sorry, the page you were looking for does not exist or is not available</h1>
</div>';
require("footer.php");


?>