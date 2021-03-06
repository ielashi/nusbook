<?php

	require_once("models/config.php");
	
	//Prevent the user visiting the logged in page if he/she is already logged in
	$url = "login.php?typemessage=errorMessage&message=ACCOUNT_LOGIN";
	
	if(!isUserLoggedIn()) { header("Location: $url"); die(); }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>.nUs BooK | Reply <?php echo $loggedInUser->firstname." ".$loggedInUser->lastname;?>!</title>
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
					Reply
				</div>              
			</div>
            <div id="leftColumnContent">
            <form name="newGroup" action="models/processing-forms/processing.posts.php" method="post">
				<input type="hidden" name="action" value="reply">
				<input type="hidden" name="group_id" value="<?php echo $_GET['id'];?>">
				<input type="hidden" name="reply_to" value="<?php echo $_GET['reply_to'];?>">
				<table id="generalTable" width="100%">
					<thead>
						<tr >
							<th><label>Text: </label></th>
							<td><textarea cols="67" rows="4" name="information"/></textarea></td>
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


