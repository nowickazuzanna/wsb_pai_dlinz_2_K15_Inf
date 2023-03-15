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
   
   <?php
       require_once"../skrypty/connect.php";

       $sql = "SELECT * FROM users U inner join cities C on C.id = U.city_id inner join states S on S.id = C.state_id inner join countries co on S.country_id = co.id;"; 

       $result = $conn->query($sql);
        
       echo <<< USERSTABLE
       <table>
       <tr>
          <th>Imie</th>
          <th>Nazwisko</th>
          <th>Data urodzenia</th>
          <th>Miasto</th>
          <th>Wojewodztwo</th>
          <th>Panstwo</th>
       </tr>
       USERSTABLE;
    
 
       while($user = $result->fetch_assoc()){
        echo <<< USERSTABLE
         <tr>
            <td>$user[firstName]</td>
            <td>$user[lastName]</td>
            <td>$user[birthday]</td>
            <td>$user[city]</td>
            <td>$user[state]</td>
            <td>$user[country]<td>
         <tr>
         USERSTABLE;   
       }
       echo "</table>";
    ?>
</body>
</html>
