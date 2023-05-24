
<?php
//dodac zmienna pomocnicza error (0), jak bedzie blad to 1 
//jesli error != 0 to cofamy uzytkownika i wyswietlamy komunikat (zmienna sesyjna) o bledzie nad formularzem
  
function sanitizeInput(&$input){

    $input = trim($input);   // nie dziala, dokonczyc i czemu nie dziala trim, moze byc problem z kolejnoscia
    $input = stripslashes($input);
    $input = htmlentities($input);
    return $input;

}

//$_POST["firstName"] = sanitizeInput($_POST["firstName"]);

//echo $_POST["firstName"]." ==> ".sanitizeInput($_POST["firstName"]).", ilośc znaków: ".strlen($_POST["firstName"]);
//exit();

if($_SERVER["REQUEST_METHOD" ] == "POST"){
    /*
    echo "<pre>";

   print_r($_POST);
 
   echo "</pre>";
*/

    $required_fields = ["firstName", "lastName", "email1", "email2", "password1", "password2", "birthday", "city_id", "gender"];
    /*
     foreach ($required_fields as $key => $value){

        echo "$key: $value<br>";
     }
    */
    
    session_start();

    //$error = 0;

   // $errors[] = ""; //tak nie mozna, bo ta tablica ma od razu pusty element

    $errors = [];

    foreach($required_fields as $value){
        if (empty($_POST[$value])){
            $errors[] = "Pole <b>$value</b> jest wymagane!";
        }
    }

    if (!empty($errors)){
        print_r($errors);
        $_SESSION["error"] = implode("<br>", $errors);
        echo "<script>history.back();</script>";
        exit();
    }

    if($_POST["email1"] != $_POST["email2"]){
        //$error = 1;
        $errors[] = "Adresy email sa rozne";
    }

    
    if($_POST["additional_email1"] != $_POST["additional_email2"]){

        $errors[] = "Adresy dodatkowe email sa rozne";
    }else{

        if(empty($_POST["additional_email1"])){

            $_POST["additional_email1"] = NULL;
        }
    }

 
    if($_POST["password1"] != $_POST["password2"]){
        
        //echo "<script>history.back();</script>";
        $errors[] = "Hasla sa rozne";
        //exit();
    }else{
        //walidacja hasła

         if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s])\S{8,}$/', $_POST["password1"])) {
	     $errors[] = "Hasło nie spełnia wymagań!";
        }
    }
    
    if (!isset($_POST["gender"])){
		$errors[] = "Wybierz płeć!";
	}

    if (!isset($_POST["terms"])){
		$errors[] = "Zatwierdź regulamin!";
	}

//walidacja hasła v2
/*
if ($error == 0 && !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s])\S{8,}$/', $_POST["password1"])) {
    $_SESSION["error"] = "Hasło nie spełnia wymagań!";
    $error++;
}
   */

    if(!empty($errors)){
        $_SESSION["error"] = implode("<br>", $errors);
        echo "<script>history.back();</script>";
        exit();
    }

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

	require_once "./connect.php";

