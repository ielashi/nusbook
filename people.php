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
		<title>.nUs BooK | Groups</title>
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
                <img src="images/people.png" alt="People" />
            </div>
            <div id="leftColumnContent">
	        	<table id="generalTable" width="100%">
	            	<thead>
	            		<tr class="odd">
							<th width="30%"><label></label></th>
	            			<th width="30%"><label>Lastname</label></th>
							<th width="30%"><label>Firstname</label></th>
							<th width="30%"><label>Username</label></th>
							<th width="30%"><label>Actions</label></th>
	            		</tr>
	            	</thead>
	            	<tbody>
		            	<?php
						$users = fetchAllUsers();
	            		while($user = mysql_fetch_array($users))
	            		{
	            		?>
	            			<tr>
	            				<td><img src="<?php echo retrieveProfilPictureThumb($user['id']);?>"/></td>
	            				<td><?php echo $user['lastname'];?></td>
	            				<td><?php echo $user['firstname'];?></td>
	            				<td><?php echo $user['username'];?></td>
	            				<td><a href="peopleview.php?username=<?php echo $user['username'];?>">View</a></td>
	            			</tr>
	            		<?php
	            		} ?>
	            	</tbody>
	            </table>
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


