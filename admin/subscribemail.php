<?php
include("init.php");
if(!isset($_SESSION['sessUserId']))//User authentication
{
	session_destroy();
 header("Location: login.php");
 exit();
}

$weight = $groups -> getLastWeightEmail();
if(isset($_POST['id']))
	$id = $_POST['id'];
elseif(isset($_GET['id']))
	$id = $_GET['id'];
else
	$id = 0;

//$set = "no";
//$type = "free";
//$time = "0";

$editable = true;

	
if(isset($_POST['btnSubmit']))
{
	extract($_POST);
	
	if(empty($subject))
		$err = "<li>Please enter Email Subject</li>";
	if(empty($contents))
		$err = $err."<li>Please enter Email Content</li>";
	
	if(empty($err))
	{		
		$groups -> saveEmail($id, $subject, $contents, $weight);
		header("Location: subscribemail.php?msg=Email details added successfully");
		exit();
	}
}
elseif ($_GET['type'] == "del")
{
	//$editable = $categories -> isEditable($_GET['delete']);
	
	$groups->delete($_GET['id']);
	header("Location: subscribemail.php?msg=Email details deleted successfully");
	
}
elseif($_GET['type'] == "edit")
{
	//echo "die"; die();
	$row = $groups -> getById($_GET['id']);
	$row=$conn->fetchArray($row);
	extract($row);	
	
	//$editable = $categories -> isEditable($id);
}

if($_GET['type']=="sendmail")
{
	$id=$_GET['id'];
	$mailContent=$groups->getById($id);
	$mailContent=$conn->fetchArray($mailContent);
	//echo $mailContent['subject']; die();
	
	//mail headers and all that
	$headers  = "";
	$headers .= "MIME-Version: 1.0 \r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";
	$headers .= "X-Priority: 1\r\n";
	$headers .= "From: "."AICC";
	
	$email=$enewsletters->getAll();
	while($emailList=$conn->fetchArray($email))
	{
		$arrTo = $emailList['email'];
		$subject = $mailContent['subject'];
		$msg = $mailContent['contents'];
		mail($arrTo, $subject, $msg, $headers); //echo $subject; die();
		header("Location: subscribemail.php?msg=Email Sent successfully");	
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo ADMIN_TITLE; ?></title>
<link href="../css/admin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
  $("input[name='set']").change(function(e){
		if($("input:radio[name='set']:checked").val() == "yes")
			$("#setParameters").show();
		else
			$("#setParameters").hide();
	});
});
</script>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

</head>
<body>
<table width="<?php echo ADMIN_PAGE_WIDTH; ?>" border="0" align="center" cellpadding="0"
	cellspacing="5" bgcolor="#FFFFFF">
  <tr>
    <td colspan="2"><?php include("header.php"); ?></td>
  </tr>
  <tr>
    <td width="<?php echo ADMIN_LEFT_WIDTH; ?>" valign="top"><?php include("leftnav.php"); ?></td>
    <td width="<?php echo ADMIN_BODY_WIDTH; ?>" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
       <tr>
          <td class="bgborder"><table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tr>
              <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="heading2">Manage Group Mail</td>
                  </tr>
                  <tr>
                    <td>
                    <form name="frmCategory" method="post" action="">
                    <table width="100%" border="0" cellspacing="0" cellpadding="2"> 
                    	<?php if(!empty($err)){ ?>
                      <tr>
                        <td colspan="2" class="err_msg"><?php echo $err; ?></td>
                      </tr>
                      <?php } ?>                   	
                      <tr>
                     	<td width="15%"><strong>Email Subject :</strong></td>
						<td><input type="tel" name="subject" value="<?php echo $subject; ?>" class="text" /></td>
                      </tr>
                      
                      <tr>
                     	<td width="15%"><strong>Email Content :</strong></td>
						          <td>
                        <textarea id="contents" name="contents"><?=$contents;?></textarea>
                        <script type="text/javascript">
                          CKEDITOR.replace( 'contents');
                        </script>
                      </td>
                      </tr>
                      
                      <tr>
                     	<td width="15%"><strong>Weight :</strong></td>
						<td><input type="tel" name="weight" value="<?php echo $weight?>" class="text" /></td>
                      </tr>
                      
                      <tr>
                        <td valign="top">&nbsp;</td>
                        <td valign="top">
                          <?php if(isset($_GET['action']) && $_GET['action'] == "edit"){ ?>
                          <input type="hidden" name="id" value="<?php echo $id; ?>" />
                          <?php }?>
                          <input type="submit" name="btnSubmit" value="Save" class="btn_submit" />
                          </td>
                      </tr>
                    </table>
                    </form>
                    </td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="5"></td>
        </tr>
        <tr>
          <td class="bgborder"><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="heading2">Group Mail Content</td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellpadding="4" cellspacing="0">
                          <tr bgcolor="#F1F1F1">
                            <td width="1">&nbsp;</td>
                            <td width="10%"><strong>SN</strong></td>
                            <td><strong>Email Subject</strong></td>
                            <td><strong>Weight</strong></td>
                            
                            <td width="165"><strong>Action</strong></td>
                          </tr>
						
                          <?php
							$counter = 0;
							$pagename = "subscribemail.php?";
							$sql = "SELECT * FROM groups where linkType='Email'";
							$sql .= " ORDER BY weight";
							//echo $sql;
							$limit = 20;
							include("paging.php"); $i=0;
							while($row = $conn -> fetchArray($result))
							{?>
                          		<tr <?php if($counter%2 != 0) echo 'bgcolor="#F7F7F7"'; else echo 'bgcolor="#FFFFFF"'; ?>>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top"><?=++$i;?></td>
                                    <td valign="top"><?= $row['subject'] ?></td>
                            		<td valign="top"><?= $row['weight'] ?></td>
                            	    
                            	    
                                    <td valign="top"> [ <a href="subscribemail.php?type=sendmail&id=<?=$row['id'];?>">Send Mail</a> | <a href="subscribemail.php?type=edit&id=<?= $row['id']?>">Edit</a> | <a href="#" onClick="javascript: if(confirm('This will permanently remove this Email info from database. Continue?')){ document.location='subscribemail.php?type=del&id=<?php echo $row['id']; ?>'; }">Delete</a> ]</td>
                          </tr>
                          
						  	<? }?>	
                            
                        </table>
                        </td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2"><?php include("footer.php"); ?></td>
  </tr>
</table>
</body>
</html>