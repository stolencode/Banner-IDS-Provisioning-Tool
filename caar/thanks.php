<?php
session_start();
include_once("send_form_email.php");


?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IT Infrastructure Design and Support Quote Form</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
</head>
<body background="../images/background.svg">
<p>
<div class="cart-view-table-back" id="view-cart">
<div id="container1">
<div id="container2">
<object data="../images/logo.svg" type="image/svg+xml" class="logo" />
</object>
<h3 align="center">CAAR has been updated!</h3></center>
<center>
Thank you for using the IT Infrastructure Design and Support Budgetary Quote tool.  Your request has been received.  You will be notified when funding has been approved and the request is ready for deployment.
</center>
</div>
</div>
</div>

<?php
//echo '<pre>';
//var_dump($_POST);
//echo '</pre>';
?>

</body>
</html>



<?php
header('Refresh: 3;url=../index.php');
?>