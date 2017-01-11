<?php
session_start();
require("phpmailer.php");


$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$email = $_SESSION['email'];


$cfname = $_SESSION['cfname'];
$clname = $_SESSION['clname'];
$cemail = $_SESSION['cemail'];


$subtsk = $_SESSION['subtsk'];
$rcnum = $_SESSION['rcnum'];

$title = $_SESSION['title'];

$space = ' ';
$fullname = ($fname.$space.$lname);
$cfullname = ($cfname.$space.$clname);
$currency = '$';


$phone = ($openpar.$phone1.$closepar.$phone2.$dash.$phone3);
$cphone = ($openpar.$cphone1.$closepar.$cphone2.$dash.$cphone3);

$evp = "EnterpriseVirtualPlatform@bannerhealth.com";


$mail = new PHPMailer();

$mail->From = "ITIDS_Quotes@bannerhealth.com";
$mail->FromName = "IT Infrastructure Design & Support Quotes";

$mail->AddAddress($evp);//mailto evp DL.  turned this off during testing so I'm not spamming constantly



$mail->WordWrap = 50;                 


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
<h3>CAAR has been submitted</h3>
</td></tr>
<tr><td>Name: </td><td>';
$body .= $fullname;
$body .= '</td></tr>';

$body .= '<tr><td>Email: </td><td>';
$body .= $email;
$body .= '</td></tr>';


$body .= '<tr><td>Customer: </td><td>';
$body .= $cfullname;
$body .= '</td></tr>';

$body .= '<tr><td>Customer Email: </td><td>';
$body .= $cemail;
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

$body .= 'Thank you for entering your funding information.  You will be notified when this quote has been approved to generate a server detail sheet. ';







$mail->Body    = $body;

$mail->AddAddress($email);//putting these here so that they either receive the preparers email, or go directly to Troy when flagged
$mail->AddAddress($cemail);//when Troy is flagged, this is $null


return $mail->Send();


?>
