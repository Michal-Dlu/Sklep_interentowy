<?php
session_start();

$con=mysqli_connect('localhost','root','','sklep');
if (isset($_SESSION['login']))
{
$login=$_SESSION['login'];
	print "<h1>"."Witaj"." ".$login."<br>"."</h1>";
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
{print "";}
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
if (!isset($_SESSION['smycz']) && !isset($_SESSION['kalendarz']) && !isset($_SESSION['kubek']) && !isset($_SESSION['koszulka']) && !isset($_SESSION['podkladka']))
{
	print "Nic nie domówiono";
}
else {print "";}
print "<form method='POST' action=''>";
print "<button name='zapisz' type='submit'>"."zapisz"."</button>";
print "</form>";
if (isset($_POST['zapisz']))
{
$user = "SELECT `id` from `klienci` where `login` = '$login'";
$result = mysqli_query($con,$user);
$wynik = mysqli_fetch_assoc($result);

if (isset($_SESSION['smycz']) || isset($_SESSION['kalendarz']) || isset($_SESSION['kubek']) || isset($_SESSION['koszulka']) || isset($_SESSION['podkladka']))
{
$wprowadz = "INSERT INTO `produkty` (`id`, `smycz`, `kubek`, `koszulka`, `kalendarz`, `podkladka`, `Klienci_id`, `data`, `godzina`, `zakup`,`zaplacono`,`skasowane`) values ('null',$smycz,$kubek,$koszulka,$kalendarz,$podkladka,$wynik[id],'$data','$time','zakup','NIE','NIE')";
mysqli_query($con,$wprowadz);

if (isset($_SESSION['smycz']))
{unset($_SESSION['smycz']);}
if (isset($_SESSION['kalendarz']))
unset($_SESSION['kalendarz']);
if (isset($_SESSION['kubek']))
{unset($_SESSION['kubek']);}
if (isset($_SESSION['koszulka']))
{unset($_SESSION['koszulka']);}
if (isset($_SESSION['podkladka']))
{unset($_SESSION['podkladka']);}

header('location:koszyk1.php');
}
else {header('location:koszyk1.php');}
}
}




else
{
header('location:kosz.php');}
mysqli_close($con);
?>
