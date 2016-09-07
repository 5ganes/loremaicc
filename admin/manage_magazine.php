<?php
include("init.php");
if(!isset($_SESSION['sessUserId']))//User authentication
{
 	header("Location: login.php");
 	exit();
}

if (isset($_POST['save']))
{
	  
 	if (isset($_POST['id']))
 	{
  		//edit contents
		$year=$_POST['year']; //echo $_POST['year']; die();
		
		$magazine->saveMagazine($_POST['id'], $_POST['name'], $_POST['year'], $_POST['month'], $_POST['contents'], $_POST['publish'], $_POST['weight']);
		
		$magazine -> saveFile($_POST['id']);
		
		$url = 	"magazine.php?groupType=". $_GET['groupType'] ."&id=". $_POST['id'];
		
		if(isset($_GET['page']))
			$url .= "&page=".$_GET['page'];

		header ("Location: " . $url ."&msg=Successfully updated!");
		exit();
	 	
 	}
	////////////////
	// ADD NEW //// /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	else //add new code goes here...
	{
		if(empty($_POST['name']))
			$msg = "Please enter Name";
		elseif($_POST['year'] == "select")
			$msg = "Please select Year";
	
 		if(empty($msg))
		{
			//echo $_FILES['file']['name']; die();
			$newId = $magazine->saveMagazine("", $_POST['name'], $_POST['year'], $_POST['month'], $_POST['contents'], $_POST['publish'], $_POST['weight']);		
			
			$magazine->saveFile($newId);
			
			if(empty($msg))
			{
				$url = 	"magazine.php?groupType=". $_GET['groupType'];
				if($showId)
					$url .= "&id=". $_POST['id'];
				if(isset($_GET['page']))
					$url .= "&page=".$_GET['page'];
		
				header ("Location: " . $url ."&msg=Successfully saved!");
				exit();
			}
		}
	}
 	
 	header ("Location: magazine.php?groupType=". $_GET['groupType'] ."&msg=" . $msg);	
 	exit();
}
else if (isset($_GET['id']) && isset($_GET['delete']))
{
 	//this will delete the group and all its belongings (image, files, etc)
 	$magazine->delete($_GET['id']);

 	$msg = "Successfully deleted!";
 	header ("Location: magazine.php?groupType=". $_GET['groupType'] ."&msg=" . $msg);
 	exit();
}
else if (isset($_GET['imageId']) && isset($_GET['deleteImage']))
{
 	$groups->delete($_GET['imageId']);
 	$msg = "Image deleted!";
 	header ("Location: cms.php?id=". $_GET['id'] ."&groupType=". $_GET['groupType'] ."&parentId=". $_GET['parentId'] ."&msg=" . $msg);
 	exit();
}
else if (isset($_GET['deleteListId']))
{
 	$groups->delete($_GET['deleteListId']);
 	$msg = "Listing deleted!";
 	header ("Location: cms.php?id=". $_GET['id'] ."&groupType=". $_GET['groupType'] ."&parentId=". $_GET['parentId'] ."&msg=" . $msg);
 	exit();
}
else if (isset($_GET['fileId']) && isset($_GET['deleteFile']))
{
 	$listingFiles->delete($_GET['fileId']);
 	$msg = "File deleted!";
 
 	$url = "cms.php?id=". $_GET['id'] ."&parentId=". $_GET['parentId'] ."&groupType=". $_GET['groupType']."&listId=" . $_GET['listId'];
	if(isset($_GET['page']))
		$url .= "&page=".$_GET['page'];
		
 	header ("Location: ". $url . "&msg=" . $msg);
 	exit();
}
elseif(isset($_GET['listId']) && isset($_GET['deleteImage']))
{
	$result = $groups -> getById($_GET['listId']);
	$row = $conn -> fetchArray($result);
	
	$groups -> updateImage($row['id'], "");
	@unlink("../". CMS_GROUPS_DIR . $row['filename']);
	
	$msg = "Image deleted!";
	
	$url = "cms.php?id=". $_GET['id'] ."&parentId=". $_GET['parentId'] ."&groupType=". $_GET['groupType'] ."&listId=". $_GET['listId'];
	if(isset($_GET['page']))
		$url .= "&page=".$_GET['page'];

 	header ("Location: ". $url ."&msg=" . $msg);
	exit();
}
elseif(isset($_GET['id']) && isset($_GET['deleteImage']))
{
	$result = $diary -> getById($_GET['id']);
	$row = $conn -> fetchArray($result);
	
	$diary->updateImage($row['id'], "");
	@unlink("../". CMS_DIARY_DIR . $row['image']);
	
	$msg = "Image deleted!";
	
	$url = "krishiobject.php?id=". $_GET['id'] ."&groupType=". $_GET['groupType'];
	if(isset($_GET['page']))
		$url .= "&page=".$_GET['page'];
	
 	header ("Location: ". $url ."&msg=" . $msg);
	exit();
}
else if (isset($_GET['videoId']) && isset($_GET['deleteVideo']))
{
 	$groups -> delete($_GET['videoId']);
 	$msg = "Video deleted!";
 	header ("Location: cms.php?id=". $_GET['id'] ."&groupType=". $_GET['groupType'] ."&parentId=". $_GET['parentId'] ."&msg=" . $msg);
 	exit();
}
?>
