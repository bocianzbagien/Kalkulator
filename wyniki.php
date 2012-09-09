<?php 
session_start();
if (isset($_SESSION['odwiedzin']))
    {
        $_SESSION['odwiedzin']++;
    }
    else $_SESSION['odwiedzin'] = 1;
include 'wyswietlaniebledow.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Wyniki kalkulatora</title>
        <link rel="stylesheet" type="text/css" href="res/style.css" />
    </head>
    <body>
<?php include('./menu.html') ?>        
<h1>Wyniki</h1>

OK, to teraz zobaczmy ja wcześniejsi użytkownicy bawili się kalkulatorem!
<?php
 //Wypluwanie wyników z bazy       

    mysql_connect('localhost', 'root', 'haslo')or die('Błąd !: ' . mysql_error());
    mysql_select_db("test");
    $dobazy = mysql_query("SELECT * FROM wyniki");
    
    while ($linia = mysql_fetch_array($dobazy))
        {
            echo $linia['id']. " " . $linia['Liczba1'] . " " . $linia['Liczba2']. " " . $linia['rodzajdzialania']. " " . $linia['wynik']. " " . date($linia['data'])."<br />";
        };
    mysql_close();

?> 
        
        <span class="err"><?php if(isset($blad)) echo $blad; ?></span><br />
<span class="err"><?php if(isset($blad)) echo $blad; ?></span><br />
    </body>
</html>
