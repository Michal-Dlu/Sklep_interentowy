<?php
session_start();
$con=mysqli_connect('localhost','root','','sklep');

if (isset($_SESSION['login']) && isset($_SESSION['hasloh']))
{

	$login = addslashes(strip_tags($_SESSION['login']));
	$hasloh = addslashes(strip_tags($_SESSION['hasloh']));
	$q = "SELECT * FROM `klienci` WHERE `login` = '".$login."' and `hasloh` = '".$hasloh."'";
	$result = mysqli_query($con,$q);
	$klient = mysqli_fetch_assoc($result);
		if(empty($klient))        
		{
			
			session_unset();
			session_destroy();
			header('location:logowanie.php');
		}
}




?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset = "utf-8">
<link rel = "stylesheet" href = "styl5.css">
</head>
<body>
<section id="container">
<?php

if(isset($_SESSION['login']))
{
print "<h3>"."Witaj"." " .$_SESSION['login']."</h3>"."<br>";
$user = "SELECT `id` from `klienci` where `login` = '$login'";
$result = mysqli_query($con,$user);
$wynik = mysqli_fetch_assoc($result);
$q="SELECT count(`id`) FROM `produkty` WHERE `Klienci_id`=$wynik[id] and `zaplacono`='TAK' and `smycz`=0 and `kubek`=0 and `koszulka`=0 and `kalendarz`=0 and `podkladka`=0";
$res = mysqli_query($con,$q);
$ktory=mysqli_fetch_row($res);
$ile=$ktory['0'];
if ($ile == 0)
{print "Twój pierwszy zakup"."<br>";}
else{
print "To już Twój ".$ile." zakup w naszym sklepie."."<br>";}
if (isset($_SESSION['alert']))
{
print $_SESSION['alert'];
}
else {
print "";
}
}
else 
{
print "Użytkownik niezalogowany"."<br>";
if (isset($_SESSION['alertb']))
{print $_SESSION['alertb'];}
else {print "";}
}
mysqli_close($con);
?>
<h1>SKLEP INTERNETOWY</h1>
<br>

<section id="banner"  >
<div class = "karuzela" >
<img src="pewex.jpg" class="fotka"  >
<img src="kasa.jpg" class="fotka"  >
<img src="prl.jpg" class="fotka"  >
</div>


</section >
<script>
slideIndex=0;
show();

function show()
{
	var slide = document.getElementsByClassName('fotka');
	var i;

for (i=0;i<slide.length;i++)
{slide[i].style.display = "none";}
slideIndex++;
if (slideIndex>slide.length)
{slideIndex=1;}
slide[slideIndex-1].style.display = "block";
	
setTimeout('show()',5000);
}	

	

</script>
<section id="drugi">
<ul type = "none">
<li class = "lit"><a class = "link" href="koszyk.php" id="kosz">Koszyk</a></li>
<li class = "lit"><a class = "link" href="czyszczenie.php">Usuń bazę</a></li>
<li class = "lit"><a class = "link" href="tworzenie.php">Utwórz bazę</a></li>
<li class = "lit"><a class = "link" href="galeria.php">Powrót do strony głównej</a></li>
<li class = "lit"><a class = "link" href="rejestracja.php">Zarejestruj się</a></li>
<li class = "lit"><a class = "link" href="logowanie.php">Zaloguj się</a></li>
<li class = "lit"><a class = "link" href="wylogowanie.php">Wyloguj się</a></li>
<li class = "lit"><a class = "link" href="zakupy.php">Co u nas kupiłeś</a></li>
<ul>
</section>
<section id="glowny" style="clear:both">
<br><h1>Wybierz produkt</h1><br>
<ul type="none" style="clear:both">
<li class="opis"><div class='najedz'><a href="#" class="widoczny"><img src="produkty1.jpg"  class="produkt"></a><a href="#" class='ukryty' ><p>Cena: 10 zł</p></a>smycz</div><br> </li>
<li class="opis"><div class='najedz'><a href="#" class="widoczny"><img src="produkty2.jpg"  class="produkt"></a><a href="#" class='ukryty' ><p>Cena: 15 zł</p></a>kalendarz</div><br><br></li>
<li class="opis"><div class='najedz'><a href="#" class="widoczny"><img src="produkty3.jpg"	class="produkt"></a><a href="#" class='ukryty' ><p>Cena: 20 zł</p></a>kubek</div><br><br></li>
<li class="opis"><div class='najedz'><a href="#" class="widoczny"><img src="produkty4.jpg"  class="produkt"></a><a href="#" class='ukryty' ><p>Cena: 60 zł</p></a>koszulka</div><br><br></li>
<li class="opis"><div class='najedz'><a href="#" class="widoczny"><img src="produkty5.jpg"  class="produkt"></a><a href="#" class='ukryty' ><p>Cena: 25 zł</p></a>podkładka pod mysz</div><br></li>
</ul>
<div id="wynik" style="font-size:15px" style="float:left;"></div>


<form method="POST" action="koszyk.php" >
<div class="inputy">
<input type="number" min="0" class="inp" name="smycz" placeholder="ile szt" id="smycz" onclick="liczenie();">
<input type="number" min="0" class="inp" name="kalendarz" placeholder="ile szt" id="kalendarz" onclick="liczenie();">
<input type="number" min="0" class="inp" name="kubek" placeholder="ile szt" id="kubek" onclick="liczenie();">
<input type="number" min="0" class="inp" name="koszulka" placeholder="ile szt" id="koszulka" onclick="liczenie();">
<input type="number" min="0" class="inp" name="podkladka" placeholder="ile szt" id="podkladka" onclick="liczenie();"></div>
<input type="reset" value="Wyczyść"  class="inp"><input type="submit" class="inp" name="koszyk" class="kosz">
</form>

<script>
function liczenie()
{
var smycz = document.getElementById('smycz').value;
var kalendarz = document.getElementById('kalendarz').value;
var kubek = document.getElementById('kubek').value;
var koszulka = document.getElementById('koszulka').value;
var podkladka = document.getElementById('podkladka').value;

if (smycz == "null") {smycz = 0;}
if (kalendarz == "null") {kalendarz = 0;}
if (kubek == "null") {kubek = 0;}
if (koszulka == "null") {koszulka = 0;}
if (podkladka == "null") {podkladka = 0;}
var zaplata = (smycz*10+kalendarz*15+kubek*20+koszulka*60+podkladka*25);
var koszt_przesylki = 50;
var razem = zaplata + koszt_przesylki;
var zostalo = 200-zaplata;
if (zaplata<=200)
{ 
document.getElementById('wynik').innerHTML = "Do zapłaty:"+" "+zaplata+" "+"zł"+"<br>"+"Koszt przesyłki"+" "+koszt_przesylki+" "+"zł"+"<br>"+"Razem"+" "+razem+" "+"zł"+"<br>"+"Do darmowej przesyłki pozostało:"+" "+zostalo+" "+" zł";
}
else 
{
	document.getElementById('wynik').innerHTML = "Do zapłaty:"+" "+zaplata+" "+"zł"+"<br>"+"Przesyłka darmowa"; 
}
}
</script>

</section>
</section>
<script src="sklep.js"></script>

</body>
</html>

