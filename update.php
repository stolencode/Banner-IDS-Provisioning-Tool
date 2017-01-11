<?php
session_start();


$currency = '$'; //Currency Character or code

if (isset($_POST['login'])) {
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['password'] = $_POST['password'];
}

$db_username = $_SESSION['username'];
$db_password = $_SESSION['password'];

echo $db_username;

$db_name = 'quotes_db';
$db_host = 'localhost';



$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$cfname = $_POST['cfname'];
$clname = $_POST['clname'];
$cemail = $_POST['cemail'];

$cphone = $_POST['cphone'];
$rcnum = $_POST['rcnum'];
$subtsk = $_POST['subtsk'];

$title = $_POST['title'];
$quote = $_POST['quote'];
$region = $_POST['region'];

$id = $_POST['id'];


$db_name = 'quotes_db';
// Create connection
$conn = new mysqli($db_host, $db_username, $db_password,$db_name);	
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE `quotes` SET `fname` = '".$fname."', `lname` = '".$lname."', `email` = '".$email."', `cfname` = '".$cfname."', `clname` = '".$clname."', `cemail` = '".$cemail."', `phone` = '".$phone."', `cphone` = '".$cphone."', `subtsk` = '".$subtsk."', `title` = '".$title."', `region` = '".$region."'  WHERE `quotes`.`id` = ".$id;

