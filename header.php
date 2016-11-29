<?php 
if(isset($_POST["logout"]))
{
	session_unset();
	session_destroy();
	header("Location:index.php");				
	exit;
}		
session_start();

if(!isset($_SESSION["aid"]))
	header("Location:index.php");				
if($_SESSION["priviledge"]==1)
	$hide="hide";
else if($_SESSION["priviledge"]==2)
	$hide='show';

?>
<html>
<head>
<style>
.btn-link
{
  border:none;
  outline:none;
  background:none;
  cursor:pointer;
  color: white;
  padding:0;
  text-decoration:none;
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
<link href="admin.css" rel="stylesheet" type="text/css" media="all" /></head>
<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

<body  style='background-color: rgb(245, 248, 249);font-family: "Open Sans";'>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="index.php">QUIZ ADMIN</a></h1>
		</div>
		<div id="menu"><form id='form1' action="header.php" method="post">
			<ul>
				<li class="active" ><a href="admin.php" accesskey="1" title="">Ballina</a></li>
				<li ><a href="admin_pyetje.php" accesskey="2" title="">Pyetjet</a></li>
				<li id="<?php echo htmlspecialchars($hide); ?>"><a href="admin_ad.php" accesskey="4" title="">Administruesit</a></li>
				<li><a href="javascript:;" onclick="document.getElementById('form1').submit();">LOG OUT</a>
												<input type="hidden" name="logout" value=<%=n%>/></li>
			</ul></form>
		</div>
	</div>
</div></body>
</html>