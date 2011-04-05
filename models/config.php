<?php

	require_once("settings.php");

	//Dbal Support - Thanks phpBB ; )
	require_once("db/".$dbtype.".php");
	
	//Construct a db instance
	$db = new $sql_db();
	if(is_array($db->sql_connect(
							$db_host, 
							$db_user,
							$db_pass,
							$db_name, 
							$db_port,
							false, 
							false
	))) {
		die("Unable to connect to the database");
	}
	
	if(!isset($language)) $langauge = "en";

	require_once("lang/".$langauge.".php");
	require_once("funcs.general.php");
	require_once("class.user.php");
	require_once("funcs.user.php");
	require_once("funcs.posts.php");
	require_once("funcs.groups.php");
	require_once("class.newuser.php");

	session_start();
	
	//Global User Object Var
	//loggedInUser can be used globally if constructed
	if(isset($_SESSION["projectUser"]) && is_object($_SESSION["projectUser"]))
	{
		$loggedInUser = $_SESSION["projectUser"];
	}
?>