<?php
session_start();//żeby sesja zaczęła działać trzeba ją sobie urworzyć tą komendą
	$con = mysqli_connect('localhost','root','','sklep');//u mnie baza danych nazywa się sklep; ustalam połącznie z ta bazą danych
  
  $alert="";//to zmienna sesyjna która wyświetla jakieś infromacje związne z logowaniem(teraz jest pusta ale można dzięki sesji jakiś komunikat w tym miejscu przekazać)
    
        // Jeżeli wciśnięto przycisk Sign up (co oznacza, że formularz rejestracji został wysłany)
        if(isset($_POST['signup']))
        {
        
            // Przeprowadza proces weryfikacji poprawności podanego loginu i hasła
            
            $login = $_POST['login'];
            $haslo = $_POST['haslo'];
        
     
                //Sprawdzamy czy w bazie nie ma już użytkownika o tej nazwie
                    $query = "SELECT * FROM klienci WHERE login = '".$login."'";//te znaki apostrofów i cudzysłowów są ważne ponieważ tu konkatenujemy(czyli dołączamy) tekst(łańcuch) czyli tzw. string
                    $result = mysqli_query($con, $query);//tu już jest klasyk z zajęć :)
                    $db_users= mysqli_fetch_assoc($result);
                    if(!empty($db_users))
                    {
                        // Jeżeli jest to wyświetla błąd
                        $alert = "Taki login już jest zarezerwowany! Wybierz inny";//tu jest jeden z tych komunikatów, który wyświetli ta zmienna $alert którą sobie na początku ustawiłem
                    }
                    else
                    {
                        // Jeżeli nie ma jeszcze takiego użytkownika to ...
                        // Ustawia opcje algorytmu szyfrującego hasło (tworzenie hasha)
                        
                        // Tworzy hash
                        $hasloh = password_hash($haslo, PASSWORD_DEFAULT);//tego hashowania nie było na zajęciach ale tu chodzi o to, że dzięki tej
                        //funkcji w nazie danych nie ma już widocznego hasła, takiego jakie sobie użytkownik wpisał tylko jest zaszyfrowane dla bezpieczeństwa
                        // Wprowadza do bazy nowy rekord
                        $add = "INSERT INTO klienci (login, hasloh) VALUES ('".$login."', '".$hasloh."')";
                        mysqli_query($con, $add);
                        
                        
                        header("Location: logowanie.php");// Odsyła do panelu logowania
                    }
        }
       
       
    ?>
    <html>
    <head>
    </head>
    <body><?php
    if(isset($_SESSION['login']))//jeśli już w sesji jest ustawiona zmienna z loginem...
    {
    print "witaj"." " .$_SESSION['login'];//to tu się wyświetli
    }
    else 
    {
        print "niezalogowany";//a jeśli nie to wypisze ten komunikat
    }
    ?>
    <h1>WITAMY W REJESTRACJI</h1>
    <form action="" method="post">
        <p><input type="text" name="login" value="" placeholder="Login..." ></p>
        <p><input type="password" name="haslo" value="" placeholder="haslo..."></p>
        <p><input type="submit" name="signup"></p>
    </form>
    <p><a href="logowanie.php">Masz juz konto? Zaloguj się!</a></p>
    <?php
        if($alert != "")//jeśli do zmiennej $alert został dodany jakiś komunikat (np. że taki login juz istnieje)... 
        {
            print "<p>".$alert."</p>";//to tu się wyświeti
        }
        else {print "";}
        mysqli_close($con);//zamknięcie połączenia z bazą danych()
    ?>
    </body>
    </html>