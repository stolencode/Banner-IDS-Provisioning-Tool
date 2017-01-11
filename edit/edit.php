<?php
session_start();
$currency = '$';

if (isset($_POST['login'])){
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

//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit quote <?php echo $rcnum; ?></title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<script src="http://www.w3schools.com/lib/w3data.js"></script>
<script src="jquery-1.12.4.min.js"></script>
<script>
submitForms = function(){
    document.getElementByName["form1"].submit();
    document.getElementByName["form2"].submit();
}

function showDiv() {
   document.getElementById('bannermart').style.display = "block";
}
	
var parent = document.getElementById('parent');
var child = document.getElementById('child');
child.style.paddingRight = child.offsetWidth - child.clientWidth + "px";
</script>



</head>
<body background="../images/background.svg">
<p>
<div class="cart-view-table-front">
<div id="container1">
<div id="container2">
<object data="../images/logo.svg" type="image/svg+xml" class="logo" />
</object>
<h3 align="center">Edit Quote <?php echo $rcnum; ?></h3></center>


<!-- View Cart Box Start -->


<center><input type="submit" name="Shop Now!" class="button" value="Add Items To Cart" onclick="showDiv()" /></center>
<p>
<span><h3>Your Shopping Cart</h3><img src="../images/cart.svg" class="cart"></img></span>

<form method="POST" name="form2" action="redir.php">
<table width="100%"  cellpadding="6" cellspacing="0">
<!-- begin header loop
this loop just sets table headers if the there are items in the cart, since you cant put headers in the foreach loop, or you'd get headers every other row.
-->
<?php 
if ($_SESSION["cart_products"] == $null) {
	echo '</center>this is the original order.  Due to the way SQL tracks quotes, you <i><u>MUST</u></i> create a new cart while editing a quote';
		$header = //if there are items in the cart, the header row is drawn
		'<table width=100% cellpadding="6" cellspacing="0" class="from_db">
				<tr>
					<thead>
						<th>Qty</th>
						<th>Product Code</th>
						<th>Name</th>
						<th>Price</th>
						<th>Subtotal</th>
					</thead>
				</tr>';
	
echo $header; //this draws the table header

//echo '<form method="POST" action="cart_update.php" name="cart_update" />';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);						
if ($conn->connect_error) {
    die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
}

$sql = "SELECT `cart` FROM quotes WHERE (`rcnum` = $rcnum)"; //looks up the quote by rcnum, which is intended as a unique, read only data object

$result = $conn->query($sql); //pipe the query definde by ($sql) to the database connection ($conn) 

if ($result->num_rows > 0) //if the number of rows is greater than zero
		{
	
			while($row = $result->fetch_assoc()) 
			{

				$cart = unserialize($row["cart"]); // this unzips the `cart` string into an array
				//if you echo $cart now, you will get back 'array' as the result.  you can var_dump($cart) though
				//var_dump($cart);
				
				foreach($cart as $obj) 
					{
						$count = count($obj); //counts the number of objects in the array.  this array contains 5 columns
					}//close of foreach loop

				(int)$a = $count; //a is the total number of objects
				(int)$b = 5;// b is the number of columns per row.  to perform division with PHP, these must be integers.  By dividing the total number of objects by the number of columns, we can find the number of rows
		
				$counter = $a / $b; //a over b = number of rows

				$i	=	0; // i is the object counter, incremented once per array object (once per column)
				$ii	=	0; // ii is the row counter, only incremented once per loop iteration (once per row)

				
				
				
				while($ii < $counter)
				{

					$bg_color = ($b++%2==1) ? 'odd' : 'even'; //class for zebra stripe 
					echo '<tr class="'.$bg_color.'">';
					echo '<td>'. $obj[$i] .'</td>';
					$i++;//column increment
					echo '<td>'. $obj[$i] .'</td>'; //this is $product_code
					$i++;//column increment
					echo "<td>" . $obj[$i] . "</td>";
					$i++;//column increment
					echo "<td>" . $obj[$i] . "</td>";
					$i++;//column increment
					echo "<td>" . $obj[$i] . "</td>";
					$i++; //column increment
					$ii++;//row increment
					$x = ($i - 4);
				}
				
			} // close of while loop
			

		} //close of if loop
echo '</tr></table>';

	
	$header = $null;
	
	
}
else {
	$header = "<thead><tr><th>Quantity</th><th>Product</th><th>Remove</th></tr></thead>";
}
	
echo $header ?>
<!-- end header loop-->
	<tbody>

	<!-- begin cart table loop
	This loop populates the table with items you select from the "Add Items To Cart" div (aka #bannermart)
	-->
	<?php
	$total =0; //sets initial total value to zero
	$b = 0; //initial value for zebra striping table rows

	foreach ($_SESSION["cart_products"] as $cart_itm)
	{
		$product_name = $cart_itm["product_name"];
		$product_qty = $cart_itm["product_qty"];
		$product_price = $cart_itm["product_price"];
		$product_code = $cart_itm["product_code"];
		$product_type = $cart_itm["product_type"];
		$bg_color = ($b++%2==1) ? 'odd' : 'even'; //zebra stripe
		echo '<tr class="'.$bg_color.'">';
		echo '<td>Qty <input type="text" size="2" maxlength="2" name="product_qty['.$product_code.']" value="'.$product_qty.'" /></td>';
		echo '<td>'.$product_name.'</td>';
		echo '<td><input type="checkbox" name="remove_code[]" value="'.$product_code.'" /> Remove</td>';
		echo '</tr>';
		$subtotal = ($product_price * $product_qty);
		$total = ($total + $subtotal);
		

	}
		if ($_SESSION["cart_products"] == $null)  {
		echo '<div class="overlay"></div>
		<div id="emptycart"  style="background-color: #F5F5F5; border-radius: 5px;" /><center><h4 class="w3-animate-fading">Your cart is empty... Click "Add Items To Cart"</h4></center></div>';
		}
?>
<td colspan="4">

<center>

<input type="submit" value="Update Cart" name="updatecart" class="button" />

<?php
	$current_url = ("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
echo	'<input type="hidden" name="return_url" value="'.$current_url.'" />';
?>
</form>
	</center></td>
	</tbody>
	</table>

<!-- View Cart Box End -->

<!-- form field begin -->	

<form action="redir.php" method="POST" name="form1" />
<?php
	$current_url = ("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
echo	'<input type="hidden" name="return_url" value="'.$current_url.'" />';
?>
<table style="margin: 0 auto;">
<tr><td width=150>Preparer Name</td><td width=550><input type="text" class="fname" name="fname" placeholder="Your first name here" value="<?php echo $fname; ?>" /><input type="text" class="lname"  name="lname" placeholder="Your Last Name Here" value="<?php echo $lname; ?>" /></td></tr>
<tr><td width=150>Preparer Email</td><td width=550><input type="text" class="form1"   name="email" placeholder="Your Email Address Here" value="<?php echo $email; ?>" /></td></tr>
<tr><td width=150>Preparer Phone Number</td><td width=550><input type="text" name="phone"  value="<?php echo $phone; ?>" /></td></tr>
<tr><td width=150>Customer Name</td><td width=550><input type="text" class="fname"  name="cfname" placeholder="Customer First Name" value="<?php echo $cfname; ?>" /><input type="text" class="lname"  name="clname" placeholder="Customer Last Name"  value="<?php echo $clname; ?>" /></td></tr>
<tr><td width=150>Customer Email</td><td width=550><input type="text" class="form1"   name="cemail" placeholder="Customer Email Address Here" value="<?php echo $cemail; ?>" /></td></tr>
<tr><td width=150>Customer Phone Number</td><td width=550><input type="text" name="cphone"  value="<?php echo $cphone; ?>" /></td></tr>
<tr><td width=150>Request Number</td><td width=550><input type="text" class="form1" name="rcnum" placeholder="Request Center Number Here" value="<?php echo $rcnum; ?>" /></td></tr>
<tr><td width=150>Subtask Number</td><td width=550><input type="text" class="form1"  name="subtsk" placeholder="Request Center Subtask Here" value="<?php echo $subtsk; ?>" readonly /></td></tr>
<tr><td width=150>Name Of Request</td><td width=550><input type="text" class="form1"  name="title" placeholder="Name of Request, eg; Quote for 2 Citrix servers" value="<?php echo $title; ?>" /></td></tr>
<tr><td width=150>Budgetary Quote</td><td width=550><input type="checkbox" class="form1"  name="quote" value="<?php echo $quote; ?>" checked /></td></tr>
<tr><td width=150>Region</td><td width=550>
<table width="400px">
	<tr><td width=33%><input <?php if ($region=='phx'){ echo 'checked="checked"';} ?> type="radio" value="phx" name="region">Phoenix
	</td>
	<td width=33%><input <?php if ($region=='tus'){ echo 'checked="checked"';} ?> type="radio" value="tus" name="region">Tucson
	</td>
	<td width=33%><input <?php if ($region=='wr'){ echo 'checked="checked"';} ?> type="radio" value="wr" name="region">Western Region
	</td></tr>
</table>
</td></tr>
	<tr><td colspan="2">
<center>


<table>
	<tr>
		<td>
			<input type="submit" value="Commit Changes" name="form1" class="button" />
			</form>
		</td>
		<td>
<?php 
		if($Err != "is required"){
echo	'<form action="view_cart.php" method="POST">
			<input type="submit" value="Checkout" class="button" onclick="submitForms()" /></center>
		</form>';
		}
		else {
}
		?>
		</td>
	</tr>
</table>

</center></td></tr> 
</table>

		</div>
	</div>
</div>

<!-- end form field -->	

<!-- Products List Start -->

<div id="bannermart" style="display:none;" class="cart-view-table-float w3-animate-top">
<div id="container1">
<div id="container2">
	<form method="post" action="redir.php">
<?php
	$current_url = ("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
echo	'<input type="hidden" name="return_url" value="'.$current_url.'" />';
?>
	<input type="submit" class="close" value="×" />
	</form>
<object data="../images/cart.svg" type="image/svg+xml" style="display: block; margin: auto;" />
</object>

<h3 align="center">BannerMart</h3>

<?php
$db_name = "product_db";
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);						
if ($conn->connect_error) {
    die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
}


$results = $conn->query("SELECT product_code, product_name, product_desc, product_img_name, price FROM products ORDER BY id ASC");
if($results){ 
$products_item = '<ul class="products">';
//fetch results set as object and output HTML
while($obj = $results->fetch_object())
{
$products_item .= <<<EOT
	<li class="product">
	<form method="post" action="redir.php">
	<div class="product-content"><h3>{$obj->product_name}</h3>
	<div class="product-thumb"><img src="../images/{$obj->product_img_name}" class="resize"></div>

	<div class="product-info">
	<div class="product-desc">{$obj->product_desc}</div>
	Price {$currency}{$obj->price} 
	<fieldset>
	<label>
		<span>Quantity</span>
		<input type="text" size="2" maxlength="4" name="product_qty" value="1" />
	</label>
	</fieldset>
	<input type="hidden" name="product_code" value="{$obj->product_code}" />
	<input type="hidden" name="type" value="add" />
	<input type="hidden" name="return_url" value="{$current_url}" />
	<div align="left"><button type="submit" class="add_to_cart" />Add</button></div>
	</div>

	</form>
	</li>
EOT;

}

$products_item .= '</ul>';
echo $products_item;
}

?>    
</div>
</div>
</div>

<!-- Products List End -->

</div>
</div>
</div>
	
</html>