// sanityzacja danych dokonczyc
/*
    foreach($_POST as $key => $value){

        if(!$_POST["password1"] && !$_POST["password2"]){

            sanitizeInput($_POST["$key"]);
        }
    }

*/

	$stmt = $conn->prepare("INSERT INTO `users` (`email`, `additional_email`, `city_id`, `firstName`, `lastName`, `birthday`, `gender`, `avatar`, `password`, `created_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,  current_timestamp());");

    $pass = password_hash( $_POST["password1"], PASSWORD_ARGON2ID);

    $avatar = ($_POST["gender"] == 'm') ? './jpg.man.png' : './jpg.woman.png' ;

	$stmt->bind_param('ssissssss', $_POST["email1"], $_POST["additional_email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $_POST["gender"], $avatar, $pass);

	$stmt->execute();

	echo $stmt->affected_rows;
  
    if ($stmt->affected_rows == 1 ){
        $_SESSION["success"] = "Dodano uzytkownika $_POST[firstName] $_POST[lastName]";
        header("location: ../pages");
        exit();

    }else{
        $_SESSION["error"] = "Nie udalo sie dodac rekordu ";
    }

}

header("location: ../pages/register.php");
 




/*---v2-------
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




/*
//-------------v3------------

// sanityzacja
// poszukać czemu trim nie działa
function sanitizeInput(&$input) {
    $input = htmlentities(stripslashes(trim($input)));
    return $input;
}
//
//echo $_POST["firstName"]." ==> ".sanitizeInput($_POST["firstName"]).", ilość znaków: ".strlen($_POST["firstName"]);
//exit();

// działa też, jeśli ktoś próbuje zmienić method na post w dev toolsach
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // tablica z nazwami wymaganych pól
    $required_fields = ["firstName", "lastName", "email1", "email2", "password1", "password2", "birthday", "city_id", "gender"];
    session_start();
    $error = 0;
    $errors = [];

    foreach ($required_fields as $value) {
        if (empty($_POST[$value])) {
            $errors[] = "Pole <b>$value</b> jest wymagane!";
            $error++;
        }
    }

    if (!empty($errors)) {
        $_SESSION["error"] = implode("<br>", $errors);
        echo "<script>history.back();</script>";
        exit();
    }

    if ($_POST["email1"] !== $_POST["email2"])
        $errors[] = "Adres email musi być taki sam!";

    if ($_POST["additional_email1"] !== $_POST["additional_email2"]) {
        $errors[] = "Adres email musi być taki sam!";
    } else {
        if (empty($_POST["additional_email1"]))
            $_POST["additional_email1"] = null;
    }

    if ($_POST["password1"] !== $_POST["password2"])
        $errors[] = "Hasło musi być takie samo w obu polach!";

    if (!isset($_POST["gender"]))
        $errors[] = "Zaznacz płeć!";

    if (!isset($_POST["terms"]))
        $errors[] = "Zatwierdź regulamin!";

    if (!empty($errors)) {
        $_SESSION["error"] = implode("<br>", $errors);
        echo "<script>history.back();</script>";
        exit();
    }

    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s])\S{8,}$/', $_POST["password1"])) {
        $_SESSION["error"] = "Hasło nie spełnia wymagań!";
        echo "<script>history.back();</script>";
        exit();
    }

    // sprawdzenie, czy email już istnieje
    require_once "connect.php";
    if ($error == 0) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $_POST["email1"]);
        $stmt->execute();

        if ($stmt->get_result()->num_rows > 0) {
            $errors = "Podany e-mail jest zajęty!";
            $error++;
        }
    }

    if ($error != 0) {
        echo "<script>history.back()</script>";
        exit();
    }

    foreach ($_POST as $key => $value) {
        if (!$_POST["password1"] && !$_POST["password2"]) {
            sanitizeInput($_POST["$key"]);
        }
    }

    $hashedPassword = password_hash($_POST["password1"], PASSWORD_ARGON2I);
    $avatarPath = $_POST["gender"] == "w" ? "./img/woman-avatar.jpg" : "./img/man-avatar.jpg";

    // zabezpieczenie przed sql injection
    $stmt = $conn->prepare("INSERT INTO users (email, additional_email, city_id, firstName, lastName, birthday, gender, avatar, password, created_at) VALUES (?, ?, ?, ? ,?, ?, ?, ?, ?, CURRENT_TIMESTAMP());");
    $stmt->bind_param("ssissssss", $_POST["email1"], $_POST["additional_email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $_POST["gender"], $avatarPath, $hashedPassword);
    $stmt->execute();

    if ($stmt->affected_rows == 1) {
        $_SESSION["success"] = "Zarejestrowano użytkownika";
    } else {
        $errors[] = "Nie udało się zarejestrować użytkownika!";
    }
}

header("location: ../pages/register.php");
*/