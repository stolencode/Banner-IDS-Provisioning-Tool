<?php
session_start();
include_once("update.php");
require("phpmailer.php");


$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$email = $_SESSION['email'];
$phone1 = $_SESSION['phone1'];
$phone2 = $_SESSION['phone2'];
$phone3 = $_SESSION['phone3'];

$cfname = $_SESSION['cfname'];
$clname = $_SESSION['clname'];
$cemail = $_SESSION['cemail'];

$cphone1 = $_SESSION['cphone1'];
$cphone2 = $_SESSION['cphone2'];
$cphone3 = $_SESSION['cphone3'];


$subtsk = $_SESSION['subtsk'];
$rcnum = $_SESSION['rcnum'];
$priority = $_SESSION['priority'];
$total = $_SESSION['total'];
$title = $_SESSION['title'];
$quote = $_SESSION['quote'];

$space = ' ';
$fullname = ($fname.$space.$lname);
$cfullname = ($cfname.$space.$clname);
$currency = '$';

$openpar = '(';
$closepar = ')';
$dash = '-';


$phone = ($openpar.$phone1.$closepar.$phone2.$dash.$phone3);
$cphone = ($openpar.$cphone1.$closepar.$cphone2.$dash.$cphone3);

$evp = "EVPReports@bannerhealth.com";
$troy = "EnterpriseVirtualPlatform@bannerhealth.com";//this will get changed to troy.clavell@bannerhealth.com at go-live


$mail = new PHPMailer();

$mail->From = "ITIDS_Quotes@bannerhealth.com";
$mail->FromName = "IT Infrastructure Design & Support Quotes";

//$mail->AddAddress($evp);//mailto evp DL.  turned this off during testing so I'm not spamming constantly



$mail->WordWrap = 50;                 
$extension = '.pdf';
$space = '_';
$outdir = '/media/quotes/';
$title = preg_replace('/\s+/', '_', $title);
$year = date(Y);
$month = date(mM);
$newdir = '/';
$attach = $outdir.$year.$newdir.$month.$newdir.$rcnum.$space.$title.$extension;

$mail->AddAttachment($attach);
$mail->IsHTML(true);

$mail->Subject = 'RC#'.$rcnum.'_'.$title;


$body = '<style>
body{
	margin: 0px;
	padding: 0px;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}

</style>';
$body .= "";
$body .= '<table width=650>
<tr><td colspan="2"><i></i><br>
<h3>Attached is a copy of the quote you have generated.
</h3></td></tr>
<tr><td>Name: </td><td>';
$body .= $fullname;
$body .= '</td></tr>';

$body .= '<tr><td>Email: </td><td>';
$body .= $email;
$body .= '</td></tr>';

$body .= '<tr><td>Phone: </td><td>';
$body .= $phone;
$body .= '</td></tr>';

$body .= '<tr><td>Customer: </td><td>';
$body .= $cfullname;
$body .= '</td></tr>';

$body .= '<tr><td>Customer Email: </td><td>';
$body .= $cemail;
$body .= '</td></tr>';

$body .= '<tr><td>Customer Phone: </td><td>';
$body .= $cphone;
$body .= '</td></tr>';

$body .= '<tr><td>Request Center Number: </td><td>';
$body .= $rcnum;
$body .= '</td></tr>';

$body .= '<tr><td>Subtask ID: </td><td>';
$body .= $subtsk;
$body .= '</td></tr>';

$body .= '<tr><td>Name of Request: </td><td>';
$body .= $title;
$body .= '</td></tr>';
	
$body .= '</table>';



$body .= '<table width="650" cellpadding="6" cellspacing="0">
<thead><tr bgcolor="#0089d0"><th><font color="#FFFFFF">Quantity</th><th><font color="#FFFFFF">Product</th><th><font color="#FFFFFF">Price</th><th><font color="#FFFFFF">Total</th></tr></font></thead>';

$flag == FALSE;

