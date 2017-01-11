<?php
session_start();
require('../fpdf.php');

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
class PDF extends FPDF
{
protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';

function WriteHTML($html)
{
    // HTML parser
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Tag
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extract attributes
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag, $attr)
{
    // Opening tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag)
{
    // Closing tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}

function SetStyle($tag, $enable)
{
    // Modify style and select corresponding font
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
    // Put a hyperlink
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}
}

//$html
$html='<b>NOTICE:</b><br>
Finance Rules and Regulations prohibit us from using Banner Operational (OPEX) or Non-Banner external funding sources.
Your request can only be processed if you include a Banner BCAP or a CAAR. 
Shown here are examples of authorized funding sources:
<i>0101-1259990101011-13-0888 or CA04910199150987 or 11-0787</i>
Any exception to use alternate funding sources, needs to be coordinated, and be approved by
Nicholas Brooks, Banner Finance Program Director.  He is the only finance person authorized to grant an exception.  
If an exception is given please include all correspondence from finance with the Quote/Purchase request.
';


//time and date block
$format = 'D m/d/Y';
$today  = date($format);
$valid = $d = date ( $format, strtotime ( '+90 days' ) );


$pdf = new PDF();
// First page
$pdf->AddPage();
$pdf->SetFont('Arial','B',25);
//Watermark
if (isset($_SESSION['quote'])){
$pdf->Image('images/watermark.png',0,0,210,300,'');
}
//Logo
$pdf->Image('images/logo.png',160,0,50,'','');
//Preparer Section
$pdf->MultiCell(0,0,'IT Infrastructure Design and Support');
$pdf->SetFont('Arial','',15);
$pdf->SetXY(10,25);
$pdf->MultiCell(0,5,'Prepared By: ');
$pdf->SetXY(55,25);
$pdf->MultiCell(0,5,$fullname);
$pdf->SetFont('Arial','',15);
$pdf->MultiCell(0,5,'Email Address: ');
$pdf->SetXY(55,30);
$pdf->MultiCell(0,5,$email);
$pdf->SetFont('Arial','',15);
$pdf->MultiCell(0,5,'Phone Number: ');
$pdf->SetXY(55,35);
$pdf->MultiCell(0,5,$phone);



//Customer Section
$pdf->SetFont('Arial','B',15);
$pdf->SetXY(10,50);
$pdf->MultiCell(0,5,'Customer');

$pdf->SetXY(10,55);
$pdf->SetFont('Arial','',15);
$pdf->MultiCell(0,5,'Name: ');
$pdf->SetXY(55,55);
$pdf->MultiCell(0,5,$cfullname);

$pdf->SetXY(10,60);
$pdf->SetFont('Arial','',15);
$pdf->MultiCell(0,5,'Email Address: ');
$pdf->SetXY(55,60);
$pdf->MultiCell(0,5,$cemail);

$pdf->SetXY(10,65);
$pdf->SetFont('Arial','',15);
$pdf->MultiCell(0,5,'Phone Number: ');
$pdf->SetXY(55,65);
$pdf->MultiCell(0,5,$cphone);

$pdf->SetXY(10,75);
$pdf->SetFont('Arial','',15);
$pdf->MultiCell(0,5,'Request Number: ');
$pdf->SetXY(55,75);
$pdf->MultiCell(0,5,$rcnum);

$pdf->SetXY(10,80);
$pdf->SetFont('Arial','',15);
$pdf->MultiCell(0,5,'Subtask Number: ');
$pdf->SetXY(55,80);
$pdf->MultiCell(0,5,$subtsk);
$pdf->SetXY(10,90);
$pdf->SetFont('Arial','',15);
$pdf->MultiCell(0,5,'Quote Generated:');
$pdf->SetXY(55,90);
$pdf->MultiCell(0,5,$today);
$pdf->SetXY(10,95);
$pdf->MultiCell(0,5,'Valid Until:');
$pdf->SetXY(55,95);
$pdf->MultiCell(0,5,$valid);








	$pdf->SetFillColor(0, 137, 208);
	$pdf->SetDrawColor(0, 137, 208);
	$pdf->SetTextColor(255,255,255);
	
	$pdf->Cell(80,5,"Product",1,0,'L',1);

	$pdf->Cell(10,5,"Qty",1,0,'R',1);

	$pdf->Cell(50,5,"Price Ea.",1,0,'R',1);

	$pdf->Cell(50,5,"Subtotal",1,1,'R',1);


//try this array
	if(isset($_SESSION["cart_products"])) //check session var
    {
		$total = 0; //set initial total value
		foreach ($_SESSION["cart_products"] as $cart_itm)
        {
			//set variables to use in content below
			$currency = "$";
			$product_name = $cart_itm["product_name"];
			$product_qty = $cart_itm["product_qty"];
			$product_price = $cart_itm["product_price"];
			$product_code = $cart_itm["product_code"];
			$product_type = $cart_itm["product_type"];
			$subtotal = ($product_price * $product_qty);
			$total = ($total + $subtotal);
	$pdf->SetFillColor(255,255,255);
	$pdf->SetDrawColor(228,228,228);
	$pdf->SetTextColor(0,0,0);
			
			$pdf->Cell(80,5,$product_name,1,0,'L',1);
			$pdf->Cell(10,5,$product_qty,1,0,'R',1);
			$pdf->Cell(50,5,"$$product_price",1,0,'R',1);
			$pdf->Cell(50,5,"$$subtotal",1,1,'R',1);

		}
			$pdf->Cell(80,5," ",1,0,'L',1);
			$pdf->Cell(10,5," ",1,0,'R',1);
			$pdf->Cell(50,5," ",1,0,'R',1);
//$tax = ($total * 10) / 100;
$tax = 0;
$grandtotal .= $total + $tax;			
		$pdf->SetFillColor(255,255,255);
		$pdf->SetDrawColor(228,228,228);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(50,5,"$$grandtotal",1,1,'R',1);
	}
	
$extension = '.pdf';
$space = '_';

$title = preg_replace('/\s+/', '_', $title);
$year = date(Y);
$month = date(mM);
$newdir = '/';
$share = '/media/quotes';

$outdir = ($share . $newdir . $year . $newdir . $month . $newdir . $rcnum . $space . $title . $extension);



$pdf->SetXY(10,220);
$pdf->WriteHTML($html);
$pdf->Output($outdir, 'F');



?>

