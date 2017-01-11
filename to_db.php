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

$conn = new mysqli($db_host, $db_username, $db_password,$db_name);						
if ($conn->connect_error) {
    die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
}


$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$email = $_SESSION['email'];
$phone1 = $_SESSION['phone1'];
$phone2 = $_SESSION['phone2'];
$phone3 = $_SESSION['phone3'];

$cfname = $_SESSION['cfname'];
$clname = $_SESSION['clname'];
$cemail = $_SESSION['cemail'];

$cphone1 = $_SESSION['cphone1'];
$cphone2 = $_SESSION['cphone2'];
$cphone3 = $_SESSION['cphone3'];


$subtsk = $_SESSION['subtsk'];
$rcnum = $_SESSION['rcnum'];

$total = $_SESSION['total'];
$title = $_SESSION['title'];
//$quote = $_SESSION['quote'];
$region = $_SESSION['region'];

$notes = $_SESSION['notes'];

$mfname = $null;
$mlname = $null;
$caar = $null;

$openpar = '(';
$closepar = ')';
$dash = '-';

$phone = ($openpar.$phone1.$closepar.$phone2.$dash.$phone3);
$cphone = ($openpar.$cphone1.$closepar.$cphone2.$dash.$cphone3);

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


$conn = new mysqli($db_host, $db_username, $db_password,$db_name);						
if ($conn->connect_error) {
    die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
}
	

$sql = "INSERT INTO `quotes` (`fname`, `lname`, `email`, `phone`, `cfname`, `clname`, `cemail`, `cphone`, `rcnum`, `subtsk`, `title`, `region`, `cart`, `total`, `mfname`, `mlname`, `caar`, `notes`)
VALUES ('$fname', '$lname', '$email', '$phone', '$cfname', '$clname', '$cemail', '$cphone', '$rcnum', '$subtsk', '$title', '$region', '$cart', '$total', '$mfname', '$mlname', '$caar', '$notes')";


if ($conn->query($sql) === TRUE) {

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>