<?php

//Własna funckja do wychwytywania błędów
function wlasneBledy($error_level, $error_message, $error_file, $error_line)
  {
    global $blad;
    $blad = "<b>Error:</b> [$error_level] $error_message w linii $error_line"; 
    
  };


//Ustawienie działania funkcji wychwytywania błędów. 
set_error_handler("wlasneBledy");

?>
