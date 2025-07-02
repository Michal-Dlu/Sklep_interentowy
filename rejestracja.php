<?php
session_start();
	$con = mysqli_connect('localhost','root','','sklep');
	mysqli_set_charset($con, "utf8");
    // Inicjalizuje nową sesję lub wczytuje już istniejącą
	
    // Jeżeli w sesji istnieją zmienne z informacją o nazwie użytkownika i zahashowanym haśle to ...
    if(isset($_SESSION['login']) && isset($_SESSION['hasloh']))
    {
        // ... sprawdza w bazie czy istnieje rekord zawierający te dwie wartości
		$login = addslashes(strip_tags($_SESSION['login']));
		$hasloh =addslashes(strip_tags($_SESSION['hasloh']));
        $query = "SELECT * FROM klienci WHERE login = '".$login."' AND hasloh = '".$hasloh."'";
        $result = mysqli_query($con, $query);
        $db_users = mysqli_fetch_assoc($result);
		// Jeżeli istnieje to ...
        if(empty($db_users))
        {
 // Natomiast jeżeli nie ma takiego rekordu to niszczy obecną sesję i odsyła do panelu logowania
            session_unset();
            session_destroy();
            header("Location: logowanie.php");           
		  
        }
        else
        {
            // ... pomija proces logowania i od razu odsyła do zawartości chronionej
            header("Location: sklep.php");
        }
    }
	
	else {	$alert="";

	// Jeżeli wciśnięto przycisk Sign up (co oznacza, że formularz rejestracji został wysłany)
    if(isset($_POST['signup']))
    {
    
		// Przeprowadza proces weryfikacji poprawności podanego loginu i hasła
        
        $login = addslashes(strip_tags($_POST['login']));
		$haslo = addslashes(strip_tags($_POST['haslo']));
		// Wymagania dot. loginu - długość 3-20 znaków, duże i małe znaki, cyfry i znaki specjalne "_-"
		$check_login = '/^[A-Za-z0-9_-]{3,20}$/';
		// Wymagania dot. hasła - długość 8-64 znaków, przynajmniej jedna duża i jedna mała litera, przynajmniej jedna cyfra i przynajmniej jeden znak specjalny z listy dozwolonych "!@#$%^&*"
		$check_password = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[!@#$%^&*]).{8,64}$/";
        if(preg_match($check_login, $login))
        {
			if(preg_match($check_password, $haslo))
			{
				// Jeżeli login i hasło spełniają wymagania to jeszcze sprawdza czy w bazie nie ma już użytkownika o tej nazwie
				$query = "SELECT * FROM klienci WHERE login = '".$login."'";
				$result = mysqli_query($con, $query);
				$db_users = mysqli_fetch_assoc($result);
				if(!empty($db_users))
				{
					// Jeżeli jest to wyświetla błąd
					$alert = "Taki login już jest zarezerwowany! Wybierz inny";
				}
				else
				{
					// Jeżeli nie ma jeszcze takiego użytkownika to ...
					// Ustawia opcje algorytmu szyfrującego hasło (tworzenie hasha)
					
					// Tworzy hash
					$hasloh = password_hash($haslo, PASSWORD_DEFAULT);
					// Wprowadza do bazy nowy rekord
					$add = "INSERT INTO klienci (login, hasloh) VALUES ('".$login."', '".$hasloh."')";
					mysqli_query($con, $add);
					// Odsyła do panelu logowania
					
					header("Location: logowanie.php");
				}
			}
			else
			{
				// Jeżeli hasło nie spełnia wymagań wyświetla błąd
				$alert = "Wymagane hasło musi posiadać 8-64 znaków, w tym wielkie i małe litery, cyfry i znaki spacjalne (takie jak: !@#$%^&*)";
			}
		}
		else
		{
			// Jeżeli login nie spełnia wymagań wyświetla błąd
			$alert = "Wymagany login musi zawierać 3-20 znaków : a-z, A-Z, 0-9, i znaki specjalne takie jak: '_-'";
		}
    }
	}
?>
<html>
<head>
</head>
<body><?php
if(isset($_SESSION['login']))
{
print "witaj"." " .$_SESSION['login'];
}
else 
{
	print "niezalogowany";
}
?>
<h1>WITAMY W REJESTRACJI</h1>
<form action="" method="post">
	<p><input type="text" name="login" value="" placeholder="Login..." autocomplete="off"></p>
	<p><input type="password" name="haslo" value="" placeholder="haslo..." autocomplete="off"></p>
	<p><button type="submit" name="signup">Sign up</button></p>
</form>
<p><a href="logowanie.php">Masz juz konto? Zaloguj się!</a></p>
<?php
	if($alert != "")
	{
		print "<p>".$alert."</p>";
	}
	else {print "";}
	mysqli_close($con);
?>
</body>
</html>