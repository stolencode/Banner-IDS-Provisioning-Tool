<?php
session_start();

if (isset($_POST['login'])) {
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['password'] = $_POST['password'];
}

$db_username = $_SESSION['username'];
$db_password = $_SESSION['password'];

$db_name = 'quotes_db';
$db_host = 'localhost';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$rcnum = $_POST['rcnum'];
//$approve = $_POST['approve'];


if(isset($_POST['approve'])) {
	$_SESSION['approve'] =	$_POST['approve'];
}

echo $_POST['approve'];


if(isset($_POST['afname'])){
$_SESSION['afname'] =	$_POST['afname'];
}


if(isset($_POST['alname'])){
$_SESSION['alname'] =	$_POST['alname'];
}

$afname = $_POST['afname'];
$alname = $_POST['alname'];
$approve = $_POST['approve'];

echo $approve;

$sql = "UPDATE `quotes` SET `afname` = '".$afname."', `alname` = '".$alname."', `approve` ='".$approve."'  WHERE `quotes`.`rcnum` = ".$rcnum;

if ($conn->query($sql) === TRUE) {

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

$thanks = "thanks.php";
header('Location:'.$thanks);

?>