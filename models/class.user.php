<?php

class loggedInUser {

	public $email = NULL;
	public $hash_pw = NULL;
	public $user_id = NULL;
	public $username = NULL;
	public $firstname = NULL;
	public $lastname = NULL;
	public $country = NULL;
	public $sex = NULL;
	
	
	//Simple function to update the last sign in of a user
	public function updateLastSignIn()
	{
		global $db,$db_table_prefix;
		
		$sql = "UPDATE users
			    SET
				lastsignin = '".time()."'
				WHERE
				id = '".$db->sql_escape($this->user_id)."'";
		
		return ($db->sql_query($sql));
	}
	
	//Return the timestamp when the user registered
	public function signupTimeStamp()
	{
		global $db,$db_table_prefix;
		
		$sql = "SELECT
				signupdate
				FROM
				users
				WHERE
				id = '".$db->sql_escape($this->user_id)."'";
		
		$result = $db->sql_query($sql);
		
		$row = $db->sql_fetchrow($result);
		
		return ($row['signupdate']);
	}
	
	
	//Logout
	function userLogOut()
	{
		destorySession("projectUser");
	}
	
	public function isInGroup($groupID)
	{
		global $db;
		
		$sql = "SELECT gm.is_admin
				FROM group_members gm
				WHERE
				user_id = '".$this->user_id."' AND group_id = '".$groupID."'";
				
		$result = $db->sql_query($sql); 
		$count = mysql_num_rows($result);
		
		if($count > 0)
		{
			return true;
		}
		return false;
	
	}
	
	//Checks if the user owns the group so it can delete/edit it.
	public function isOwnerGroup($groupID)
	{
		global $db;
		
		$sql = "SELECT gm.is_admin
				FROM group_members gm
				WHERE
				user_id = '".$this->user_id."' AND group_id = '".$groupID."'";
				
		$result = $db->sql_query($sql);
		$count = mysql_num_rows($result);

		if($count > 0)
		{
			$row = $db->sql_fetchrow($result);
			
			if($row['is_admin'] == 1)
			{
				return true;
			}
		}

		return false;
	}
	
	//Checks if the user is the owner of the post so it can delete/edit it.
	public function isOwnerPost($postID)
	{
		global $db;
		
		$sql = "SELECT p.poster
				FROM posts p
				WHERE
				p.id = '".postID."' ";
				
		$result = $db->sql_query($sql);
		$count = mysql_num_rows($result);
		
		if($count > 0)
		{
			$row = $db->sql_fetchrow($result);
			
			if($row['p.poster'] == $this->user_id)
			{
				return true;
			}
		
		}

		return false;
	
	}
	
	//This returns the five latest groups created. They are sorted by ID as the ID is auto increment. Also, a link is created to view them.
	function printJoinedGroupsWithLink()
	{
		global $db;
		
		$sql = "";


		$result = $db->sql_query($sql);		
		
		while($row = mysql_fetch_assoc($result))
		{
			echo ("<a href=\"groupsview.php?id=".$row['id']."\">".$row['title']." - ".$row['name']."</a><br /><br />");	
		}	
		
	}
	
	public function changeProfilPicture($path)
	{
		global $db,$db_table_prefix;		
		
		$sql = "SELECT picture_path FROM users WHERE `id` = '".$db->sql_escape($this->user_id)."'";
		$result = $db->sql_query($sql);		
		$row = $db->sql_fetchrow($result);
		
		//Delete the old pictures
		if($row["picture_path"] != "default.png")
		{
			unlink("/Applications/MAMP/htdocs/nusbook/uploads/profilpictures/full/".$row["path"]);
			unlink("/Applications/MAMP/htdocs/nusbook/uploads/profilpictures/thumbs/".$row["path"]);
		}		
		
		$sql = "UPDATE users SET `picture_path` = '".$path."' WHERE `id` = '".$db->sql_escape($this->user_id)."'";		
		return ($db->sql_query($sql));
	}
	
	//This is a function that deletes the original picture that needed resize.
	public function clearOriginalPicture($path)
	{
		unlink("/Applications/MAMP/htdocs/nusbook/uploads/".$path);		
	}

}
?>