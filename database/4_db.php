<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Użytkownicy</title>
</head>
<body>
<h4>Użytkownicy z db</h4>
<?php  /// php - polaczenie z baza danych
  require_once "../skrypty/connect.php";
  $sql = "SELECT * FROM `users`;";
  $result = $conn->query ($sql); // przechowujemy obiekt, result - obiekt
  //$user = $result->fetch_assoc(); // tablica asocjacyjna
  //print_r($user);
  //echo "imie i nazwisko: " . $user["firstName"] . " " . $user["lastName"] . "<br>";

  while($user = $result->fetch_assoc()){
    echo <<< USER
      imie i nazwisko:
      $user[firstName] $user[lastName] <br> 
      data urodzenia: $user[birthday]
      <hr>
      
    USER; //  wyswieta tekst i rozpoznaje zmienne heredoc jest cudzysowem
  }


?>
</body>
</html>

