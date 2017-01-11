<?php
session_start();
if (isset($_POST['login'])) {
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['password'] = $_POST['password'];
}
else {
	$db_username = 'caaruser';
	$db_password = '';
}

$db_username = $_SESSION['username'];
$db_password = $_SESSION['password'];

$db_name = 'quotes_db';
$db_host = 'localhost';

if(isset($_POST['rcnum'])){
$_SESSION['rcnum'] = $_POST['rcnum'];
}

if(isset($_SESSION['rcnum'])) {
	$rcnum = $_SESSION['rcnum'];
}


if(isset($_POST['subtsk'])){
$_SESSION['subtsk'] = $_POST['subtsk'];
}

if(isset($_SESSION['subtsk'])) {
	$subtsk = $_SESSION['subtsk'];
}


if(isset($_POST['fname'])){
$_SESSION['fname'] = $_POST['fname'];
}

if(isset($_SESSION['fname'])) {
	$fname = $_SESSION['fname'];
}


if(isset($_POST['lname'])){
$_SESSION['lname'] = $_POST['lname'];
}

if(isset($_SESSION['lname'])) {
	$lname = $_SESSION['lname'];
}

if(isset($_POST['phone'])){
$_SESSION['phone'] = $_POST['phone'];
}

if(isset($_SESSION['phone'])) {
	$phone = $_SESSION['phone'];
}

if(isset($_POST['email'])){
$_SESSION['email'] = $_POST['email'];
}

if(isset($_SESSION['email'])) {
	$email = $_SESSION['email'];
}



if(isset($_POST['cfname'])){
$_SESSION['cfname'] = $_POST['cfname'];
}

if(isset($_SESSION['cfname'])) {
	$cfname = $_SESSION['cfname'];
}


if(isset($_POST['clname'])){
$_SESSION['clname'] = $_POST['clname'];
}

if(isset($_SESSION['clname'])) {
	$clname = $_SESSION['clname'];
}

if(isset($_POST['cphone'])){
$_SESSION['cphone'] = $_POST['cphone'];
}

if(isset($_SESSION['cphone'])) {
	$cphone = $_SESSION['cphone'];
}

if(isset($_POST['cemail'])){
$_SESSION['cemail'] = $_POST['cemail'];
}

if(isset($_SESSION['cemail'])) {
	$cemail = $_SESSION['cemail'];
}

if(isset($_POST['title'])){
$_SESSION['title'] = $_POST['title'];
}

if(isset($_SESSION['title'])) {
	$title = $_SESSION['title'];

}

if(isset($_POST['region'])){
$_SESSION['region'] = $_POST['region'];
}

if(isset($_SESSION['region'])) {
	$region = $_SESSION['region'];
}


if(isset($_POST['mfname'])){
$_SESSION['mfname'] = $_POST['mfname'];
}

if(isset($_SESSION['mfname'])) {
	$mfname = $_SESSION['mfname'];
}

if(isset($_POST['mlname'])){
$_SESSION['mlname'] = $_POST['mlname'];
}

if(isset($_SESSION['mlname'])) {
	$mlname = $_SESSION['mlname'];
}

if(isset($_POST['caar'])){
$_SESSION['caar'] = $_POST['caar'];
}

if(isset($_SESSION['caar'])) {
	$caar = $_SESSION['caar'];
}
 
 
// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IT Infrastructure Design and Support Quote Form</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<script src="http://www.w3schools.com/lib/w3data.js"></script>
<script src="jquery-1.12.4.min.js"></script>
<script>var parent = document.getElementById('parent');
var child = document.getElementById('child');
child.style.paddingRight = child.offsetWidth - child.clientWidth + "px";
</script>

</head>
<body background="../images/background.svg">
<p>
<div id="bannermart" class="cart-view-table-front">

<div id="container1">
<div id="container2">
<object data="../images/logo.svg" type="image/svg+xml" class="logo" />
</object>
<h3 align="center">IT Infrastructure Design and Support Quote Database</h3></center>

<?php

$sql = "SELECT id, fname, lname, email, phone, cfname, clname, cemail, cphone, rcnum, subtsk, title, region, cart, total, mfname, mlname, caar FROM quotes WHERE (rcnum = $rcnum) ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc()) {

		echo '<table class="from_db" cellpadding="6" cellspacing="0">';
		echo  '<thead><tr><th colspan="2">'. $row["rcnum"] . "_" . $row["title"] ."</th></tr></thead>";
		echo '<tbody>';
		echo '<tr><td width=250>Preparer Name</td><td width=550>' . $row["fname"]. " " . $row["lname"]. '</td></tr>';
		echo "<tr><td width=250>Preparer Email</td><td width=550>". $row["email"].  "</td></tr>";
		echo "<tr><td width=250>Preparer Phone</td><td width=550>". $row["phone"]. "</td></tr>";
		echo "<tr><td width=250>Customer Name</td><td width=550>". $row["cfname"]. " " . $row["clname"]. "</td></tr>";
		echo "<tr><td width=250>Customer Email</td><td width=550>". $row["cemail"]. "</td></tr>";
		echo "<tr><td width=250>Customer Phone</td><td width=550>". $row["cphone"]. "</td></tr>";
		echo "<tr><td width=250>Request Number</td><td width=550>". $row["rcnum"]. "</td></tr>";
		echo "<tr><td width=250>Subtask Number</td><td>". $row["subtsk"]. "</td></tr>";
		echo "<tr><td width=250>Name Of Request</td><td width=550>". $row["title"]. "</td></tr>";
		echo "<tr><td width=250>Region</td><td>". $row["region"]."</td></tr>";
		echo '<tr><td width=250>Approving Manager</td><td width=550>'. $row["mfname"]. " " . $row["mlname"]. '</td></tr>';
		echo "<tr><td width=250>CAAR</td><td>". $row["caar"]."</td></tr>";

		echo "<tr><td width=250>Cart</td><td>";

		echo '<table class="from_db" cellpadding="6" cellspacing="0" width=350>
			<tr>
				<thead>
					<th>qty</th>
