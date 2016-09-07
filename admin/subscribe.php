<?php
include("init.php");
if(!isset($_SESSION['sessUserId']))//User authentication
{
 header("Location: login.php");
 exit();
}

$id=$_GET['id'];	
if($_GET['type']=="status")
{ 
	$cdetail = $enewsletters-> updateStatus($id);
	header("Location: subscribe.php?msg=Subscription status changed successfully");
	exit();
}
elseif($_GET['type']=="del")
{
	$enewsletters -> delete($id);
	header("Location: subscribe.php?msg=Subscription deleted successfully");
	exit();
}
elseif($_GET['type']=="show" )
{ 
	$cdetail = $enewsletters-> getById($id);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo ADMIN_TITLE; ?></title>
<link href="../css/admin.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
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
                      <td class="heading2">&nbsp;Subscriptions</td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellpadding="4" cellspacing="0">
                          <tr bgcolor="#F1F1F1" class="tahomabold11">
                            <td width="1">&nbsp;</td>
                            <td><strong>SN</strong></td>
                            <td><strong>Email</strong></td>
                            <td><strong>Status</strong></td>
                            <td><strong>Date</strong></td>
                            <td width="85"><strong>Action</strong></td>
                          </tr>
													<?php
													$counter = 0;
													$pagename = "subscribe.php?";
													$sql = "SELECT * FROM enewsletter ORDER BY id DESC, onDate Desc";
													$limit = 20;
													include("../includes/paging.php");
													while($row = $conn -> fetchArray($result))
													{
													?>
                          <tr <?php if($counter%2 != 0) echo 'bgcolor="#F7F7F7"'; else echo 'bgcolor="#FFFFFF"'; ?>>
                            <td valign="top">&nbsp;</td>
                            <td valign="top"><?= ++$counter; ?></td>
                            <td valign="top"><?= $row['email'] ?></td>
                            <td valign="top">
														<?php
														if($row['status']=="No")
														{
															echo "Inactive";
														?>
														<a href="subscribe.php?type=status&id=<?=$row['id']?>">[Enable]</a>
														<?php
														}
														else
														{
															echo "Active";
													 	?>
														<a href="subscribe.php?type=status&id=<?=$row['id']?>">[Disable]</a> 
														<?php
														}
														?>     
														&nbsp;</td>
                            <td valign="top">
														<?php 
														$arrDate = explode(' ',$row['onDate']); 
														$arrDate1 = explode('-',$arrDate[0]);
														echo date("M j, Y",mktime(0,0,0,$arrDate1[1],$arrDate1[2],$arrDate1[0]));
														?>														</td>
                            <td valign="top">
														[<a href="#" onClick="javascript: if(confirm('This will permanently delete Subscription details from database. Continue?')){ document.location='subscribe.php?type=del&id=<?php echo $row['id']; ?>'; }">Delete</a>]														</td>
                          </tr>
                          <?
													}
													?>
                        </table>
												<?php include("../includes/paging_show.php"); ?>
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