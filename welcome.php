<?php
session_start(); //makes $_SESSION available on this page

$currency = '$'; //Currency Character or code

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




// this block is to allow form fields to persist by posting to session
if (isset($_POST['form1'])) {
	$_SESSION['fname'] = $_POST['fname'];
	$_SESSION['lname'] = $_POST['lname'];
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['phone1'] = $_POST['phone1'];		
	$_SESSION['phone2'] = $_POST['phone2'];
	$_SESSION['phone3'] = $_POST['phone3'];
	$_SESSION['cfname'] = $_POST['cfname'];
	$_SESSION['clname'] = $_POST['clname'];
	$_SESSION['cemail'] = $_POST['cemail'];	
	$_SESSION['cphone1'] = $_POST['cphone1'];		
	$_SESSION['cphone2'] = $_POST['cphone2'];
	$_SESSION['cphone3'] = $_POST['cphone3'];
	$_SESSION['rcnum'] = $_POST['rcnum'];
	$_SESSION['title'] = $_POST['title'];
	$_SESSION['subtsk'] = $_POST['subtsk'];
	$_SESSION['quote'] = $_POST['quote'];	
	$_SESSION['region'] = $_POST['region'];
	$_SESSION['notes'] = $_POST['notes'];
}

$region = "";
if (isset($_SESSION['region'])) {
	$region = $_SESSION['region'];
}


//these vars are for setting proper file permissions to the directory where PDFs are written.  
//If the directory is not owned by user 'www' and group 'www' (the service account Apache runs under) writes will fail
//outdir also needs to be RW. 0777 is overkill, but it's writing to a CIFS share which can cause goofyness.

//outdir block
$user = "www";
$group = "www";
$colon = ":";
$chown = ($user.$colon.$group);
$outdir = '/media/quotes';
$year = date(Y);
$month = date(mM);
$newdir = '/';

//creates directories
mkdir($outdir.$newdir.$year.$newdir);
mkdir($outdir.$newdir.$year.$newdir.$month.$newdir);
//sets ownership of new directories to 'www:www'
chown($outdir.$newdir.$year.$newdir, $chown);
chown($outdir.$newdir.$year.$newdir.$month.$newdir, $chown);
//sets file permissions of new directories to RW all
chown($outdir.$newdir.$year.$newdir, 0777);
chown($outdir.$newdir.$year.$newdir.$month.$newdir, 0777);
//end outdir block

//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

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
<script>
submitForms = function(){
    document.getElementByName["form1"].submit();
    document.getElementByName["form2"].submit();
}

function showDiv() {
   document.getElementById('bannermart').style.display = "block";
}
		
</script>
</head>
<body background="images/background.svg">


<!-- View Cart Box Start -->

<p>

<div class="cart-view-table-front" id="view-cart">
<div id="container1">
<div id="container2">
<object data="images/logo.svg" type="image/svg+xml" class="logo" />
</object>
<h3 align="center">IT Infrastructure Design and Support Quote Form</h3></center>
<center><input type="submit" name="Shop Now!" class="button" value="Add Items To Cart" onclick="showDiv()" /></center>
<p>
<span><h3>Your Shopping Cart</h3><img src="images/cart.svg" class="cart"></img></span>

All server pricing has been cost averaged to reflect an initial build starting point below the maximum vCPU and vRAM.  While working with all application owners these servers will be monitored and adjusted accordingly to provide the proper performance to the application while keeping over provisioning of resource at a minimum.  This should provide benefits to our customers and IT’s budget.


