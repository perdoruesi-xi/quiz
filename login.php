<?php 
session_start();
if(isset($_SESSION["aid"]))
	header("Location:admin.php");				

$servername = "server";
$username = "user";
$passwordDB = "pass";
$dbname = "dbname";

	if(isset($_POST['password']))$logpass=$_POST['password'];
	if(isset($_POST['id']))
		$logID=$_POST['id'];
	
	$idDB="";
	$passDB="";
	$privilegji=NULL;

	$conn = new mysqli($servername, $username, $passwordDB,$dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
		$sql = "SELECT AID,Fjalekalimi,Privilegji from tbladmin where AID=".$logID;
	if(isset($_POST['submit']))
	{


		$rezultati=$conn->query($sql);

		if(is_object($rezultati))
		{
			if($rezultati->num_rows>0)
			{
				while($row = $rezultati->fetch_assoc())
				{
					$idDB=$row["AID"];
					$passDB=$row["Fjalekalimi"];
					$privilegji=$row["Privilegji"];
					if($passDB==$row['Fjalekalimi'])
					{					
						$_SESSION["privilegji"]=$privilegji;
						$_SESSION["aid"]=$idDB;
						header("Location:admin.php");				
						exit;
						
					}
					else
					{
						echo "<script type='text/javascript'>alert('Te dhenat jane gabim!\n".$row['Fjalekalimi']."\n".$passDB."');</script>";
					}
				}
			}
		}
		else 
		{
			echo "<script type='text/javascript'>alert('Te dhenat jane gabim!".$sql."');</script>";
		}
	}	
	


	$conn->close();

?>
<html>
<style>
.input
{
		margin-left:45%;
}
</style>
<head>
<title>Login | Kuizi Islam</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>
<body>
<div class='bg'>
<br>
<h1 class="h1">Jepni të dhënat tuaja:</h1>
<form action = "login.php" method = "post" style="text-align:left">
<h2 class='page_count' style="font-size:20px;">ID</h2>
<input class="input" type='text' name='id' placeholder='ID' autocomplete="off">
<br><br>
<h2 class='page_count' style="font-size:20px">PASSWORD</h2>
<input class="input" type='password' name='password' placeholder='Password'>
<br>

<button type="submit" class='button' style="margin-left:33%;margin-top:4%" width type="button" name="submit" value="submit"><span class='p'>Kyçu</span></button>
</form>


</div>

</body>
</html>