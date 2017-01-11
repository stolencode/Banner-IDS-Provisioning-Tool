<?php
$servername = "localhost";
$username = "www";
$password = "www";
$dbname = "quotes_db";

$rcnum = $_POST['rcnum'];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

session_start(); //makes $_SESSION available on this page
include_once("config.php");//this connects to the mysql db

//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);



if (isset($_POST['form1'])) {
	$_SESSION['fname'] = $_POST['fname'];
	$_SESSION['lname'] = $_POST['lname'];
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['phone'] = $_POST['phone'];		
	$_SESSION['cfname'] = $_POST['cfname'];
	$_SESSION['clname'] = $_POST['clname'];
	$_SESSION['cemail'] = $_POST['cemail'];	
	$_SESSION['cphone'] = $_POST['cphone'];		
	$_SESSION['rcnum'] = $_POST['rcnum'];
	$_SESSION['title'] = $_POST['title'];
	$_SESSION['subtsk'] = $_POST['subtsk'];
	$_SESSION['quote'] = $_POST['quote'];	
	$_SESSION['region'] = $_POST['region'];
	$_SESSION['cart'] = $_POST['cart'];
}

?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit quote <?php echo $rcnum; ?></title>
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
<p>
<div class="cart-view-table-front">


<div id="container1">
<div id="container2">
<object data="images/logo.svg" type="image/svg+xml" class="logo" />
</object>
<h3 align="center">Edit Quote <?php echo $rcnum; ?></h3></center>

<!-- View Cart Box Start -->

<p>
<center><input type="submit" name="Shop Now!" class="button" value="Add Items To Cart" onclick="showDiv()" /></center>

<p>
<span><h3>Your Shopping Cart</h3><img src="images/cart.svg" class="cart"></img></span>

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
	
$sql = "SELECT * FROM quotes WHERE (`rcnum` LIKE ".$rcnum.") ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	
	 while($row = $result->fetch_assoc()) {

		$srlzcart = $row['cart'];
	
	}
}
	
$cart = unserialize($srlzcart);		

	
	$total =0; //sets initial total value to zero
	$b = 0; //initial value for zebra striping table rows

	$i	=	0;
	
	foreach ($cart as $cart_itm)
	{

	$count = count($cart_itm);
	
	}
	
	$a = (int)$count;
(int)$b = 5;
		
		
	$counter = $a / $b;

$i	=	0; //initial value of counter object
$ii	=	0; //other counter


while($ii < $counter){
		$product_qty = $cart_itm["$i"];//product code
		$i++;
		$product_code = $cart_itm["$i"];//product qty
		$i++;
		$product_name = $cart_itm["$i"];//product name
		$i++;
		$product_price = $cart_itm["$i"];//product_price
		$i++;
		$subtotal = $cart_itm["$i"];//total
		$i++;
		
		$bg_color = ($b++%2==1) ? 'odd' : 'even'; //zebra stripe
		echo '<tr class="'.$bg_color.'">';
		echo '<td>Qty <input type="text" size="2" maxlength="2" name="product_qty['.$product_code.']" value="'.$product_qty.'" /></td>';
		echo '<td>'.$product_name.'</td>';
		echo '<td><input type="checkbox" name="remove_code[]" value="'.$product_code.'" /> Remove</td>';
		echo '</tr>';
		$subtotal = ($product_price * $product_qty);
		$total = ($total + $subtotal);

		
		$ii++;
	}
		if ($cart == $null)  {
		echo '<div class="overlay"></div>
		<div id="emptycart"  style="background-color: #F5F5F5; border-radius: 5px;" /><center><h4 class="w3-animate-fading">Your cart is empty... Click "Add Items To Cart"</h4></center></div>';
		}
		

		
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
			array_push($cart_array, $product_qty, $product_code, $product_name, $product_price, $total);

		  }
		
		$cart = serialize($cart_array);
//var_dump($cart);
?>
<td colspan="4">

<center>
<input type="submit" value="Update Cart" name="updatecart" class="button" />


<?php
	$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
echo	'<input type="hidden" name="return_url" value="'.$current_url.'" />';
?>
</form>
	</center></td>
	</tbody>
	</table>

	
