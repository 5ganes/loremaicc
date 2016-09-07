<style>
	.video{float: left; width: 219px; margin-bottom:10px; margin-right:6px; border: 1px solid; overflow:hidden;}
	.video:last-child{ margin-right:0;}
</style>
<div align="right" style="cursor: pointer;" onclick="addVideo();">+ Add Video +</div>
<div id="uploadVideoHolder">
  
  <div style="">Video Title :</div>
  <div style="float:left; padding-bottom:5px;">
    <input type="text" name="vName[]" style="width:300px" />
  </div>
  <br style="clear: both;">
  
  <div style="">Link : <strong>[ eg. http://www.youtube.com/v/1425WRE54 ]</strong></div>
  <div style="float:left; padding-bottom:5px;">
    <textarea name="videoUrl[]" rows="1" cols="110" style="width:430px"></textarea>
  </div>
  <br style="clear: both;">
  
  <div style="">Video Description :</div>
  <div style="float:left; padding-bottom:5px;">
    <textarea name="contents[]" rows="2" cols="110" style="width:430px"></textarea>
  </div>
  <hr style="clear: both;">
  
</div>
<?php
if (isset($_GET['id']))
{
?>
<div style="font-size:14px; font-weight:bold; margin:20px 0 4px; 0">Existing videos</div>
<div>
  <?php
	$pagename = "cms.php?id=" . $_GET['id'] . "&parentId=" . $_GET['parentId'] . "&groupType=" . urlencode($_GET['groupType']) . "&";		

	$sql = "SELECT * FROM groups WHERE parentId = '". $_GET['id'] . "' ORDER BY id DESC";
	$limit = ADMIN_VIDEO_GALLERY_LIMIT;
	include("../includes/paging.php");
	
	$videoResult = $result;
	
	//$videoResult = $videos->getByGroupId($_GET['id']);
	while ($videoRow = $conn->fetchArray($videoResult))
	{
	?>
  		<div class="video">
    		<div align="right">
      			<div style="cursor: pointer;" onclick="delete_confirmation('manage_cms.php?id=<?php echo $_GET['id']; ?>&parentId=<?php echo $_GET['parentId']
				; ?>&groupType=<?php echo $_GET['groupType']; ?>&videoId=<?php echo $videoRow['id']; ?>&deleteVideo');">[x]&nbsp;</div>
    		</div>
    		<div align="center" style="width: 100%; height: 95px;">
            	<img src="<?php echo getYouTubeImage($videoRow['shortcontents'], "big"); ?>" width="130" height="70">
          	</div>
            <style> .bold{text-align:left; margin:0 0 0 2px; padding:0; font-weight:bold} </style>
    		<div align="center">
      			<input type="hidden" name="oldVideoIds[]" value="<?php echo $videoRow['id'] ?>" />
                <p class="bold">Title:</p> <input type="text" name="oldvNames[]" style="width:210px;padding:0px 2px;height:25px;" value="<?php echo $videoRow['name'] ?>" /><br />
      			<p class="bold">URL:</p> <textarea name="oldUrls[]" rows="1" cols="31"><?php echo $videoRow['shortcontents'] ?></textarea><br />
                <p class="bold">Description:</p> <textarea name="oldContents[]" rows="4" cols="32"><?php echo $videoRow['contents'] ?></textarea><br />
    		</div>
  		</div>
  <?php
	}
	include("../includes/paging_show.php");
	?>
</div>
<?php
}
?>