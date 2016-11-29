<?php
require('header.php');
error_reporting(E_ALL);
$hide;
if(!isset($_SESSION["aid"]))
	header("Location:index.php");				

if($_SESSION["priviledge"]==2)
	$hide="hide";
else if($_SESSION["priviledge"]==1)
	$hide='show';
$aidSesion=$_SESSION["aid"];
if(isset($_POST["logout"]))
{
	session_unset();
	session_destroy();
	header("Location:index.php");				
	exit;
}		
?>
<html >
<head>
<style>
.btn-link
{
  border:none;
  outline:none;
  background:none;
  cursor:pointer;
  color: rgb(100, 114, 135);
  padding:0;
  text-decoration:underline;
  font-family:inherit;
  font-size:inherit;
  margin-right:0%;
}
.btn-link:hover
{
	border:none;
  outline:none;
  background:none;
  cursor:pointer;
  color: rgb(100, 114, 135);
  padding:0;
  text-decoration:underline;
  font-family:inherit;
  font-size:inherit;
}
#show
{
	display:inline;
}
#hide
{
	display:none;
}
</style>
<title>ADMIN | Kuizi Islam</title>
<link rel="stylesheet" type="text/css" href="table.css">
<link rel="stylesheet" type="text/css" href="srbox.css">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="hr.css">
<link rel="stylesheet" type="text/css" href="button.css">
<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="kerkoadmin.js"></script>
</head>
<body class='body' onload="processadmin()">


<br>
<hr class="hr-text" data-content="ADMINISTRUESIT">
<div id="<?php echo $hide ?>" style='background-color:#f2bfbf'><br>
<div class='search-wrapper cf' style="margin-left:4.5%">
<h2>Kërko administrues:</h2><br>

<!--<h4 style="margin-left:20px;border:none;">ID:</h3>-->
  <input type="text" placeholder="Shkruaj ID..." id="kerkoadmin" autocomplete="off" value="*" onkeyup="processadmin()")>
	<button type="button" onclick="processadmin()" name="kerkoadmin" value="kerkoadmin">Kërko</button>

<div class='wrapper' style="background-color: rgb(245, 248, 249);" id="rezultatiadmin"></div>
</div>
<?php
$servername = "server";
$username = "user";
$passwordDB = "pass";
$dbname = "dbname";
$conn = new mysqli($servername, $username, $passwordDB,$dbname);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 
$aiddb="";
$privdb="";
$passdb="";


