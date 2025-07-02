<?php
session_start();
$con = mysqli_connect('localhost','root','','sklep');


if (isset($_POST['koszyk']))
{
if ($_POST['smycz']>0) {$_SESSION['smycz']=$_POST['smycz'];} else {$_SESSION['smycz']=0;};
if ($_POST['kalendarz']>0){$_SESSION['kalendarz']=$_POST['kalendarz'];} else {$_SESSION['kalendarz']=0;};
if ($_POST['kubek']>0){$_SESSION['kubek']=$_POST['kubek'];} else {$_SESSION['kubek']=0; };
if ($_POST['koszulka']>0){$_SESSION['koszulka']=$_POST['koszulka'];} else {$_SESSION['koszulka']=0; };
if ($_POST['podkladka']>0){$_SESSION['podkladka']=$_POST['podkladka'];} else {$_SESSION['podkladka']=0; };
$data = date('j-m-Y');
$time = date('H:i:s');



if (isset($_SESSION['login']))
{
$login=$_SESSION['login'];	
$smycz= $_SESSION['smycz'];
$kalendarz= $_SESSION['kalendarz'];
$kubek= $_SESSION['kubek'];
$koszulka= $_SESSION['koszulka'];
$podkladka= $_SESSION['podkladka'];

$user = "SELECT `id` from `klienci` where `login` = '$login'";
$result = mysqli_query($con,$user);
$wynik = mysqli_fetch_assoc($result);
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
exit;
}

else {header('location:koszyk2.php');}
}

else {

if (isset($_SESSION['login']))
{

header('location:koszyk2.php');

}
else 
{
	header('location:kosz.php');
}
}


mysqli_close($con);
?>




</body>
</html>
