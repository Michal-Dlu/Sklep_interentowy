<?php
session_start();
$con = mysqli_connect('localhost','root','','sklep');

if (isset($_SESSION['login']))
{
$login=$_SESSION['login'];
	 print "<h1>"."Witaj"." ".$login."<br>"."</h1>";
	 $data = date('j-m-Y');
$time = date('H:i:s'); 
$user = "SELECT `id` from `klienci` where `login` = '$login'";
	$result = mysqli_query($con,$user);
$wynik = mysqli_fetch_assoc($result);
$zakup = "SELECT sum(`smycz`),sum(`kubek`),sum(`koszulka`),sum(`kalendarz`),sum(`podkladka`),`data`,`godzina` FROM `produkty` WHERE `Klienci_id`=$wynik[id] and `zakup`='zakup' GROUP BY `Klienci_id`";
$zakupy = mysqli_query($con,$zakup);
$zakupiono = mysqli_fetch_row($zakupy);
if (!empty($zakupiono))
	{
print "(Ostatni zakup) ".$data." ".$time."<br>";
if ($zakupiono[0]>0) {print "Chcesz kupić: ".$zakupiono[0]." "."szt"." "."smyczy"." "."koszt"." ".$zakupiono[0]*10 ." "."zł"."<br>";} else {print "";}
if ($zakupiono[1]>0) {print "Chcesz kupić: ".$zakupiono[1]." "."szt"." "."kubek"." "."koszt"." ".$zakupiono[1]*20 ." "."zł"."<br>";} else {print "";}
if ($zakupiono[2]>0) {print "Chcesz kupić: ".$zakupiono[2]." "."szt"." "."koszulka"." "."koszt"." ".$zakupiono[2]*60 ." "."zł"."<br>";} else {print "";}
if ($zakupiono[3]>0) {print "Chcesz kupić: ".$zakupiono[3]." "."szt"." "."kalendarz"." "."koszt"." ".$zakupiono[3]*15 ." "."zł"."<br>";} else {print "";}
if ($zakupiono[4]>0) {print "Chcesz kupić: ".$zakupiono[4]." "."szt"." "."podkladka"." "."koszt"." ".$zakupiono[4]*25 ." "."zł"."<br>";} else {print "";}
$koszt_przesylki = 50;
print "<br><br>";
if (($zakupiono[0] * 10 + $zakupiono[1] * 20 + $zakupiono[2] * 60 + $zakupiono[3] * 15 + $zakupiono[4] * 25)<200)
{
print "Koszt przesyłki :".$koszt_przesylki." "."zł"."<br>";
print "<h3>"."Do zapłaty :".$zakupiono[0] * 10 + $zakupiono[1] * 20 + $zakupiono[2] * 60 + $zakupiono[3] * 15 + $zakupiono[4] * 25 + $koszt_przesylki." "."zł"."<br>";
print "Do darmowej przesyłki brakuje: ". 200 - ($zakupiono[0] * 10 + $zakupiono[1] * 20 + $zakupiono[2] * 60 + $zakupiono[3] * 15 + $zakupiono[4] * 25)." "."zł"."<br>";
}
	else
	{
	print "Darmowa przesyłka"."<br>";
	print "<h3>"."Do zapłaty :".$zakupiono[0] * 10 + $zakupiono[1] * 20 + $zakupiono[2] * 60 + $zakupiono[3] * 15 + $zakupiono[4] * 25 ." "."zł"."<br>";
	}

print "<form action='' method='POST'>";
print "<button name='powrot'>"."Chcesz kontynuować zakupy?"."</button>";
print "<button name='zaplata'>"."Chcesz zapłacić?"."</button>";
print "<button name='kasowanie'>"."Chcesz wyczyscić koszyk?"."</button>";
print "</form>";
	if(isset($_POST['powrot']))
	{
		$_SESSION['alert']="";
		header('location:sklep.php');}

if (isset($_POST['kasowanie']))
{
$zeruj="INSERT INTO `produkty` (`id`, `smycz`, `kubek`, `koszulka`, `kalendarz`, `podkladka`, `Klienci_id`, `data`, `godzina`, `zakup`,`zaplacono`,`skasowane`) values ('null',0,0,0,0,0,$wynik[id],'$data','$time','zakup','NIE','TAK')";
mysqli_query($con,$zeruj);
$kasuj = "UPDATE `produkty` set `zakup`='skasowane' where `Klienci_id`=$wynik[id]";
mysqli_query($con,$kasuj);
$skasowane = "UPDATE `produkty` set `skasowane`='TAK' where `Klienci_id`=$wynik[id] and `zaplacono` not like 'TAK'";
mysqli_query($con,$skasowane);
$_SESSION['alert'] = "Koszyk oczyszczony";
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
header('location:sklep.php');


}
if (isset($_POST['zaplata']))
{
$zeruj="INSERT INTO `produkty` (`id`, `smycz`, `kubek`, `koszulka`, `kalendarz`, `podkladka`, `Klienci_id`, `data`, `godzina`, `zakup`,`zaplacono`,`skasowane`) values ('null',0,0,0,0,0,$wynik[id],'$data','$time','skasowane','TAK','NIE')";
mysqli_query($con,$zeruj);
$kasuj = "UPDATE `produkty` set `zakup`='skasowane', `zaplacono`='TAK' where `Klienci_id`=$wynik[id] and `skasowane` not like 'TAK'";
mysqli_query($con,$kasuj);
$_SESSION['alert'] = "Dziękujęmy za zakup";
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
header('location:sklep.php');
}
	}
else
{
$_SESSION['alert'] = "Koszyk jest pusty";
header('location:sklep.php');
}
}

else
{	
unset($_SESSION['alert']);
$_SESSION['alert'] = "Zaloguj się";
	header('location:sklep.php');
}
mysqli_close($con);
?>

