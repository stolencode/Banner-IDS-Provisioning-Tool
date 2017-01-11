<?php
session_start();
include_once('to_pdf.php');

$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];

$cfname = $_SESSION['cfname'];
$clname = $_SESSION['clname'];
$cemail = $_SESSION['cemail'];

$cphone = $_SESSION['cphone'];


$subtsk = $_SESSION['subtsk'];
$rcnum = $_SESSION['rcnum'];
$priority = $_SESSION['priority'];
$total = $_SESSION['total'];
$title = $_SESSION['title'];
$quote = $_SESSION['quote'];
$region = $_SESSION['region'];

$space = ' ';
$fullname = ($fname.$space.$lname);
$cfullname = ($cfname.$space.$clname);
$currency = '$';

?>




<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IT Infrastructure Design and Support Quote Form</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
</script>
</head>
<body background="../images/background.svg">
<div class="cart-view-table-front">
<object data="../images/logo.svg" type="image/svg+xml" class="logo" />
<img src=‘images/logo.png’ class=“logo” alt=“IT Infrastructure Design and Support” /></img>
</object>
<p>
Please review the data you have entered.  If everything is correct, click "Submit" to generate the quote.  If you need to make changes, click 'Go Back' to return to the first page.
<p>


<table width="650px" style="font-size: 12;	font-family: Arial;">
<tr><td width=150>Preparer Name</td><td width=550><?php echo $fullname; ?></td></tr>
<tr><td width=150>Preparer Email</td><td width=550><?php echo $email; ?></td></tr>
<tr><td width=150>Preparer Phone Number</td><td width=550><?php echo $phone; ?></td></tr>
<tr><td width=150>Customer Name</td><td width=550><?php echo $cfullname; ?></td></tr>
<tr><td width=150>Customer Email</td><td width=550><?php echo $cemail; ?></td></tr>
<tr><td width=150>Customer Phone Number</td><td width=550><?php echo $cphone; ?></td></tr>
<tr><td width=150>Request Number</td><td width=550><?php echo $rcnum; ?></td></tr>
<tr><td width=150>Subtask Number</td><td><?php echo $subtsk; ?></td></tr>
<tr><td width=150>Name Of Request</td><td width=550><?php echo $title; ?></td></tr>
<!-- <tr><td width=150>Budgetary Quote</td><td width=550><input type="checkbox" class="form1"  name="quote" value="<?php echo isset($_SESSION['quote']) ? $_SESSION['quote'] : ''; ?>" onclick="return false" checked /></td></tr> -->
<tr><td width=150>Region</td><td width=550>
<?php 
if($region=='phx'){
echo "Phoenix";	
}
elseif($region=='tus'){
echo "Tucson";
}
elseif($region=='wr'){
echo "Western Region";
}
?>

</table>


<table width="100%"  cellpadding="6" cellspacing="0"><thead><tr><th>Quantity</th><th>Name</th><th></th><th>Price</th><th>Total</th></tr></thead>
  <tbody>
 	<?php
	if(isset($_SESSION["cart_products"])) //check session var
    {
		$total = 0; //set initial total value
		$b = 0; //var for zebra stripe table 
		foreach ($_SESSION["cart_products"] as $cart_itm)
        {
			//set variables to use in content below
			$product_name = $cart_itm["product_name"];
			$product_qty = $cart_itm["product_qty"];
			$product_price = $cart_itm["product_price"];
			$product_code = $cart_itm["product_code"];
			$product_type = $cart_itm["product_type"];
			$subtotal = ($product_price * $product_qty); //calculate Price x Qty
			
		   	$bg_color = ($b++%2==1) ? 'odd' : 'even'; //class for zebra stripe 
		    echo '<tr class="'.$bg_color.'">';
			echo '<td><input type="text" size="2" maxlength="2" name="product_qty['.$product_code.']" value="'.$product_qty.'" /></td>';
			echo '<td>'.$product_name.'</td>';
			echo '<td>'.$product_type.'</td>';
			echo '<td>'.$currency.$product_price.'</td>';
			echo '<td>'.$currency.$subtotal.'</td>';
            echo '</tr>';
			$total = ($total + $subtotal); //add subtotal to total var
        }
		
$tax = ($total * 10) / 100;
$grand_total = $total + $tax;
		foreach($taxes as $key => $value){ //list and calculate all taxes in array
				//$tax_amount     = round($total * ($value / 100));
				//$tax_item[$key] = $tax_amount;
				$grand_total    = $grand_total + $tax_amount;  //add tax val to grand total
		}
		
		//$shipping_cost = ($shipping_cost)?'Shipping Cost : '.$currency. sprintf("%01.2f", $shipping_cost).'<br />':'';
	}
    ?>
    <tr><td colspan="5"><span style="float:right;text-align: right;"><?php echo 'Grand Total: ', $currency,$grand_total;?></span></td></tr>
  </tbody>
</table>
<td colspan="4">
<center>
<?php
	$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
echo	'<input type="hidden" name="return_url" value="'.$current_url.'" />';
?>
	</center></td>
	</tbody>
	</table>

</p>
<center>
<table >
	<tr>
		<td>
			<a href="send_form_email.php" class="button">Submit</a>
		</td>
		<td>
			<a href="edit.php" class="button">Go back</a>
		</td>
	</tr>
</table>
</center>
</div>
</body> 

