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
		        	<table id="generalTable" width="100%">
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
           	</div>

			<?php
				$addedGroups = fetchAddedGroupsByUser($userInfo['id']);
				$count = 0;
				$number = mysql_num_rows($addedGroups); 
				if($number > 0)
				{
				?> 
					<div id="insidePageTitleWithoutBorder">Groups added by <?php echo $userInfo['firstname'];?></div>
					<div id="listAddedBy">
			    		<?php
			    		while ($row = mysql_fetch_array($addedGroups)) 
			    		{
			    		?>	<a href="groupsview.php?category_id=<?php echo $row['id'];?>">
			    			
			    			<?php echo $row['title'];?></a>
			    			<br />
			    		<?php
			        		$count++;
			        		if($count != $number)
			        		{
								?><div class="grayLine"></div><?php
			        			
			        		
			        		}
			        	}
			    		?> 
					</div> <?php
				} else {
				
					echo "<br/>No Groups added.";
				}
			
			?>
			
			<?php
				$addedPosts = fetchPostsByUser($userInfo['id']);
				$count = 0;
				$number = mysql_num_rows($addedPosts); 
				if($number > 0)
				{
				?> 
					<div id="insidePageTitleWithoutBorder">Posts by <?php echo $userInfo['firstname'];?></div>
					<div id="listAddedBy">
			    		<?php
			    		while ($row = mysql_fetch_array($addedPosts)) 
			    		{
			    		?>	<a href="postview.php?post_id=<?php echo $row['post'];?>">
			    			
			    			<?php echo $row['title'];?></a>
			    			<br />
			    		<?php
			        		$count++;
			        		if($count != $number)
			        		{
								?><div class="grayLine"></div><?php
			        			
			        		
			        		}
			        	}
			    		?> 
					</div> <?php
				} else {
				
					echo "<br/>No posts were made.";
				}
			
			?>

       </div>
		
		<div id="rightColumn">
			<?php include("layout/generalrightcolumn.php"); ?>
		</div>
		
        <div style="clear:both;"></div>
        
	</div>
</div>
</body>
</html>


