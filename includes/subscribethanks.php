<div class="services-full-width container">
    <div class="row">
        <div class="services-full-width-text span12">
            <p>
			<?php
			$email=$_POST['email']; //echo $email; die();
			if(!empty($email))
			{
				$old=mysql_fetch_array(mysql_query("select count(email) as cnt from enewsletter where email='$email'"));
				if($old['cnt']==0)
				{
					$sql="insert into enewsletter set email='$email', status='No', onDate=NOW()";
					$conn->exec($sql);
					
					$headers  = "";
					$headers .= "MIME-Version: 1.0 \r\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";
					$headers .= "X-Priority: 1\r\n";
					$headers .= "From: "."aicc.gov.np";
				
					$arrTo=$email;
					$subject = "Thank You for Subscription:";
					$msg="Thank You for Subscription. Stay Tuned for more updates.";
					if(@mail($arrTo, $subject, $msg, $headers))
					{
						$disp="Thank You for Subscription. Stay Tuned for more updates.";
					}
					else
					{
						$disp="Invalid Email. Please Re enter your email address.";
					}
				}
				else
					$disp="This email id is already registered. Please try another email id";
			}
			else
				$disp="Please enter your email address";
			
			echo $disp;
            ?>
            </p>
        </div>
    </div>
</div>