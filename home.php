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
                <img src="images/welcome.jpg" alt="welcome" />
            </div>
            <div id="leftColumnContent">
            	<p>nUs Book is a discussion tool that allows users to post their thoughts and ideas regarding different topics.</p>
            	<p>There are various different categories, each containing related group topics.</p>
            	<p>Users can join groups and add posts, or create a new group!</p>
            	<p>Start by searching for interesting  <a href="groups.php">groups</a></p>
            	<p>Or find other registered <a href ="people.php">users</a></p>   
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


