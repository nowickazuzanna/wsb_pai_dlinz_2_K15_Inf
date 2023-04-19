
<?php
//echo "<pre>";

  //print_r($_POST);

//echo "</pre>";

//1.regulamin nie zaznaczony
//2.adres mail rozny
//3.hasla sa rozne

//dodac zmienna pomocnicza error (0), jak bedzie blad to 1 
//jesli error != 0 to cofamy uzytkownika i wyswietlamy komunikat (zmienna sesyjna) o bledzie nad formularzem
  
session_start();


    //$error = 0;
    foreach($_POST as $key => $value){
        if (empty($value)){
            //echo "Wypełnij wszystkie pola";
            $_SESSION["error"] = "Wypełnij wszystkie pola";
            echo "<script>history.back();</script>";
            //echo $_SESSION["error"];
            exit(); //przeryw wykonywanie skryptu
        }
    }

    $error = 0;

    if (!isset($_POST["terms"])){
		$_SESSION["error"] = "Zatwierdź regulamin!";
		$error++;
	}


    if($_POST["password1"] != $_POST["password2"]){
        $error = 1;
        //echo "<script>history.back();</script>";
        $_SESSION["error"] = "Hasla sa rozne";
        //exit();
    }

    if($_POST["email1"] != $_POST["email2"]){
        $error = 1;
       // echo "<script>history.back();</script>";
        $_SESSION["error"] = "Adresy email sa rozne";
        //exit();
    }

    

    if($error != 0 ){
        echo "<script>history.back();</script>";
        exit();
    }


    //mail
    //haslo
    //regulamin

    /*
    if (!isset($_POST["term"])){
		$_SESSION["error"] = "Zatwierdź regulamin!";
		$error++;
	}*/





/*
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
*/

	require_once "./connect.php";
	$stmt = $conn->prepare("INSERT INTO `users` (`email`, `city_id`, `firstName`, `lastName`, `birthday`, `password`, `created_at`) VALUES (?, ?, ?, ?, ?, ?, current_timestamp());");


    $pass = password_hash( password: '$_POST["password1"]', algo: PASSWORD_ARGON2ID);

	$stmt->bind_param('sissss', $_POST["email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $pass);

	$stmt->execute();

    //$pass = password_hash( password: '$_POST["passowrd1]')

	echo $stmt->affected_rows;
  

    if ($stmt->affected_rows == 1 ){
        $_SESSION["success"] = "Dodano uzytkownika $_POST[firstName] $_POST[lastName]";

    
    }else{
        $_SESSION["error"] = "Nie udalo sie dodac rekordu ";
    }

    header("location: ../pages/register.php");

    /*
    echo "<pre>";
		print_r($_POST);
    echo "</pre>";*/




/*
session_start();
$error = 0;

foreach ($_POST as $key => $value) {
    if (empty($value)) {
        $_SESSION["error"] = "Wypełnij wszystkie pola w formularzu!";
        $error++;
        break;
    }
}

if ($error == 0 && $_POST["email1"] !== $_POST["email2"]) {
    $_SESSION["error"] = "Adres email musi być taki sam!";
    $error++;
}

if ($error == 0 && $_POST["password1"] !== $_POST["password2"]) {
    $_SESSION["error"] = "Hasło musi być takie samo w obu polach!";
    $error++;
}

if ($error == 0 && !isset($_POST["terms"])) {
    $_SESSION["error"] = "Zatwierdź regulamin!";
    $error++;
}

if ($error != 0) {
    echo "<script>history.back()</script>";
    exit();
}

$hashedPassword = password_hash($_POST["password1"], PASSWORD_ARGON2I);

require_once "connect.php";
// zabezpieczenie przed sql injection
$stmt = $conn->prepare("INSERT INTO users (email, city_id, firstName, lastName, birthday, password, created_at) VALUES (?, ?, ? ,?, ?, ?, CURRENT_TIMESTAMP());");
$stmt->bind_param("sissss", $_POST["email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $hashedPassword);
$stmt->execute();

echo $stmt->affected_rows;
*/

/*
echo "<pre>";
    print_r($_POST);
echo "</pre>";*/



