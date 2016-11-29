<?php
header('Content-Type: text/xml');
error_reporting(E_ALL);
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

echo '<response>';

$servername = "server";
$username = "user";
$passwordDB = "pass";
$dbname = "dbname";
$conn = new mysqli($servername, $username, $passwordDB,$dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if(isset($_GET["txt"]))
{
	$text=$_GET["txt"];
	if($text=="*")
		$sql="SELECT * From tblpyetja";
	else
		$sql="SELECT * From tblpyetja where txtPyetjes LIKE'%".$text."%'";
	$result=$conn->query($sql);
	
	if($result->num_rows>0)
	{
			echo "<h4 style='margin-left:30px'>Rezultati:</h3>";
			echo "<div class='row header' style='margin: 45px auto 50px auto;'>";
				echo "<div class='cell'>PID</div>";
				echo "<div class='cell'>Pyetja</div>";
				echo "<div class='cell'>Alternativat</div>";
				echo "<div class='cell'>Pergjigja e sakte</div>";		
				echo "<div class='cell'>Lokacioni i fotografise</div>";
				echo "<div class='cell'>A eshte aktive pyetja?</div>";
				echo "<div class='cell'>Ndrysho</div>";
			echo "</div>";			

		while($row=$result->fetch_assoc())
		{
			echo "<div class='row' id='".$row['PID']."'>";
				echo "<div class='cell'>".$row['PID']."</div>";
				echo "<div class='cell'>".$row['txtPyetjes']."</div>";//question
				echo "<div class='cell'>".$row['alternativat']."</div>";//alternatives
				echo "<div class='cell'>".$row['pSakte']."</div>";//right answer
				if($row['fotoLocation']=='')//image check
					echo "Kjo pyetje nuk ka fotografi!";
				else
					echo "<div class='cell' >".$row['fotoLocation']."</div>";
				if($row['aktive']==1)//active check
					echo "<div class='cell'>PO</div>";
				else
					echo "<div class='cell'>JO</div>";
				$pid=$row['PID'];

				echo "<div class='cell'><a title='Kliko per te ndryshuar kete rresht!' href='#form' onclick='edit(".$pid.")';return false;'>Ndrysho</a></div>";//edit or delete
			echo "</div>";
			
			
		}

	}
	else
	{
		//cannot process order
		echo "Kerkesa juaj nuk mund te plotesohet! Te dhenat tuaja jane gabim!";
		
	}
	$conn->close();
}
echo '</response>';
?>