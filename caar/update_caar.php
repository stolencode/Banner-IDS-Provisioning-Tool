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
$caar = $_POST['caar'];


if(isset($_POST['mfname'])){
$_SESSION['mfname'] =	$_POST['mfname'];
}

if(isset($_POST['mlname'])){
$_SESSION['mlname'] =	$_POST['mlname'];
}

$mfname = $_POST['mfname'];
$mlname = $_POST['mlname'];

$sql = "UPDATE `quotes` SET `mfname` = '".$mfname."', `mlname` = '".$mlname."', `caar` = '".$caar."'  WHERE `quotes`.`rcnum` = ".$rcnum;

if ($conn->query($sql) === TRUE) {

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

if (strlen($mfname) < 1 ) {
	$_SESSION['mfname_err'] = "First Name Required";
	$return_url = (isset($_POST["return_url"]))?urldecode($_POST["return_url"]):''; //return url
	header('Location:'.$return_url);
	}

if(strlen($caar) != 12) {

$_SESSION['carr_err'] = "Must be 12 digits!";

$return_url = (isset($_POST["return_url"]))?urldecode($_POST["return_url"]):''; //return url
header('Location:'.$return_url);
}

else 
{
	$thanks = "thanks.php";
	header('Location:'.$thanks);
}

?>