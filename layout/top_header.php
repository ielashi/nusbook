 <div class="autoCenterBlock">
 	<div id="headerMainBlock">
		<div id="headerLogo">
			<img src="Images/smallLogo.png" alt="Logo" />
		</div>        
        <div id="headerProfilMiniFrame" style="padding-right:0px;float:right;" >
        	<div id="headerProfilMiniContent">
            	<table>
	                <tr>
                		<td width="45%">
                			<img src="<?php echo retrieveProfilPictureThumb($loggedInUser->user_id);?>" alt="profilePictureThumb">
 		               	</td>
                		<td width="55%"> 
	                		<table>
								<th colspan="2">
									<?php echo $loggedInUser->firstname; ?>
								</th>		
								<tr>
									<td style="padding-top:8px;padding-bottom:5px;">
										<a href="userprofil.php"><img src="Images/cog.png" alt="Company Logo" /></a>
									</td>
									<td id="settingsDiv" style="padding-top:8px;padding-bottom:5px;">
										<a href="userprofil.php">Settings</a>
									</td> 
								</tr>		
							</table>
						</td>
	                </tr>
                </table>
             </div>
        </div>
	</div>   
</div>