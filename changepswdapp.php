<?
	include("clientobjects.php");
	if(!isset($_SESSION['sessFrontUsername']))
	{
		header("location:userloginapp.php");	
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
				header("Location: changepswdapp.php?msg=Password changed sucessfully!");
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
    	
        <!--Forum content-->
		
        <?
		if(isset($_GET['id']))
		{
			$id=$_GET['id'];
			$post=$groups->getByIdForum($id);
			$postGet=$conn->fetchArray($post);
		}?>
        <div class="page-title" style="text-align:center">
            <div class="container">
                <div class="row">
                    <div class="span9">
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
       

    </body>

</html>