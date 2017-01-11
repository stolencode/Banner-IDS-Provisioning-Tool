<?php
session_start();

if (isset($_POST['login'])) {
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['password'] = $_POST['password'];
}
elseif (isset($_POST['query'])) {
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['password'] = $_POST['password'];
}

$db_username = $_SESSION['username'];
$db_password = $_SESSION['password'];

$db_name = 'quotes_db';
$db_host = 'localhost';   
	 


?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IT Infrastructure Design and Support Quote Form</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="jquery.min.js"></script>
<script src="bootstrap.min.js"></script>
<script src='Chart.js'></script>
<meta charset="utf-8" />


<?php

mysql_connect('localhost', 'www', 'www') or die("Error connecting to database: ".mysql_error());     
mysql_select_db("quotes_db") or die(mysql_error());


$one_month_sql = ("SELECT  *,
        DATE_FORMAT(datetime, '%m/%d/%Y') 
   FROM quotes 
  WHERE DATE(add_time) = CURDATE() - INTERVAL 30 DAY 
ORDER BY ID DESC");

$total_quotes_sql = ("SELECT COUNT(*) FROM `quotes`");
$total_quotes_result = mysql_query($total_quotes_sql);
$total_result = mysql_fetch_array($total_quotes_result);

$caar_quotes_sql = ("SELECT COUNT(*) FROM `quotes` WHERE `caar` IS NOT NULL");
$caar_quotes_result = mysql_query($caar_quotes_sql);
$caar_result = mysql_fetch_array($caar_quotes_result);


$approve_quotes_sql = ("SELECT COUNT(*) FROM `quotes` WHERE `approve` != 1");
$approve_quotes_result = mysql_query($approve_quotes_sql);
$approve_result = mysql_fetch_array($approve_quotes_result);


?>

</head>
<body background="../images/background.svg">
<p>

<?php 
mysql_connect('localhost', 'www', 'www') or die("Error connecting to database: ".mysql_error());     
mysql_select_db("quotes_db") or die(mysql_error());

         
//$approve_list_sql = mysql_query("SELECT * FROM `quotes` WHERE (`approve` is FALSE)");

$approve_list_sql = mysql_query("SELECT * FROM `quotes`");


if(mysql_num_rows($approve_list_sql) > 0){
	
echo	"<table class='from_db' cellpadding='6' cellspacing='0'>	
		<thead><tr><th>RC Number</th><th>Title</th><th>Approved</th></tr></thead>
		<tbody>
		";

while($results = mysql_fetch_array($approve_list_sql)){
$approve = $results["approve"];
$caar = $results["caar"];

echo "<tr><td>".$results["rcnum"]."</td><td>".$results["title"]."</td><td>";

if ($approve == FALSE) {
		echo '<font color="red">No</font>'; 
		}		
		
else if ($approve == TRUE) {
		echo '<font color="lime">Yes</font>'; 
}	

echo "</td></tr>";
		
}

echo "</table>";

}

?>	


<div class="cart-view-table-back" id="view-cart">
<div id="container1">
<div id="container2">
<object data="../images/logo.svg" type="image/svg+xml" class="logo" />
</object>
<h3 align="center">IT ID&S Quotes Dashboard</h3></center>
<center>
<table class="from_db" cellpadding="6" cellspacing="0">
		<thead><tr><th colspan="2">some title here </th></tr></thead>
		<tbody>
		<tr class="odd"><td width=250>Quotes</td><td width=550><?php echo $total_result[0]; ?> </td></tr>
		<tr class="even"><td width=250>Funded</td><td width=550><?php echo $caar_result[0]; ?>  </td></tr>
		<tr class="odd"><td width=250>Not Yet Approved</td><td width=550> <?php echo $approve_result[0]; ?> </td></tr>
</table>




<?php $less = ($total_result[0] - $approve_result[0]); ?>

		<script>
			var pieData1 = [{
			    value: <?php echo $less; ?>,
			    color: "rgba(151,187,205,1)",
			    highlight: "rgba(151,187,205,0.2)",
			    label: "Approved"
			}, {
			    value: <?php echo $approve_result[0]; ?>,
			    color: "rgba(220,220,220,1)",
			    highlight: "rgba(220,220,220,0.2)",
			    label: "Not approved"		
				
			}];
			
			window.onload = function(){
			var ctx = document.getElementById("chart-area1").getContext("2d");
			window.myPie = new Chart(ctx).Doughnut(pieData1);
			
			var textCtx = document.getElementById("text-area1").getContext("2d");
				textCtx.textAlign = "center";
				textCtx.textBaseline = "middle";
				textCtx.font = "30px sans-serif";
				textCtx.strokeStyle = "rgba(151,187,205,1)";
			};
		</script>	
													<div style="position: relative; width:300px; height:150px;">
																					<canvas id="chart-area1" 
																						style="z-index: 2; 
																						position: absolute;
																						left: 0px; 
																						top: 0px;" 
																						height="150" 
																						width="300"></canvas>
																					<canvas id="text-area1" 
																						style="z-index: 1; 
																						position: absolute;
																						left: 0px; 
																						top: 0px;" 
																						height="150" 
																						width="150"></canvas>
																					<div style="width: 300px; height: 150px; float: left; position: relative;">
																						<div style="width: 100%; height: 40px; position: absolute; top: 50%; left: 0; margin-top: -35px; line-height:19px; text-align: center; z-index: 999999999999999">
																							<h3 class="letterpress">
																							
																							<?php
																							$inv_perc = ($approve_result[0]/$total_result[0]); 
																							echo 100*round($inv_perc, 1, PHP_ROUND_HALF_EVEN)."%";
																							?>

																							</h3>
																							<br />
																						</div>
																						<canvas id="chart-area" width="150" height="150" />
																					</div>
																					<div id="chartjs-tooltip"></div>
																				</div>

																		
																				
																				
																				
		<a href="../navigate.php">         <input type="submit" value="Back" class="button" /> </a>
</center>
</div>
</div>
</div>
</body>
</html>



