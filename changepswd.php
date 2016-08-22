<?
	include("clientobjects.php");
	if(!isset($_SESSION['sessFrontUsername']))
	{
		header("location:userlogin.php");	
	}
	
	//change password submit
	if(isset($_POST['update']))
	{
		$msg="";
		extract($_POST);
		$oldpswd=trim($oldpswd);
		$newpswd=trim($newpswd);
		$confirmpswd=trim($confirmpswd);
		
		$usr=$users->getUserById($_SESSION['sessFrontUserId']);
		//echo $oldpswd." ".$newpswd." ".$confirmpswd." ".$_SESSION['sessFrontUserId']." ".$usr['username']; die(); 
		
		if($usr['password']!=$oldpswd)
		{
			$msg="Old password does not match";	
		}
		else if($newpswd!=$confirmpswd)
		{
			$msg="Password donot match";	
		}
		if(empty($msg))
		{		
			$result=$users -> updateUserPassword($_SESSION['sessFrontUserId'], $newpswd);
			if($result)
			{
				header("Location: changepswd.php?msg=Password changed sucessfully!");
				exit();	
			}
			else
				$msg="Password was not updated";
		}
	}
	//change password submit
	
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>Agriculture Information & Communucation Center</title>
        <? include("baselocation.php"); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/prettyPhoto/css/prettyPhoto.css">
        <link rel="stylesheet" href="assets/css/flexslider.css">
        <link rel="stylesheet" href="assets/css/font-awesome.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="images/title.ico">
		
        <!--css and jquery fils for dropdown menubar-->
        <link href="css/ddsmoothmenu.css" rel="stylesheet" type="text/css" media="screen" />
		<script src="js/slide.js"></script>
        <script src="js/slides.min.jquery.js"></script>
        <script type="text/javascript" src="js/ddsmoothmenu.js"></script>
   		
		<script type="text/javascript">
			ddsmoothmenu.init({
				mainmenuid: "smoothmenu1", //Menu DIV id
				orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
				classname: 'ddsmoothmenu', //class added to menu's outer DIV
				//customtheme: ["#804000", "#482400"],
				contentsource: "markup", //"markup" or ["container_id", "path_to_menu_file"]
				speed:5000
			})
		</script>
        <!--end of menubar jquery and css-->
        
        <!--change password validation-->
        <script>
			function validatePswd(fm)
			{
				if(fm.oldpswd.value=="")
				{
					document.getElementById("oldpswd").style.color="red";
					document.getElementById("oldpswd").innerHTML="Please Enter Old Password"; 
					fm.oldpswd.focus(); return false;
				}
				if(fm.newpswd.value=="")
				{
					document.getElementById("newpswd").style.color="red";
					document.getElementById("newpswd").innerHTML="Please Enter New Password";
					fm.newpswd.focus(); return false;
				}
				if(fm.confirmpswd.value=="")
				{
					document.getElementById("confirmpswd").style.color="red";
					document.getElementById("confirmpswd").innerHTML="Please Enter Confirm Password";
					fm.confirmpswd.focus(); return false;
				}
			}
		</script>
        <style>
			.red{color:red;}
      		.forgot a{ color:#FB5200}
			.forgot a:hover{color:#00D500}
			
        </style>
        <!--change password validation-->
        
    </head>

    <body>
    	<div id="fb-root"></div>
			<script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        	</script>

        <!-- Header -->
        <div class="container" style="width:100%">
            <div class="header row" style="width:100%">
                <div class="span12" style="width:100%">
                    <div class="navbar">
                        <div class="navbar-inner" style="background:#2d842d">
                            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </a>
                            <h1>
                                <a class="brand" href="index.php"><img src="assets/img/logo.png" style="width:100%" /></a>
                            </h1>
                            <div class="nav-collapse collapse">
                            	<div id="menu">
        							<div>
                            			<div id="smoothmenu1" class="ddsmoothmenu">
                                    		<? createMenu(0, "Header"); ?>
                               			</div>
                                 	</div>
                              	</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Forum content-->
		
        <?
		if(isset($_GET['id']))
		{
			$id=$_GET['id'];
			$post=$groups->getByIdForum($id);
			$postGet=$conn->fetchArray($post);
		}?>
        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="span9">
                        <i class="icon-flag page-title-icon"></i>
                        <h2>Forum Posts</h2>
                        <h4 style="margin:10px 0 -15px 20px; font-size:16px;">
                        	<a href="forum.php/add-new-post" style="border:1px solid; padding:1px 10px">Add New Post</a>
                      	</h4>
                    </div>
                    <div class="span3">
                        <h2 style="font-size:19px">
                        	[ Welcome <? echo $_SESSION['sessFrontUsername'];?>
                      		<a href="userlogout.php">Logout</a> ]
                        </h2>
                        <h4 style="margin:0px 0 0 10px; font-size:15px"><a href="changepswd.php">Change Password</a></h4>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Change Password Full Width Text -->
        <div class="testimonials container" style="margin-top:12px; padding-bottom:0;">
    
            <div class="span8" style="margin-left:8px;border:1px solid; padding:3% 0">
                <div class="testimonials-title" style="margin-left:15%; text-align:left">
                    <h3 style="">Change Your Password</h3>
                </div>
                <div class="row">
                	<?
                    	if(!empty($msg))
						{ 
							echo '<div style="color:red; text-align:left; margin-left:15%">'.$msg."</div>"; 
						}
						if(isset($_GET['msg']))
						{
							echo '<div style="color:red; text-align:left; margin-left:15%">'.$_GET['msg']."</div>";	
						}
					?>
                    <div class="testimonial-list span8" style="margin-top:15px;">
                        <div class="tabbable tabs-below">
                            <div class="tab-content">
                                <div class="tab-pane active" id="A" style="margin:4% 0 0 15%">
                                    <form action="" method="post" onSubmit="return validatePswd(this);">
                                    	<p>
                                        	Old Password : <input type="password" name="oldpswd" style="margin-left:9px" />
                                        	<span id="oldpswd"></span>
                                        </p>
                                        <p>
                                        	New Password : &nbsp;<input type="password" name="newpswd" />
                                      		<span id="newpswd"></span>
                                        </p>
                                        <p>
                                        	Confirm Password : &nbsp;<input type="password" name="confirmpswd" />
                                      		<span id="confirmpswd"></span>
                                        </p>
                                        <p><input type="submit" name="update" value="Update Password" /></p>
                                    </form>
                                	
                                </div>
                                
                            </div>
                           
                       </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <br />
        
        
        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="widget span3">
                        <? $about=$groups->getById(ABOUTAICC); $aboutGet=$conn->fetchArray($about); ?>
                        <h4><?=$aboutGet['name'];?></h4>
                        <p><?=substr($aboutGet['shortcontents'],0,280);?></p>
                        <p><a href="<?=$aboutGet['urlname'];?>">Read more...</a></p>
                    </div>
                    <div class="widget span3">
                        <h4>Important Links</h4>
						<style>
							.show-links ul{ margin:0; padding:0;}
							.show-links ul li{ margin:9px 5px; border-bottom:1px solid #cdcdcd; list-style:none}
							.show-links ul li:last-child{ border-bottom:none}
							.show-links ul li a{ color:#5d5d5d; font-size:14px}
							.show-links ul li a:hover{ color:#9d426b}
                      	</style>                       
                        <div class="show-links">
                        	<ul>
                            	<? $link=$groups->getByParentIdWithLimit(LINKS,6);
								while($linkGet=$conn->fetchArray($link))
								{?>
                                	<li><a href="<?=$linkGet['contents'];?>" target="_blank" title="<?=$linkGet['name'];?>"><?=$linkGet['name'];?></a></li>
                            	<? }?>
                            </ul>
                        </div>
                    </div>
                    <div class="widget span3">
                        <h4>Connect With Us</h4>
                        <div class="facebook">
                        	<div class="fb-like-box" data-href="https://www.facebook.com/helloaicc" data-width="250" data-height="220" data-colorscheme="light" data-show-faces=
                            "true" data-header="false" data-stream="false" data-show-border="true"></div>
                        </div>
                    </div>
                    <div class="widget span3">
                        <? $contact=$groups->getById(CONTACT); $contactGet=$conn->fetchArray($contact); ?>
                        <h4><?=$contactGet['name'];?></h4>
                        <?=$contactGet['shortcontents'];?>
                        
                    </div>
                </div>
                <div class="footer-border"></div>
                <div class="row">
                    <div class="copyright span4">
                        <p>Copyright 20<?=date("y");?>. Agriculture Information and Communication Centre - All rights reserved. Managed by: <span style="color:#9d426b">IT Section</span>.</p>
                    </div>
                    <!--<audio controls><source src="audio.mp3" type="audio/mpeg"></audio>-->
                    <div class="social span8">
                        <a class="facebook" target="_blank" href="https://www.facebook.com/helloaicc" title="Facebook Page"></a>
                        <a class="twitter" target="_blank" href="https://www.twitter.com/helloaicc" title="Twitter"></a>
                        <a class="googleplus" target="_blank" href="https://www.googleplus.com/helloaicc" title="Google Plus"></a>
                        <a class="youtube" target="_blank" href="https://www.youtube.com/helloaicc" title="Youtube Channel"></a>
                        <a class="skype" target="_blank" href="https://www.skype.com/helloaicc" title="Skype"></a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.8.2.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.flexslider.js"></script>
        <!--<script src="assets/js/jquery.tweet.js"></script>-->
        <!--<script src="assets/js/jflickrfeed.js"></script>-->
        <!--<script src="http://maps.google.com/maps/api/js?sensor=true"></script>-->
        <script src="assets/js/jquery.ui.map.min.js"></script>
        <script src="assets/js/jquery.quicksand.js"></script>
        <!--<script src="assets/prettyPhoto/js/jquery.prettyPhoto.js"></script>-->
        <script src="assets/js/scripts.js"></script>

    </body>

</html>