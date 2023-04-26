
<?php
echo "<pre>";

  print_r($_POST);

echo "</pre>";

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


    if (!isset($_POST["gender"])){
		$_SESSION["error"] = "Wybierz płeć!";
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






    
    /*
    if($_POST["email1"] == $_POST["email1"]){
        $error = 1;
       // echo "<script>history.back();</script>";
        $_SESSION["error"] = "Zduplikowane adresy mail";
        //exit();
    }
    */


    /*
    mysqli_query('INSERT INTO ...');
    if (mysqli_errno() == 1062) {
    print 'duplikat!';
    }
    */







    /*
    //------------------------------------------------
    require_once "./connect.php";
    $duplicate = mysqli_query($conn, "SELECT * from users where email = $_POST[email1] ");
    if (mysqli_num_rows($duplicate) > 0){
        $error = 1;
        //$duplicate = 1;
       // echo "<script>history.back();</script>";
        $_SESSION["error"] = "Zduplikowane adresy mail";
        //exit();

       // header("Location: index.php?message=User name or Email id already exists.");
       //$duplicate=mysqli_query($conn,"SELECT * from 'users' where email='$email'");
    }
    */




    /*
    //mysqli_query('INSERT INTO `users` (`email`, `city_id`, `firstName`, `lastName`, `birthday`, `password`, `created_at`) VALUES (?, ?, ?, ?, ?, ?, current_timestamp());');
    if (mysqli_errno($conn) == 1062)
    {
       //print 'no way!'; 

       $error = 1;
       // echo "<script>history.back();</script>";
        $_SESSION["error"] = "Adresy email sa zduplikowane";
    }
    */








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

    $sql = "SELECT * FROM users WHERE email = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $_POST["email1"]);
    $stmt->execute();
    $result= $stmt->get_result();

    if ($result->num_rows != 0 ){
        $_SESSION["error"] = "Mail $_POST[email1] jest juz używany!";
        echo "<script>history.back();</script>";
        exit();
    }
    //header("location: ../pages/register.php");





	require_once "./connect.php";
	$stmt = $conn->prepare("INSERT INTO `users` (`email`, `city_id`, `firstName`, `lastName`, `birthday`, `gender`, `avatar`, `password`, `created_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?,  current_timestamp());");


    $pass = password_hash( password: '$_POST["password1"]', algo: PASSWORD_ARGON2ID);

    /*
    if($_POST['gender'] == 'm' )
    {
        $avatar = 'men.jpg';

    }else{
        $avatar = 'women.jpg';
    }
    */

    $avatar = ($_POST["gender"] == 'm') ? './jpg.man.png' : './jpg.woman.png' ;

	$stmt->bind_param('sissssss', $_POST["email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $_POST["gender"], $avatar, $pass);

	$stmt->execute();

    //$pass = password_hash( password: '$_POST["passowrd1]')

	echo $stmt->affected_rows;
  

    if ($stmt->affected_rows == 1 ){
        $_SESSION["success"] = "Dodano uzytkownika $_POST[firstName] $_POST[lastName]";

    
    }else{
        $_SESSION["error"] = "Nie udalo sie dodac rekordu ";
    }

    //header("location: ../pages/register.php");

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