if(isset($_POST['Register']))
{

	$pass=$_POST['pass'];
	$passver=$_POST['passver'];
	$id=$_POST['id'];
	$priv=$_POST['priv'];

	$SQLINSERT="INSERT into tbladmin(Fjalekalimi,Privilegji) Values ('".$pass."',".$priv.")";
	$insert=$conn->query($SQLINSERT);

	if($insert==TRUE)
	{
		$message1="Te dhenat u regjistruan me sukses";
		echo "<script type='text/javascript'>alert('$message1');</script>";
		$aiddb=$id;
		$privdb=$priv;
		$passdb=$pass;
		$_SESSION['regsuccess']=true;
		$_SESSION['pass']=$passakt;
		$page = $_SERVER['REQUEST_URI'];
echo '<script type="text/javascript">';
echo 'window.location.href="'.$page.'";';
echo '</script>';		
	}
	$conn->close();
	
	unset($_POST);

}
//Behet UPDATE i te dhenave te administruesit
if(isset($_POST['Update']))
{

	if(!empty($_POST['pass']) && !empty($_POST['passver']))
	{
		$pass=$_POST['pass'];
		$passver=$_POST['passver'];
		if(($pass!=$passver))
			echo "<script type='text/javascript'>alert('Fjalëkalimet duhet te jenë të njëjta!');</script>";	
		else
		{
			$id=$_POST['id'];
			$priv=$_POST['priv'];


			$SQLUPDATE="UPDATE tbladmin SET Fjalekalimi='".$pass."',Privilegji=".$priv." WHERE AID=".$id;
			$update=$conn->query($SQLUPDATE);
			if($update==TRUE)
			{
				$message1="Te dhenat u ndryshuan me sukses".$passakt;
				echo "<script type='text/javascript'>alert('$message1');</script>";
				$aiddb=$id;
				$privdb=$priv;
				$passdb=$pass;
				$_SESSION['pass']=$passakt;
				$_SESSION['updsuccess']=true;	
				$page = $_SERVER['REQUEST_URI'];
echo '<script type="text/javascript">';
echo 'window.location.href="'.$page.'";';
echo '</script>';		
			}
		}
	}
	else 
		echo "BLLA";
	$conn->close();
	
	unset($_POST);
}
//Behet DELETE i te dhenave te administruesit
if(isset($_POST['Delete']))
{
	$id=$_POST['id'];
	if($id==$aidSesion)
	{
		$message1="Nuk mund te fshini vetveten nga baza e te dhenave!";
		echo "<script type='text/javascript'>alert('$message1');</script>";
	}
	else
	{
		$SQLDELETE="DELETE FROM  tbladmin WHERE AID=".$id;	
		$dl_stud=$conn->query($SQLDELETE);
		if($dl_stud==TRUE)
		{
			$message1="Te dhenat jane fshier me sukses";
			echo "<script type='text/javascript'>alert('$message1');</script>";
			$_SESSION['delsuccess']=true;
			$page = $_SERVER['REQUEST_URI'];
echo '<script type="text/javascript">';
echo 'window.location.href="'.$page.'";';
echo '</script>';		
		}
		$conn->close();
	}
	unset($_POST);

}
if(isset($_SESSION['regsuccess'])&&$_SESSION['regsuccess']=true)
{
	$message1="Te dhenat u regjistruan me sukses!";
	echo "<script type='text/javascript'>alert('$message1\n".$_SESSION['pass']."');</script>";
	unset($_SESSION['regsuccess']);
}
if(isset($_SESSION['updsuccess'])&&$_SESSION['updsuccess']=true)
{
	$message1="Te dhenat u ndryshuan me sukses!".$_SESSION['pass'];
	echo "<script type='text/javascript'>alert('$message1');</script>";
	unset($_SESSION['updsuccess']);
}
if(isset($_SESSION['delsuccess'])&&$_SESSION['delsuccess']=true)
{
	$message1="Te dhenat jane fshier me sukses!";
	echo "<script type='text/javascript'>alert('$message1');</script>";
	unset($_SESSION['delsuccess']);
}

?>

	<script>
function edit(pid)
{

	id=document.getElementById('id');
	priv=document.getElementById('priv');
	pass=document.getElementById('pass');
	passver=document.getElementById('passver');

	pd=document.getElementById(pid).childNodes[0].innerHTML;
	id.value=pd;
	
	pr=document.getElementById(pid).childNodes[2].innerHTML;
	priv.value=pr;
	
	p=document.getElementById(pid).childNodes[1].innerHTML;
	pass.value=p;

	passver.value=p;

}
	</script>

<hr class='style5'>
<div class='wrapper' style="background-color: rgb(245, 248, 249);width:85%">
<h2>Ndrysho/Fshij administrues:</h2><br>
<form action="admin_ad.php" method="POST"  id="form">
<div class='row header green'>
<div class='cell'>AID:</div>
<div class='cell'>Privilegji:</div>
<div class='cell'>Fjalekalimi:</div>
<div class='cell'>Fjalekalimi(Konfirmim):</div>
</div>
<div class='row'>
	<div class='cell'><input id="id" type="number" min="1" max="999" name="id" value="<?php if($aiddb!="") echo $aiddb;?>"required> </div>
	<div class='cell'><input id="priv" type="number" min="1" max="2" name="priv" value="<?php if($privdb!="") echo $privdb;?>" required/></div>
	<div class='cell'><input id="pass" type="text" name="pass" required/></div>
	<div class='cell'><input id="passver" type="text" name="passver" required/></div>
</div>

<br><br>

<button type="submit" name="Register" value="Register"  class='register'>Regjistro</button>
<button type="submit" name="Update" value="Update"  class='update'>Ndrysho</button>
<button type="submit" name="Delete" value="Delete"  class='delete'>Fshij</button>

</form>	
</div>
</div>
</body>

</html>