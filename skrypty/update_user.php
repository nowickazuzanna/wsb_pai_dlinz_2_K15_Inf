<?php
session_start();
 print_r($_POST);
 foreach ($_POST as $key => $value){
    //echo "$key: $value<br>"; //wyswietla tablice
    if (empty($value)){
      //echo "$key<br>";
      $_SESSION["error"] = "Wypelnij wszystkie pola";
      echo "<script>history.back();</script>";
      exit();
    }
 }
 
 require_once "./connect.php";
 //$sql = "INSERT INTO `users` (`id`, `city_id`, `firstName`, `lastName`, `birthday`) VALUES (NULL, '$_POST[city_id]', '$_POST[firstName]', '$_POST[lastName]', '$_POST[birthday]');";

 $sql ="UPDATE `users` SET `city_id` = '$_POST[city_id]', `firstName` = '$_POST[firstName]', `lastName` = '$_POST[lastName]', `birthday` = '$_POST[birthday]' WHERE `users`.`id` = $_SESSION[updateUserId];";

 echo $sql;
 $conn->query($sql); //wyslanie zapytania
 unset($_SESSION["updateUserId"]);

 //echo $conn->affected_rows;

 if ($conn->affected_rows == 1){

    //echo "prawidlowo dodano rekord";
    $_SESSION["error"] = "prawidlowo dodano rekord";
 }else{
    //echo "nie dodano rekordu";
    $_SESSION["error"] = "nie dodano reokrdu";


 }

 header("location: ../database/2_db_tabele.php");


?>