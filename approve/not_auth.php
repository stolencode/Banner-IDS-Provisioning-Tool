<?php
session_start();
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
<h3 align="center">Warning!</h3></center>
<center>
You are not authorized to submit approvals.  If the matter is urgent, please contact your immediate supervisor.
</center>
</div>
</div>
</div>
</body>
</html>



<?php
session_destroy();
header('Refresh: 3;url=../index.php');
?>