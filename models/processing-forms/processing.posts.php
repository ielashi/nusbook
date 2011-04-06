<?php
	/* 
		This is the register PHP page. It will process the information obtained from the various html/php pages.
	*/	
require_once("../config.php");


if(isset($_POST["action"]) && $_POST["action"] == "add")
{
	$group_id = $_POST["group_id"];
	$user_id = $_POST["user_id"];
	$title = trim($_POST["title"]);
	$post = trim($_POST["post"]);

	$sql = "INSERT INTO posts 
			(group_id,title,poster,post,post_date) 
			VALUES 
			('".$group_id."','".$title."','".$user_id."','".$post."','".time()."')";
	
	echo $sql;
	
	$db->sql_query($sql);
	$postID = $db->sql_nextid();
	
	$url = "../../postview.php?id=".$postID;
	header("Location: $url");
	die();
		
} else if($_POST["action"] == "reply") {
	
	$group_id = $_POST["group_id"];
	$user_id = $_POST["user_id"];
	$reply = $_POST["reply"];
	$title = trim($_POST["title"]);
	$post = trim($_POST["post"]);

	$sql = "INSERT INTO posts 
			(group_id,title,poster,post,post_date,reply_to) 
			VALUES 
			('".$group_id."','".$title."','".$user_id."','".$post."','".time()."','".$reply."')";
	
	echo $sql;
	
	$db->sql_query($sql);
	$postID = $db->sql_nextid();
	
	// THIS ONE ISN'T WORKING FOR SOME REASON
	
	$url = "../../postview.php?id=".$postID;
	header("Location: $url");
	die();
	
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