<style>
.error {color: #FF0000;}
</style>

<form action="update.php" method="POST" name="form1" />
<table style="margin: 0 auto;">





<?php
$sql = "SELECT * FROM quotes WHERE (`rcnum` LIKE ".$rcnum.") ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc()) {

		$rcnum = $row['rcnum'];
		$title = $row['title'];
		$fname = $row['fname'];
		$lname = $row['lname'];
		$email = $row['email'];
		$phone = $row['phone'];
		$cfname = $row['cfname'];
		$clname = $row['clname'];
		$cemail = $row['cemail'];
		$cphone = $row['cphone'];
		$subtsk = $row['subtsk'];
		$region = $row['region'];
		$id = $row['id'];
				
		echo '<table class="from_db">';
		echo  '<thead><tr><th colspan="2">'. $rcnum . " " . $title ."</th></tr></thead>";
		echo '<tbody>';
		echo '<tr><td width=250>Preparer Name</td><td width=550><input type="text" class="fname" name="fname" placeholder="Your first name here" value="'.$fname.'" /><input type="text" class="lname" name="lname" placeholder="Your last name here" value="'.$lname.'" /></td></tr>';
		echo '<tr><td width=250>Preparer Email</td><td width=550><input type="text" class="form1" name="email" placeholder="Your email here" value="'.$email.'" /></td></tr>';
		echo '<tr><td width=250>Preparer Phone</td><td width=550><input type="text" class="form1" name="phone" placeholder="Your phone number here" value="'. $phone .'" /></td></tr>';
		echo '<tr><td width=250>Customer Name</td><td width=550><input type="text" class="fname" name="cfname" placeholder="Customer first name here" value="'.$cfname.'" /><input type="text" class="lname" name="clname" placeholder="Customer last name here" value="'.$clname.'" /></td></tr>';
		echo '<tr><td width=250>Customer Email</td><td width=550><input type="text" class="form1" name="cemail" placeholder="Customer email here" value="'.$cemail.'" /></td></tr>';
		echo '<tr><td width=250>Customer Phone</td><td width=550><input type="text" class="form1" name="cphone" placeholder="Customer phone number here" value="'. $cphone .'" /></td></tr>';
		echo '<tr><td width=250>Request Number</td><td width=550><input type="text" class="error" name="rcnum" placeholder="Your phone number here" value="'. $rcnum .'" readonly /></td></tr>';
		echo '<tr><td width=250>Subtask Number</td><td><input type="text" class="form1" name="subtsk" placeholder="Subtask number here" value="'.$subtsk.'" /></td></tr>';
		echo '<tr><td width=250>Name Of Request</td><td width=550><input type="text" class="form1" name="title" placeholder="Title of request" value="'.$title.'" /></td></tr>';
		echo '<input type="hidden" name="id" value="'.$id.'" />';
		echo '<tr><td width=250>Region</td><td>
		<table width="300">
		<tr><td width=33><input type="radio" name="region" value="phx" ';
		if($region=="phx"){ echo "checked";}
		echo ' /> Phoenix </td><td width=33>';
		echo  '<input type="radio" name="region" value="tus" ';
		if($region=="tus"){	echo "checked";	} 
		echo '/> Tucson </td><td width=33>';
		echo '<input type="radio" name="region" value="wr" ';
  		if($region=="wr"){
		echo $checked;
		}
		echo '/> Western Region</td></tr></table>
		</td></tr>';
		echo '<tr><td colspan="2"><input type="submit" value="Update" class="button" /></form></td></tr>';



		echo '<tr><td colspan="2">';


        
        echo "</table>";
		echo "</td></tr>";

		
		echo "</table>";

		echo "<p>";
}
}
?>




	</td>
	</tr>
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
	<input type="hidden" name="return_url" value="edit.php" />
	<input type="submit" class="close" value="×" />
	</form>


	
	
<h3 align="center">BannerMart</h3>

<!-- Products List Start -->
<?php
$results = $mysqli->query("SELECT product_code, product_name, product_desc, product_img_name, price FROM products ORDER BY id ASC");
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
		<input type="text" size="2" maxlength="2" name="product_qty" value="1" />
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



<?php
$conn->close();
?>



</div>
</div>
</html>