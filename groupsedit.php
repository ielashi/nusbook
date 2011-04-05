<?php

	require_once("models/config.php");
	
	//Prevent the user visiting the logged in page if he/she is already logged in
	$url = "login.php?typemessage=errorMessage&message=ACCOUNT_LOGIN";
	$groupInfo = fetchGroupDetails($_GET['id']);
	
	if(!isUserLoggedIn()) { header("Location: $url"); die(); }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>.nUs BooK | Welcome <?php echo $loggedInUser->firstname." ".$loggedInUser->lastname;?>!</title>
<?php include("models/includes.home.php"); ?>
</head>

<body>

<div id="topHeader">
	<?php include("layout/top_header.php"); ?>
</div>

<div id="main">
    <div id="header">
        <div id="headercontent">
            <div id="menu">
            	<?php include("layout/menu.php"); ?>
            </div>
        </div>
    </div>

    <div id="mainContent">
        <div id="leftColumn">
            <div id="leftColumnHeader">
				<div id="pageTitleWithBorder">
					Edit Group
				</div>              
			</div>
            <div id="leftColumnContent">
            <form name="edit group" action="models/processing-forms/processing.groups.php" method="post">
				<input type="hidden" name="action" value="edit">
				<input type="hidden" name="id" value="<?php echo $groupInfo['id'];?>">
				<table id="generalTable" width="100%">
					<thead>
						<tr class="odd">
							<th width="30%"><label>Title: </label></th>
							<td><input type="text" name="title" value="<?php echo $groupInfo['title'];?>" /></td>
						</tr>
						<tr class="odd">
							<th><label>Category: </label></th>
							<td><select name="category_id">
							<?php 
								$categories = getAllGroupCategories();					
									while($category = mysql_fetch_array($categories))
								{
								?>
							   <option <?php if($groupInfo["category_id"] == $category['id']) { echo "selected=\"selected\""; }?> value="<?php echo $category['id'];?>"><?php echo $category['name']; ?></option>
							<?php } ?>
							</select><br />
							</td>
						</tr>
						<tr >
							<th><label>Info: </label></th>
							<td><textarea cols="67" rows="4" name="information"/><?php echo $groupInfo['info'];?></textarea></td>
						</tr>
					</thead>
				</table>
				<input type="image" src="Images/save.png" value="submit" class="submit"/>
			</form>
            </div>
        </div>

        <div id="rightColumn">
        	<?php include("layout/generalrightcolumn.php"); ?>
        </div>
        
        <div style="clear:both;">
        </div>
	</div>
</div>

</body>
</html>


