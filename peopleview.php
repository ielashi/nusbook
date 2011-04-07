<?php

	require_once("models/config.php");
	
	//Prevent the user visiting the logged in page if he/she is already logged in
	$url = "login.php?typemessage=errorMessage&message=ACCOUNT_LOGIN";
	$userInfo = fetchUserDetails($_GET['username']);
	
	if(!isUserLoggedIn()) { header("Location: $url"); die(); }
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
		<title>.nUs BooK | <?php echo $userInfo['firstname']." ".$userInfo['lastname'];?></title>
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
					<?php echo $userInfo['firstname']." ".$userInfo['lastname'];?>
				</div>
			</div>
               
			<div id="leftColumnContent">
			<div style="width:400px;float:left;padding-top:25px;">
				<img src="<?php echo retrieveProfilPicture($userInfo['id']); ?>"/>
			</div>
	            <div style="border-bottom:1px solid black;">
		        	<table id="generalTable" width="40%">
		        		<thead>
		        			<tr class="odd">
		        				<th><label>Country: </label></th>
		        				<td><?php echo $userInfo['country'];?></td>
		        			</tr>
		        			<tr >
		        				<th><label>Sex: </label></th>
		        					<td><?php echo $userInfo['sex'];?></td>
		        			</tr>
							<tr class="odd">
								<th><label>Email: </label></th>
								<td><?php echo $userInfo['email'];?></td>
							</tr>
		        		</thead>
		        	</table>
	   			</div>
           	
			<br/>
			<?php
				$addedGroups = fetchAddedGroupsByUser($userInfo['id']);
				echo "<p>User has added ".$addedGroups." group(s)<br/>";
				

				$addedPosts = fetchPostsByUser($userInfo['id']);
				echo "User has posted ".$addedPosts." post(s)</p>";
			?>
			</div>
       </div>
		
		<div id="rightColumn">
			<?php include("layout/generalrightcolumn.php"); ?>
		</div>
		
        <div style="clear:both;"></div>
        
	</div>
</div>
</body>
</html>


