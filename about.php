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
                <img src="images/about.png" alt="welcome" />
            </div>
            <div id="leftColumnContent">
            	<p>nUs Book was created for academic purposes as the final project for CS2102: Database Systems. 
            	It's structure is inspired primarily by Yahoo Groups.
            	</p>
                <p>Creators: </p>
                	<ul>
                	<li> Antoine Bisson: A0079406Y </li>
					<li>Islam El-Ashi: A0079399A</li>
					<li>Ivan Cheng: A0075706B</li>
					<li>Erkka Mutanen: A0075815Y</li>
					<li>James Rossy: A0079482R</li>
                	</ul>
            </div>
        </div>

        <div id="rightColumn">
        	<?php include("layout/generalrightcolumn.php"); ?>
        </div>
        
        <div style="clear:both;">
        </div>
        
</div>
</body>
</html>