<!--					<th>code</th> -->
					<th>name</th>
					<th>price</th>
					<th>subtotal</th>
				</thead>
			</tr>';

$b = 0; //var for zebra stripe table 

$cart = unserialize($row["cart"]);		

		
echo "<p>";
foreach($cart as $obj) {

	$count = count($obj);

}

		

$a = (int)$count;
(int)$b = 5;
		
		
	$counter = $a / $b;

$i	=	0; //initial value of counter object
$ii	=	0; //other counter





while($ii < $counter){
        

			$bg_color = ($b++%2==1) ? 'odd' : 'even'; //class for zebra stripe.  '%' means modulo division.  basically, if there is no remainder dividing by 2, row class=even, else row class=odd
		   echo '<tr class="'.$bg_color.'">';
			echo "<td>" . $obj[$i] . "</td>";
			$i++; 
			//echo "<td>" . $obj[$i] ."</td>";
			$i++;
			echo "<td>" . $obj[$i] . "</td>";
			$i++;
			echo "<td>" . $obj[$i] . "</td>";
			$i++;
			echo "<td>" . $obj[$i] . "</td><tr>";
			$i++;
			$ii++;
				}
		$bg_color = ($b++%2==1) ? 'odd' : 'even'; //class for zebra stripe 		

	if ($counter % 2 == 0){
		echo '<tr class="odd"><td colspan=2></td><td>Subtotal</td><td>' . $currency . $row["total"] . "</td></tr>";
		$tax = 0;
		//$tax = (($row["total"] * 10)/100 );
		//echo '<tr class="even"><td colspan=2></td><td>markup</td><td>' . $currency . $tax . "</td></tr>";
		echo '<tr class="even"><td colspan=2></td><td>Grand Total</td><td>' . $currency . ($row["total"] + $tax) . "</td></tr>";
        } 
        else 
        {
		echo '<tr class="even"><td colspan=2></td><td><b>Total</b></td><td>' . $currency . $row["total"] . "</td></tr>";
		$tax = 0;
		//$tax = (($row["total"] * 10)/100 );
		//echo '<tr class="odd"><td colspan=2></td><td><b>10% Markup</b></td><td>' . $currency . $tax . "</td></tr>";
		echo '<tr class="odd"><td colspan=2></td><td><b>Grand Total</b></td><td>' . $currency . ($row["total"] + $tax) . "</td></tr>";
        } 
        
		echo "</td></tr>";
		echo "</tbody>";
		echo "</table>";
		echo "<p>";

		}
	 
}

echo '</td>
</tr>

<tr><td colspan="2">

<form method="POST" name="form1" action="update_caar.php">
<table cellpadding="6" cellspacing="0">
<tr><td>';

echo 'Approving Manager</td><td> <input type="text" class="fname" name="mfname" value="'.$mfname.'" placeholder="First Name Here" /><input type="text" class="lname" name="mlname" placeholder="Last name here" value="'.$mlname.'" />'; 
?>
</td></tr>
<tr><td>
CAAR Number</td><td> <input type="text" class="ca" value="CA" readonly />
<?php echo '<input type="number" name="caar" pattern=".{12,12}"  class="caar" value="'.$caar.'" />'; ?> 
<?php if(isset($_POST['carr_err'])){ echo '<span class="error" value="'.$caar_err.'"></span>'; 
}?>

<?php  echo '<input type="hidden" value="'.$rcnum.'" name="rcnum" />'; ?>
<?php  echo '<input type="hidden" value="'.$title.'" name="title" />'; ?>
<?php  echo '<input type="hidden" value="'.$row["fname"].'" name="fname" />'; ?>
<?php  echo '<input type="hidden" value="'.$row["lname"].'" name="lname" />'; ?>
<?php  echo '<input type="hidden" value="'.$row["email"].'" name="email" />'; ?>
<?php  echo '<input type="hidden" value="'.$phone.'" name="phone" />'; ?>
<?php  echo '<input type="hidden" value="'.$cfname.'" name="cfname" />'; ?>
<?php  echo '<input type="hidden" value="'.$clname.'" name="clname" />'; ?>
<?php  echo '<input type="hidden" value="'.$cemail.'" name="cemail" />'; ?>
<?php  echo '<input type="hidden" value="'.$cphone.'" name="cphone" />'; ?>
<?php  echo '<input type="hidden" value="'.$subtsk.'" name="subtsk" />'; ?>
<?php  echo '<input type="hidden" value="'.$region.'" name="region" />'; ?>
<?php  echo '<input type="hidden" value="'.$id.'" name="id" />'; ?>

</td></tr>


<tr><td colspan="2"><center>
<?php
	$current_url = ("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
echo	'<input type="hidden" name="return_url" value="'.$current_url.'" />';
?>


</form>
<input type="submit" class="button" value="Submit CAAR" />
</center>
</td></tr>
</table>
</td></tr>
</table>

</div>
</div>


</html>
<?php
$conn->close();
?>