<?php
		require_once("models/config.php");

/*
note:
this is just a static test version using a hard-coded countries array.
normally you would be populating the array out of a database

the returned xml has the following structure
<results>
	<rs>foo</rs>
	<rs>bar</rs>
</results>
*/
               
	if ($result =  getAllGroupsWithTitleLike($_GET['input']));
    {
    	if (mysql_num_rows($result))
		{
			while ($row = mysql_fetch_assoc($result))
			{
				$aGroup[] = array("title" => $row['title'], "id" => $row['id']);
				$aCategory[] = array("interest" => $row['title'], "category" => $row['name']);
			}
		}
	}

	$input = strtolower( $_GET['input'] );
	$len = strlen($input);
	$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 0;
	
	
	$aResults = array();
	$count = 0;
	
	if ($len)
	{
		for ($i=0;$i<count($aGroup);$i++)
		{
			// had to use utf_decode, here
			// not necessary if the results are coming from mysql
			//
			if (strtolower(substr(utf8_decode($aGroup[$i]['title']),0,$len)) == $input)
			{
				$count++;
				$aResults[] = array("id"=>htmlspecialchars($aGroup[$i]['id']) ,"value"=>htmlspecialchars($aGroup[$i]['title']), "info"=>htmlspecialchars($aCategory[$i]['category']), "id2" =>htmlspecialchars($aCategory[$i]['category']));
			}
			
			if ($limit && $count==$limit)
				break;
		}
	}
	
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
	header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header ("Pragma: no-cache"); // HTTP/1.0
	
	
	
	if (isset($_REQUEST['json']))
	{
		header("Content-Type: application/json");
	
		echo "{\"results\": [";
		$arr = array();
		for ($i = 0; $i < count($aResults); $i++)
		{
			$arr[] = "{\"id\": \"".$aResults[$i]['id']."\", \"id2\": \"".$aResults[$i]['id2']."\", \"value\": \"".$aResults[$i]['value']."\", \"info\": \"".$aResults[$i]['info']."\"}";
		}
		echo implode(", ", $arr);
		echo "]}";
	}
?>