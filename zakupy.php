<html>
<head>
<meta charset="utf-8">
<style>
th, td
{
	width:150px;
	text-align:center;
}
</style>
</head>
<body>
<?php
session_start();

$con=mysqli_connect('localhost','root','','sklep');
if (isset($_SESSION['login']))
{
	$login=$_SESSION['login'];
	$user = "SELECT `id` from `klienci` where `login` = '$login'";
	$result = mysqli_query($con,$user);
$wynik = mysqli_fetch_assoc($result);
$q="SELECT count(`id`) FROM `produkty` WHERE `Klienci_id`=$wynik[id] and `zaplacono`='TAK'";	
$res = mysqli_query($con,$q);
$ktory=mysqli_fetch_row($res);
$ile=$ktory['0'];
if ($ile == 0)
{print "Twój pierwszy zakup"."<br>";}

else{

	$q="SELECT `id`,`smycz`,`kubek`,`koszulka`,`kalendarz`,`podkladka`,`data`,`godzina` FROM `produkty` WHERE `Klienci_id`=$wynik[id] and `zaplacono`='TAK' and (`smycz`>0 or `kubek`>0 or `koszulka`>0 or `kalendarz`>0 or `podkladka`>0)";
	$query=mysqli_query($con,$q);
	
	print "<table border='style:1px'>";
	print "<tr>";
	print "<th>"."Data zakupu"."</th>"."<th>"."Godzina zakupu"."</th>"."<th>"."Smycz"."</th>"."<th>"."Kubek"."</th>"."<th>"."Koszulka"."</th>"."<th>"."Kalendarz"."</th>"."<th>"."Podkładka pod mysz"."</th>";
	print "</tr>";
	while ($result=mysqli_fetch_row($query))
	{
	print "<tr>";
if ($result[1]==0)
{$result[1]="";}
if ($result[2]==0)
{$result[2]="";}
if ($result[3]==0)
{$result[3]="";}
if ($result[4]==0)
{$result[4]="";}
if ($result[5]==0)
{$result[5]="";}	
	print "<td>".$result[6]."</td>"."<td>".$result[7]."</td>"."<td>".$result[1]."</td>"."<td>".$result[2]."</td>"."<td>".$result[3]."</td>"."<td>".$result[4]."</td>"."<td>".$result[5]."</td>";
	print "</tr>";	
	}	
	
	print "</table>";
	print "<br><br>";
	print "<h3 style='color:blue'>"."Dziękujemy"."</h3>";
}
print "<form method='POST' action=''>";
print "<button name='sklep' type='submit'>"."Sklep"."</button>";
print "</form>";
if (isset($_POST['sklep']))
{
header('location:sklep.php');	
}	
}
else
{
	$_SESSION['alertb'] = "Jeszcze nic nie zakupiono";
	header('location:sklep.php');
}

mysqli_close($con);
?>
</body>
</html>