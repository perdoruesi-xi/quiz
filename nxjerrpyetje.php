<?php
session_start();
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
if(isset($_GET["pid"]) && $_GET['pid']!=0 && $_GET['pid']!=999)
{
	
	$nr=$_GET['pid'];
	$sql="SELECT * From tblpyetja where PID=".$nr." and aktive=1";
	$result=$conn->query($sql);
	
	if($result->num_rows>0)
	{
			echo "<div class='bg' style='min-height:97%;height:auto'><br>
			<h2 class='page_count' style='display:<?php echo $h?>'>
			<div class='progress' style='display:<?php echo $h?>'>

	  			<span class='progress-val' id='progtxt'></span>


	  			<span class='progress-bar' ><span class='progress-in' id='progbar' style=''></span></span>
			</div>
			</h2>";
		while($row=$result->fetch_assoc())
		{
				if(strpos($row['txtPyetjes'],"_"))//fill in the blanks questions
				{
					$pyetjand=explode('_',$row['txtPyetjes']);
					echo"<h1 class='h1' style='font-weight: 400'>".$pyetjand[0]."</h1>";
					echo "<input type='text' ondrop='drop(event)' onkeypress=\"this.style.width = ((this.value.length + 3 ) * 10) + 'px';\" ondragover='allowDrop(event)' style='text-align:center' name='pergjigja' class='pergjigja' id='pergjigja1' onkeyup='validof()'>";
					echo"<h1 class='h1' style='font-weight: 400'>".$pyetjand[1]."</h1>";

					echo "<input type='text' ondrop='drop(event)' onkeypress=\"this.style.width = ((this.value.length + 3 ) * 10) + 'px';\"   ondragover='allowDrop(event)' style='text-align:center' name='pergjigja' class='pergjigja' id='pergjigja2' onkeyup='validof()'>";
					$altarray=explode(';',$row['alternativat']);
					echo "<br>";
					$i=0;
					foreach($altarray as $alt)
					{
						echo "<button class='button' style='margin:5px;cursor: pointer;' id='".$alt."' ><p class='p' draggable='true' id='drag".$i."' ondragstart='drag(event)'>".$alt."</p></button>";
						$ide=$alt;$i++;
					}
					$_SESSION['psakte']=$row['pSakte'];
					$x="fill";

			
				}
				else
				{
					echo"<h1 class='h1' style='font-weight: 400'>".$row['txtPyetjes']."</h1>";
					
					$_SESSION['psakte']=$row['pSakte'];
					$altarray=explode(';',$row['alternativat']);
					if($row['fotoLocation']!="")//check if image for photo exists
						echo "<img src='".$row['fotoLocation']."'style='width:25%;height:50%;'><br>";
					
					if($row['alternativat']=="")///open questions
					{
						echo "<input type='text' onkeypress=\"this.style.width = ((this.value.length + 3 ) * 10) + 'px';\" style='text-align:center' name='pergjigja' class='pergjigja' id='pergjigja' onkeyup='validot(\"pergjigja\")'>";
						$ide='pergjigja';
						$x="blank";
					}
					else if($row['alternativat']!="")//multiple choice questions(may have photos)
					{
						$l=0;
						$t="";
						$c=0;
						foreach($altarray as $alt)
						{
							switch ($l)
							{
								case 0:
									$t='A';
									break;
								case 1:
									$t='B';
									break;
								case 2:
									$t='C';
									break;
								case 3:
									$t='D';
									break;
								case 4:
									$t='E';
									break;
								case 5:
									$t='F';
									break;
								case 6:
									$t='G';
									break;	
								default:
									$t="";
							}
							echo "<button class='button' style='margin:5px;cursor: pointer;' id='".$alt."' onclick='validob(\"".$alt."\")'><p class='p'><span style='float:left; margin-left:3%; font-weight:bold; color:#636363'>".$t.") </span><span style=text-align: center;>".$alt."</p></button>";
							$ide=$alt;
							$l=$l+1;
						}
						$x="multi";
					}

				}

				$_SESSION['pyetjat']++;
				$alt=$row['alternativat'];
				//else
				//echo "<div class='cell'>".$row['fotoLocation']."</div>";
			#echo "<hr class='style2' style='position:relative;bottom:10px;'>";
			echo "<br>";
			echo "<br>";
			echo "<button style='bottom:100px;display:<?php echo $h?>;font-size:14px;' type='submit' name='next' value='next' class='btn-link' onclick='showans(\"".$x."\")'>Shfaq përgjigjen e saktë!</button><br>";
			echo "<button style='bottom:100px;display:<?php echo $h?>;font-size:20px;' type='submit' name='next' value='next' class='btn-link' onclick='processpyetje()'>Kalo te pyetja tjetër!</button></div>";
		}

	}
	else//SQL error
	{
		echo "Kërkesa juaj nuk mund të plotësohet! Të dhënat tuaja janë gabim!";
		var_dump($sql);
	}
	$conn->close();
}
else if($_GET['pid']==999)//end of quiz, when all questions have been displayed
{
	echo "<h1 class='h1'>KUIZI KA PËRFUNDUAR!</h1>";
	echo "<a href='kuizi.php'>Provoni përsëri</a>";
	$_SESSION['pyetjat']=$_SESSION['total'];
}
else//error happened and user cannot take the quiz
{
	echo '<img src="sad.png">';	
	echo '<h1 class="h1">Kerkojme falje, per momentin nuk mund te i nenshtroheni kuizit! Provoni përsëri më vonë!</h3>';
	echo $_SESSION['total'];
}
				echo "<input type='hidden' id='ide' value='$".$ide."'$)>";
				echo "<input type='hidden' id='alt' value='+".$alt."'+>";
				echo "<input type='hidden' id='pt' value='|".$_SESSION['pyetjat']."'>";
				echo "<input type='hidden' id='ps' value='~".$_SESSION['psakte']."'>";

				
echo "</response>"
?>
<script src="valido.js"></script>