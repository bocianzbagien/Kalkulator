<?php 
session_start();
if (isset($_SESSION['odwiedzin']))
    {
        $_SESSION['odwiedzin']++;
    }
    else $_SESSION['odwiedzin'] = 1;
include 'wyswietlaniebledow.php';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Kalkulator by Piotr ver 0.1</title>
        <link rel="stylesheet" type="text/css" href="res/style.css" />
    </head>
    <body>
<?php include('./menu.html') ?>                
<?php 
//Walidacja

$liczba1Err = $liczba2Err = $jakieDzialanieErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["liczba1"]))
            {
                $liczba1Err = "Brakuje liczby 1";
                $err = 1; 
            }
            else $liczba1 = $_POST["liczba1"];
            
        if (empty($_POST["liczba2"]))
            {
                $liczba2Err = "Brakuje liczby 2";
                $err = 1; 
            }
            else $liczba2 = $_POST["liczba2"];
    
        if (!isset($_POST["jakieDzialanie"]))
            {
                $jakieDzialanieErr = "Nie wybrałeś co mam zrobić!";
                $err = 1; 
            }
            else $jakieDzialanie = $_POST["jakieDzialanie"];
    };

?>
        <h1>Kalkulator</h1>
        <br />
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post" >
            Pierwsza Liczba: 
                <input type="text" name="liczba1" value="<?php if (isset($liczba1))echo $liczba1 ?>" />  
                    <span class="err"><?php if (isset($liczba1Err)) echo $liczba1Err ?> </span>
                <br /> 
            Druga Liczba: 
                <input type="text" name="liczba2" value="<?php if (isset($liczba2)) echo $liczba2 ?>" />
                    <span class="err"><?php if (isset($liczba2Err)) echo $liczba2Err ?> </span>
                <br />  
            Co mam wykonać? <br />
                <span class="err"><?php if (isset($jakieDzialanieErr)) echo $jakieDzialanieErr ?> </span>
            Dodawanie: <input type="radio" name="jakieDzialanie" value="dodawanie" 
                              <?php if (isset($jakieDzialanie) && $jakieDzialanie == "dodawanie") echo "checked"?>
                              /><br />
            Odejmowanie: <input type="radio" name="jakieDzialanie" value="odejmowanie" 
                              <?php if (isset($jakieDzialanie) && $jakieDzialanie == "odejmowanie") echo "checked"?>
                                /><br />
            Mnożenie: <input type="radio" name="jakieDzialanie" value="mnozenie" 
                              <?php if (isset($jakieDzialanie) && $jakieDzialanie == "mnozenie") echo "checked"?>                             
                             /><br />
            Dzielenie: <input type="radio" name="jakieDzialanie" value="dzielenie" 
                              <?php if (isset($jakieDzialanie) && $jakieDzialanie == "dzielenie") echo "checked"?>
                              /><br />
            <input type="submit" name="submit" value="Oblicz!" />
        </form>
        
<?php
//Serce kalkulatora
   function dodawanie($a, $b)
        {
            global $wynik;
            $wynik = $a + $b;
        };
        
   function odejmowanie($a, $b)
        {
            global $wynik;
            $wynik = $a - $b;
        };
   function mnozenie ($a, $b)
        {
            global $wynik;
            $wynik = $a * $b;
        };
    function dzielenie ($a, $b)
    {
        global $wynik;
        $wynik = $a / $b;
    };
        
   if  (isset($_POST["submit"])&& !isset($err))
        {
            switch ($jakieDzialanie)
                {
                    case "dodawanie":
                      dodawanie ($_POST["liczba1"], $_POST["liczba2"]);  
                      break;

                    case "odejmowanie":
                      odejmowanie ($_POST["liczba1"], $_POST["liczba2"]);
                      break;

                    case "mnozenie":
                      mnozenie ($_POST["liczba1"], $_POST["liczba2"]);
                      break;
                  
                    case "dzielenie":
                      dzielenie ($_POST["liczba1"], $_POST["liczba2"]);
                      break;
                };
            
                echo "<h1> Wynik:".$wynik."</h1>";
            
            mysql_connect('localhost', 'root', 'haslo')or die('Błąd !: ' . mysql_error());
            mysql_select_db("test");
            $dobazy =  
                    "
                        INSERT 
                        INTO wyniki (Liczba1, Liczba2, rodzajdzialania, wynik) 
                        VALUES ( '$_POST[liczba1]', '$_POST[liczba2]', '$_POST[jakieDzialanie]', '$wynik')
                    ";
            if (mysql_query($dobazy))
                echo "Zapis do bazy udany!";
                    else echo "dupa, coś nie działa ".mysql_error();
            mysql_close();
        };

?>
        Stronę odwiedziłeś:  <?php echo $_SESSION['odwiedzin']; ?>  razy.<br /> 

        
               
<span class="err"><?php if(isset($blad)) echo $blad; ?></span><br />



    </body>
</html>