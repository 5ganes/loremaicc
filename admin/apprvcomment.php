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
	//echo $id; die();
	$cdetail = $groups -> updateStatusComment($id);
	header("Location: apprvcomment.php?msg=Comment status changed successfully");
	exit();
}
elseif($_GET['type']=="del")
{
	$groups -> deleteComment($id);
	header("Location: apprvcomment.php?msg=Comment deleted successfully");
	exit();
}
elseif($_GET['type']=="show" )
{ 
	$cdetail = $groups -> getByIdComment($id);
	$cdetail = $conn->fetchArray($cdetail);
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
	<? if(isset($_GET['type']) && $_GET['type'] == "show")
	{ ?>
        <tr>
          <td class="bgborder"><table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tr>
              <td bgcolor="#FFFFFF">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="heading2">&nbsp;Comment Details</td>
                  </tr>
                  <tr>
                    <td><table width="100%" border="0" cellspacing="1" cellpadding="4">
                      	
                        <td><strong>Comment</strong> :</td>
						<td><?=$cdetail['comment'];?></td>
                        </td>

                      </tr>
                      
                      <tr><td><strong>Post Sender:</strong></td>
                        <td>
							<? $postuserid=$cdetail['userid'];
							$postuser=mysql_query("select name from usergroups where id='$postuserid'");
							$postusername=mysql_fetch_array($postuser); echo $postusername['name'];
							?>
                       	</td>
                      </tr>
                      <tr>

					<tr>
                   		<td><strong>Post Name</strong> :</td>
						<td>
							<? $postid=$cdetail['postid'];
							$post=mysql_query("select name,contents from forum where id='$postid'");
							$postname=mysql_fetch_array($post); echo $postname['name'];
							?>
                        </td>
					</tr>
                    
                 	<tr>
                    	<td width="10%" valign="top"><strong>Post Detail </strong>:</td>
                        <td valign="top">
							<?=$postname['contents'];?>
                      	</td>
                 	</tr>
                    
                    <tr>
                    	<td width="10%" valign="top"><strong>Comment Date </strong>:</td>
                        <td valign="top">
                        	<?php 
							$arrDate = explode(' ',$cdetail['onDate']); 
							$arrDate1 = explode('-',$arrDate[0]);
							echo date("M j, Y",mktime(0,0,0,$arrDate1[1],$arrDate1[2],$arrDate1[0]));
							?>
                      	</td>
                 	</tr>
                    
                    </table></td>

                  </tr>

              </table></td>

            </tr>

          </table></td>

        </tr>

        <tr>

          <td height="5"></td>

        </tr>

	<? }?>
            
    <tr>
      <td height="5"></td>
    </tr>

        <tr>

          <td class="bgborder"><table width="100%" border="0" cellspacing="1" cellpadding="0">

              <tr>

                <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                      <td class="heading2">&nbsp;Comment List</td>

                    </tr>

                    <tr>

                      <td><table width="100%"  border="0" cellpadding="4" cellspacing="0">

                          <tr bgcolor="#F1F1F1" class="tahomabold11">

                            <td width="1">&nbsp;</td>
                            <td><strong>SN</strong></td>
                            <td><strong>Comments</strong></td>
                            <td><strong>Post Title</strong></td>
                            <td><strong>Comment Sender</strong></td>
                            <td width="85"><strong>Status</strong></td>
                            <td width="70"><strong>Date</strong></td>
                            <td width="120"><strong>Action</strong></td>
                          </tr>
							<?php
                            $counter = 0;
                            $pagename = "apprvcomment.php?";
                            $sql = "SELECT * FROM comments ORDER BY id DESC, onDate Desc";
                            //echo $sql;
                            $limit = 20;
                            include("../includes/paging.php");
                            while($row = $conn -> fetchArray($result))
                            {
                            ?>
                          <tr <?php if($counter%2 != 0) echo 'bgcolor="#F7F7F7"'; else echo 'bgcolor="#FFFFFF"'; ?>>

                            <td valign="top">&nbsp;</td>
                            <td valign="top"><?= ++$counter; ?></td>
                            <td valign="top"><?= substr($row['comment'],0,30);?>...</td>
                            <td valign="top">
								<? $postid=$row['postid']; $post=mysql_query("select * from forum where id='$postid'");
								$postname=mysql_fetch_array($post); echo $postname['name']; ?>
                         	</td>
							<td valign="top">
								<? $senderid=$row['userid'];
								$sender=mysql_query("select * from usergroups where id='$senderid'");
								$username=mysql_fetch_array($sender); echo $username['name']; ?>
                         	</td>
                            <td valign="top">
								<?php
                                if($row['publish']=="No")
                                {
                                    echo "Inactive";
                                ?>
                                	<a href="apprvcomment.php?type=status&id=<?=$row['id']?>">[Enable]</a>
                                <?php
								}
								else
								{
									echo "Active";
								?>
									<a href="apprvcomment.php?type=status&id=<?=$row['id']?>">[Disable]</a> 
								<?php
								}
								?>     
								&nbsp;</td>
                            <td valign="top">
								<?php 
                                $arrDate = explode(' ',$row['onDate']); 
                                $arrDate1 = explode('-',$arrDate[0]);
                                echo date("M j, Y",mktime(0,0,0,$arrDate1[1],$arrDate1[2],$arrDate1[0]));
                                ?>
                          	</td>
                            <td valign="top">
                                [<a href="apprvcomment.php?type=show&id=<?php echo $row['id']; ?>">Details</a>]
                                [<a href="#" onClick="javascript: if(confirm('This will permanently delete comment details from database. Continue?')){ document.location='apprvcomment.php?type=del&id=<?php echo $row['id']; ?>'; }">Delete</a>]																
                        	</td>

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