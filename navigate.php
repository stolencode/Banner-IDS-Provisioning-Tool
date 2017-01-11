<?php
session_start(); //makes $_SESSION available on this page

if (isset($_POST['login'])) {
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['password'] = $_POST['password'];
}

$db_username = $_SESSION['username'];
$db_password = $_SESSION['password'];
$db_name = 'product_db';
$db_host = 'localhost';


$conn = new mysqli($db_host, $db_username, $db_password, $db_name);						
if ($conn->connect_error) {
    die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
}


$can_approve = array('ldevereux','rbest','tclavell','ddouillard','jengel','rcuda');

if($_SESSION['username'] == 'rcuda') {
$afname = 'Ryan';
$alname = 'Cuda';
}
if($_SESSION['username'] == 'tclavell') {
$afname = 'Troy';
$alname = 'Clavell';
}
if($_SESSION['username'] == 'ldevereux') {
$afname = 'Liz';
$alname = 'Devereux';
}
if($_SESSION['username'] == 'jengel') {
$afname = 'Jade';
$alname = 'Engel';
}
if($_SESSION['username'] == 'ddouillard') {
$afname = 'Doug';
$alname = 'Douillard';
}
if($_SESSION['username'] == 'rbest') {
$afname = 'Rich';
$alname = 'Best';
}


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IT Infrastructure Design and Support Quote Form</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
<link href="style/circle.css" rel="stylesheet" type="text/css" />		
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript" ></script>
<script type="text/javascript">
			$(document).ready(function(){
			var items = document.querySelectorAll('.circleNavi a');
			for(var i = 0, l = items.length; i < l; i++) {
			  items[i].style.left = (52 - 35*Math.cos(-0.5 * Math.PI - 2*(1/l)*i*Math.PI)).toFixed(4) + "%";
			  
			  items[i].style.top = (52 + 35*Math.sin(-0.5 * Math.PI - 2*(1/l)*i*Math.PI)).toFixed(4) + "%";
			}
			document.querySelector('.navbtn').onclick = function(e) {
			   e.preventDefault(); document.querySelector('.circleNavi').classList.toggle('open');
			}
			})(jQuery);
</script>
</head>
<body background="images/background.svg">

<div class="cart-view-table-front" id="view-cart">

<object data="images/logo.svg" type="image/svg+xml" class="logo" />
</object>
<h3 align="center">Navigation Menu</h3></center>
			<section class="contentSection">
                <nav class="CircularNavigation">
                  <div class="circleNavi">
                    <a href="search/search.php" class="svg"><p class="fa search"><object data="images/search.svg" type="image/svg+xml" class="search" /></object><div class="quote">search quotes</div></p></a>
<?php
if ($db_username == 'caaruser') {
echo '<a href="not_auth.php" class="svg"><p class="fa quotes"><object data="images/quotes.svg" type="image/svg+xml" class="quotes" /></object><div class="quote">generate <br>a quote</div></p></a>';
}
else {
echo '<a href="welcome.php" class="svg"><p class="fa quotes"><object data="images/quotes.svg" type="image/svg+xml" class="quotes" /></object><div class="quote">generate <br>a quote</div></p></a>';

}
?>

<?php
if ($db_username == 'caaruser') {
	echo '<a href="edit/not_auth.php" class="svg"><p class="fa edit"><object data="images/edit.svg" type="image/svg+xml" class="edit" /></object><div class="quote">edit a<br> quote</div></p></a>';
	}                    
else {
	echo '<a href="edit/search.php" class="svg"><p class="fa edit"><object data="images/edit.svg" type="image/svg+xml" class="edit" /></object><div class="quote">edit a<br> quote</div></p></a>';
	}
?>	                  
<a href="caar/search.php" class="svg"><p class="fa fund"><object data="images/fund.svg" type="image/svg+xml" class="fund" /></object><div class="quote">enter <br>caar</div></p></a>

<?php 
if (in_array($db_username, $can_approve)) {
echo                     '<a href="approve/search.php" class="svg"><p class="fa home"><object data="images/approve.svg" type="image/svg+xml" class="home" /></object><div class="quote"><br>Approve</div></p></a>';                   
}
else {
	echo '<a href="approve/not_auth.php" class="svg"><p class="fa home"><object data="images/approve.svg" type="image/svg+xml" class="home" /></object><div class="quote"><br>Approve</div></p></a>';
}
?>	


					<a href="http://intranet.bannerhealth.com" class="svg"><p class="fa home"><object data="images/home.svg" type="image/svg+xml" class="home" /></object><div class="quote"><br>Home</div></p></a>  					
					
					<a href="dashboard/dashboard.php" class="svg"><p class="fa home"><object data="images/dashboard.svg" type="image/svg+xml" class="home" /></object><div class="quote">Dash<br>Board</div></p></a>  
                  </div>
                  <a href="" class="navbtn svg"><p class="fa hamburger"><object data="images/hamburgermenu.svg" type="image/svg+xml" class="hamburger" /></object></p></a>
                </nav>
			</section>

</div>
	</body>
</html>