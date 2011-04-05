<?php 
	require_once("models/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>nUs BooK - Welcome.</title>
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
        
            <h1>Welcome to the nUs Book Social Network.</h1>
            
            <p>This is a CS2102 class project done by:</p>
            <ul>
            	<li>Antoine Bisson</li>
            	<li>Islam El-Ashi</li>
            	<li>Erkka Tapio Mutanen</li>
            	<li>Ivan Yee-Hang Cheng</li>
            	<li>James Rossy</li>
            </ul>
            <p>Our assignment was to replicate a social network were users could sign in and manage their profiles. They can also create groups and join them, as well as adding entries in a specific group</p>
            
            <p>A default account is presently activated with the username "default" and with a password "password".</p>
            
            <p>As of now, there are no email validation required when someone signs up, but it could be done in the future if the project was extended.</p>
            
            <div class="clear"></div>
        </div>
   </div>
</div>
</body>
</html>


