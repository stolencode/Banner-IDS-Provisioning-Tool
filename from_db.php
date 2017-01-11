<?php
$servername = "localhost";
$username = "www";
$password = "www";
$dbname = "quotes_db";

$rcnum = 1770798;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
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
<link href="style/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<script src="http://www.w3schools.com/lib/w3data.js"></script>
<script src="jquery-1.12.4.min.js"></script>
<script>var parent = document.getElementById('parent');
var child = document.getElementById('child');
child.style.paddingRight = child.offsetWidth - child.clientWidth + "px";
</script>

</head>
<body background="images/background.svg">
<p>
<div id="bannermart" class="cart-view-table-front">

<div id="container1">
<div id="container2">
<object data="images/logo.svg" type="image/svg+xml" class="logo" />
</object>
<h3 align="center">IT Infrastructure Design and Support Quote Database</h3></center>

<?php
$sql = "SELECT id, fname, lname, email, phone, cfname, clname, cemail, cphone, rcnum, subtsk, title, region, cart, total FROM quotes WHERE (rcnum = $rcnum) ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc()) {
		
		echo '<table class="from_db">';
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

		echo "<tr><td width=200>Cart</td><td>";

		echo "<table width=400>
			<tr>
				<thead>
					<th>qty</th>
					<th>code</th>
					<th>name</th>
					<th>price</th>
					<th>subtotal</th>
				</thead>
			</tr>";

$b = 0; //var for zebra stripe table 

//$cart = ($row["cart"]);


//echo $cart;



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
			echo "<td>" . $obj[$i] ."</td>";
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

		echo '<tr class="'.$bg_color.'"><td colspan=3></td><td>Subtotal</td><td>' . $row["total"] . "</td></tr>";
		$tax = (($row["total"] * 10)/100 );
		
		echo '<tr class="'.$bg_color.'"><td colspan=3></td><td>markup</td><td>' . $tax . "</td></tr>";
				echo '<tr class="'.$bg_color.'"><td colspan=3></td><td>Grand Total</td><td>' . ($row["total"] + $tax) . "</td></tr>";
        echo "</table>";
		echo "</td></tr>";
		echo "</tbody>";
		echo "</table>";
		echo "<p>";
		}
		
		
	 
}
$conn->close();
?>

<form method="POST" action="update_caar.php">

Approving Manager: <input type="text" class="fname" name="mfname" placeholder="First name Here" /><input type="text" class="lname" name="mlname" placeholder="Last name here" />
<p>
CAAR Number: <input type="text" value="CA" readonly /><input type="number" name="caar" placeholder="012345678901" />

<p>
<input type="submit" class="button" value="Submit CAAR" name="caar" />

</div>
</div>
</html>