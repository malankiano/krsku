<?php

   session_start();
   include("config/config.php");
   
   //menghancurkan session yang telah terbentuk
   session_destroy();
   
   //kemudian akan diarahkan kehalaman index
   header("Location:index.php");
   
?>
