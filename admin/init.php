<?php
session_start();
ini_set("register_globals", "off");

// ini_set("upload_max_filesize", "20M");
// ini_set("post_max_size", "40M");
// ini_set("memory_limit", "80M");

ini_set('upload_max_filesize', '100M');
ini_set('post_max_size', '100M');
ini_set('max_input_time', 1000);
ini_set('max_execution_time', 1000);

require_once("../data/conn.php");
require_once("../data/users.php");
require_once("../data/groups.php");
require_once("../data/listingfiles.php");
require_once("../data/enewsletters.php");
require_once("../data/testimonials.php");
require_once("../data/feedbacks.php");
require_once("../data/categories.php");
require_once("../data/diary.php");
require_once("../data/magazine.php");

$conn 					= new Dbconn();		
$users	 				= new Users();	
$groups					= new Groups();
$listingFiles		= new ListingFiles();
$enewsletters			= new Enewsletters();
$testimonials		= new Testimonials();
$feedbacks			= new Feedbacks();
$categories			= new Categories();
$diary				= new Diary();
$magazine			= new Magazine();

define (ADMIN_GALLERY_LIMIT,20);


require_once("../data/constants.php");
require_once("../data/sqlinjection.php");
require_once("../data/youtubeimagegrabber.php");
?>