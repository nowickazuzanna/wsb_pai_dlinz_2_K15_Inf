<?php
  //echo "delete user";

  require_once "./connect.php";
  $sql = "DELETE FROM cities WHERE `id` = $_GET[deleteCityId]";
  $conn->query($sql);
  $deleteCity = 0;

  
  if($conn->affected_rows != 0){
    echo "usunieto rekord";
    $deleteCity =  $_GET["deleteCityId"];
  }else{
    echo "nie usunieto rekordu";
    $deleteCity = 0;
  }
  header ("location: ../skrypty/wyswietl_tabele.php?deleteCity=$deleteCity");
  ?>




  