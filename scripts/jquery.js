$(document).ready(function() {
	$("#uploadify").uploadify({
		'uploader'       : 'scripts/uploadify.swf',
		'script'         : 'scripts/uploadify.php',
		'cancelImg'      : 'Images/cancel.png',
		'folder'         : 'uploads',
		'multi'          : false,
'onAllComplete' : function(event, data) {

},
'onComplete': function(event, queueID, fileObj, response, data) {   

	
	$test = "pictures/profilpictureupload.php/?fileName=" + fileObj.name;
	window.location.replace($test);
       
  //$("#gallery_fileInputUploader").hide(); //Use these to hide browse button after upload (can set a limit to reach as well)
  //$("#gallery_upUploader").hide(); //Use these to hide upload button after upload (can set a limit to reach as well)
}
});
});


$(document).ready(function() {
	$("#uploadifyRestaurant").uploadify
	({
		'uploader'       : 'scripts/uploadify.swf',
		'script'         : 'scripts/uploadify.php',
		'cancelImg'      : 'Images/cancel.png',
		'folder'         : 'uploads',
		'multi'          : false,
		'onAllComplete'  : function(event, data) 
		{ },
		'onComplete': function(event, queueID, fileObj, response, data) 
		{   
			$test = "pictures/restaurantpictureupload.php/?fileName=" + fileObj.name;
			window.location.replace($test);    
  //$("#gallery_fileInputUploader").hide(); //Use these to hide browse button after upload (can set a limit to reach as well)
  //$("#gallery_upUploader").hide(); //Use these to hide upload button after upload (can set a limit to reach as well)
		}
	});
});
        
                    	
$(document).ready(function() {

	$("#showPasswordForm").click(function () 
	{			
		$("#changePasswordForm").show("slow");
		$("#showPasswordForm").hide();
    					
	});
});	


$(document).ready(function() {

	$("#showAddQuoteAdminForm").click(function () 
	{			
		$("#addQuoteFormAdmin").show("slow");
		$("#showAddQuoteAdminForm").hide();
    					
	});
});	


$(document).ready(function() {

	$("#showAddNewsAdminForm").click(function () 
	{			
		$("#addNewsFormAdmin").show("slow");
		$("#showAddNewsAdminForm").hide();
    					
	});
});	


$(document).ready(function() {

	$("#showAddUserAdminForm").click(function () 
	{			
		$("#addUserFormAdmin").show("slow");
		$("#showAddUserAdminForm").hide();
    					
	});
});	



$(document).ready(function() {

	$("#showDelete").click(function () 
	{			
		$("#deleteForm").show("slow");
		$("#showDelete").hide();
    					
	});
});	