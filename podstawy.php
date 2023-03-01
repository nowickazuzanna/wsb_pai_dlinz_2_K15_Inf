<?php
    $firstName = "Zuzanna";
    $lastName = "Nowicka";
    echo "Imie i nazwisko: $firstName $lastName<br>";

    //heredoc - etykieta   nie moze byc zadnych spacji po
    echo <<< DATA
        <hr>
        Imie: $firstName<br>
        Nazwisko: $lastName
        <br>
    DATA;

    $data = <<< DATA
        <hr>
        Imie: $firstName<br>
        Nazwisko: $lastName
        <br>
    DATA;
    echo $data;


    $datal = <<< 'DATA'
        <hr>
        Imie: $firstName<br>
        Nazwisko: $lastName
        <br>
    DATA;

   // echo $data1;

    $bin = 0b1010;
    echo $bin; //10

    $oct = 0101;
    echo $oct; //65

    $hex = 0x1A;
    echo $hex; //26

    echo PHP_VERSION;

    $x=1;
    $y=1.0;

    echo gettype($x); //integer
    echo gettype($y); // double 


    if ($x == $y) {
        echo "Rowne";
    }else{
        "Rozne";
    }

    if($x===$y) {
        echo "Identyczne";
    }else {
        echo "Nieidentyczne";
    }

?>