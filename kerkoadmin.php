<?php
header('Content-Type: text/xml');
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
if(!empty($_GET["aid"]))
{
	$idkerko=$_GET["aid"];
	if($idkerko=="*")
		$sql="SELECT * From tbladmin";
	else
		$sql="SELECT * From tbladmin where AID=".$idkerko;
	$result=$conn->query($sql);
	
	if($result->num_rows>0)
	{
			echo "<h4 style='margin-left:30px'>Rezultati:</h3>";
			echo "<div class='row header' style='margin: 45px auto 50px auto;' id='rezadmin'>";
				echo "<div class='cell'>ID</div>";
				echo "<div class='cell'>Fjalekalimi</div>";
				echo "<div class='cell'>Privilegji</div>";
				echo "<div class='cell'>Ndrysho</div>";

			echo "</div>";			
	
		while($row=$result->fetch_assoc())
		{
			echo "<div class='row' id='".$row['AID']."'>";
				echo "<div class='cell'>".$row['AID']."</div>";
				echo "<div class='cell'>".$row['Fjalekalimi']."</div>";//password
				echo "<div class='cell'>".$row['Privilegji']."</div>";//priviledge
				$pid=$row['AID'];

				echo "<div class='cell'><a title='Kliko per te ndryshuar kete rresht!' href='#form' onclick='edit(".$pid.")';return false;'>Ndrysho</a></div>";//edit or delete

			echo "</div>";
			
			
		}

	}
	else
		{
			echo "Kerkesa juaj nuk mund te plotesohet! Te dhenat tuaja jane gabim!";
		}
	$conn->close();
}
echo '</response>';
?>