<?php

class User 
{
	public $user_active = 1;
	private $clean_email;
	public $status = false;
	private $clean_password;
	private $clean_username;
	private $firstname;
	private $lastname;
	private $country;
	private $sex;
	public $sql_failure = false;
	public $mail_failure = false;
	public $email_taken = false;
	public $username_taken = false;
	public $activation_token = 0;

	function __construct($user,$pass,$email,$p_firstname,$p_lastname,$p_country,$p_sex)
	{
		//Used for display only
		$this->unclean_username = $user;
		
		//Sanitize
		$this->clean_email = sanitize($email);
		$this->clean_password = trim($pass);
		$this->clean_username = sanitize($user);
		$this->firstname = $p_firstname;
		$this->lastname = $p_lastname;
		$this->country = $p_country;
		$this->sex = $p_sex;
		
		if(usernameExists($this->clean_username))
		{
			$this->username_taken = true;
		}
		else if(emailExists($this->clean_email))
		{
			$this->email_taken = true;
		}
		else
		{
			//No problems have been found.
			$this->status = true;
		}
	}
	
	public function addNewUser()
	{
		global $db,$db_table_prefix;
	
		//Prevent this function being called if there were construction errors
		if($this->status)
		{
			//Construct a secure hash for the plain text password
			$secure_pass = generateHash($this->clean_password);

			//Insert the user into the database providing no errors have been found.
			$sql = "INSERT INTO `users` (
					`username`,
					`firstname`,
					`lastname`,
					`country`,
					`sex`,
					`password`,
					`email`,
					`signupdate`
					)
			 		VALUES (
					'".$db->sql_escape($this->clean_username)."',
					'".$db->sql_escape($this->firstname)."',
					'".$db->sql_escape($this->lastname)."',
					'".$db->sql_escape($this->country)."',
					'".$db->sql_escape($this->sex)."',
					'".$secure_pass."',
					'".$db->sql_escape($this->clean_email)."',
					'".time()."'
					)";
			return $db->sql_query($sql);
			
		}
	}
}

?>