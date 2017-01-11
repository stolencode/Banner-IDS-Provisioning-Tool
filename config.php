<?php
$currency = '$'; //Currency Character or code

$db_username = 'www';
$db_password = 'www';
$db_name = 'product_db';
$db_host = 'localhost';

//$shipping_cost      = 1.50; //shipping cost
//$taxes              = array( //List your Taxes percent here.
//                            'VAT' => 12, 
//                            'Service Tax' => 5
//                           );						
//connect to MySql						
$conn = new mysqli($db_host, $db_username, $db_password,$db_name);						
if ($conn->connect_error) {
    die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
}
?>
