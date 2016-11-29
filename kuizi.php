<?php 
session_start();
$_SESSION['pyetjat']=0;
$_SESSION['ptj']="";
$pt=$_SESSION['pyetjat'];
$servername = "server";
$username = "user";
$passwordDB = "pass";
$dbname = "dbname";
$conn = new mysqli($servername, $username, $passwordDB,$dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//numri i pyetjeve
$sql="";
$sqlo="select query from tblorder where ID=1";
$result=$conn->query($sqlo);
if($result->num_rows>0)
{
	while($row=$result->fetch_assoc())
	{
		$sql=$row['query'];
	}
}
else
{
	$sql="SELECT PID From tblpyetja WHERE aktive=1 order by kategoria";
}
$result=$conn->query($sql);
$questions=array();
if($result->num_rows>0)
{
	while($row=$result->fetch_assoc())
	{
		$questions[]=$row['PID'];
		$_SESSION['pids']=$_SESSION['pids'].$row['PID'].",";
	}
	$_SESSION['total']=count($questions);
}
else
{
	unset($questions);
	$questions=array();
}
if(count($questions)==0)
	$h="none";
else
	$h="inline";
?>
<head>
<style>
.btn-link
{
  border:none;
  outline:none;
  background:none;
  text-decoration:none;
  cursor:pointer;
  color: rgb(100, 114, 135);
  padding:0;
  margin:5px;
  font-family:'Open Sans',sans-serif;
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
<script>
function allowDrop(ev) 
{
    ev.preventDefault();
}

function drag(ev) 
{
    ev.dataTransfer.setData("Text", ev.target.id);
}

function drop(ev) 
{
    var data = ev.dataTransfer.getData("Text");
    ev.target.value=document.getElementById(data).innerHTML;
    validof();
    ev.preventDefault();
}
</script>
<!--AJAX KERKESA-->
<script>
var xmlHttp = createXmlHttpRequestObject();
var questions = [];


k=-1;
nrp=1;
ps="";
x=0;
function createXmlHttpRequestObject(){
var xmlHttp;
if(window.ActiveXObject){ 
    try{
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }catch(e){
        xmlHttp = false;
    }
}else{ 
    try{
        xmlHttp = new XMLHttpRequest();
    }catch(e){
        xmlHttp = false;
    }
}

if(!xmlHttp)
    console.log("Cant create that object !")
else
    return xmlHttp;
}

function processpyetje()//send AJAX request to nxjerrpyetje.php
{
	if(xmlHttp.readyState==0 || xmlHttp.readyState==4)
	{
		questions=document.getElementById("pids").value.split(" ");
		questions.pop();
		if(k<questions.length-1)
		{
			k++;
			if(questions.length==0)
				questions[k]=null;
			xmlHttp.open("GET", "nxjerrpyetje.php?pid=" + questions[k],true);
		}
		else 
		{
			xmlHttp.open("GET", "nxjerrpyetje.php?pid=" + 999,true);
		}

		xmlHttp.onreadystatechange = handleServerResponse;
		xmlHttp.send(null);

	}
	else
	{
		setTimeout('processpyetje()',2000);
		k++;
	}
}

function handleServerResponse()//gets AJAX request results
{
if(xmlHttp.readyState==4){ 
    if(xmlHttp.status==200)
	{
        document.getElementById("rezultatipyetje").innerHTML = xmlHttp.responseText;
		text=xmlHttp.responseText;
		
		p=text.split('~')[1];
		ps=p.split('\'')[0];
		x=xmlHttp.responseText.split('|')[1];
		y=x.split('\'')[0];
		document.getElementById('progtxt').innerHTML="Pyetja "+y+"/"+<?php echo count($questions)?>;
		a=(y/<?php echo count($questions);?>);
		document.getElementById('progbar').style.width=(a*100)+"%";



	}
	else
	{
		console.log('Someting went wrong !');
	}
}
}
function showans(x)//shows right answer
{
	if(x=="fill")
	{
		p=ps.split(",");
		p[1]=p[1].trimLeft();
		x1=document.getElementById('pergjigja1');
		x2=document.getElementById('pergjigja2');
		x1.className='input_right';
		x1.value=p[0].toUpperCase().trim();
		x2.className='input_right';
		x2.value=p[1].toUpperCase().trim();
	}
	else if(x=="blank")
	{
		x=document.getElementById("pergjigja");
		x.className='input_right';
		x.value=ps.toUpperCase().trim();
	}
	else
	{
		x=document.getElementById(ps);
		x.className='button_right';
	}
}
function getRandomInt(min, max) 
{
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
function in_array(array, el) {
   for(var i = 0 ; i < array.length; i++) 
       if(array[i] == el) 
		   return true;
		else 
			return false;
}

function validot(id)//validates open questions
{
	x=document.getElementById(id);
	if(x.value.toUpperCase().trim()==ps.toUpperCase().trim())
		x.className='input_right';
	else
		x.className='input_wrong';
}
function validof()//validates fill in the blank questions
{
	p=ps.split(",");
	p[1]=p[1].trimLeft();
	x1=document.getElementById('pergjigja1');
	x2=document.getElementById('pergjigja2');
	if(x1.value.toUpperCase().trim()==p[0].toUpperCase().trim())
	{
		x1.className='input_right';
		
		
	}
	else
	{
		x1.className='input_wrong';
	}
	if(x2.value.toUpperCase().trim()==p[1].toUpperCase().trim())
	{
		x2.className='input_right';
		
		
	}
		else
	{
		x2.className='input_wrong';
	}
}
function validob(alt)//validates multiple choice questions
{
	x=document.getElementById(alt);
	if(alt.trim()!=ps.trim())
	{
		x.className='button_wrong';
		document.getElementById(ps).className='button_right';
	}
	else
		x.className='button_right';
}
</script>
<title>Kuizi Islam</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="hr.css">
<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="table.css">
<link rel="stylesheet" type="text/css" href="progbar.css">
<script src="valido.js"></script>
</head>
<body class='body' style="background-color:white" onload="processpyetje();">
<input type="hidden" name="nrpGET" id="pyc" value="<?php echo $pt;?>">
<input type="hidden" name="nrt" id="pytot" value="<?php echo count($questions);?>">
<input type="hidden" name="nrt" id="pids" value="<?php foreach($questions as $p) echo $p." ";?>">

<div  id="rezultatipyetje" style="min-height:97.5%;height:auto;"></div>
	

</body>
</html>