<form method="POST" name="form2" action="cart_update.php">
<table width="100%"  cellpadding="6" cellspacing="0">
<!-- begin header loop
this loop just sets table headers if the there are items in the cart, since you cant put headers in the foreach loop, or you'd get headers every other row.
-->
<?php 
if ($_SESSION["cart_products"] == $null) {
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
<?php
// define variables and set to empty values
$Err = $fnameErr = $lnameErr = $emailErr = $cfnameErr = $clnameErr = $cemailErr = $phoneErr = $cphoneErr = $rcnumErr = "";


if (isset($_POST['form1'])) {
	if(empty($_SESSION['fname'])){
	$Err = "is required";
	$fnameErr = "First name ";
	$andErr = " & ";
	} 	
}	
if (isset($_POST['form1'])) {
	if(empty($_SESSION['lname'])){
	$Err = "is required";
	$lnameErr = "Last name ";
	} 	
}	
if (isset($_POST['form1'])) {
	if(empty($_SESSION['email'])){
	$Err = "is required";
	$emailErr = "Email ";
	} 	
}	

if (isset($_POST['form1'])) {
	if(empty($_SESSION['phone1'])){
	$Err = "is required";
	$phoneErr = "Phone ";
	} 	
}	
if (isset($_POST['form1'])) {
	if(empty($_SESSION['phone2'])){
	$Err = "is required";
	$phoneErr = "Phone ";
	} 	
}	
if (isset($_POST['form1'])) {
	if(empty($_SESSION['phone3'])){
	$Err = "is required";
	$phoneErr = "Phone ";
	} 	
}	


if (isset($_POST['form1'])) {
	if(empty($_SESSION['cfname'])){
	$Err = "is required";
	$cfnameErr = "First name ";
	$candErr = " & ";
	} 	
}	
if (isset($_POST['form1'])) {
	if(empty($_SESSION['clname'])){
	$Err = "is required";
	$clnameErr = "Last name ";
	} 	
}	
if (isset($_POST['form1'])) {
	if(empty($_SESSION['cemail'])){
	$Err = "is required";
	$cemailErr = "Email ";
	} 	
}	

if (isset($_POST['form1'])) {
	if(empty($_SESSION['cphone1'])){
	$Err = "is required";
	$cphoneErr = "Phone ";
	} 	
}	
if (isset($_POST['form1'])) {
	if(empty($_SESSION['cphone2'])){
	$Err = "is required";
	$cphoneErr = "Phone ";
	} 	
}	
if (isset($_POST['form1'])) {
	if(empty($_SESSION['cphone3'])){
	$Err = "is required";
	$cphoneErr = "Phone ";
	} 	
}	

if (isset($_POST['form1'])) {
	if(empty($_SESSION['rcnum'])){
	$Err = "is required";
	$rcnumErr = "Request Center ";
	} 	
}	

if (isset($_POST['form1'])) {
	if(empty($_SESSION['rcnum'])){
	$Err = "is required";
	$titleErr = "Title ";
	} 	
}

if (isset($_POST['form1'])) {
	if(empty($_SESSION['region'])){
	$Err = "is required";
	$regionErr = "Region ";
	} 	
}


?>

<style>
.error {color: #FF0000;}
</style>

<form action="welcome.php" method="POST" name="form1" />
<table style="margin: 0 auto;">
<tr><td width=150>Preparer Name</td><td width=550><input type="text" class="fname" name="fname" placeholder="Your first name here" value="<?php echo isset($_SESSION['fname']) ? $_SESSION['fname'] : ''; ?>" /><input type="text" class="lname"  name="lname" placeholder="Your Last Name Here" value="<?php echo isset($_SESSION['lname']) ? $_SESSION['lname'] : ''; ?>" /><span class="error">* <?php echo $fnameErr . $andErr . $lnameErr . $Err; ?></span></td></tr>
<tr><td width=150>Preparer Email</td><td width=550><input type="text" class="form1"   name="email" placeholder="Your Email Address Here" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" /><span class="error">* <?php echo $emailErr . $Err; ?></span></td></tr>
<tr><td width=150>Preparer Phone Number</td><td width=550><input type="number" class="tel1" name="phone1" pattern="[0-9]" placeholder="602" maxlength="3"  value="<?php echo isset($_SESSION['phone1']) ? $_SESSION['phone1'] : ''; ?>" /><input type="number" class="tel2" name="phone2" pattern="[0-9]" placeholder="747" maxlength="3" value="<?php echo isset($_SESSION['phone2']) ? $_SESSION['phone2'] : ''; ?>" /><input type="number" class="tel3" name="phone3" pattern="[0-9]" placeholder="4444" maxlength="4" value="<?php echo isset($_SESSION['phone3']) ? $_SESSION['phone3'] : ''; ?>" /><span class="error">* <?php echo $phoneErr . $Err; ?></span></td></tr>
<tr><td width=150>Customer Name</td><td width=550><input type="text" class="fname"  name="cfname" placeholder="Customer First Name" value="<?php echo isset($_SESSION['cfname']) ? $_SESSION['cfname'] : ''; ?>" /><input type="text" class="lname"  name="clname" placeholder="Customer Last Name"  value="<?php echo isset($_SESSION['clname']) ? $_SESSION['clname'] : ''; ?>" /><span class="error">* <?php echo $cfnameErr . $candErr . $clnameErr . $Err; ?></td></tr>
<tr><td width=150>Customer Email</td><td width=550><input type="text" class="form1"   name="cemail" placeholder="Customer Email Address Here" value="<?php echo isset($_SESSION['cemail']) ? $_SESSION['cemail'] : ''; ?>" /><span class="error">* <?php echo $cemailErr . $Err; ?></td></tr>
<tr><td width=150>Customer Phone Number</td><td width=550><input type="number" class="tel1" name="cphone1" pattern="[0-9]" placeholder="602" maxlength="3"  value="<?php echo isset($_SESSION['cphone1']) ? $_SESSION['cphone1'] : ''; ?>" /><input type="number" class="tel2" name="cphone2" pattern="[0-9]" placeholder="747" maxlength="3" value="<?php echo isset($_SESSION['cphone2']) ? $_SESSION['cphone2'] : ''; ?>" /><input type="number" class="tel3" name="cphone3" pattern="[0-9]" placeholder="4444" maxlength="4" value="<?php echo isset($_SESSION['cphone3']) ? $_SESSION['cphone3'] : ''; ?>" /><span class="error">* <?php echo $cphoneErr . $Err; ?></td></tr>
<tr><td width=150>Request Number</td><td width=550><input type="text" class="form1" name="rcnum" placeholder="Request Center Number Here" value="<?php echo isset($_SESSION['rcnum']) ? $_SESSION['rcnum'] : ''; ?>" /><span class="error">* <?php echo $rcnumErr . $Err; ?></td></tr>
<tr><td width=150>Subtask Number</td><td width=550><input type="text" class="form1"  name="subtsk" placeholder="Request Center Subtask Here" value="<?php echo isset($_SESSION['subtsk']) ? $_SESSION['subtsk'] : ''; ?>" /></td></tr>
<tr><td width=150>Name Of Request</td><td width=550><input type="text" class="form1"  name="title" placeholder="Name of Request, eg; Quote for 2 Citrix servers" value="<?php echo isset($_SESSION['title']) ? $_SESSION['title'] : ''; ?>" /><span class="error">* <?php echo $titleErr . $Err; ?></td></tr>
<!-- <tr><td width=150>Budgetary Quote</td><td width=550><input type="checkbox" class="form1"  name="quote" value="<?php echo isset($_SESSION['quote']) ? $_SESSION['quote'] : ''; ?>" checked /></td></tr> -->
<tr><td width=150>Region</td><td width=550>
<table width="400px">
	<tr><td width=33%><input <?php if ($region=='phx'){ echo 'checked="checked"';} ?> type="radio" value="phx" name="region">Phoenix
	</td>
	<td width=33%><input <?php if ($region=='tus'){ echo 'checked="checked"';} ?> type="radio" value="tus" name="region">Tucson
	</td>
	<td width=33%><input <?php if ($region=='wr'){ echo 'checked="checked"';} ?> type="radio" value="wr" name="region">Western Region
	</td></tr>
</table><span class="error">* <?php echo $regionErr . $Err; ?>
</td></tr>
<tr><td width=150>Notes</td><td width=550><input type="text" class="form1" name="notes" placeholder="Quote for SQL Management Database for Medical Records" value="<?php echo isset($_SESSION['notes']) ? $_SESSION['notes'] : ''; ?>" /></td></tr>

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

	

<!-- View Cart Box End -->



<script>
var parent = document.getElementById('parent');
var child = document.getElementById('child');
child.style.paddingRight = child.offsetWidth - child.clientWidth + "px";
</script>

<div id="bannermart" style="display:none;" class="cart-view-table-float w3-animate-top">
<div id="container1">
<div id="container2">
	<form method="post" action="cart_update.php">
<?php
	$current_url = ("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
echo	'<input type="hidden" name="return_url" value="'.$current_url.'" />';
?>
	<input type="submit" class="close" value="×" />
	</form>
<object data="images/cart.svg" type="image/svg+xml" style="display: block; margin: auto;" />
</object>

<h3 align="center">BannerMart</h3>

All server pricing has been cost averaged to reflect an initial build starting point below the maximum vCPU and vRAM.  While working with all application owners these servers will be monitored and adjusted accordingly to provide the proper performance to the application while keeping over provisioning of resource at a minimum.  This should provide benefits to our customers and IT’s budget.
<!-- Products List Start -->
<?php
$results = $conn->query("SELECT product_code, product_name, product_desc, product_img_name, price FROM products ORDER BY id ASC");
if($results){ 
$products_item = '<ul class="products">';
//fetch results set as object and output HTML
while($obj = $results->fetch_object())
{
$products_item .= <<<EOT
	<li class="product">
	<form method="post" action="cart_update.php">
	<div class="product-content"><h3>{$obj->product_name}</h3>
	<div class="product-thumb"><img src="images/{$obj->product_img_name}" class="resize"></div>

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
<!-- Products List End -->

</div>
</div>
</div>

</body>
</html>
