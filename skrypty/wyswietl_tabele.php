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
   <h4>Miasta</h4>
   <br>
   
   <?php
       require_once"../skrypty/connect.php";
       $sql = "SELECT c.id, state, c.city FROM cities c inner join states S on S.id = C.state_id";
 
       $result = $conn->query($sql);
      
       echo <<< USERSTABLE
         <table border=1>
            <tr>
              <th>Id</th>
              <th>Wojewodztwo</th>
              <th>Miasto</th>
            </tr>
    USERSTABLE;

       if(!$result || mysqli_num_rows($result) == 0){

         echo '<tr><td colspan="7">brak wynikow</td></tr>';

       }
       else{
       while($user = $result->fetch_assoc()){
        echo <<< USERSTABLE
         <tr> 
           <td>$user[id]</td>
           <td>$user[state]</td>
           <td>$user[city]</td>
           <td><a href="../skrypty/delete_city.php?deleteCityId=$user[id]">Usun</a></td>
         </tr>
    USERSTABLE;   
       }
      }

      
       echo "</table>";
       if(isset ($_GET['deleteCity'])){

         if($_GET["deleteCity"] != 0){

           echo "<hr>usunieto miasto o id = $_GET[deleteCity]";

         } else {
         echo "<hr>nieusunieto miasta o id = $_GET[deleteCity]";

       }
      }


/*
    require_once "../skrypty/connect.php";
	  $sql = "SELECT c.id, state, c.city FROM cities c inner join states S on S.id = C.state_id";

    $result = $conn->query($sql);
    echo <<< USERSTABLE
      <table>
        <tr>
          <th>Id</th>
          <th>Wojewodztwo</th>
          <th>Miasto</th>
        </tr>
USERSTABLE;

    if ($result->num_rows > 0){
	    while($user = $result->fetch_assoc()){
		    echo <<< USERSTABLE
        <tr>
          <td>$user[id]</td>
          <td>$user[state]</td>
          <td>$user[city]</td>
          <td><a href="../skrypty/delete_city.php?deleteCityId=$user[id]">Usun</a></td>
        </tr>
USERSTABLE;
	    }
    }else{
	    echo <<< USERSTABLE
        <tr>
          <td colspan="19">Brak rekordów do wyświetlenia</td>
        </tr>
USERSTABLE;
    }

    
    echo "</table>";
    if (isset($_GET["deleteCity"])){
	    if ($_GET["deleteCity"] != 0){
		    echo "<hr>Usunięto miasto o id = $_GET[deleteCity]";
	    }else{
		    echo "<hr>Nie usunięto miasta";
	    }
    }
*/

    ?>

   
</body>
</html>



