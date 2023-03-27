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
   ?>



</body>
</html>


