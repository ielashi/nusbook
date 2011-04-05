<?php
	/* 
		Below is a very simple example of how to process a login request.
		Some simple validation (ideally more is needed).
	*/
		require_once("../models/config.php");
		require_once("simpleimage.php");


//Forms posted
if(!empty($_GET))
{
		$picture = trim($_GET["fileName"]);	
		
   		$imageProfilPicture = new simpleimage();
		$imageProfilPictureThumb = new simpleimage();

   		
   		$path = "/Applications/MAMP/htdocs/nusbook/uploads/".$picture;
		$pathProfilPicture = "/Applications/MAMP/htdocs/nusbook/uploads/profilpictures/full/".$picture;
		$pathProfilPictureThumbs = "/Applications/MAMP/htdocs/nusbook/uploads/profilpictures/thumbs/".$picture;


		//Profile Picture
   		$imageProfilPicture->load($path);
   		$imageProfilPicture->resizeToWidth(360,false);
   		$imageProfilPicture->save($pathProfilPicture);		
		
		//Profile Picture Thumbnails
		$imageProfilPictureThumb->load($path);
		$imageProfilPicture->resizeToWidth(80,true);
		$imageProfilPicture->save($pathProfilPictureThumbs);



		//Change the profil picture assigned to the profil in the DB
		$loggedInUser->changeProfilPicture($picture);
		
		
		//Clear the original picture
		$loggedInUser->clearOriginalPicture($picture);

		
		header("Location: ../../userprofil.php");
		die();
	}
?>