<?php

	require_once("models/config.php");
	
	//Prevent the user visiting the logged in page if he/she is already logged in
	if(isUserLoggedIn()) { header("Location: home.php"); die(); }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>nUs BooK - Login.</title>
<?php include("models/includes.index.php"); ?>
</head>
<body>
<div id="wrapper">
	<div id="content">
        <div id="left-nav">
        <?php include("layout/left_nav_index.php"); ?>
            <div class="clear"></div>
        </div>
        
        <div id="main">
        
	        <h1>Login</h1>
	       
	       <?php
	       if(isset($_GET["message"]))
	       {
	       	?><br />
	       	<div id="messageBlockDisplay">
	       		<div id="<?php echo ($_GET["typemessage"]); ?>">
	       			<?php echo (lang($_GET["message"])); ?>
	       		</div>   
	       	</div>
	       	<?php
	       }
	       ?>
	       
        
	        <form name="newUser" action="models/processing-forms/processing.user.index.php" method="post">
					<input type="hidden" name="action" value="login">

	                <p>
	                    <label>Username:</label>
	                    <input type="text" name="username" />
	                </p>
	                
	                <p>
	                     <label>Password:&nbsp;</label>
	                     <input type="password" name="password" />
	                </p>
	                
	                <p>
	                    <label>&nbsp;</label>
	                    <input type="submit" value="Login" class="submit" />
	                </p>
	
	         </form>
                
            </div>
        </div>
        
            <div class="clear"></div>
        </div>
</div>
</body>
</html>


