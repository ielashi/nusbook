<?php

	require_once("models/config.php");
	
	//Prevent the user visiting the logged in page if he/she is already logged in
	$url = "login.php?typemessage=errorMessage&message=ACCOUNT_LOGIN";
	$postInfo = fetchPostDetail($_GET['id']);
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
		<?php if($loggedInUser->isInGroup($postInfo['group_id'])) { ?>
        <div id="leftColumn">
            <div id="leftColumnHeader">
				<div id="pageTitleWithBorder">
					<?php echo $postInfo['title'];?>
				</div>            
			</div>
            <div id="leftColumnContent">
				<table id="generalTable" width="100%">
					<thead>
						<tr>
							<th><label>Poster: </label></th>
							<td><?php echo printFirstnameLastnameUserLink($postInfo['poster']);?></td>
							<th><label>Post Date: </label></th>
							<td><?php echo $postInfo['post_date'];?></td>
							<th><label>Response to:</label></th>
							<?php
							if ($postInfo['reply_to'] != NULL) {
								$reply_to = $postInfo['reply_to'];
							?>
							<td><a href="postview.php?id=<?php echo $reply_to; ?>">POST #<?php echo $reply_to; ?></a></td>
							<?php } else { ?>
							<td>NO ONE</td>
							<?php } ?>
						</tr>
						<tr>
							<td colspan=8><?php echo $postInfo['post'];?></td>
						</tr>
					</thead>
				</table>
            </div>
            
            <div id="pageTitleWithBorder">
            	Replies
            </div>  
            
            <div id="leftColumnContent">
			<?php $url = "postadd.php?id=".$postInfo['group_id']."&reply=".$postInfo['id'];?>
			<a href="<?php echo $url;?>"><img src="images/reply.png"/></a><br/><br/>
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
							<a href="postview.php?id=<?php echo $post[0]?>"><?php echo $post['title'] ?></a> - <?php echo $post['username'] ?>, <?php echo $post['post_date'] ?>
						</div>
						<div>
							<?php for ($i=0; $i<$indent; $i++) { echo ">"; } ?>
							<?php echo $post['post'] ?>
						</div>
					<?php 
					printThread($post[0], $indent+1);				
					}
				} else { ?>
					<br/><?php
				}
			}
			printThread($postInfo['id'], 1);
			?>
            </br><a href="<?php echo $url;?>"><img src="images/reply.png"/></a>
            </div>
        </div>

        <div id="rightColumn">
        	<?php include("layout/generalrightcolumn.php"); ?>
        </div>
        
        <div style="clear:both;">
        </div>
	</div>
	<?php } else { ?>
	You do not have permission to view this post.
	<?php } ?>
</div>

</body>
</html>


