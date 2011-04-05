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
		<title>.nUs BooK | Groups</title>
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
        <?php
        if(isset($_GET["message"]))
        {
        	?>
        	<div id="messageBlockDisplay">
        		<div id="<?php echo ($_GET["typemessage"]); ?>">
        			<?php echo (lang($_GET["message"])); ?>
        		</div>    
        		<br/>
        	</div>
        	<?php
        }
        ?>
            <div id="leftColumnHeader">
                <img src="images/groups.jpg" alt="welcome" />
            </div>
            <div id="leftColumnContent">
	            <p>
	            	A group on nUs BooK is assigned a main category upon its creation. TEXXXT if possible on more things about the groups etc.
	            </p>
	            <div style="padding-top:15px;">

              		<form method="get" action="groupsview.php" >
            			<label style="padding-right:67px;">By Title:</label>
            			<input style="width: 200px" type="text" id="findGroupByTitleAutoSuggest" value="" />
            			<input type="hidden" name="id" id="id" /> 
                    	<input type="submit" value="View" class="submit" />
            		</form>
            	</div>                  
            
            	<script type="text/javascript">
            		var findByTitle = {
            		script:"autosuggestgroupbytitle.php?json=true&limit=6&",
            		varname:"input",
            		json:true,
            		shownoresults:true,
            		maxresults:6,
            		callback: function (obj) { document.getElementById('id').value = obj.id;}
            		};
            	
               	var as_json = new bsn.AutoSuggest('findGroupByTitleAutoSuggest', findByTitle);
                </script>
               
             <br /><div id="pageTitleWithBorder"></div><br />       
			<form method="get" action="groups.php">

			By general category:
	            <select name="category_id">
	            <?php 
	            	$categories = getAllGroupCategories();					
	            		while($category = mysql_fetch_array($categories))
	            	{
	            	?>
	               <option <?php if(isset($_GET["category_id"]) && $_GET["category_id"] == $category['id']) { echo "selected=\"selected\""; }?> value="<?php echo $category['id'];?>"><?php echo $category['name']; ?></option>
	            <?php } ?>
	            </select>
				<input type="submit" value="Search" value="submit" />
				<span style="float:right;padding-top:4px;padding-right:2px;"><a href="groupsadd.php"><img src="images/add.png"></a></span>
            </form>
            
            <table id="generalTable" width="100%">
            	<thead>
            		<tr class="odd">
            			<th width="30%"><label>Title</label></th>
						<th width="60%"><label>Description</label></th>
						<!--<th width="30%"><label>Lastest Post</label></th>-->
						<th width="10%"><label>Actions</label></th>
            		</tr>
            	</thead>
            	<tbody>
	            	<?php
	  				
	              	if(isset($_GET["category_id"]))
	            	{	            	
	            		$categoryGroups = fetchAllGroupsBelongingToCategory($_GET["category_id"]);
	            		$count = mysql_num_rows($categoryGroups); 
	            		if($count > 0)
	            		{
		            		while($group = mysql_fetch_array($categoryGroups))
		            		{
		            		?>
		            			<tr>
		            				<td><?php echo $group['title'];?></td>
		            				<td><?php echo $group['info'];?></td>
		            				<!--<td><?php echo printMostRecentPostOfGroup($group['id']);?></td>-->
		            				<td><a href="groupsview.php?id=<?php echo $group['id'];?>">View</a><br />
		            				<?php if($loggedInUser->isInGroup($group['id'])) { ?>
		            				<br/> <a href="postadd.php?id=<?php echo $group['id'];?>">Post</a>
		            				<?php } else { ?>
									<br/> <a href="models/processing-forms/processing.groups.php?id=<?php echo $group['id'];?>&action=join">Join</a>
		            				<?php } ?>
		            				</td>
		            			</tr>
		            		<?php
		            		}
	            		}
	            		else
	            		{
	            		?>
		            		<tr>
		            			<td colspan="3">
		            				No Groups found in that category!
		            			</td>
		            		</tr>
	            		<?php 
	            		}		
	            		
	            	}
	            	else
	            	{
	            	?>
	            		<tr>
	            			<td colspan="3">
	            				Select a category from above and press "Search"
	            			</td>
	            		</tr>
	            	<?php
	            	}
	            	?>
            	</tbody>
            </table>
			</div>
            
            <span style="float:right;padding-right:2px;"><a href="groupsadd.php"><img src="images/add.png"></a></span>
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


