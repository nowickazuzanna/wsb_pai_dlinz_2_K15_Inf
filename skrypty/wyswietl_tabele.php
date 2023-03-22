<?php

//$sql = "DELETE FROM users WHERE `users`.`id` = $_GET[deleteUserId]";
require_once "./connect.php";
$sql = "SELECT * FROM CITIES";
$conn->query($sql);
?>
