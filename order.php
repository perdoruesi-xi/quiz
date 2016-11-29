<?php
header('Content-Type: text/xml');
error_reporting(E_ALL);
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';
//this file returns results to the AJAX requests that set the order of the question categories
echo '<response>';
echo "<script>alert(".$_GET["txt"].")</script>";
if(empty($_GET["txt"]))
	echo "<script>alert('aoasodasodj')</script>";
$servername = "server";
$username = "user";
$passwordDB = "pass";
$dbname = "dbname";
	$a=1;
	$b=2;
	$c=3;
	$d=4;
	$e=5;
$conn = new mysqli($servername, $username, $passwordDB,$dbname);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 
if(isset($_GET["txt"]))
{

	$text=$_GET["txt"];
	$t=explode("~~",$text);
	for($i=0;$i<count($t);++$i)
	{
		switch($t[$i])//check order for each category
		{
			case 1: $a=$i; break;
			case 2: $b=$i; break;
			case 3: $c=$i; break;
			case 4: $d=$i; break;
			case 5: $e=$i; break;
		}
	}
	$xx="'".$t[1].",".$t[2].",".$t[3].",".$t[4].",".$t[5]."'";
	$oo="'".$a.",".$b.",".$c.",".$d.",".$e."'";
	$qu="'select PID from tblpyetja where aktive=1 order by case when kategoria=1 then ".$a." when kategoria=2 then ".$b." when kategoria=3 then ".$c." when kategoria=4 then ".$d." when kategoria=5 then ".$e." end' ";
	$SQLINSERT="INSERT into tblorder(id, query, order_only) Values (1, ".$qu.",".$oo.") ON DUPLICATE KEY UPDATE query=".$qu.", order_only=".$oo;
	$insert=$conn->query($SQLINSERT);
	if($insert==TRUE)
	{
		echo "Ö".$xx."Ä";
		echo "==".$xx."**";
	}
	else
	{
		echo "GABIM".mysqli_error($conn);
		echo $SQLINSERT;
	}
	$conn->close();
			
			
}

echo '</response>';
?>