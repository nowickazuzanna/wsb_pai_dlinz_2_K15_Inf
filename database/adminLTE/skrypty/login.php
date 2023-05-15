<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
	//print_r($_POST);
	$errors = [];
	foreach ($_POST as $key => $value){
		if(empty($value)){
			$errors[] = "Pole <b>$key</b> musi być wypełnione";
		}
	}
	//print_r($errors);
	//echo $error_message;

	if(!empty($errors)){
		$error_message = implode("<br>", $errors);
		header("Location: ../pages/index.php?error=".urlencode($error_message));
		exit();
	}

	echo "email: ".$_POST["email"].", hasło: ".$_POST["password"]."<br>";


	//$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL); //  j<b>an@</b>o2.pl  => jban@bo2.pl
	//echo $email;

	echo htmlentities($_POST["email"]); //j<b>an@</b>o2.pl

}else{
	header("location: ../pages");
}





/* ----v1----
session_start();

if($_SERVER["REQUEST_METHOD"] == 'POST'){

    $errors=[]; //pusta tablica
    //print_r($_POST);
    foreach($_POST as $key => $value){
        //dodac tablice bledow, wyslac ja do indeksu i wyswietlic bledy
        //wyswietlic w indeksie
        //pole email jest wymagane
        //pole pass jest wymagane

        if(empty($value)){ //czy dana wartosc jest pusta

            //array_push($errors, "Pole $key jest wymagane!"); //jesli wartosc pusta to kominukat
            $errors[] = "Pole $key jest wymagane";
        }
    }
    //$_SESSION["error"] = $errors;

    //echo $error_message;
    if(!empty($errors))
    {
        $error_message = implode("<br>", $errors );
        header("location:../pages/index.php?error=".urlencode($error_message));

        exit();

    }

    echo "email: ".$_POST["email"].", hasło: ".$_POST["pass"]."<br>";

    //$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    //echo $email;

    echo htmlentities($_POST["email"]);
}


else{
    header("location: ../pages/");
}
//header("location: ../pages");
*/




/*----v2---
session_start();
// sprawdzenie, czy formularz jest wysłany metodą POST
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $errors = [];

    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[] = "Pole $key musi być wypełnione!";
        }
    }

    if (sizeof($errors) > 0) {
        $_SESSION["error"] = $errors;
        echo "<script>history.back()</script>";
        exit();
    }

    echo "email: ".$_POST["email"].", hasło: ".$_POST["password"]."<br>";
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL); // usuwa niedozwolone znaki
    echo $email;
} else {
    header("location: ../pages");
}
*/