<?php
include("init.php");
if(!isset($_SESSION['sessUserId']))//User authentication
{
	session_destroy();
 header("Location: login.php");
 exit();
}

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

	
if(isset($_POST['btnSubmit']) || isset($_POST['btnChange']))
{
	extract($_POST);
	
	if(empty($title))
		$err = "<li>Please enter Category</li>";
	
	if(empty($err))
	{		
		$categories -> saveOrUpdate($id, $parentId, $title);
		header("Location: krishicategory.php?msg=Category details added successfully");
		exit();
	}
}
elseif (isset($_GET['delete']))
{
	//$editable = $categories -> isEditable($_GET['delete']);
	
	$categories->delete($_GET['delete']);
	header("Location: krishicategory.php?msg=Category details deleted successfully");
	
}
elseif($_GET['action'] == "edit")
{
	$row = $categories -> getById($id);
	extract($row);	
	
	//$editable = $categories -> isEditable($id);
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
                    <td class="heading2">Manage Krishi Diary Category</td>
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
                        <td width="15%"><strong>Parent Category :</strong></td>
												<td>
                        <select name="parentId" class="list1">
                        	<option value="0">Select Parent Category</option>
							<?php $categories -> getCombo(0, $parentId); ?>
                        </select>
                        </td>
                      </tr>
                      <tr>
                     	<td width="15%"><strong>Title :</strong></td>
						<td><input type="tel" name="title" value="<?php echo $title; ?>" class="text" /></td>
                      </tr>
                      
                      
                      <tr>
                        <td valign="top">&nbsp;</td>
                        <td valign="top">
                          <?php if(isset($_GET['action']) && $_GET['action'] == "edit"){ ?>
                          <input type="hidden" name="id" value="<?php echo $id; ?>" />
                          <input type="submit" name="btnChange" value="Change" class="btn_submit" />
                          <?php } else { ?>
                          <input type="submit" name="btnSubmit" value="Save" class="btn_submit" />
                          <?php } ?>
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
                      <td class="heading2">Krishi Categories</td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellpadding="4" cellspacing="0">
                          <tr bgcolor="#F1F1F1">
                            <td width="1">&nbsp;</td>
                            <td width="10%"><strong>SN</strong></td>
                            <td><strong>Title</strong></td>
                            
                            <td width="130"><strong>Action</strong></td>
                          </tr>
													<?php
													$counter = 0;													
													$categories -> getListOutput(0, 0);													
													?>
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