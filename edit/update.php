<?php
session_start();


$currency = '$'; //Currency Character or code

if (isset($_POST['login'])) {
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['password'] = $_POST['password'];
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



//try to serialize the cart so it can be written to SQL.  All we need to write to the database in order to reconstruct the qhote should be quantity and product.
if(isset($_SESSION["cart_products"])) //check session var
   {


		//$product_qty = $null;
		//$product_code = $null;
		$cart_array = array();
        	$total = 0; //set initial total value		
		foreach ($_SESSION["cart_products"] as $cart_itm)
        {

			$product_qty = $cart_itm["product_qty"];			
			$product_code = $cart_itm["product_code"];
			$product_name = $cart_itm["product_name"];
			$product_price = $cart_itm["product_price"];
			$subtotal = ($product_price * $product_qty);
			$total = ($total + $subtotal);
			array_push($cart_array, $product_qty, $product_code, $product_name, $product_price, $subtotal);

		  }

	}
	$cart = serialize(array($cart_array));

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password,$db_name);	
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE `quotes` SET `fname` = '".$fname."', `lname` = '".$lname."', `email` = '".$email."', `cfname` = '".$cfname."', `clname` = '".$clname."', `cemail` = '".$cemail."', `phone` = '".$phone."', `cphone` = '".$cphone."', `subtsk` = '".$subtsk."', `title` = '".$title."', `cart` = '".$cart."', `total` = '".$total."', `region` = '".$region."'  WHERE `quotes`.`rcnum` = ".$rcnum;

if ($conn->query($sql) === TRUE) {

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>


