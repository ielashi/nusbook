<?php
	/* 
		This is the register PHP page. It will process the information obtained from the various html/php pages.
	*/	
require_once("../config.php");

if(isset($_POST["action"]) && $_POST["action"] == "add")
{
	$errors = array();
	$title = trim($_POST["title"]);
	$information = trim($_POST["information"]);
	$category_id = trim($_POST["category_id"]);

	$sql = "INSERT INTO groups 
			(title,info,category_id,creator_id) 
			VALUES 
			('".$title."','".$information."','".$category_id."','".$loggedInUser->user_id."')";
	
	$db->sql_query($sql);
	$groupID = $db->sql_nextid();
	
	$sql = "INSERT INTO group_members
			(group_id,user_id,is_admin)
			VALUES
			('".$groupID."','".$loggedInUser->user_id."',1)";

	$db->sql_query($sql);

	$url = "../../groupsview.php?id=".$groupID;
	header("Location: $url");
	die();
		
} else if(isset($_POST["action"]) && $_POST["action"] == "edit") {
	
	$id = $_POST["id"];
	$title = trim($_POST["title"]);
	$information = trim($_POST["information"]);
	$category_id = trim($_POST["category_id"]);

	$sql = "UPDATE groups
			SET 
			title = '".$title."', info = '".$information."' ,category_id = '".$category_id."' 
			WHERE id = '".$id."'";

	$db->sql_query($sql);

	$url = "../../groupsview.php?id=".$id;
	header("Location: $url");
	die();
	
} else if(isset($_GET["action"]) && $_GET["action"] == "delete") {
	
	$id = $_GET["id"];
	
	$sql = "DELETE FROM groups WHERE id = '".$id."'";
	$db->sql_query($sql);
	$groupID = $db->sql_nextid();

	$url = "../../groups.php?typemessage=successMessage&message=DELETE_SUCCESS";
	header("Location: $url");
	die();
	
} else if(isset($_GET["action"]) && $_GET["action"] == "join") {
	
	$id = $_GET["id"];
	
	$sql = "DELETE FROM groups g WHERE g.id = '".$id."'";
	
	$db->sql_query($sql);
	$groupID = $db->sql_nextid();

	$url = "../../groups.php?typemessage=successMessage&message=JOIN_SUCCESS";
	header("Location: $url");
	die();
	
} else if(isset($_GET["action"]) && $_GET["action"] == "unjoin") {
	
	$id = $_GET["id"];
	
	$sql = "DELETE FROM group_members gc WHERE gc.group_id = '".$id."' AND gc.user_id = '".$loggedInUser->user_id."'";

	$url = "../../groups.php?typemessage=successMessage&message=UNJOIN_SUCCESS";
	header("Location: $url");
	die();
	
} 
else
{
	// Error Message

}

?>