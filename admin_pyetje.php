<?php
require('header.php');
error_reporting(E_ALL);
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

	$sql="SELECT order_only From tblorder";
	$result=$conn->query($sql);
	$x="";
	if($result->num_rows>0)
	{
		while($rreshti=$result->fetch_assoc())
		{
			$x=$rreshti['order_only'];
		}

	}
	else
	{
		$x="1,2,3,4";
	}
$hide;
if(!isset($_SESSION["aid"]))
{
	$page = 'index.php';
	echo '<script type="text/javascript">';
	echo 'window.location.href="'.$page.'";';
	echo '</script>';
	#header("Location:index.php");				
}
if($_SESSION["privilegji"]==2)
	$hide="hide";
else if($_SESSION["privilegji"]==1)
	$hide='show';
$aidSesion=$_SESSION["aid"];
if(isset($_POST["logout"]))
{
	session_unset();
	session_destroy();
	$page = 'index.php';
	echo '<script type="text/javascript">';
	echo 'window.location.href="'.$page.'";';
	echo '</script>';

	#header("Location:index.php");				
	#exit;
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
<link rel="stylesheet" type="text/css" href="hr.css">
<link rel="stylesheet" type="text/css" href="table.css">
	<link rel="stylesheet" type="text/css" href="order.css">

<link rel="stylesheet" type="text/css" href="srbox.css">
<link rel="stylesheet" type="text/css" href="button.css">

<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Oswald" />

<script type="text/javascript" src="kerkopyetje.js"></script>
<script type="text/javascript" src="order.js"></script>
</head>
<body class='body' style="width:80%;margin-left:0" onload="processpyetje()">

<br>
<?php
$f=false;
$conn = new mysqli($servername, $username, $passwordDB,$dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$aiddb="";
$privdb="";
$passdb="";

//ruhet pyetja e re
if(isset($_POST['PyetjaRegister']))
{
	$txt=$_POST['txtPyetjes'];
	$id=$_POST['PID'];
	$psakte=$_POST['psakte'];
	$alternativat=$_POST['alternativat'];
	$aktive=$_POST['aktive'];
	$kategoria;
	if($aktive=="PO")
		$aktive=1;
	else
		$aktive=0;
	$fl=fileUpload();
	if(strpos($txt,"_"))
	{					
		$kategoria=1;
	}
	else
	{
		if($fl!=="")
			$kategoria=5;
		else
		{
			if($alternativat=="")
			{
				$kategoria=2;
			}
			else if($alternativat!="")
			{				
				if($psakte=="PO" or $psakte=="JO")
				{					
						$kategoria=4;					
				}
				else
				{

						$kategoria=3;
				}
			}		
		}
	}

	$SQLINSERT="";
	if($fl!="")
		$SQLINSERT="INSERT into tblpyetja(txtPyetjes,pSakte,alternativat, aktive, fotoLocation, kategoria) Values (\"".$txt."\",\"".$psakte."\",\"".$alternativat."\",".$aktive.",\"".$fl."\",".$kategoria.")";
	else
		$SQLINSERT="INSERT into tblpyetja(txtPyetjes,pSakte,alternativat, aktive, kategoria) Values ('".$txt."','".$psakte."','".$alternativat."',".$aktive.",".$kategoria.")";
	$insert=$conn->query($SQLINSERT);
	if($insert==TRUE)
	{
		$_SESSION['regsuccess']=true;
		
		$page = $_SERVER['REQUEST_URI'];
		echo '<script type="text/javascript">';
		echo 'window.location.href="'.$page.'";';
		echo '</script>';

		/*header("Location:admin_pyetje.php");
		exit();*/
	}
	else
	{
		echo "GABIM".mysqli_error($conn);
		var_dump($SQLINSERT);
	}
	$conn->close();
	
	unset($_POST);

}
//Behet UPDATE i te dhenave te pyetjes
if(isset($_POST['PyetjaUpdate']))
{

	$txt=$_POST['txtPyetjes'];
	$id=$_POST['PID'];
	$psakte=$_POST['psakte'];
	$alternativat=$_POST['alternativat'];
	$aktive=$_POST['aktive'];
	$fl=fileUpload();
	if($aktive=="PO")
		$aktive=1;
	else
		$aktive=0;
	if(strpos($txt,"_"))
	{					
		$kategoria=1;
	}
	else
	{
		if($fl!=="")
			$kategoria=5;
		else
		{
			if($alternativat=="")
			{
				$kategoria=2;
			}
			else if($alternativat!="")
			{				
				if($psakte=="PO" or $psakte=="JO")
				{					
						$kategoria=4;					
				}
				else
				{

						$kategoria=3;
				}
			}		
		}
	}
	if($fl!="")
		$SQLUPDATE="UPDATE tblpyetja SET txtPyetjes='".$txt."',psakte='".$psakte."', alternativat='".$alternativat."',fotoLocation='".$fl."', aktive=".$aktive.", kategoria=".$kategoria." WHERE PID=".$id;
	else
		$SQLUPDATE="UPDATE tblpyetja SET txtPyetjes='".$txt."',psakte='".$psakte."', alternativat='".$alternativat."', aktive=".$aktive.", kategoria=".$kategoria." WHERE PID=".$id;
	$update=$conn->query($SQLUPDATE);
	if($update==TRUE)
	{
		$_SESSION['updsuccess']=true;	

		$page = $_SERVER['REQUEST_URI'];
		echo '<script type="text/javascript">';
		echo 'window.location.href="'.$page.'";';
		echo '</script>';

		/*header("Location:admin_pyetje.php");
		exit();		*/
	}
	else
	{
		echo "GABIM".mysqli_error($conn);		
		var_dump($SQLUPDATE);
	}
	$conn->close();
	
	unset($_POST);

}
//Behet DELETE i te dhenave te pyetjes
if(isset($_POST['PyetjaDelete']))
{
	$id=$_POST['PID'];
	if($id==$aidSesion)
	{
		$message1="Nuk mund te fshini vetveten nga baza e te dhenave!";
		echo "<script type='text/javascript'>console.log('$message1');</script>";
	}
	else
	{
		$SQLDELETE="DELETE FROM  tblpyetja WHERE PID=".$id;	
		$dl_stud=$conn->query($SQLDELETE);
		if($dl_stud==TRUE)
		{
			$_SESSION['delsuccess']=true;
			
			$page = $_SERVER['REQUEST_URI'];
			echo '<script type="text/javascript">';
			echo 'window.location.href="'.$page.'";';
			echo '</script>';

/*			header("Location: " . $_SERVER['REQUEST_URI']);
			exit();		*/

		}
		$conn->close();
	}
	unset($_POST);

}
if(isset($_SESSION['regsuccess'])&&$_SESSION['regsuccess']=true)
{
	$message1="Te dhenat u regjistruan me sukses!";
	echo "<script type='text/javascript'>alert('$message1');</script>";

	unset($_SESSION['regsuccess']);

}
if(isset($_SESSION['updsuccess'])&&$_SESSION['updsuccess']=true)
{
	$message1="Te dhenat u ndryshuan me sukses!";
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

	id=document.getElementById('pid');	txt=document.getElementById('txtpyetjes');
	alt=document.getElementById('alternativat');
	ps=document.getElementById('psakte');

	pd=document.getElementById(pid).childNodes[0].innerHTML;
	id.value=pd;
	
	text=document.getElementById(pid).childNodes[1].innerHTML;
	txt.value=text;
	
	alter=document.getElementById(pid).childNodes[2].innerHTML;
	alt.value=alter;
	
	psakte=document.getElementById(pid).childNodes[3].innerHTML;
	ps.value=psakte;
	//document.getElementbyId('pid').value=pid;

}

</script>


<hr class="hr-text" data-content="PYETJET">
<div class='search-wrapper cf' style="margin-left:4.5%;min-width:300px;width:auto;max-width:96%">
<h2>Kërko pyetje:</h2><br>
<!--<h4 style="margin-left:20px;border:none;">ID:</h3>-->
  <input type="text" placeholder="Shkruaj pyetjen apo disa pjese te saj..."id="kerkopyetje" value="*" autocomplete="off" onkeyup="processpyetje()">
	<button type="button" onclick="processpyetje()" name="kerkopyetje" value="kerkopyetje">Kërko</button>
<div class='wrapper' id="rezultatipyetje" style="background-color: rgb(245, 248, 249);">
</div></div>
<hr class='style5'>
	<form action="admin_pyetje.php" method="POST" id="form" enctype="multipart/form-data">

<div id='pyetje'  style="width:99%;margin-left:1px"><br>
		<div class="wrapper"  style="background-color: rgb(245, 248, 249);width:98%">
			<h2>Menaxho me pyetjet:</h2><br>
			<div class='row header blue'>
				
				<div class='cell' style="width:350px">Pyetja</div>
				<div class='cell'>Alternativat</div>
				<div class='cell'>Pergjigja e sakte</div>				
				<div class='cell'>Foto</div>
				<div class='cell'>Aktive/Joaktive</div>
			</div>
			<div class='row'>
				<input type="hidden" name="PID" id="pid" >
				<div class='cell' style="width:auto;height:auto;word-wrap:normal;word-break:break-all;"><input type="text" name="txtPyetjes" id='txtpyetjes' style="width:100%;height:80%" required></div>
				<div class='cell' style="width:auto;height:auto;word-wrap:normal;word-break:break-all;"><input type="text" id="alternativat" name="alternativat" id='alternativat'  style="width:100%;height:80%"></div>
				<div class='cell' style="width:auto;height:auto;word-wrap:normal;word-break:break-all;"><input type="text" name="psakte" id='psakte'  style="width:100%;height:80%"></div>	
				<div class='cell' style="width:auto"><input type="file" name="file" id="file"></div>
				<div class='cell' style="width:auto">				
					<select id="aktive" name="aktive">
						<option value="PO">PO</option>
						<option value="JO">JO</option>
					</select>
				</div>
			</div>
<br>
<button type="submit" name="PyetjaRegister" value="PyetjaRegister"  class='register'>Regjistro</button>
<button type="submit" name="PyetjaUpdate" value="PyetjaUpdate" class='update'>Ndrysho</button>
<button type="submit" name="PyetjaDelete" value="PyetjaDelete" class='delete'>Fshij</button>		

</div>
</div>

	</form>
<hr class='style5'>
<br>
<div class="wrapper"  style="background-color: rgb(245, 248, 249);">
<h2 style="font-family: 'Open Sans', sans-serif;">Ndrysho renditjen e pyetjeve sipas kategorisë (sipas rendit nga lartë poshtë):</h2><br>
<h4 >Renditja e tanishme: <span id="displayorder"><?php echo $x;?></span>.</h4>
<div id="order" >
<script>
var source;

function isbefore(a, b) {
    if (a.parentNode == b.parentNode) {
        for (var cur = a; cur; cur = cur.previousSibling) {
            if (cur === b) { 
                return true;
            }
        }
    }
    return false;
} 

function dragenter(e) {
    if (isbefore(source, e.target)) {
        e.target.parentNode.insertBefore(source, e.target);
    }
    else {
        e.target.parentNode.insertBefore(source, e.target.nextSibling);
    }
}

function dragstart(e) {
    source = e.target;
    e.dataTransfer.effectAllowed = 'move';
}
</script>
<button id="btnReload" onclick="processorder()">SAVE</button>

<ul class="rolldown-list" id="myList">
  <li draggable="true" ondragenter="dragenter(event)" ondragstart="dragstart(event)">1. Fjali me fjalë që mungojnë</li>
  <li draggable="true" ondragenter="dragenter(event)" ondragstart="dragstart(event)">2. Shkruaj përgjigjen</li>
  <li draggable="true" ondragenter="dragenter(event)" ondragstart="dragstart(event)">3. Me alternativa(A/B/C/D...)</li>
  <li draggable="true" ondragenter="dragenter(event)" ondragstart="dragstart(event)">4. Me alternativa(PO/JO)</li>
  <li draggable="true" ondragenter="dragenter(event)" ondragstart="dragstart(event)">5. Me fotografi</li>
</ul> 
<input type="hidden" id="orderstorage">
<script>
/*ul = document.getElementById("myList");
var list=[];
//add to array
for(var i = 0;i<ul.childNodes.length;i++)
{
		if(ul.childNodes[i].nodeName === 'LI')
		 	list.push(ul.childNodes[i].innerHTML);
}
p=document.getElementById("order_db").value;
or=p.split(',');
alert(p);			
for(var i=0; i<list.length; i++) 
{
    console.log(or[i]+":", list[i]);
    lis[i] = list[i];
}
for(i=0;i<lis.length;i++)
	//alert(lis[i]+"\n");


for(var i = 1; i <= list.length; i++)
		ul.childNodes[i].innerHTML=lis[i];
*/
</script>
</div>
</div>

<?php
function fileUpload()
{
	$name = $_FILES['file']['name'];
	$r="";
	$extension = pathinfo($name,PATHINFO_EXTENSION);
	$type = $_FILES['file']['type'];
	$size = $_FILES['file']['size'];
	$max_size = 2097152;//2MB
	$tmp_name = $_FILES['file']['tmp_name'];
	$error = $_FILES['file']['error'];


	if(isset($name))
	{
		if(!empty($name))
		{
			if(($extension=='jpg' || $extension=='jpeg' ||$extension=='png')&& ($type=='image/jpg' || $type=='image/jpeg')|| $type='image/png')
			{
				if($size<=$max_size)
				{
					$location='foto/';
					if(move_uploaded_file($tmp_name, $location.$name))
						$r=$location.$name;
					else
						echo 'Ka ndodhur nje gabim!';
				}
				else
					'Foto nuk mund te jete me e madhe se 2MB';
			}
			else
				echo 'Ju lutemi zgjedhni nje file JPG, JPEG ose PNG!';
		}
		else
		{
			return "";
		}
	}
	
	
	return $r;
}

?>
</body>

</html>