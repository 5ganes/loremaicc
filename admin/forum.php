<?php
include("init.php");
if(!isset($_SESSION['sessUserId']))//User authentication
{
 header("Location: login.php");
 exit();
}

if(isset($_POST['id']))
	$id = $_POST['id'];
elseif(isset($_GET['id']))
	$id = $_GET['id'];
else
	$id = 0;

$weight = $groups -> getLastWeightForum();

if($_GET['type'] == "edit")
{
	$result = $groups->getByIdForum($_GET['id']);
	$editRow = $conn->fetchArray($result);	
	extract($editRow);
}
if($_POST['type'] == "Save")
{
	extract($_POST);
	$vall="";
	//echo $contents; die();
	
	if(empty($contents))
		$errMsg .= "<li>Please Enter Post Detail</li>";
	
	if(empty($errMsg))
	{
		$userid=0;
		$pid = $groups -> saveForum($id, $contents, $userid, $publish, $weight);
		if($id > 0)
			$pid = $id;
		if($id>0)
			header("Location: forum.php?type=edit&id=$id&msg=Post details updated successfully");
		else
			header("Location: forum.php?msg=Post details saved successfully");
		exit();
	}		
}

if($_GET['type']=="del")
{
		$groups -> deleteForum($_GET['id']);
		//echo "hello";
		//header("Location : forum.php?&msg=Bill deleted successfully.");?>
    	<script> document.location='forum.php?&msg=Bill deleted successfully.' </script>    
<? }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo ADMIN_TITLE; ?></title>
<link href="../css/admin.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FF0000
}
-->
</style>
<script type="text/javascript" src="../js/cms.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>

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
                <td bgcolor="#fff"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    
                    <tr>
                      <td class="heading2">&nbsp; Manage Forum Post
                        <div style="float: right;">
                          <?
														$addNewLink = "forum.php";
													if(isset($_GET['category']) && !empty($_GET['category']))
														$addNewLink .= "?category=".$_GET['category'];
													?>
                          <a href="<?= $addNewLink?>" class="headLink">Add New</a></div></td>
                    </tr>
                    
                    <tr>
                      <td>
                      <form action="<?= $_REQUEST['uri']?>" method="post" enctype="multipart/form-data">
                      <table width="100%" border="0" cellpadding="2" cellspacing="0">
                          <?php if(!empty($errMsg)){ ?>
                          <tr align="left">
                            <td colspan="3" class="err_msg"><?php echo $errMsg; ?></td>
                          </tr>
                          <?php } ?>                          
                            <tr><td></td></tr>                           
                            
                            <tr>
                              <td>&nbsp;</td>
                              <td class="tahomabold11"><strong> Post Detail :</strong></td>
                              <td style="width:975px">
                                <textarea id="contents" name="contents"><?=$contents;?></textarea>
                                <script type="text/javascript">
                                  CKEDITOR.replace( 'contents');
                                </script>
                              </td>
                            </tr>
                            <tr><td></td></tr>                           
                            
                            <tr>
                              <td></td>
                              <td class="tahomabold11"><strong>Publish :</strong></td>
                              <td>
                              	<label>
                                  <input name="publish" type="radio" id="featured_0" value="No" checked="checked" />
         						  No</label>
                                <label>
                                  <input type="radio" name="publish" value="Yes" id="featured_1" <? if($publish == 'Yes') echo 'checked="checked"';?> />
                                  Yes</label>
                              </td>
                            </tr>
                            <tr><td></td></tr>      
                           
                            <tr>
                              <td></td>
                              <td class="tahomabold11"><strong>Weight :</strong></td>
                              <td><input name="weight" type="text" class="text" id="weight" value="<?php echo $weight; ?>" style="width:35px;" /></td>
                            </tr>
                            <tr><td></td></tr>
                            
                            <tr>
                              <td></td>
                              <td></td>
                              <td>
                              	<input name="type" type="submit" class="button" id="button" value="Save" />
                              	<?php if($_GET['type'] == "edit"){ ?>
                              	<input type="hidden" value="<?= $id?>" name="id" id="id" />
                                <?php }else{ ?>                                
                                <input name="reset" type="reset" class="button" id="button2" value="Clear" />
                                <?php } ?>
                                </td>
                            </tr>                        
                        </table>
                        </form></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr height="5"><td></td></tr>
        <tr>
          <td class="bgborder"><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="heading2">&nbsp;List of Posts</td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellpadding="4" cellspacing="0">
                          <tr bgcolor="#F1F1F1" class="tahomabold11">
                            <td width="1">&nbsp;</td>
                            <td style="width:25px"><strong>S.N.</strong></td>                           
                            <td style="width:150px"> Post</td>
                            <td style="width:70px;">Upload Date</td>
                            <td style="width:60px">Publish</td>
                            <td style="width:60px">Weight</td>
                            <td style="width:70px"><strong>Action</strong></td>
                          </tr>
                          <?php
							$counter = 0;
							$pagename = "forum.php?";
							$sql = "SELECT * FROM forum";
							$sql .= " ORDER BY weight";
							//echo $sql;
							$limit = 20;
							include("paging.php"); $i=0;
							while($row = $conn -> fetchArray($result))
							{?>
                          		<tr <?php if($counter%2 != 0) echo 'bgcolor="#F7F7F7"'; else echo 'bgcolor="#FFFFFF"'; ?>>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top"><?=++$i;?></td>                                    
                                    <td valign="top"><?= substr($row['contents'],0,25); ?>...</td>
                                  	<td valign="top"><?=$row['onDate'];?></td>
                                    <td valign="top"><?=$row['publish'];?></td>
                            		<td valign="top"><?= $row['weight'] ?></td>
                            		<td valign="top"> [ <a href="forum.php?type=edit&id=<?= $row['id']?>">Edit</a> | <a href="#" onClick="javascript: if(confirm('This will permanently remove this post info from database. Continue?')){ document.location='forum.php?type=del&id=<?php echo $row['id']; ?>'; }">Delete</a> ]</td>
                          </tr>
                          <?
													}
													?>
                        </table>
                      <?php include("paging_show.php"); ?></td>
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