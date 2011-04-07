<?php
	/* 
		This is the register PHP page. It will process the information obtained from the various html/php pages.
	*/	
require_once("../config.php");

if(!empty($_POST))
{
	$action = trim($_POST["action"]);
	
	if($action == "register")
	{
		$errors = array();
		$email = trim($_POST["email"]);
		$username = trim($_POST["username"]);
		$firstname = trim($_POST["firstname"]);
		$lastname = trim($_POST["lastname"]);
		$password = trim($_POST["password"]);
		$confirm_pass = trim($_POST["passwordc"]);
		$country = trim($_POST["country"]);
		$sex = trim($_POST["sex"]);
		//$birthday = trim($_POST["year"])."-".trim($_POST["month"])."-".trim($_POST["day"]);
	
		//Perform some validation for the new user registration
		
		if(minMaxRange(5,25,$username))
		{
			$errors[] = lang("ACCOUNT_USER_CHAR_LIMIT",array(5,25));
		}
		if(minMaxRange(8,50,$password) && minMaxRange(8,50,$confirm_pass))
		{
			$errors[] = lang("ACCOUNT_PASS_CHAR_LIMIT",array(8,50));
		}
		else if($password != $confirm_pass)
		{
			$errors[] = lang("ACCOUNT_PASS_MISMATCH");
		}
		if(!isValidEmail($email))
		{
			$errors[] = lang("ACCOUNT_INVALID_EMAIL");
		}
				
		if(count($errors) == 0)
		{	
			//Construct a user object in order to check if 
			$user = new User($username,$password,$email,$firstname,$lastname,$country,$sex);
			
			//Checking this flag tells us whether there were any errors such as possible data duplication occured
			if(!$user->status)
			{
				if($user->username_taken) $errors[] = lang("ACCOUNT_USERNAME_IN_USE",array($username));
				if($user->email_taken) 	  $errors[] = lang("ACCOUNT_EMAIL_IN_USE",array($email));		
			}
			else
			{
				//Attempt to add the user to the database
				if(!$user->addNewUser())
				{
					if($user->mail_failure) $errors[] = lang("MAIL_ERROR");
					if($user->sql_failure)  $errors[] = lang("SQL_ERROR");
				}
			}
		}
		$url = "../../login.php?typemessage=successMessage&message=REGISTRATION_SUCCESS";
		header("Location: $url");
		die();
			
	} else if($action == "login") {
		
		$errors = array();
		$username = trim($_POST["username"]);
		$password = trim($_POST["password"]);
	
		//Perform some validation
		//Feel free to edit / change as required
		if($username == "")
		{
			$errors[] = lang("ACCOUNT_SPECIFY_USERNAME");
		}
		if($password == "")
		{
			$errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
		}
		
		//End data validation
		if(count($errors) == 0)
		{
			//A security note here, never tell the user which credential was incorrect
			if(!usernameExists($username))
			{
				$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
			}
			else
			{
				$userdetails = fetchUserDetails($username);

				//Hash the password and use the salt from the database to compare the password.
				$entered_pass = generateHash($password,$userdetails["password"]);
				
				if($entered_pass != $userdetails["password"])
				{
					//Again, we know the password is at fault here, but lets not give away the combination incase of someone bruteforcing
					$errors[] = "ACCOUNT_USER_OR_PASS_INVALID";
				}
				else
				{
					if(count($errors) != 0)
					{
						$url = "../../login.php?typemessage=errorMessage&message="."".$errors[0];
						header("Location: $url");
					}

					//Construct a new logged in user object
					//Transfer some db data to the session object

					$loggedInUser = new loggedInUser();
					$loggedInUser->email = $userdetails["email"];
					$loggedInUser->user_id = $userdetails["id"];
					$loggedInUser->hash_pw = $userdetails["password"];
					$loggedInUser->username = $userdetails["username"];
					$loggedInUser->firstname = $userdetails["firstname"];
					$loggedInUser->lastname = $userdetails["lastname"];
					$loggedInUser->country = $userdetails["country"];
					$loggedInUser->sex = $userdetails["sex"];
					
					//Update last sign in
					$loggedInUser->updateLastSignIn();
					$_SESSION["projectUser"] = $loggedInUser;

					//Redirect to user account page
					header("Location:../../home.php");
					die();
				}
			}
		}
		
		$url = "../../login.php?typemessage=errorMessage&message=".$errors[0];
		header("Location: $url");
	} 
	else if ($action == "edit") 
	{
		$errors = array();
		$email = trim($_POST["email"]);
		$country = trim($_POST["country"]);
	
		//Perform some validation for the new user data
		
		if(!isValidEmail($email))
		{
			$errors[] = lang("ACCOUNT_INVALID_EMAIL");
		}
				
		if(count($errors) == 0)
		{	
			global $db;
			
			$sql = "UPDATE users
					SET 
					email = '".$email."', country = '".$country."' 
					WHERE id = '".$loggedInUser->user_id."'";

			$db->sql_query($sql);
		}
		$url = "../../userProfil.php";
		header("Location: $url");
		die();	
	}
	else
	{
		die();
	
	}
	
}
?>