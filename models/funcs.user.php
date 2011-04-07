<?php

//This is a php pages that is used to retrieve information about a user. NO modifications are done here.
//The modifications are done in the user class.

	function usernameExists($username)
	{
		global $db;
		
		$sql = "SELECT firstname
				FROM users
				WHERE
				username = '".$db->sql_escape(sanitize($username))."'
				LIMIT 1";

		if(returns_result($sql) > 0)
			return true;
		else
			return false;
	}
	
	function emailExists($email)
	{
		global $db,$db_table_prefix;
	
		$sql = "SELECT firstname FROM users
				WHERE
				email = '".$db->sql_escape(sanitize($email))."'
				LIMIT 1";
	
		if(returns_result($sql) > 0)
			return true;
		else
			return false;	
	}
	
	//Fetches all the Users in the Database
	function fetchAllUsers()
	{
		global $db;
		
		$sql = "SELECT * FROM users u ORDER by u.lastname";

		return $db->sql_query($sql);	
	}
	
	//You can use a activation token to also get user details here
	function fetchUserDetails($username=NULL,$token=NULL)
	{
		global $db,$db_table_prefix; 
		
		if($username!=NULL) 
		{  
			$sql = "SELECT * FROM users
					WHERE
					username = '".$db->sql_escape(sanitize($username))."'
					LIMIT
					1";
		}
		 
		$result = $db->sql_query($sql);
		
		$row = $db->sql_fetchrow($result);
		
		return ($row);
	}
	
	//Returns the firstname and lastname printer, and in a form of a link
	function printFirstnameLastnameUserLink($id)
	{
		global $db,$db_table_prefix; 
		
		$sql = "SELECT u.firstname,u.lastname,u.username FROM users u
				WHERE
				id = '".$id."'";
		 
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);

		echo "<a href=\"peopleview.php?username=".$row['username']."\">".$row['firstname']." ".$row['lastname']."</a>";
	}
	
	
	function fetchAddedGroupsByUser($user_id)
	{
		global $db;
			
		$sql = "SELECT COUNT(*) as numAdded
				FROM groups
				WHERE creator_id = ".$user_id;
	
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		return $row["numAdded"];	
	}
	
	function fetchPostsByUser($user_id)
	{
		global $db;
			
		$sql = "SELECT COUNT(*) as numAdded
				FROM posts
				WHERE poster = ".$user_id;
	
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		return $row["numAdded"];	
	
	}
	
	function retrieveProfilPicture($user_id)
	{
		global $db,$db_table_prefix;
		$sql = "SELECT picture_path FROM users WHERE `id` = '".$user_id."'";
		
		$result = $db->sql_query($sql);
		
		$row = $db->sql_fetchrow($result);

		return ("uploads/profilpictures/full/".$row["picture_path"]);
	}
	
		
	function retrieveProfilPictureThumb($user_id)
	{
		global $db,$db_table_prefix;
		$sql = "SELECT picture_path FROM users WHERE `id` = '".$user_id."'";
		$result = $db->sql_query($sql);
		
		$row = $db->sql_fetchrow($result);

		return ("uploads/profilpictures/thumbs/".$row["picture_path"]);
	}
	
	
	function isUserLoggedIn()
	{
		global $loggedInUser,$db;
		
		if(isset($loggedInUser->user_id) || isset($loggedInUser->hash_pw))
		{		
			$sql = "SELECT id,
				password
				FROM users
				WHERE
				id = '".$db->sql_escape($loggedInUser->user_id)."'
				AND 
				password = '".$db->sql_escape($loggedInUser->hash_pw)."' 
				LIMIT 1";
	
			if($loggedInUser == NULL)
			{
				return false;
			}
			else
			{
				//Query the database to ensure they haven't been removed or possibly banned?
				if(returns_result($sql) > 0)
				{
					return true;
				}
				else
				{
					//No result returned kill the user session, user banned or deleted
					$loggedInUser->userLogOut();
				
					return false;
				}
			}
		}
	}
	
	//This returns the five latest groups created. They are sorted by ID as the ID is auto increment. Also, a link is created to view them.
	function printFiveLatestUsersWithLink()
	{
		global $db;
		
		$sql = "SELECT * FROM users u
				ORDER BY u.id DESC LIMIT 5";


		$result = $db->sql_query($sql);		
		
		while($row = mysql_fetch_assoc($result))
		{
			echo ("<a href=\"peopleview.php?username=".$row['username']."\">".$row['firstname']." ".$row['lastname']."</a><br /><br />");	
		}	
		
	}
	
	//This function should be used like num_rows, since the PHPBB Dbal doesn't support num rows we create a workaround
	function returns_result($sql)
	{
		global $db;
		
		$count = 0;
		$result = $db->sql_query($sql);
		
		while ($row = $db->sql_fetchrow($result))
		{
		  $count++;
		}
		
		$db->sql_freeresult($result);
		
		return ($count);
	}
?>