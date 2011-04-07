<?php

	//Should return all the groups available on the website and order by date of latest post / (or subject or w/e)
	//If we do the latest post, we should be able to see the information of that post.
	function fetchAllGroups()
	{
		global $db;
		
		$sql = "SELECT *
				FROM groups g
				ORDER BY g.title";

		return $db->sql_query($sql);
	}
	
	//Return the information about the group in question. Its category as well as its information.
	function fetchGroupDetails($group_id)
	{
		global $db;
	
		$sql = "SELECT g.id, g.category_id, g.title, g.info, c.name FROM groups g, categories c 
			WHERE c.id = g.category_id AND g.id = '".$group_id."'";

		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		return ($row);
	}
	
	//Return all the groups that are contained within a category.
	function fetchAllGroupsBelongingToCategory($category_id)
	{
		global $db;
			
		$sql = "SELECT * FROM groups g 
				WHERE g.category_id = '".$category_id."'";
		
		return $db->sql_query($sql);
	}
	
	//Return the available categories for groups
	function getAllGroupCategories()
	{
		global $db;
		
		$sql = "SELECT * FROM categories
				ORDER BY name";

		return $db->sql_query($sql);
	}
	
	//This is for the AutoSuggest Page. This will do an instant search for the groups with the title like the user is typing. Do Not Modify this query. It is required like this.
	function getAllGroupsWithTitleLike($title)
	{
		global $db;
		$sql = "SELECT g.id, g.title, c.name FROM groups g, categories c 
					WHERE g.title LIKE ('%".$title."%') AND g.category_id = c.id 
						ORDER BY g.title";
				
		return $db->sql_query($sql);	
	}
	
	//This returns the five latest groups created. They are sorted by ID as the ID is auto increment. Also, a link is created to view them.
	function printFiveLatestGroupsWithLink()
	{
		global $db;
		
		$sql = "SELECT g.id, g.title FROM groups g
				ORDER BY g.id DESC LIMIT 5";


		$result = $db->sql_query($sql);		
		
		while($row = mysql_fetch_assoc($result))
		{
			echo ("<a href=\"groupsview.php?id=".$row['id']."\">".$row['title']."</a><br /><br />");	
		}	
		
	}

?>