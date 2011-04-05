<?php

	require_once("models/config.php");
	
	//If the user is already logged in, no need to go back to the login page.
	if(isUserLoggedIn()) { header("Location: account.php"); die(); }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>nUs BooK - Register.</title>
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
			
            <h1>Registration</h1>

			<?php
			if(isset($_GET["message"]))
			{
				?>
				<div id="messageBlockDisplay">
					<div id="<?php echo ($_GET["typemessage"]); ?>">
						<?php echo (lang($_GET["message"])); ?>
					</div>    
				</div>
				<?php
			}
			?>

            <div id="regbox">
                <form name="newUser" action="models/processing-forms/processing.user.index.php" method="post">

				<input type="hidden" name="action" value="register">
                
                <p>
                    <label>Firstname:</label>
                    <input type="text" name="firstname" />
                </p>
                
                <p>
                    <label>Lastname:</label>
                    <input type="text" name="lastname" />
                </p>
                
                <p>
                    <label>Username:</label>
                    <input type="text" name="username" />
                </p>
                
                <p>
                    <label>Password:</label>
                    <input type="password" name="password" />
                </p>
                
                <p>
                    <label>Confirm Password:</label>
                    <input type="password" name="passwordc" />
                </p>
                
                <p>
                	<label>Country:</label>
                	<?php include("layout/country_select.php"); ?>                	
                </p>
                
                <p>
                	<label>I am: </label>
                	<select name="sex">
						<option value="Male">- Select Sex -</option>
                		<option value="Male">Male</option>
                		<option value="Female">Female</option>
                	</select>
                </p>

                <!--<p>
                	<label>Birthday:</label>
					<?php include("layout/birthday_select.php"); ?>                	
                </p>-->
                
                <p>
                    <label>Email:</label>
                    <input type="text" name="email" />
                </p>
                
                <p>
                    <label>&nbsp;</label>
                    <input type="submit" value="Register"/>
                </p>
                
                </form>
            </div>

			<div class="clear"></div>
	 	</div>
	</div>
</div>
</body>
</html>


