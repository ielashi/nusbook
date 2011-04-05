<?php
	/* 
		This is the register PHP page. It will process the information obtained from the various html/php pages.
	*/	
require_once("../config.php");


if(isset($_POST["action"]) && $_POST["action"] == "add")
{
	
	$db->sql_query($sql);
	$postID = $db->sql_nextid();
	
	$url = "../../postview.php?id=".$postID;
	header("Location: $url");
	die();
		
} else if(isset($_GET["reply"]) && $_GET["action"] == "reply") {
	
		
	$url = "../../login.php?typemessage=errorMessage&message=".$errors[0];
	header("Location: $url");
	
} else if(isset($_POST["action"]) && $_POST["action"] == "edit"){
	
		
	$url = "../../login.php?typemessage=errorMessage&message=".$errors[0];
	header("Location: $url");
	
} else if(isset($_GET["delete"]) && $_GET["action"] == "delete") {
	
		
	$url = "../../login.php?typemessage=errorMessage&message=".$errors[0];
	header("Location: $url");
}
else
{
	// Error Message

}


?>