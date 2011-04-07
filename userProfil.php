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
                   <img src="images/information.png" alt="restaurants" />
            </div>
               
			<div id="leftColumnContent">
	            <div style="border-bottom:1px solid black;">
						<form action="models/processing-forms/processing.user.index.php" method="post">
						<?php $userInfo = fetchUserDetails($loggedInUser->username);?>
					<input type="hidden" name="action" value="edit">
		        	<table id="generalTable" width="100%">
		        		<thead>
		            		<tr class="odd">
		            			<th width="30%"><label>Name: </label></th>
		            				<td>
		     						<input type="text" name="name" value='<?php echo $loggedInUser->firstname;?> <?php echo $loggedInUser->lastname;?>' readonly="readonly">
		            				</td>
		            		</tr>
		        		
		        			<tr class="odd">
		        				<th><label>Country: </label></th>
		        				<td><input type="text" name="country" value='<?php echo $userInfo['country'];?>'><br /> </td>
		        			</tr>
		        			<tr >
		        				<th><label>Sex: </label></th>
		        					<td><input type="text" name="sex" value='<?php echo $userInfo['sex'];?>' readonly="readonly"><br /> </td>
		        			</tr>
							<tr class="odd">
								<th><label>Email: </label></th>
								<td><input type="text" name="email" value='<?php echo $userInfo['email'];?>'><br /> </td>
							</tr>
		        		</thead>
		        	</table>
					<input type="image" value="submit" src="images/save.png"/><br /><br />
					</form>
	   			</div>
           	</div>
           
           
           <div id="leftColumnHeader">
               <img src="images/profilpicturemain.png" alt="restaurants" />
           </div>
           <div id="leftColumnContent">
			 <table>
				<tbody>
	         		<tr>
	         			<td><label>Current Picture:</label></td>
	         			</tr>
	         		<tr>
	         			<td id="tdContentTable">
	         				<img src="<?php echo retrieveProfilPicture($loggedInUser->user_id);?>" alt="profilePicture">
	         				</td>
	         		</tr>
	         		
	         		
	         		<tr>
	         			<td><label>New Picture:</label></td>
	         		</tr>
	         		<tr>
	
	        			<td id="tdContentTable">
	        			<a style="border:0;" href="javascript:jQuery('#uploadify').uploadifyUpload()">
	        				<img src="images/upload.png"/>
	        			</a>
	        			<input type="file" name="uploadify" id="uploadify" />
	        			</td>
	        		</tr>
				</tbody>
			</table>
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


