<script language="javascript">
                function validateform(fm){
                    if(fm.txtname.value == ""){
                        alert("Please type your Name.");
                        fm.txtname.focus();
                        return false;
                    }	
                    var goodEmail = fm.txtemail.value.match(/\b(^(\S+@).+((\.com)|(\.net)|(\.edu)|(\.mil)|(\.gov)|(\.org)|(\..{2,3}))$)\b/gi);		
                    if(fm.txtemail.value == ""){
                        alert("Please type your E-mail.");
                        fm.txtemail.focus();
                        return false;
                    }
                    if (!goodEmail) {
                        alert("The Email address you entered is invalid please try again!")
                        fm.txtemail.focus()
                        return (false);
                    }			
                    if(fm.txtcomment.value == ""){
                        alert("Please type your Comment.");
                        fm.txtcomment.focus();
                        return false;
                    }
                    if(fm.security_code.value == ""){
                        alert("Please enter security code.");
                        fm.security_code.focus();
                        return false;
                    }
                    else if(fm.security_code.value.length < 6)
                    {
                        alert("Please enter valid length security code.");
                        fm.security_code.focus();
                        return false;
                    }
                }
                </script>
<style>
	.cmsFormTable input, .cmsFormTable textarea{ background:#ACE3AC; width:200px; border:1px solid #AB6A3F; height:17px; border-radius:4px; color:#000; 
	padding:2px 3px}
</style>

<?
	$pageResult = $groups->getById(CONTACT);
	$pageRow = $conn->fetchArray($pageResult);
?>

<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="span12">
                <i class="icon-flag page-title-icon"></i>
                <h2>Our Contact Information</h2>
            </div>
        </div>
    </div>
</div>

<!-- Conetnt Full Width Text -->
<div class="services-full-width container">
    <div class="row">
        <div class="services-full-width-text span12">
            <p>
            	<?=$pageRow['contents'];?>
          	</p>
            <p>
            	
                <div class="content" style="padding:0% 2%">
 					<div style="clear:both;">
                		<?php
                			if(!empty($feedbackmsg))
                    			$msg = $feedbackmsg;
                			else if(isset($_REQUEST['msg']))
								$msg = $_REQUEST['msg'];
                		?>
                
              			<div class="contentHdr" style=" margin-top:20px"><h2 style="margin-top:20px; font-size:20px;">Contact Form</h2></div>
    					<div style="padding-top:10px;">
                            <form name="frmFeedback" method="post" action="" onSubmit="return validateform(this);">
                                <table width="92%" border="0" cellspacing="0" cellpadding="2" class="cmsFormTable">      
                                        <?php if(!empty($msg)){ ?>
                                        <tr>
                                    <td colspan="2"><span class="cmsFormSubmitMsg" style="color:red;"><?php echo $msg; ?>...</span></td>
                                  </tr>
                                  <tr><td></td></tr>
                                        <?php } ?>
                                  <tr>
                                    <th width="10%" align="left" valign="top">Name : <span class="cmsAstriks">*</span></th>
                                    <td width="73%"><input type="text" class="cmsTxtField" name="txtname" value="<?php echo $txtname; ?>" /></td>
                                  </tr>
                                  <tr><td></td></tr>
                                  <tr>
                                    <th align="left" valign="top">Address :</th>
                                    <td><input type="text" class="cmsTxtField" name="txtaddress" value="<?php echo $txtaddress; ?>" /></td>
                                  </tr>
                                  <tr><td></td></tr>
                                  <tr>
                                    <th align="left" valign="top">E-mail : <span class="cmsAstriks">*</span></th>
                                    <td><input type="text" class="cmsTxtField" name="txtemail" value="<?php echo $txtemail; ?>" /></td>
                                  </tr>
                                  <tr><td></td></tr>
                                  <tr>
                                    <th align="left" valign="top">Country :</th>
                                    <td><input type="text" class="cmsTxtField" name="txtcountry" value="<?php echo $txtcountry; ?>" /></td>
                                  </tr>
                                  <tr><td></td></tr>
                                  <tr>
                                    <th valign="top" align="left">Comment : <span class="cmsAstriks">*</span></th>
                                    <td>
                                    	<textarea style="width:55%; height:60px" class="cmsTxtArea" name="txtcomment"><?php echo $txtcomment; ?></textarea>
                                  	</td>
                                  </tr>
                                  <tr><td></td></tr>
                                  <tr>
                                    <th align="left">Security Code : <span class="cmsAstriks">*</span></th>
                                    <td>
                                    	<img src="includes/captcha.php?width=110&height=40&characters=6" id="captchaimage" style="margin-bottom:3px;" />
                                        &nbsp;
                                        <a href="javascript: void(0);" onclick="document.getElementById('captchaimage').src = 
                                        'includes/captcha.php?width=110&height=40&characters=6&' + Math.random(); return false;" class="captchaReload" style="
                                        position:relative; top:0px; color:red">[ Reload Image ]</a></td>
                                  </tr>
                                  <tr><td></td></tr>
                                  <tr>
                                    <th></th>
                                    <td><input id="security_code" name="security_code" type="text" maxlength="6" class="securitycode cmsTxtField" /></td>
                                  </tr>
                                  <tr><td></td></tr>
                                  <tr>
                                    <th></th>
                                    <td><input name="btnFeedback" type="submit" value="Submit" class="cmsFormBtn cmsBtn" style="background:#2D842D;
                                border: 2px solid #320A11;
                                border-radius: 4px;
                                color: #FFFFFF;
                                cursor: pointer;
                                font-weight: bold;
                                height: 25px; width:90px;" /></td>
                                  </tr>
                                  <tr>
                                    <th>&nbsp;</th>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="2"><span class="cmsFormNotes" style="color:#910000;">[ Fields marked with <span class="cmsAstriks">*</span> are compulsory fields ]</span></td>
                                    </tr>
                                </table>
                        	</form>
    					</div>
  						<!-- feedback ends -->
  						<div class="CB"></div>
        			</div>
				</div>
            </p>
      	</div>
  	</div>
</div>