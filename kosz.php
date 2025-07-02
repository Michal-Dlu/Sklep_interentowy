<?php
session_start();
$con=mysqli_connect('localhost','root','','sklep');
print "<h1>"."Użytkownik niezalogowany"."<br>"."</h1>";
print "Dziś jest: ".$data = date('j-m-Y')."<br>";
$time = date('H:i:s');

print "Zamówienie: "."<br>";
if (isset($_SESSION['smycz']))
{$smycz=$_SESSION['smycz'];
if ($smycz == 0)
{
	print "";
}
else {
switch($smycz)
	{
		
		case 1: print "1 smycz cena: 10 zł"."<br>";
		break;
		case 2: print $smycz." "."smycze cena: 10 zł, do zapłaty :".$smycz*10 ." "."zł"."<br>";
		break;
		case 3: print $smycz." "."smycze cena: 10 zł, do zapłaty :".$smycz*10 ." "."zł"."<br>";
		break;
		case 4: print $smycz." "."smycze cena: 10 zł, do zapłaty :".$smycz*10 ." "."zł"."<br>";
		break;
		default: print $smycz." "."smyczy cena: 10 zł, do zapłaty :".$smycz*10 ." "."zł"."<br>";   
		
	}
}
}

if(isset($_SESSION['kalendarz']))
{$kalendarz=$_SESSION['kalendarz'];
if ($kalendarz == 0)
{print "";
}
else {
switch($kalendarz)
	{
	
		case 1: print "1 kalendarz cena: 15 zł"."<br>";
		break;
		case 2: print $kalendarz." "."kalendarze cena: 15 zł, do zapłaty:  ".$kalendarz*15 ." "."zł"."<br>";
		break;
		case 3: print $kalendarz." "."kalendarze cena: 15 zł, do zapłaty:  ".$kalendarz*15 ." "."zł"."<br>";
		break;
		case 4: print $kalendarz." "."kalendarze cena: 15 zł, do zapłaty:  ".$kalendarz*15 ." "."zł"."<br>";
		break;
		default: print $kalendarz." "."kalendarzy cena: 15 zł, do zapłaty:  ".$kalendarz*15 ." "."zł"."<br>";   
		
	}
}
}

if(isset($_SESSION['kubek']))
{$kubek=$_SESSION['kubek'];
if ($kubek == 0)
{print "";
}
else {
switch($kubek)
	{
	
		case 1: print "1 kubek cena: 20 zł"."<br>";
		break;
		case 2: print $kubek." "."kubki cena: 20 zł, do zapłaty: ".$kubek*20 ." "."zł"."<br>";
		break;
		case 3: print $kubek." "."kubki cena: 20 zł, do zapłaty: ".$kubek*20 ." "."zł"."<br>";
		break;
		case 4: print $kubek." "."kubki cena: 20 zł, do zapłaty: ".$kubek*20 ." "."zł"."<br>";
		break;
		default: print $kubek." "."kubków cena: 20 zł, do zapłaty: ".$kubek*20 ." "."zł"."<br>";   
		
	}
}
} 

if(isset($_SESSION['koszulka']))
{$koszulka=$_SESSION['koszulka'];
if ($koszulka == 0)
{print "";
}
else {
switch($koszulka)
	{
		
		case 1: print "1 koszulka cena: 60 zł"."<br>";
		break;
		case 2: print $koszulka." "."koszulki cena: 60 zł, do zapłaty: ".$koszulka*60 ." "."zł"."<br>";
		break;
		case 3: print $koszulka." "."koszulki cena: 60 zł, do zapłaty: ".$koszulka*60 ." "."zł"."<br>";
		break;
		case 4: print $koszulka." "."koszulki cena: 60 zł, do zapłaty: ".$koszulka*60 ." "."zł"."<br>";
		break;
		default: print $koszulka." "."koszulek cena: 60 zł, do zapłaty: ".$koszulka*60 ." "."zł"."<br>";   
		
	}
}
}
if(isset($_SESSION['podkladka']))
{$podkladka=$_SESSION['podkladka'];
if ($podkladka == 0)
{print "";
}
else {
switch($podkladka)
	{
	
		case 1: print "1  podkładka pod mysz cena: 25 zł"."<br>";
		break;
		case 2: print $podkladka." "."podkładki pod mysz cena: 25 zł, do zapłaty:  ".$podkladka*25 ." "."zł"."<br>";
		break;
		case 3: print $podkladka." "." podkładki pod mysz cena: 25 zł, do zapłaty:  ".$podkladka*25 ." "."zł"."<br>";
		break;
		case 4: print $podkladka." "."podkładki pod mysz cena: 25 zł, do zapłaty:  ".$podkladka*25 ." "."zł"."<br>";
		break;
		default: print $podkladka." "."podkładek pod mysz cena: 25 zł, do zapłaty:  ".$podkladka*25 ." "."zł"."<br>";   
		
	}
}
}
if (isset($_SESSION['smycz']) || isset($_SESSION['kalendarz']) || isset($_SESSION['kubek']) || isset($_SESSION['koszulka']) || isset($_SESSION['kalendarz']))
{if ($smycz==0 && $kalendarz == 0 && $kubek == 0 && $koszulka == 0 && $podkladka == 0)
{print "Nic nie zamówiono";}}
else {print "Nic";}


mysqli_close($con);	

?>
<html>
<head>
<style>
.logo
{
	display:block;
	
}
.logo_ukryty
{
	display:none;
	
}
#nacisnij
{
	background-color:gray;
	font-size:20px;
	border:3px solid black;
	border-radius:5px;
} 
a
{
	text-decoration:none;
	color:black;
}

</style>
</head>
<body>
<br><br>

<button id="zapisz">Zapisz</button>
<button id="sklep"><a href="sklep.php">Sklep</a></button><br><br>
<div class="logo_ukryty" ><button id="nacisnij" ><a href="logowanie.php">Logowanie</a></button></div>

<div id="logo"></div>

<script>
const przycisk = document.querySelector('#zapisz');
const logo = document.querySelector('.logo_ukryty');
przycisk.addEventListener("click",function()
{
	
logo.classList.remove('logo_ukryty');
logo.classList.add('logo');
document.getElementById('logo').innerHTML = "Musisz się zalogować";
})

</script>

</body>
</html>