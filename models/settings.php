<?php

	//General Settings
	//--------------------------------------------------------------------------
	
	//Database Information
	$dbtype = "mysql"; 
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "root";
	$db_name = "nusbook";
	$db_port = "8889";
	$db_table_prefix = "";

	$langauge = "en";
	
	//Generic website variables
	$websiteName = "nusBook";
	$websiteUrl = "http://localhost/nusbook/index.php"; //including trailing slash	

	
	//Tagged onto our outgoing emails
	$emailAddress = "antoine@bisson.me";
	
	//Date format used on email's
	$emailDate = date("l \\t\h\e jS");
	
	//Directory where txt files are stored for the email templates.
	$mail_templates_dir = "models/mail-templates/";
	
	$default_hooks = array("#WEBSITENAME#","#WEBSITEURL#","#DATE#");
	$default_replace = array($websiteName,$websiteUrl,$emailDate);
	
	//Display explicit error messages?
	$debug_mode = true;
	
	//---------------------------------------------------------------------------
?>