<?php
include("init.php");
if(!isset($_SESSION['sessUserId']))//User authentication
{
 	header("Location: login.php");
 	exit();
}

$showSaveForm = false;
$showListing = false;

if (isset($_GET['id']))
{
	$groupResult = $diary->getById($_GET['id']);
	$groupRow = $conn->fetchArray($groupResult);

	$selectedGroupType = $groupRow['parentId'];

	$showSaveForm = true;
	$showListing = true;
}
if (isset($_GET['groupType']))
{
	$selectedGroupType = $_GET['groupType'];
	$showSaveForm = true;
	$showListing = true;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo ADMIN_TITLE; ?> :: <?php echo PAGE_TITLE; ?></title>
	<link href="../css/admin.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="../js/cms.js"></script>
	<script language="javascript" src="../js/jquery.min.js"></script>

  <script type="text/javascript" src="ckeditor/ckeditor.js"></script>

</head>

<body>
<table width="<?php echo ADMIN_PAGE_WIDTH; ?>" border="0" align="center" cellpadding="0" cellspacing="5" bgcolor="#FFFFFF">
  	<tr>
    	<td colspan="2"><?php include("header.php"); ?></td>
  	</tr>
  	<tr>
    	<td width="<?php echo ADMIN_LEFT_WIDTH; ?>" valign="top"><?php include("leftnav.php"); ?></td>
    	<td width="<?php echo ADMIN_BODY_WIDTH; ?>" valign="top">
        	<table width="100%" border="0" cellspacing="1" cellpadding="0">
       			<tr>
          			<td class="bgborder">
                    	<table width="100%" border="0" cellspacing="1" cellpadding="0">
              				<tr>
                				<td bgcolor="#FFFFFF">
                                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    					<tr>
                      						<td valign="top">
                                            
                                            	<table width="100%" border="0" cellpadding="2" cellspacing="0">
                          							<tr>
                            							<td class="heading2">
                              								<div style="float: right;">
                                								<?php
																	$addLink = "krishiobject.php";
																	$formLink = "manage_diary.php";
																
																	if (isset($_GET['groupType']))
																	{
																	 $addLink .= "?groupType=" . $_GET['groupType'];
																	 $formLink .= "?groupType=" . $_GET['groupType'];
																	}
																	if(isset($_GET['page']))
																	{
																		$addLink .= "&page=" . $_GET['page'];
																		$formLink .= "&page=" . $_GET['page'];
																	} 
																?>
                                								<a href="<?php echo $addLink ?>" class="headLink"> Add New </a>
                                                          	</div>
															&nbsp;Manage Krishi Diary Contents
                                                     	</td>
                          							</tr>
                          							<tr>
                            							<td>
															<?php
																if (isset($_GET['msg']))
																{
															 		//echo $msg;
																}
															?>
                              								<form action="krishiobject.php" method="get">
                                								<table border="0" width="100%" cellpadding="2" cellspacing="0">
                                  									<tr>
                                    									<td width="90"><strong>Type : </strong></td>
                                    									<td>
                                                                        	<select name="groupType" onchange="changeTypeCat(this);" class="list1">
                                        										<option value="select">Select Category</option>
                                        										<?php $categories -> getCategories(0, $selectedGroupType); ?>
                                    										</select>
                                                                       	</td>
                                  									</tr>
                                								</table>
                              								</form>
                                                       	</td>
                          							</tr>
                          							<?php
													if ($showSaveForm)
													{?>
                          								<tr>
                            								<td>
                                                            	<form action="<?php echo $formLink; ?>" method="post" enctype="multipart/form-data">
                                									<?php
																	if (isset($_GET['id']))
																	{?>
                                										<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                									<?php }?>
                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                                                      	<?php
																		if (isset($_GET['id']))
																		{?>
                                                                          	<tr>
                                                                            	<td><strong>Created On : </strong></td>
                                                                            	<td>
                                                                               		<?php
																						//echo $groupRow['onDate']; die();
                                                                                     	$arr = explode("-", $groupRow['onDate']);
                                                                                        echo date("M d, Y", mktime(0, 0, 0, $arr[1], $arr[2], $arr[0]));
                                                                                 	?>
                                                                               	</td>
                                                                          </tr>
                                                                      	<?php }?>
                                                                      	<tr>
                                                                        	<td width="90"><strong>Name : </strong></td>
                                                                        	<td>
                                                                            	<input type="text" name="name" value="<?php echo $groupRow['name']; ?>" 
                                                                                class="text" onchange="copySame('urlname', this.value);">
                                                                          	</td>
                                                                      	</tr>
                                                                      	
                                                                        <tr>
                                                                        	<td><strong>Alias Name :</strong> </td>
                                                                        	<td>
                                                                            	<div style="float:left">
                                                                            	   <input type="text" name="urlname" id="urlname" 
                                                                                   value="<?php echo $groupRow['urlname']; ?>" class="text" 
                                                                                   onchange="copySame('urlname', this.value);" 
                                                                                   onBlur="checkUrlName('<?php echo $_GET['id']; ?>', this.value, 'urlmsg');">
                                                                              	</div>
                                                                                <div id="urlmsg" style="float:left; padding-left:10px;"></div>
                                                                           	</td>
                                                                     	</tr>
                                                                        <input type="hidden" name="parentId" value="<?php echo $selectedGroupType; ?>" />
                                                                      	
                                                                      	<tr>
                                                                        	<td></td>
                                                                        	<td>
																				
                                                                                <?
                                                                                $catType=$categories->getByParentId($selectedGroupType);
																				$idGet=$categories->getById($selectedGroupType);
																				//echo mysql_num_rows($catType)." + ".$idGet['parentId'];
																				if(mysql_num_rows($catType)<1 and $idGet['parentId']!=KRISHI_FFEW)
																				{?>
																					<div id="fckEditor" class="groupBox">
                                                                                     	<?php
                                                                                     		include("ajaxKrishiContents.php");
                                                                                        ?>
                                                                                    </div>
																				<? }
																				else if($idGet['parentId']==KRISHI_FFEW)
																				{
                                                                                 	include("ajaxKrishiFFEW.php");
																				}
																				?>
                                                                                <?php /*?><div id="fckEditor" class="groupBox"
                                                                                    <?php
                                                                                    if ($groupRow['linkType'] != "Contents Page")
                                                                                    {
                                                                                        echo "style=\"display:none;\"";
                                                                                    }
                                                                                    ?>
                                                                                    >
                                                                                    <?php
                                                                                       if (isset($_GET['id']) && $groupRow['linkType'] == "Contents Page")
                                                                                       {
                                                                                            include("ajaxContentsPanel.php");
                                                                                       }                                
                                                                                    ?>
                                                                                </div><?php */?>
																																						
                                                                         	</td>
                                                                      	</tr>
                                                                      	
                                                                      	
                                                                        <tr>
                                                                        	<td><strong>Weight : </strong></td>
                                                                        	<?php
                                                                         	if (!isset($groupRow['weight']))
                                                                         	{
                                                                                $groupRow['weight'] = $diary -> getLastWeight($_GET['groupType']);
                                                                                
                                                                           	} ?>
                                                                        	<td>
                                                                            	<input type="text" value="<?php echo $groupRow['weight'] ?>" name="weight" 
                                                                                class="text" style="width:25px;">
                                                                          	</td>
                                                                    	</tr>
																		
																		<?php if(!empty($groupRow['image']) && file_exists("../". CMS_DIARY_DIR .
                                                                        $groupRow['image']))
                                                                        { ?>
                                                                            <tr>
                                                                                <td align="left"><strong>Existing Image : </strong></td>
                                                                                <td>
                                                                                    <img src="../<?php echo CMS_DIARY_DIR . $groupRow['image']; ?>" 
                                                                                    width="100" border="0" /> [<a href="manage_diary.php?id=<?php echo $_GET
                                                                                    ['id']; ?>&groupType=<?php echo $_GET['groupType']; ?>&deleteImage<?php 
																					if(isset($_GET['page'])) echo '&page='. $_GET['page']; ?>">Delete</a>]
                                                                                </td>
                                                                            </tr>
                                                                      	<?php } ?>
                                                                        <tr>
                                                                            <td>
                                                                                <div id="ImageLabel"><strong> Image : </strong></div>
                                                                            </td>
                                                                            <td>
                                                                                <div id="grpImage">
                                                                                    <input type="file" name="image" class="file">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td></td>
                                                                            <td><input type="submit" value="Save" name="save" class="button"></td>
                                                                        </tr>
                                                                 	
                                                                    </table>
                              									</form>
                                                          	</td>
                          								</tr>
                          							<?php }
													if ($showListing)
													{?>
                          							<?php }?>
                        						</table>
                                           	
                                            </td>
                    					</tr>
                  					</table>
                              	</td>
              				</tr>
            			</table>
                  	</td>
        		</tr>
        		<tr>
          			<td height="5"></td>
        		</tr>
        		<tr>
                  	<td class="bgborder">
                    	<table width="100%" border="0" cellspacing="1" cellpadding="0">
                      		<tr>
                        		<td bgcolor="#FFFFFF">
                                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            			<tr>
                              				<td valign="top"><?php
											
												if(!isset($_GET['groupType']))
												{
													$pagename = "krishiobject.php";
												}
												else
													$pagename = "krishiobject.php?groupType=".$_GET['groupType']."&";
												
												$withEdit = true;
												$withDelete = true;
												$withOpen = true;
												//selectedGroupType will be used inside groupListing.php
												$parentId = 0;
												if (isset($_GET['parentId']))
												$parentId = $_GET['parentId'];
												include("diarylisting.php");
												if(isset($_GET['groupType']))
												{
													include("paging_show.php");
												}
												?>
                              				</td>
                            			</tr>
                          			</table>
                               	</td>
                      		</tr>
                    	</table>
                  	</td>
        		</tr>
      		</table>
       	</td>
  	</tr>
  	<tr>
    	<td colspan="2"><?php include("footer.php"); ?></td>
  	</tr>
</table>
</body>
</html>
