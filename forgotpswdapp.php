<?
	include("clientobjects.php");
	
	//reset password submit
	if(isset($_POST['forgot']))
	{
		$msg=""; //echo "hi"; die();
		extract($_POST);
		$email=trim($email);
		
		$user=$users->getUserByEmail($email);
		$userCount=$conn->numRows($user); //echo $userCount; die();
		if($userCount==0)
		{
			$msg="Sorry! No user exists with this email";	
		}
		else
		{
			$headers  = "";
			$headers .= "MIME-Version: 1.0 \r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";
			$headers .= "X-Priority: 1\r\n";
			$headers .= "From: "."aicc.gov.np";
		
			$arrTo=$email;
			$subject = "Password As Requested:";
			$message='<h3>'.$subject.'</h3>';
			
			$userGet=$conn->fetchArray($user); $name=$userGet['name']; 
			$username=$userGet['username']; $password=$userGet['password'];
			$message=$message.'<div>Dear '.$name.', Your account at <a href="www.aicc.gov.np">aicc.gov.np</a> has sent your 
			username and paassword on your request. The password as requested by you is as follows:</div>';
			$message=$message.'<h5>Username: <span style="color:red">'.$username.'</span></h5>';
			$message=$message.'<h5>Password: <span style="color:red">'.$password.'</span></h5>';
			$message=$message.'You can change your password after you login to your <a href="www.aicc.gov.np">aicc.gov.np</a> 
			account.';
			$message=$message.'<div><strong>Thank you</strong></div>';
			
			if(mail($arrTo, $subject, $message, $headers))
			{
				$msg='<h4>Your password has been sent successfully. Please check your email address.</h4>';
				$msg=$msg.'If you do not receive email within a minute or two, check your emails spam, or try resending 
				your request.';
			}	
		}
		//echo $oldpswd." ".$newpswd." ".$confirmpswd." ".$_SESSION['sessFrontUserId']." ".$usr['username']; die(); 
		
	}
	//reset password submit
	
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
				var goodEmail = fm.email.value.match(/\b(^(\S+@).+((\.com)|(\.net)|(\.edu)|(\.mil)|(\.gov)|(\.org)|(\..{2,3}))$)\b/gi);		
			if(fm.email.value=="")
				{
					document.getElementById("email").style.color="red";
					document.getElementById("email").innerHTML="Please Enter Your email"; 
					fm.email.focus(); return false;
				}
			if (!goodEmail)
			{
				document.getElementById("email").style.color="red";
				document.getElementById("email").innerHTML="Email address is invalid"; 
				fm.email.focus(); return false;
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
   
        <!-- Change Password Full Width Text -->
        <div class="testimonials container" style="margin-top:12px; padding-bottom:0;">
    
            <div class="span8" style="margin-left:8px;border:1px solid; padding:3% 0">
                <div class="testimonials-title" style="margin-left:15%; text-align:left">
                    <h3 style="">Did you forget your password?</h3>
                    <h5>Enter your email to reset your password</h5>
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
                                        	Email Address : <input type="text" name="email" style="margin-left:9px" />
                                        	<span id="email"></span>
                                        </p>
                                        <p><input type="submit" name="forgot" value="Submit" /></p>
                                    </form>
                                    <div>
                                    	Your password will be sent to your email address
                                    </div>
                                    <div class="forgot">
                                        [ <a href="forgotpswdapp.php">Forgot password ?</a> ]
                                    </div>
                                	
                                </div>
                                
                            </div>
                           
                       </div>
                    </div>
                </div>
            </div>
            
        </div>

    </body>

</html>