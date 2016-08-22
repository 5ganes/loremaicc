<? include("clientobjects.php"); ?>
<?
//user sign up
if(isset($_SESSION['sessFrontUsername']))
{
	header("location:forumapp.php");	
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
		header("Location: forumapp.php");
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
                                        [ <a href="forgotpswdapp.php">Forgot password ?</a> ]
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
                                    	<p>Name <span class="red">*</span> : <input type="text" name="name" /></p>
                                        <p>Username <span class="red">*</span> : <input type="text" name="username" /></p>
                                        <p>Password <span class="red">*</span> : <input type="password" name="password" /></p>
                                        <p>Email <span class="red">*</span> : <input type="text" name="email" /></p>
                                        <p>Address : <input type="text" name="address" /></p>
                                        <p>Phone : <input type="text" name="phone" /></p>
                                        <p><input type="submit" name="register" value="Register" /></p>
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