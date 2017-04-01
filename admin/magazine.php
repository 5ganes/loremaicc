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
	$groupResult = $magazine->getById($_GET['id']);
	$groupRow = $conn->fetchArray($groupResult);

	$selectedGroupType = $groupRow['year'];
	//echo $selectedGroupType; die();
	$showSaveForm = true;
	$showListing = true;
}
if (isset($_GET['groupType']))
{
	$selectedGroupType = $_GET['groupType'];
	//echo $selectedGroupType; die();
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
																	$addLink = "magazine.php";
																	$formLink = "manage_magazine.php";
																
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
															&nbsp;Manage Magazines
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
                              								<form action="magazine.php" method="get">
                                								<table border="0" width="100%" cellpadding="2" cellspacing="0">
                                  									<tr>
                                    									<td width="90"><strong>Year : </strong></td>
                                    									<td>
                                                                        	<select name="groupType" onchange="changeTypeMagazine(this);" class="list1">
                                        										<option value="select">Select Year</option>
                                        										<?
																				$year=2020;
																				for($i=$year;$i<=2075;$i++)
																				{?>
																					<option value="<?=$i?>" <? if($selectedGroupType==$i){ echo "selected";}?>>
																						<?=$i?>
                                                                                  	</option>
																				<? }?>
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
                                                                                class="text">
                                                                          	</td>
                                                                      	</tr>
                                                                        
                                                                        <tr>
                                                                            <td width="90"><strong>Month : </strong></td>
                                                                            <td>
                                                                                <select name="month" class="list1">
                                                                                    <option value="select">Select Month</option>
                                                                                    <? include("month.php"); ?>
                                                                                    
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        
                                                                        <input type="hidden" name="year" value="<?php echo $selectedGroupType; ?>" />
                                                                      	
																		<? include("ajaxMagazine.php"); ?>																		
                                                                         	
                                                                        <tr>
                                                                        	<td><strong>Weight : </strong></td>
                                                                        	<?php
                                                                         	if (!isset($groupRow['weight']))
                                                                         	{
                                                                                $groupRow['weight'] = $magazine -> getLastWeight($_GET['groupType']);
                                                                                
                                                                           	} ?>
                                                                        	<td>
                                                                            	<input type="text" value="<?php echo $groupRow['weight'] ?>" name="weight" 
                                                                                class="text" style="width:25px;">
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
												$pagename = "magazine.php";
												$withEdit = true;
												$withDelete = true;
												$withOpen = true;
												//selectedGroupType will be used inside groupListing.php
												$parentId = 0;
												if (isset($selectedGroupType))
												$year = $selectedGroupType;
												include("magazinelisting.php");
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
