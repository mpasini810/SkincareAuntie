<?php
	//var_dump($_POST);
	error_reporting(E_ERROR | E_WARNING | E_PARSE); // prevents error notices
	session_start();  // starts the session so variables can be stored in the session superglobal

	include 'database.php'; // This includes our database functions
    // Gets email and password from HTML form
	$email = $_POST['email'];
	$passwordToCheck = $_POST['password'];
	$hasError=false;
	$errMsg="";

	if(empty($email)){
		$hasError=true;
		$errMsg=$errMsg . "Please provide an email address.<br />";
	}

	if(empty($passwordToCheck)){
		$hasError=true;
		$errMsg=$errMsg . "Please provide a password.<br />";
	}

	if($hasError){			// If $hasError is true, send a location header to move browser to new location
		$_SESSION['errMsg']		= $errMsg; // Save the error message in the session to send to the next page
		// Send the values that were submitted when we
		// redirect the user
		$_SESSION['username'] 			    = $username;		// Puts values we received in post into the session superglobal
		$_SESSION['passwordToCheck'] 		= $passwordToCheck;

		header("Location: login.php");

		exit();
	}

		// The session is our vehicle for sending information between pages
	checkPassword($email, $passwordToCheck);

	if(checkPassword($email, $passwordToCheck)){
	    $_SESSION['email'] = $email;
	    $destination = "";
	    if(isset($_POST['destination'])){
	        $destination = $_POST['destination'];
        }else{
	        $destination = "index.php";
        }
        /*
         * Could also be written $destination = (isset($_GET['destination'])) ? $_GET['destination'] : "index.php";
         */
		header("Location: ".$destination);
	} else {
		header("Location: login.php");
	}




	exit();
?>
