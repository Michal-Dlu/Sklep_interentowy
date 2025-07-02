<?php
session_start();
$con=mysqli_connect('localhost','root','','sklep');

if (isset($_SESSION['login']) && isset($_SESSION['hasloh']))
{
	$login = addslashes(strip_tags($_SESSION['login'])); 
	$hasloh = addslashes(strip_tags($_SESSION['hasloh'])); 
	
	$q = "SELECT * FROM klienci WHERE login = '".$login."' && hasloh = '".$hasloh."'";
	$result=mysqli_query($con,$q);
	$klient=mysqli_fetch_assoc($result);

	if (!empty($klient))
	{
		header('location:sklep.php');
	}
	
}	
 $alert = "";
if  (isset($_POST['signup']))
{

$login = $_POST['login'];
$haslo = $_POST['haslo'];
$login = htmlentities($login,ENT_QUOTES,"UTF-8");
$haslo = htmlentities($haslo,ENT_QUOTES,"UTF-8");

$hasloh = password_hash($haslo,PASSWORD_DEFAULT);
$qu = "SELECT * FROM `klienci` WHERE `login` = '".$login."'";


$res = mysqli_query($con,$qu);
$kli = mysqli_fetch_assoc($res);
if (empty($kli))
{
	$alert = "nie ma takiego loginu";	
}
else
{
 if (password_verify($haslo,$kli['hasloh']))
 {
	 $_SESSION['login']=$login;
	 $_SESSION['hasloh']=$kli['hasloh'];

header('location:sklep.php');}	

 else
 {
	 $alert = "nieprawidłowe hasło";	 
 }
}
}



?>
<html>
<head>
</head>
<body>
<?php
if(isset($_SESSION['login']))
{
print "witaj"." ".$_SESSION['login'];
}
else 
{
	print "niezalogowany";
}
?>
<h1>Logowanie</h1>
	<form action="" method="post">
	<p><input type="text" name="login" value="" placeholder="Login..." autocomplete="off"></p>
	<p><input type="password" name="haslo" value="" placeholder="haslo..." autocomplete="off"></p>
	<p><button type="submit" name="signup">Sign up</button></p>
	</form>
<p><a href="rejestracja.php">Nie masz konta? Zarejestruj się</a></p>
<?php
	if($alert != "")
	{
		echo "<p>".$alert."</p>";
	}
		else {print "";}
		mysqli_close($con);
?>

</body>
</html>