
<?php
session_start();
	//print_r($_POST);
	$error = 0;
	foreach ($_POST as $key => $value){
		// echo "$key: $value<br>";
		if (empty($value)){
			// echo "$key<br>";
			$_SESSION["error"] = "Wypełnij wszystkie pola w formularzu!";
			echo "<script>history.back();</script>";
			exit();
		}
	}

	if (!isset($_POST["term"])){
		$_SESSION["error"] = "Zatwierdź regulamin!";
		$error++;
	}

	if  ($error != 0){
		echo "<script>history.back();</script>";
		exit();
	}

	require_once "./connect.php";
	$sql = "INSERT INTO `users` (`id`, `city_id`, `firstName`, `lastName`, `birthday`) VALUES (NULL, '$_POST[city_id]', '$_POST[firstName]', '$_POST[lastName]', '$_POST[birthday]');";
	$conn->query($sql);

	// echo $conn->affected_rows;
	if ($conn->affected_rows == 1){
		// echo "Prawidłowo dodano rekord";
		$_SESSION["error"] = "Prawidłowo dodano rekord";
	}else{
		// echo "Nie dodano rekordu!";
		$_SESSION["error"] = "Nie dodano rekordu!";
	}

   header("location: ../database/2_db_tabele.php");



/*
//moje
session_start();
  //print_r($_POST);
 $error = 0;
 foreach ($_POST as $key => $value){
    //echo "$key: $value<br>"; //wyswietla tablice
    if (empty($value)){
      //echo "$key<br>";
      //echo "<script>history.back();</script>";
      //exit();

      $_SESSION["error"] = "Wypelnij wszystkie pola";
      echo "<script>history.back();</script";
      exit();
     // $error++;
    }
 }
 
 if (!isset($_POST["term"])){
   $_SESSION["error"] = "zatwierdz regulamin!";
   $error++;
   
 }


 if($error != 0){
   echo "<script>history.back();</script";
   exit();

 }

 require_once "./connect.php";
 $sql = "INSERT INTO `users` (`id`, `city_id`, `firstName`, `lastName`, `birthday`) VALUES (NULL, '$_POST[city_id]', '$_POST[firstName]', '$_POST[lastName]', '$_POST[birthday]');";
 $conn->query($sql); //wyslanie zapytania

 //echo $conn->affected_rows;

 if ($conn->affected_rows ==1){

    //echo "prawidlowo dodano rekord";
    $_SESSION["error"] = "prawidlowo dodano rekord";
 }else{
    //echo "nie dodano rekordu";
    $_SESSION["error"] = "nie dodano reokrdu";


 }

 header("location: ../database/2_db_tabele.php");
*/


 


/*
session_start();
//print_r($_POST);
foreach($_POST as $key => $value){
   // echo "$key: $value<br>";

if (empty($value)){
    //echo "$key<br>";
    echo "<script>history.back();</script>";
    $_SESSION["error"]="Wypełnij wszystkie pola w formularzu";
    exit();
    }
}

require_once "./connect.php";
$sql = "INSERT INTO `users` (`id`, `city_id`, `firstName`, `lastName`, `birthday`) VALUES (NULL, '$_POST[city_id]', '$_POST[firstName]', '$_POST[lastName]', '$_POST[birthday]');";
$conn->query($sql);


if( $conn->affected_rows ==1){
    //echo "Prawidłowo dodano rekord";
    $_SESSION["error"]="Prawidłowo dodano rekord";
}else{
    //echo "Nie dodano rekordu";
    $_SESSION["error"]="Nie dodano rekordu";
}

header("location: ../database/2_db_tabele.php");
*/



?>

