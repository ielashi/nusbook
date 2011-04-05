<?php

	//Should return the information about the post, as well as who wrote it, and the pictures of the person.
	function fetchPostDetail($id)
	{
		global $db;
		
		//This is to check if we pass an invalid ID. Check the groups.php table for an example.
		if($id == -1)
		{
			return null;
		}
		
		$sql = "SELECT * FROM posts p WHERE p.id == '".$id."'";

		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		return ($row);
	}
	
		
	//Return all the posts of the group, ordered by date. This should also return who wrote the post and its information (picture link and name). JOIN might be used here.
	function fetchPostsOfGroup($group_id)
	{
		global $db;
	
		$sql = "SELECT p.id, p.post_date, p.reply_to, p.title, p.post, 
				u.id, u.username, u.picture_path
				FROM posts p, users u
				WHERE p.poster = u.id
				AND p.group_id = " . $group_id . "
				ORDER BY p.post_date";

		return $db->sql_query($sql);
	}
	
	//Return all the posts of the group, ordered by date. This should also return who wrote the post and its information (picture link and name). JOIN might be used here.
	function printMostRecentPostOfGroup($group_id)
	{
		global $db;
		
		$sql = "SELECT p.id, p.post_date, p.reply_to, p.title, p.post, 
				u.id, u.username, u.firstname, u.lastname, u.picture_path
				FROM posts p, users u
				WHERE p.poster = u.id
				AND p.group_id = " . $group_id . " 
				ORDER BY p.post_date LIMIT 1";
		
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		
		if($row == null)
		{
			echo "No posts in that group!";
		}
		else
		{
			$name =  $row['firstname']." ".$row['lastname'];
			echo ("<a href=\"postview.php?id=".$row['id']."\">".$row['title']." - ".$name."</a>");
		}
	}
	

?>