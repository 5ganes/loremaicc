<? include("clientobjects.php"); ?>
<?
//user sign up
if(isset($_SESSION['sessFrontUsername']))
{
	header("location:forum.php");	
}
if(isset($_POST['register']))
{
	$regmsg="";
	extract($_POST);
	
	$email=trim($email);
	$mail=$users->getUserByEmail($email); $mailExists=$conn->numRows($mail);
	if($mailExists==1)
	{
		$regmsg="This email is already registered. Try another one";	
	}
	else
	{
		$users -> saveUser($name, $username, $password, $email, $address, $phone);
		$regmsg="You are successfully registered. Please login";
		//header("Location: userlogin.html?msg=You are successfully registered. Please login");
		//exit();
	}
}
//end user sign up

//user login
if(isset($_POST['login']))
{
	$loginmsg="";
	extract($_POST);
	$username=trim($username);
	$password=trim($password);
	
	$userExists=$users -> validateUser($username, $password);
	if($userExists)
	{
		header("Location: forum.php");
		exit();	
	}
	else
		$loginmsg="Login Failed. Please Try Again";
}
//end user login
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

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

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
        
        <!--user signup validation-->
        <script>
			function validateUser(fm)
			{
				if(fm.name.value=="")
				{
					alert("Please Enter Your Name"); fm.name.focus(); return false;
				}
				if(fm.username.value=="")
				{
					alert("Please Enter Username"); fm.username.focus(); return false;
				}
				if(fm.password.value=="")
				{
					alert("Please Enter Password"); fm.password.focus(); return false;
				}
				var goodEmail = fm.email.value.match(/\b(^(\S+@).+((\.com)|(\.net)|(\.edu)|(\.mil)|(\.gov)|(\.org)|(\..{2,3}))$)\b/gi);		
				if(fm.email.value=="")
				{
					alert("Please Enter Your Email"); fm.email.focus(); return false;
				}
				if (!goodEmail) {
					alert("The Email address you entered is invalid please try again!")
					fm.email.focus()
					return (false);
				}
			}
		</script>
        <style>
			.red{color:red;}
      		.forgot a{ color:#FB5200}
			.forgot a:hover{color:#00D500}
        </style>
        <!--user signup validation-->
        
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

        <!--user login and register content-->
		<div class="testimonials container" style="margin-top:12px; padding-bottom:0;">
    
            <div class="span6" style="margin-left:8px;border:1px solid; padding:3% 0">
                <div class="testimonials-title" style="margin-left:15%; text-align:left">
                    <h3 style="">Login Here</h3>
                </div>
                <div class="row">
                	<? if(!empty($loginmsg)){ echo '<div style="color:red; text-align:left; margin-left:15%">'.$loginmsg."</div>"; }?>
                    <div class="testimonial-list span6" style="margin-top:15px;">
                        <div class="tabbable tabs-below">
                            <div class="tab-content">
                                <div class="tab-pane active" id="A" style="margin:4% 0 0 15%">
                                    <form action="" method="post">
                                    	<p>Username : <input type="text" name="username" /></p>
                                        <p>Password : &nbsp;<input type="password" name="password" /></p>
                                        <p><input type="submit" name="login" value="Login" /></p>
                                    </form>
                                	<div class="forgot">
                                        [ <a href="forgotpswd.php">Forgot password ?</a> ]
                                    </div>
                                </div>
                                
                            </div>
                           
                       </div>
                    </div>
                </div>
            </div>
            
            <div class="span6" style="margin-left:8px;border:1px solid; padding:1% 0">
                <div class="testimonials-title" style="margin-left:15%; text-align:left">
                    <h3 style="">Sign Up Here</h3>
                </div>
                <div class="row">
                	<? if(!empty($regmsg)){ echo '<div style="color:red; text-align:left; margin-left:15%">'.$regmsg."</div>"; }?>
                    <div class="testimonial-list span6" style="margin-top:15px;">
                        <div class="tabbable tabs-below">
                            <div class="tab-content">
                                <div class="tab-pane active" id="A" style="margin:4% 0 0 10%">
                                    <form action="" method="post" onSubmit="return validateUser(this)">
                                    	<p>Name <span class="red">*</span> : <input style="margin-left:25px;" type="text" name="name" /></p>
                                        <p>Username <span class="red">*</span> : <input type="text" name="username" /></p>
                                        <p>Password <span class="red">*</span> : <input style="margin-left:3px;" type="password" name="password" /></p>
                                        <p>Email <span class="red">*</span> : <input style="margin-left:29px;" type="text" name="email" /></p>
                                        <p>Address : <input style="margin-left:23px;" type="text" name="address" /></p>
                                        <p>Phone : <input style="margin-left:33px;" type="text" name="phone" /></p>
                                        <p><input type="submit" name="register" value="Register" /></p>
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