if ($conn->query($sql) === TRUE) {

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>


<?php
    mysql_connect("$db_hostname", "$db_username", "$db_password") or die("Error connecting to database: ".mysql_error());     
    mysql_select_db("quotes_db") or die(mysql_error());

	$currency = "$";
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

<center>
    <form action="search.php" method="GET">
        <input type="text" name="query" class="query" />
        <input type="submit" value="Search" class="button" />
    </form>
</center>

<?php
    $query = $_GET['query']; 
    // gets value sent over search form
     
    $min_length = 2;
    // query if you want
     
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysql_real_escape_string($query);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysql_query("SELECT * FROM quotes WHERE 
        (`fname` LIKE '%".$query."%') 
        OR (`lname` LIKE '%".$query."%')
        OR (`email` LIKE '%".$query."%')
        OR (`phone` LIKE '%".$query."%')
        OR (`cfname` LIKE '%".$query."%')
        OR (`clname` LIKE '%".$query."%')
        OR (`cemail` LIKE '%".$query."%')
        OR (`cphone` LIKE '%".$query."%')
        OR (`rcnum` LIKE '%".$query."%')
        OR (`subtsk` LIKE '%".$query."%')
        OR (`region` LIKE '%".$query."%')
        OR (`title` LIKE '%".$query."%')
        OR (`total` LIKE '%".$query."%')
        OR (`add_time` LIKE '%".$query."%')") 
        or die(mysql_error());
             
 // you will be able to search pretty much anything that is in the database.  Pretty clever!
          
        if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following
             
            while($results = mysql_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
             
                echo "<p><h3>".$results['rcnum'] . " " . $results['title']. "</h3>";
  $sql = "SELECT id, fname, lname, email, phone, cfname, clname, cemail, cphone, rcnum, subtsk, title, region, cart, total FROM quotes ORDER BY id DESC";
 echo '<table class="from_db" cellpadding="6" cellspacing="0">';
		echo  '<thead><tr><th colspan="2">'. $results["rcnum"] . "_" . $results["title"] ."</th></tr></thead>";
		echo '<tbody>';
		echo '<tr><td width=250>Preparer Name</td><td width=550>' . $results["fname"]. " " . $results["lname"]. '</td></tr>';
		echo "<tr><td width=250>Preparer Email</td><td width=550>". $results["email"].  "</td></tr>";
		echo "<tr><td width=250>Preparer Phone</td><td width=550>". $results["phone"]. "</td></tr>";
		echo "<tr><td width=250>Customer Name</td><td width=550>". $results["cfname"]. " " . $results["clname"]. "</td></tr>";
		echo "<tr><td width=250>Customer Email</td><td width=550>". $results["cemail"]. "</td></tr>";
		echo "<tr><td width=250>Customer Phone</td><td width=550>". $results["cphone"]. "</td></tr>";
		echo "<tr><td width=250>Request Number</td><td width=550>". $results["rcnum"]. "</td></tr>";
		echo "<tr><td width=250>Subtask Number</td><td>". $results["subtsk"]. "</td></tr>";
		echo "<tr><td width=250>Name Of Request</td><td width=550>". $results["title"]. "</td></tr>";
		echo "<tr><td width=250>Region</td><td>". $results["region"]."</td></tr>";
		
		echo '<tr><td colspan="2">';

		echo '<table width=100% cellpadding="6" cellspacing="0" class="from_db">
			<tr>
				<thead>
					<th>Qty</th>
					<th>Product Code</th>
					<th>Name</th>
					<th>Price</th>
					<th>Subtotal</th>
				</thead>
			</tr>';

$b = 0; //var for zebra stripe table 

//$cart = ($row["cart"]);


//echo $cart;



$cart = unserialize($results["cart"]);		

		
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
        

			$bg_color = ($b++%2==1) ? 'odd' : 'even'; //class for zebra stripe 
		    echo '<tr class="'.$bg_color.'">';

			echo "<td>" . $obj[$i] . "</td>";
			$i++; 
				
			echo "<td>" . $obj[$i] ."</td>";
			$i++;
			echo "<td>" . $obj[$i] . "</td>";
			$i++;
			echo "<td>" . $currency . $obj[$i] . "</td>";
			$i++;
			echo "<td>" . $currency. $obj[$i] . "</td><tr>";
			$i++;
			$ii++;
				}
				

if ($counter % 2 == 0){
		echo '<tr class="odd"><td colspan=3></td><td>Subtotal</td><td>' . $currency . $results["total"] . "</td></tr>";
		$tax = (($results["total"] * 10)/100 );
		echo '<tr class="even"><td colspan=3></td><td>markup</td><td>' . $currency . $tax . "</td></tr>";
		echo '<tr class="odd"><td colspan=3></td><td>Grand Total</td><td>' . $currency . ($results["total"] + $tax) . "</td></tr>";
        } 
        else 
        {
		echo '<tr class="even"><td colspan=3></td><td><b>Total</b></td><td>' . $currency . $results["total"] . "</td></tr>";
		$tax = (($results["total"] * 10)/100 );
		echo '<tr class="odd"><td colspan=3></td><td><b>10% Markup</b></td><td>' . $currency . $tax . "</td></tr>";
		echo '<tr class="even"><td colspan=3></td><td><b>Grand Total</b></td><td>' . $currency . ($results["total"] + $tax) . "</td></tr>";
        } 
        
        echo "</table>";
		echo "</td></tr>";

		$rcnum = $results["rcnum"];
		echo '<tr><td colspan="2"><form action="edit.php" method="POST" name="edit" />
		<input type="hidden" value="'. $rcnum .'" name="rcnum" />
		<input type="submit" value="Edit Quote" class="button" ></form></td></tr>';
		echo "</tbody>";
		     
		
		echo "</table>";

		echo "<p>";
}
		

             
        }
        else{ // if there is no matching rows do following
            echo "<center>No results</center>";
        }
         
    }
    else{ // if query length is less than minimum
        echo "<center><div width=500px>
        	Search anything!</center>
       			<ul>
       				<li><b>Minimum Length</b> - minimum query length is ".$min_length." characters.  Special characters like $ or & are illegal.</li>
       				<li><b>Case Insensitive</b> - Queries are case insensitive</li>
       				<li><b>Wild Cards</b> - the wild card for queries is '%'.<br>
       				<i>eg; 177% may return all request center numbers beginning in 177</i></li>
       				<li><b>Request Center</b> - this is the <u>preferred</u> method for tracking quotes</li>
       				<li><b>Subtask</b> - where applicable, this is also the most appropriate search term</li>
       				<li> <b>Date</b> - To search by date the format is 'YYYY-MM-DD'.
       				<br><i>eg; searching '2016-10' will return all quotes generated in October '16.</i></li>
       				<li><b>Name</b> - any person's name attached to any quote can be queried</li>
       				<li><b>Email</b> - any email address on any quote can be queried</li>
       				<li><b>Phone</b> - any phone number, or any <i>part</i> of any phone number. <br>
       				<i>eg; you don't remember the number, but you know if was from Mesa, you could search '480'</i></li>
       				<li><b>Title</b> - you can search any word or phrase in any quote title.<br>
       				<i>eg; 'Cerner' will return a list of all quotes with 'cerner' in the title</i></li>
       				<li><b>Total</b> - Not terribly useful, but if you know the exact dollar amount, totals are searchable</li>
       				</ul>
       				</div>
       				</center>";

       				
       				
    }
?>
</body>
</html>