<?php
session_start();


$currency = '$'; //Currency Character or code

if (isset($_POST['login'])) {
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['password'] = $_POST['password'];
}

$db_username = $_SESSION['username'];
$db_password = $_SESSION['password'];
$db_name = 'product_db';
$db_host = 'localhost';

$conn = new mysqli($db_host, $db_username, $db_password,$db_name);						
if ($conn->connect_error) {
    die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
}
 
 //add product to session or create new one
if(isset($_POST["type"]) && $_POST["type"]=='add' && $_POST["product_qty"]>0)
{
	foreach($_POST as $key => $value){ //add all post vars to new_product array
		$new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING);
    }
	//remove unecessary vars
	unset($new_product['type']);
	unset($new_product['return_url']); 
	
 	//we need to get product name and price from database.
    $statement = $conn->prepare("SELECT product_name, price FROM products WHERE product_code=? LIMIT 1");
    $statement->bind_param('s', $new_product['product_code']);
    $statement->execute();
    $statement->bind_result($product_name, $price);
	
	while($statement->fetch()){
		
		//fetch product name, price from db and add to new_product array
        $new_product["product_name"] = $product_name; 
        $new_product["product_price"] = $price;
        
        if(isset($_SESSION["cart_products"])){  //if session var already exist
            if(isset($_SESSION["cart_products"][$new_product['product_code']])) //check item exist in products array
            {
                unset($_SESSION["cart_products"][$new_product['product_code']]); //unset old array item
            }           
        }
        $_SESSION["cart_products"][$new_product['product_code']] = $new_product; //update or create product session with new item  
    } 
}


//update or remove items 
if(isset($_POST["product_qty"]) || isset($_POST["remove_code"]))
{
	//update item quantity in product session
	if(isset($_POST["product_qty"]) && is_array($_POST["product_qty"])){
		foreach($_POST["product_qty"] as $key => $value){
			if(is_numeric($value)){
				$_SESSION["cart_products"][$key]["product_qty"] = $value;
			}
		}
	}
	//remove an item from product session
	if(isset($_POST["remove_code"]) && is_array($_POST["remove_code"])){
		foreach($_POST["remove_code"] as $key){
			unset($_SESSION["cart_products"][$key]);
		}	
	}
}



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
$return_url = "edit.php"; //return url
header('Location:'.$return_url);
?>