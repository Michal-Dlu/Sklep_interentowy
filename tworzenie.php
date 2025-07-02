<html>
<head>
<meta charset="utf-8">
<style>
#a
{
	text-decoration:none;
	color:black;
}
#napis
{
	opacity:0;
	animation: napis 5s both;
}
@keyframes napis
{0% {opacity:0;}
100% {opacity:1;}
}

</style>
</head>
<body onload="napis();">

<div id="napis">Baza usunięta. Jeśli chcesz korzystać ze strony musisz utworzyć bazę danych.</div>

 
<form action="" method="POST">
<input type="submit" value="Utwórz bazę danych" name="baza">

</form>
</body>
</html>


<?php
$con = mysqli_connect('localhost','root','','sklep');
if (isset($_POST['baza'])){
$q="CREATE TABLE `sklep`.`klienci` (`id` INT NOT NULL AUTO_INCREMENT , `hasloh` VARCHAR(255) NOT NULL , `login` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB";
$result=mysqli_query($con,$q);
$qu="CREATE TABLE `sklep`.`produkty` (`id` INT NOT NULL AUTO_INCREMENT , `data` VARCHAR(255) NOT NULL , `godzina` VARCHAR(255) NOT NULL , `kalendarz` INT(255) NOT NULL, Klienci_id INT (11) NOT NULL, koszulka INT(255) NOT NULL, kubek INT(255) NOT NULL, podkladka INT(255) NOT NULL, smycz INT(255) NOT NULL, zakup VARCHAR(255) NULL, zaplacono VARCHAR(255) NULL, skasowane VARCHAR(255) NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB";
mysqli_query($con,$qu);
$quu="INSERT INTO `klienci` (`id`,`login`,`hasloh`) value (0, 'primus', 'number');";
mysqli_query($con,$quu);	
print "Baza została utowrzona"."<br><br>";
print "<button>"."<a href='sklep.php' id='a'>"."Przejdź do sklepu"."</button>";
}
mysqli_close($con);
?>