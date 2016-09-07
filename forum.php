<?
	include("clientobjects.php");
	if(!isset($_SESSION['sessFrontUsername']))
	{
		header("location:userlogin.php");	
	}
	
	$msg="";
	if(isset($_POST['post']))
	{
		$comment=$_POST['comment'];
		$postid=$_POST['postid'];
		$userid=$_SESSION['sessFrontUserId'];
		$publish="No";
		$groups->saveComment($comment, $postid, $userid, $publish);	
		$msg="Successfully posted and pending for approval";
	}
	
	if(isset($_POST['ask']))
	{
		extract($_POST);
		$userid=$_SESSION['sessFrontUserId'];
		$publish="No";
		$id=0;
		$weight=$groups->getLastWeightForum();
		$groups->saveForum($id,$contents, $userid, $publish, $weight);	
		$msg="Successfully posted and pending for approval";
	}
	
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
                        <h4 style="margin:10px 0 0px 20px; font-size:16px;">
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
        
        <!-- Services Full Width Text -->
        <div class="services-full-width container">
            <div class="row">
                <div class="services-full-width-text span12">
                	
                    <?
					if(isset($_GET['id']))
					{?>
                    	<div>
                        	<p>
                            	<? if(!empty($msg)){?><h5 style="color:red"><?=$msg;?></h5><? }?>
								<?
                                $uid=$postGet['userId'];
								if($uid==0)
								{
									$poster="Admin";
								}
								else
								{
									$user=$users->getUserById($uid);
									$poster=$user['name'];
								}
								?>
								Post: <?=$postGet['contents'];?>
                                <? echo '<p style="color:red; margin:0; font-size:12px"><span style="color:#000">From: </span>'.$poster.'</p>';?>
                           	</p>
                            
                            <? //echo $postGet['id']; die();
							$com=$groups->getCommentByPost($postGet['id']);
							if(mysql_num_rows($com)>0)
							{?>
                            	<ul>
                               		<h5 style="text-decoration:underline">COMMENTS</h5>
                                	<?
									while($comGet=$conn->fetchArray($com))
									{?>
										<li>
                                           	</p>
                                            <p style="color:#F00; font-size:18px; width:80%">
												<?=$comGet['comment'];?>
                                           	</p>
                                            <p style="color:#00C; font-size:12px; margin-bottom:0">
                                            <?
                                            	$comntr=$users->getUserById($comGet['userid']);
												echo $comntr['name'].", ".$comGet['onDate'];
											?>
                                        </li>
									<? }
									?>
                                </ul>
                            <? }?>
                      		<br />
                            <h4>Post a Comment / <? echo $_SESSION['sessFrontName'];?></h4>
                            <form action="" method="post" style="margin-left:20px">
                            	Comment: <textarea name="comment" style="width:70%" rows="2"></textarea><br />
                                <input type="hidden" name="postid" value="<?=$_GET['id'];?>" /><br />
                            	<input type="submit" name="post" value="Post Comment" />
                            </form>
                        </div>	
                    <? }
					if(isset($_GET['action']))
					{?>
                    	<div>
                        	<p>
                            	<? if(!empty($msg)){?><h5 style="color:red"><?=$msg;?></h5><? }?>
                           	</p>
                            <h4>Add New Post / Ask Question</h4>
                            <form action="" method="post" style="margin-left:20px">
                                Post: <textarea name="contents" style="width:70%" rows="4"></textarea><br />
                            	<input type="submit" name="ask" value="Post" style="width:60px" />
                            </form>
                        </div>
                    <? }?>
                    
                    <? if(isset($_GET['id']) or isset($_GET['action'])){?><br /><h4>Other Posts</h4><? }?>
                    <ul class="list">
                    	<style> .list li a:hover{ text-decoration:underline}</style>
                        <?
                        $forum=$groups->getForumPosts();
                        while($forumGet=$conn->fetchArray($forum))
                        {?>
                            <li style="font-size:19px; list-style:none; margin:10px 0">
                            	<a href="forum.php/<?=$forumGet['id'];?>"><?=$forumGet['contents'];?></a>
                          	</li>
                        <? }?>
                    </ul>
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