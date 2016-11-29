<?php
require('header.php');

if($_SESSION["priviledge"]==2)
	$hide="none";
else if($_SESSION["priviledge"]==1)
	$hide='inline';

?>
<html >
<head>
<style>
a:link {
    color: #fffff;
	text-decoration:none;
}

a:visited {
    color: #fffff;
	text-decoration:none;
}

a:hover {
    color: #fffff;
	text-decoration:none;
}

a:active {
    color: #fffff;
	text-decoration:none;
} 
#show
{
	display:inline;
}
#hide
{
	display:none;
}
.btn-link
{
  border:none;
  outline:none;
  background:none;
  cursor:pointer;
  color: rgb(100, 114, 135);
  padding:0;
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
  font-family:inherit;
  font-size:inherit;
}


</style>
<title>ADMIN | Kuizi Islam</title>
<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link href="default.css" rel="stylesheet" type="text/css" media="all" />

</head>
<body>

<?php 
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


<!-- Navigation -->
<div style="margin:30px"><br><br>
<p>Ky sistem ofron mundësinë për të menaxhuar me pyetjet e kuizit, duke mundësuar shtimin, ndryshimin dhe fshirjen e tyre.<br> Poashtu mundëson edhe menaxhimin me administrues, duke mundësuar shtimin, ndryshimin apo fshirjen. <br><br>Për më shumë rreth këtyre, shihni më poshtë sektorët përkatës.

</p>
<div id="a" style="display:<?php echo $hide ?>"><h1>Adminsitruesit</h1><br><br>
<h2 >Kërkimi</h2><br>
<p>Për të shfaqur të gjithë administruesit, te fusha për kërkim shtyp *, kurse për të kërkuar një administrues, shtypni ID e tij.</p>
<br><h4 >Privilegji</h4>
<p>Privilegji 1 nënkupton që administruesi ka çasje edhe në të dhënat e administruesve tjerë, kurse 2 nënkupton që ai ka çasje vetëm te menaxhimi i pyetjeve.</p>
<br><br><h2 >Regjistrimi</h2><br>
<p>Për të regjistruar një administrues të ri, mbushni të gjitha fushat e nevojshme, kurse AID caktohet nga sistemi. </p>
<br><br><h2 >Ndryshimi</h2><br>
<p>Për të ndryshuar të dhënat e një administruesi, klikoni ndrysho pranë të dhënave të tij, pastaj ndryshoni ato sipas dëshirës dhe klikoni butonin Ndrysho.</p>
<br><h2 >Fshirja</h2><br><br>
<p>
Për të fshirë nga sistemi një administrues, klikoni ndrysho pranë të dhënave të tij, pastaj ndryshoni ato sipas dëshirës dhe klikoni butonin Fshij. Për të konfirmuar se është fshirë, kërko me * dhe shiko a paraqitet kjo kolonë.
</p>
<br><br><br>
</div>
<div id='p'><h1>Pyetjet</h1><br><br>
<h2> Renditja</h2><br>
<p>Pyetjet renditen sipas kategorisë, ku secila kategori ka numrin përkatës. Renditjen mund ta ndryshoni me drag-drop, pastaj duke klikuar butonin SAVE. Renditja e tanishme paraqitet vetëm me numra, të cilët mund ti identifikoni tek lista.</p><br>
<h2 >Kërkimi</h2><br>
<p>Për të shfaqur të gjitha pyetjet, te fusha për kërkim shtyp *, kurse për të kërkuar një pyetje, shtypni ID e saj.</p>
<br><h4>Pyetja</h4>
<p>Kjo kolonë paraqet vetë pyetjen. Nëse pyetja është e llojit "tekst me zbrazëtira", atëherë duhet që te pjesa ku mendoni ta shfaqni zbrazëtirën të vendosni _. Psh: "Sot është ditë e _, nesër është ditë e _". Ky lloj i pyetjeve parasheh se duhet të ketë 2 zbrazëtira. </p>
<br><h4>Alternativat</h4>
<p>Për një pyetje të hapur(që përgjigjen e shkruan përdoruesi gjatë kuizit), apo për anagram, kjo fushë të lihet e zbrazët. Kurse për pyetjet me PO/JO, apo A,B,C,D, të shkruhen alternativat dhe të ndahen me ; si psh. Islam; Kuran; Sunnet. Pyetjet me më shumë se 4 alternativa janë pyetje që duhet të mbushen zbrazëtirat. KUJDES! Vetëm njëra nga alternativat mund të jetë e saktë.</p>
<br><h4>Përgjigja e saktë</h4>
<p>Këtu shënohet përgjigja e saktë e pyetjes, pa marrë parasysh llojin e saj. Nëse pyetja është e llojit "tekst me zbrazëtira", atëherë përgjigja e saktë shkruhet sipas rradhës së zbrazëtirave, duke ndarë me , dhe një hapësirë. Psh: saktë1, saktë2</p>
<br><h4>Fotografia</h4>
<p>Nëse pyetja përmban fotografi, atë duhet ta vendosni në këtë fushë.</p>
<br><h4>Aktive</h4>
<p>Nëse dëshironi që kjo pyetje të jetë aktive në kuiz, duhet këtë fushë ta bëni PO, përndryshe duhet ta leni JO.</p>

<br><br><h2 >Regjistrimi</h2><br>
<p>Për të regjistruar një pyetje të re, duhet që të mbushni të gjitha fushat e nevojshme, kurse PID caktohet nga sistemi. Për të konfirmuar se është regjistruar, kërko me * dhe shiko a paraqitet kjo kolonë.</p>
<br><br><h2 >Ndryshimi</h2><br>
<p>Për të ndryshuar të dhënat e një administruesi, klikoni ndrysho pranë të dhënave të pyetjes, pastaj ndryshoni ato sipas dëshirës dhe klikoni butonin Ndrysho. Për të konfirmuar se është ndryshuar, kërko me * dhe shiko a paraqitet kjo kolonë.</p>
<br><h2 >Fshirja</h2><br><br>
<p>
Për të fshirë nga sistemi një pyetje, klikoni ndrysho pranë të dhënave të pyetjes, pastaj ndryshoni ato sipas dëshirës dhe klikoni butonin Fshij. Për të konfirmuar se është fshirë, kërko me * dhe shiko a paraqitet kjo kolonë.
</p>

<br><br><br>
</div>
	<hr><h1>KUJDES!</h1>
	<strong>Për të fshirë apo ndryshuar pyetjet me lehtësi, kliko Ndrysho tek pyetja, e pastaj ndryshoni përmbajtjen në formën poshtë ku do të ju paraqiten të dhënat e pyetjes.</strong><br><br>
	<strong>Nëse teksti përmban&nbsp;&nbsp;<big>'</big>&nbsp;&nbsp;atëherë duhet ta shkruani&nbsp;&nbsp;<big>\'</big>&nbsp;&nbsp;sepse paraqitet error!.</strong>

</div>
<strong>Nëse ke nevojë për ndihmë, kontakto <a href="mailto:dhkelmendi@gmail.com?Subject=Ndihme%20per%20KUIZ">dhkelmendi@gmail.com</a></strong>

</body>

</html>