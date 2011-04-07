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
					<?php echo $groupInfo['title'];?>
				</div>            
			</div>
			
				<table id="generalTable" width="100%">
					<thead>
						<tr class="odd">
							<th width="30%"><label>Category: </label></th>
							<td><a href="groups.php?category_id=<?php echo $groupInfo['id'];?>"><?php echo $groupInfo['name'];?></a></td>
						</tr>
						<tr >
							<th><label>Description: </label></th>
							<td><?php echo $groupInfo['info'];?></td>
						</tr>
						<?php if($loggedInUser->isOwnerGroup($groupInfo['id']) == 1)
						{
						?>
						<tr >
							<th><label>Creator Actions: </label></th>
							<td><a href="groupsedit.php?id=<?php echo $groupInfo['id'];?>"><img src="images/edit.png"/></a>    <a href="models/processing-forms/processing.groups.php?id=<?php echo $groupInfo['id'];?>&action=delete"><img src="images/delete.png"/></a></td>
						</tr>
						<?php }?>
					</thead>
				</table>
            <br />
            
            <div id="pageTitleWithBorder">
            	Posts
            </div> 
            
            <div id="leftColumnContent">
            	<!--This gets all the posts of the group and by view the post, you can see its reply, and actually reply to it. THERE IS A CHECK THAT IS MADE RIGHT HERE.-->
            	
				<?php if($loggedInUser->isInGroup($groupInfo['id'])) { ?>
				<!-- YOU ARE IN THE GROUP. SHOW ME ALL THE POSTS OR IF NOT OWNER, YOU CAN UNJOIN.-->
					<?php if(!$loggedInUser->isOwnerGroup($groupInfo['id'])) {?>
						<a href="models/processing-forms/processing.groups.php?id=<?php echo $groupInfo['id'];?>&action=unjoin"><img style="float:right;" src="images/unjoin.png"/>
					<?php } ?>
					
					<a href="postadd.php?id=<?php echo $groupInfo['id'];?>"><img src="images/add.png"></a><br/><br/>
					<!--This is where all the posts of the group are displayed-->
					<?php
					function printThread($id, $indent) {
						$posts = fetchReplies($id);
						$count = mysql_num_rows($posts); 
						if($count > 0)
						{
							while ($post = mysql_fetch_array($posts))
							{?>
							<div>
								<?php for ($i=0; $i<$indent; $i++) { echo ">"; } ?>
								<a href="postview.php?id=<?php echo $post[0]?>"><?php echo $post['title'] ?></a> - <?php echo $post['username'] ?>, <?php echo $post['post_date'] ?> <a href="postadd.php?id=<?php echo $post['group_id'];?>&reply=<?php echo $post[0]?>"><img src="images/reply.png"></a>
							</div>
							<div>
								<?php for ($i=0; $i<$indent; $i++) { echo ">"; } ?>
								<?php echo $post['post'] ?>
							</div>
							<?php
							printThread($post[0], $indent+1);
							}
						}
					}
					
					$posts = fetchPostsOfGroup($groupInfo['id']);
					$count = mysql_num_rows($posts); 
					if($count > 0)
					{
						while ($post = mysql_fetch_array($posts))
						{?>
							<div>
								<a href="postview.php?id=<?php echo $post[0]?>"><?php echo $post['title'] ?></a> - <?php echo $post['username'] ?>, <?php echo $post['post_date'] ?> <a href="postadd.php?id=<?php echo $groupInfo['id'];?>&reply=<?php echo $post[0]?>"><img src="images/reply.png"></a>
							</div>
							<div>
								<?php echo $post['post'] ?>
							</div>
						<?php printThread($post[0], 1); ?>
						<br/><?php
						}
					}
					?>
						
				<a href="postadd.php?id=<?php echo $groupInfo['id'];?>"><img src="images/add.png"></a><br/>	
				<?php } else { ?>
				<br/><br />You are not part of this group. Please join it! <br /><a href="models/processing-forms/processing.groups.php?id=<?php echo $groupInfo['id'];?>&action=join"><img style="float:right;" src="images/join.png"/></a>
				<?php } ?>
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


