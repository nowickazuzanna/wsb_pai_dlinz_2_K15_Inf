<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/table.css">
    <title>Document</title>
</head>
</body>
   <h4>Uzytkownicy</h4>
   <td><a href="../skrypty/wyswietl_tabele.php">Wyswietl miasta</a></td><br>
   <br>
   <?php

       //ehco $_SESSION["error"];
       if (isset($_SESSION["error"])){
        echo $_SESSION["error"];
        unset($_SESSION["error"]);

       }
       require_once"../skrypty/connect.php";

       $sql = "SELECT U.id, firstName, lastName, city, state, birthday FROM users U inner join cities C on C.id = U.city_id inner join states S on S.id = C.state_id;"; 
       //echo $sql;

       $result = $conn->query($sql);
        
       echo <<< USERSTABLE
       <table>
       <tr>
          <th>Imie</th>
          <th>Nazwisko</th>
          <th>Data urodzenia</th>
          <th>Miasto</th>
          <th>Wojewodztwo</th>

       </tr>
       USERSTABLE;

       if(!$result || mysqli_num_rows($result) == 0){

         echo '<tr><td colspan="7">brak wynikow</td></tr>';

       }
       else{
       while($user = $result->fetch_assoc()){
        echo <<< USERSTABLE
         <tr>
            <td>$user[firstName]</td>
            <td>$user[lastName]</td>
            <td>$user[birthday]</td>
            <td>$user[city]</td>
            <td>$user[state]</td>
            <td><a href="../skrypty/delete_user.php?deleteUserId=$user[id]">Usun</a></td>
            <td><a href="./2_db_tabele.php?updateUserId=$user[id]">Edytuj</a></td>
    
         <tr>
         USERSTABLE;   
       }
      }

       echo "</table>";
       if(isset ($_GET['deleteUser'])){

         if($_GET["deleteUser"] != 0){
           echo "<hr>usunieto uzytkownika o id = $_GET[deleteUser]";

         } else {
         echo "<hr>nieusunieto uzytkownika o id = $_GET[deleteUser]";

       }
      }
//autofocus-pole od razu aktywne

      if (isset($_GET["addUserForm"])){
        echo <<< ADDUSERFORM
          <h4>Dodawanie uzytkownika</h4>
          <form action="../skrypty/add_user.php" method="post">
             <input type="text" name="firstName" placeholder="Podaj imie" autofocus><br><br> 
             <input type="text" name="lastName" placeholder="Podaj nazwisko"><br><br> 
             <select name="city_id">
    ADDUSERFORM;

            $sql = "SELECT * from cities";
            $result = $conn->query($sql);
            while($row = mysqli_fetch_array($result)){ //($city = $result->fetch_assoc())
              echo "<option value='$row[id]'>$row[city]</option>"; // value-przesyla id // echo"<option value=\"$city[id]\">$city[city]</option>";
            }

            //select/option cities
            /*
            while($row = mysqli_fetch_array($result)){
              echo "<option value='$row[id]>$row[city]</option>";
            }
            */

         echo <<< ADDUSERFORM
             </select>
             <input type="date" name="birthday">Data urodzenia<br><br>
             <input type="submit" value="Dodaj uzytkownika">
          </form>
   ADDUSERFORM;
      }else{
        echo '<hr><a href="./2_db_tabele.php?addUserForm=1">Dodaj uzytkownika</a>';


      }

//formularz bedzie mial value, uzytkownik bedize mial..., edytujemy wszystkie pola
      if (isset($_GET["updateUserId"])){
        echo <<< UPDATEUSERFORM
          <h4>Aktualizacja uzytkownika</h4>
    UPDATEUSERFORM;


      }
   ?>

</body>
</html>


