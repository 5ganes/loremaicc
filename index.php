<? include("clientobjects.php"); ?>
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
        
        <? include("analyticstracking.php");?>

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
        
        <!--Newsletter email validation-->
        <script language="javascript">
		function validateform(fm)
		{	
			var goodEmail = fm.email.value.match(/\b(^(\S+@).+((\.com)|(\.net)|(\.edu)|(\.mil)|(\.gov)|(\.org)|(\..{2,3}))$)\b/gi);		
			if(fm.email.value == "")
			{
				alert("Please type your E-mail.");
				fm.email.focus();
				return false;
			}
			if (!goodEmail)
			{
				alert("The Email address you entered is invalid please try again!")
				fm.email.focus()
				return false;
			}
		}
	</script>
        
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
		
        <div class="page-title" style="padding:8px 0 0 0">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <h5 style="margin:0">
                        	<marquee direction="left" onmouseover="this.stop();" onmouseout="this.start();">
								<? $hot=$groups->getById(HOT_NEWS); $hotGet=$conn->fetchArray($hot);?>
								<a style="font-size:17px" href="<?=$hotGet['urlname'];?>">
									<? echo $hotGet['shortcontents'];?>
                               	</a>
                         	</marquee>
                       	</h5>
                    </div>
                    
                </div>
            </div>
        </div>

        <!--main content dynamic part-->
		<?php 
			if(isset($_GET['action']))
			{
				$action = $_GET['action'];
				$action = str_replace(".","", $action);
				include("includes/".$action.".php");			
			}				
			else if(isset($pageLinkType))
			{
				if ($pageLinkType == ""){}
				else if ($pageLinkType == "Product"){ include("includes/showtrip.php"); }
				else if ($pageLinkType == "PackageRegion"){ include("includes/packageregion.php"); }
				else{ include("includes/cmspage.php"); }
			}
			else{ include("includes/main.php"); }
		?>
        
        
        <!-- Footer -->
        <!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="widget span3">
                        <? $about=$groups->getById(ABOUTAICC); $aboutGet=$conn->fetchArray($about); ?>
                        <h4><?=$aboutGet['name'];?></h4>
                        <p><?=$aboutGet['shortcontents'];?></p>
                        <p><a href="<?=$aboutGet['urlname'];?>">[ विस्तृत ]</a></p>
                    </div>
                    <div class="widget span3">
                        <h4>&#2350;&#2361;&#2340;&#2381;&#2357;&#2346;&#2370;&#2352;&#2381;&#2339; &#2354;&#2367;&#2344;&#2381;&#2325; &#2361;&#2352;&#2369;</h4>
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
                        <h4>&#2360;&#2366;&#2350;&#2366;&#2332;&#2367;&#2325; &#2360;&#2306;&#2332;&#2366;&#2354;</h4>
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
                    
                    <!--newsletter-->
                    <div class="copyright span4">
                        <p>
                        <form action="subscribethanks.html" method="post" class="input-group span4">
			     <input id="fieldEmail" name="email" class="form-control" type="email" placeholder="Email" required="">
			     <span class="input-group-btn">
			       <input class="btn btn-default" type="submit" name="submit" value="Subscribe" style="margin:-9px 0 0 0" />
			     </span>
			</form>
                        </p>
                    </div>
                    
                    <!--<audio controls><source src="audio.mp3" type="audio/mpeg"></audio>-->
                    <div class="social span4">
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