if(isset($_SESSION["cart_products"])) //check session var
   {
		$total = 0; //set initial total value
		foreach ($_SESSION["cart_products"] as $cart_itm)
        {

//Troy flag bit			
if((($cart_itm["product_qty"] >= ('16')) and ($cart_itm["product_code"] == ('PD1008'))) or (($cart_itm["product_qty"] >= ('4')) and ($cart_itm["product_code"] == ('PD1009'))) 
	or (($cart_itm["product_qty"] >= ('1')) and ($cart_itm["product_code"] == ('PD1003')))
	or (($cart_itm["product_qty"] >= ('1')) and ($cart_itm["product_code"] == ('PD1004')))
	or (($cart_itm["product_qty"] >= ('1')) and ($cart_itm["product_code"] == ('PD1005')))
	or (($cart_itm["product_qty"] >= ('1')) and ($cart_itm["product_code"] == ('PD1006')))
	) {
	
	$mail->Priority = 1;
	// MS Outlook custom header
	// May set to "Urgent" or "Highest" rather than "High"
	$mail->AddCustomHeader("X-MSMail-Priority: High");
	// Not sure if Priority will also set the Importance header:
	$mail->AddCustomHeader("Importance: High");

	
	$email = $troy;//this sets the email to be sent only to $troy 
	$cemail = $null;//this makes sure the customer does not recieve an email with quote attached
	$flag == TRUE;
	
	}
//end of Troy flag bit

	
			//set variables to use in content below
			$currency = "$";//you have to set $ to a variable or else it confuses PHP
			$product_name = $cart_itm["product_name"];
			$product_qty = $cart_itm["product_qty"];
			$product_price = $cart_itm["product_price"];
			$product_code = $cart_itm["product_code"];
			$product_type = $cart_itm["product_type"];
			$subtotal = ($product_price * $product_qty);
			$total = ($total + $subtotal);
			//end of variables
if($flag == TRUE){

$body .= '<tr><td><font color="#FF0000">';//hilights table entries in red in the email ';
$body .= $product_qty;
$body .= '</font></td><td><font color="#FF0000">';
			
$body .= $product_name;
$body .= '</font></td><td><font color="#FF0000">';

$body .= $currency.$product_price;

$body .= '</font></td><td><font color="#FF0000">';

$body .= $currency.$subtotal;
$body .= '</font></td></tr>';
}
else{
$body .= '<tr><td>';
$body .= $product_qty;
$body .= '</td><td>';
			
$body .= $product_name;
$body .= '</td><td>';

$body .= $currency.$product_price;

$body .= '</td><td>';

$body .= $currency.$subtotal;
$body .= '</td></tr>';
}
	



		}

$body .= '<tr><td colspan="2"></td><td><b>Grand Total</b><td>';
//$tax = ($total * 10) / 100;
$tax = 0;

$grandtotal = $total + $tax;
$body .= $currency.$grandtotal;

$body .= '</td></tr>';
	}
	
$body .= '</table>';

$body .= '
<?php
session_start();
?>

<table width="650" cellpadding="6" cellspacing="0">
<thead><tr bgcolor="#0089d0"><th><font color="#FFFFFF">Notice</th></tr></font></thead>
<tr><td>
<font size=1>Finance Rules and Regulations prohibit us from using Banner Operational (OPEX) or Non-Banner external funding sources. Your request can only be processed if you include a Banner BCAP or a CAAR. Shown here are examples of authorized funding sources:<br>
<i>0101-1259990101011-13-0888 or CA04910199150987 or 11-0787</i> Any exception to use alternate funding sources, needs to be coordinated, and be approved by Nicholas Brooks, Banner Finance Program Director.  He is the only finance person authorized to grant an exception.  If an exception is given please include all correspondence from finance with the Quote/Purchase request.
</font></td></tr>
</table>

Next step:  Please enter your funding info.<br>

Open the <a href="http://pvqxlv01.bhs.bannerhealth.com" >IT ITD&S Quotes tool </a><br>

log in with the username `<i>caaruser</i>`<br>

Click on `<i>Enter CAAR</i>` (the `$` icon)<br>

in the `Search` field, enter the `<i>Request Center Number</i>`

Enter the first and last name of the manager approving the use of funds as well as a valid 12 digit CAAR number<br>

Click `Submit CAAR`<br>
';






if($email == $troy) {
$body .= "<b>Enterprise Virtual Platform, you're being looped in for a consult on this quote</b>";	
}

$mail->Body    = $body;

$mail->AddAddress($email);//putting these here so that they either receive the preparers email, or go directly to Troy when flagged


$mail->AddAddress($cemail);//when Troy is flagged, this is $null

//$mail->AltBody = "Please disregard this email.  I'm testing PHP mail functions.  Attached is a copy of the quote you've generated.";
if($email == $troy) {
$html = '<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IT Infrastructure Design and Support Quote Form</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
</script>
</head>
<body background="images/background.svg">
<div class="cart-view-table-front">
<object data="images/logo.svg" type="image/svg+xml" class="logo" />
<img src=‘images/logo.png’ class=“logo” alt=“IT Infrastructure Design and Support” /></img>
</object>
<center><p>Thank you for using the IT Infrastructure Design and Support Budgetary Quote tool.  In order to better serve you, we have flagged this quote for review.  Due to the large volume of resources you have requested, a representative from the EVP team will be in contact with you shortly to verify.</p>

<a href="index.php" class="button">Go back</a></center>
</div>
</body> 
';
session_destroy();
header('Refresh: 3;url=index.php');

} 
else 
{
$html = '<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IT Infrastructure Design and Support Quote Form</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
</script>
</head>
<body background="images/background.svg">
<div class="cart-view-table-front">
<object data="images/logo.svg" type="image/svg+xml" class="logo" />
<img src=‘images/logo.png’ class=“logo” alt=“IT Infrastructure Design and Support” /></img>
</object>
<center><p>Thank you for using the IT Infrastructure Design and Support Budgetary Quote tool.  Your quote is now available at <a href="file://///stor102/EVI/budgetary_quotes/">\\stor102\EVI\budgetary_quotes</a></p>
<p>
<b>an email with your quote attached should arrive at your inbox momentarily</b>
</p>
<a href="../index.php" class="button">Go back</a></center>
</div>
</body> 
';
session_destroy();
header('Refresh: 3;url=../index.php');

}
echo $html;
return $mail->Send();


?>
