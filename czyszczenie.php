<?php
$con = mysqli_connect('localhost','root','','sklep');
$q="Drop table `klienci`";
$result=mysqli_query($con,$q);
$qu="Drop table `produkty`";
$res=mysqli_query($con,$qu);
header('location:tworzenie.php');
mysqli_close($con);
?>