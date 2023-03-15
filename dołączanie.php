<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Dołączanie pliku</title>
</head>
<body>
    <h4>Początek strony</h4>
    <?php

    //include, include_once, require, require_once

        include "./skrypty/lista.php"; // dolaczenie pliku 
        include_once "./skrypty/lista.php";  // @ - ukrywa warningi

        require "./skrypty/lista.php";
        //require_once "./skrypty/lista.php"; // wymagamy danego pliku 
       // @require "./skrypty/lista1.php"; // nie dostanniemy ostrzezenia tylko fatal error i nie wyswietli sie kod
    
    
    
    
    ?>
    <h4>Koniec strony</h4>
</body>
</html>