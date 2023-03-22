<?php
  //echo "delete user";

  require_once "./connect.php";
  $sql = "DELETE FROM users WHERE `users`.`id` = $_GET[deleteUserId]";
  $conn->query($sql);


 // echo $conn->affected_rows ;

  
  if($conn->affected_rows != 0){
    //echo "usunieto rekord";
    $deleteUser =  $_GET["deleteUserId"];
  }else{
    //echo "nie usunieto rekordu";
    $deleteUser = 0;
  }
  header ("location: ../database/2_db_tabele.php?deleteUser=$deleteUser");
  ?>

  <script>
   // hisotry.back();

  </script>



  