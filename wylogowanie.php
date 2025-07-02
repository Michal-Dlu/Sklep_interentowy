<?php
session_start();
if (isset($_SESSIONS['login']) AND isset($_SEESION['hasloh']))
{
session_unset();
session_destroy();

header('location:sklep.php');
}
else
{
session_unset();
session_destroy();
header('location:sklep.php');
}
?>
