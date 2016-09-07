<?
	include("clientobjects.php");
	if(!isset($_SESSION['sessFrontUsername']))
	{
		header("location:userloginapp.php");	
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
		
    </head>

    <body>
		
        <?
		if(isset($_GET['id']))
		{
			$id=$_GET['id'];
			$post=$groups->getByIdForum($id);
			$postGet=$conn->fetchArray($post);
		}?>
        <div class="page-title" style="padding-top:5px;">
            <div class="container">
                <div class="row">
                    <div class="span9" style="text-align:center">
                        <h3>
                        	[ Welcome <? echo $_SESSION['sessFrontUsername'];?>
                      		<a href="userlogoutapp.php">Logout</a> ]
                        </h3>
                        <h4>
                        	<a href="changepswdapp.php">Change Password</a>
                       	</h4>
                        <h4 style="margin-top:18px">
                        	<a href="forumapp.php?action=newpost" style="border:1px solid; padding:1px 10px">Add New Post</a>
                      	</h4>
                        
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
                    
                    <? if(isset($_GET['id']) or isset($_GET['action']))
					{?>
                    	<br /><h4>Other Posts</h4>
					<? }
					else
					{?>
						<h4 style="margin:5px">Forum Posts</h4>
					<? }?>
                    <ul class="list">
                    	<style> .list li a:hover{ text-decoration:underline}</style>
                        <?
                        $forum=$groups->getForumPosts();
                        while($forumGet=$conn->fetchArray($forum))
                        {?>
                            <li style="font-size:19px; margin:10px 0">
                            	<a href="forumapp.php?id=<?=$forumGet['id'];?>"><?=$forumGet['contents'];?></a>
                          	</li>
                        <? }?>
                    </ul>
                </div>
            </div>
        </div>
        
        <br />
        
    </body>

</html>