<table width="100%" border="0" cellspacing="0" cellpadding="2">
  	<tr>
    	<td colspan="6" class="heading2">
			<?php	
			if ($parentId != 0)
			{
				$upResult = $diary->getById($parentId);
				$upRow = $conn->fetchArray($upResult);
				?>
				<div style="float:right; padding-right:5px;">
            		<a href="<?php echo $pagename; ?>?parentId=<?php echo $upRow['parentId']; ?>&groupType=<?php echo $upRow['type']; ?>"  class="headLink">
                    UP</a>	
         		</div>
			<?php }?>
			&nbsp;<?php
			if (!isset($_GET['groupType']))
			{
				echo "Showing Objects of Diary";
			}
			else
			{
				echo "Showing Objects of " . $categories->getNameById($_GET['groupType']);
			}
			?>
       	</td>
  	</tr>
  	<tr bgcolor="#F1F1F1">
    	<td class="tahomabold11" style="width:80px;">S.No</td>
        <td class="tahomabold11" style="width:120px">Image</td>
    	<td class="tahomabold11">Name</td>
   	 	<td class="tahomabold11">Parent Category</td>
    	<td class="tahomabold11">Weight</td>
    	<td class="tahomabold11">Action</td>
  	</tr>
  	<?php
	$counter = 0;
	if ($parentId == 0)
	{
		if(!empty($selectedGroupType))
		$sql = "select * from diary where categoryId='$selectedGroupType' order by weight"; 
		//$result = $diary->getByParentIdAndType(0, $selectedGroupType);
	}
	else
	{
		$sql = "SElECT * FROM diary WHERE categoryId = '$parentId' ORDER BY weight";
		$result = $diary->getByCategoryId($parentId);
	}
	$limit = 20;
	if(isset($_GET['groupType']))
	{
		include("paging.php");
	}

	while ($result && $row = $conn->fetchArray($result))
	{
		$counter++;
		?>
  		<tr <?php if ($counter % 2 == 0) { echo "bgcolor='#F7F7F7'";} ?>>
            <td valign="top"><?php echo $counter; ?></td>
            <td valign="top"><img src="<?php echo "../".CMS_DIARY_DIR.$row['image']; ?>" width="45" height="25" /></td>
            <td valign="top"><?php echo $row['name']; ?></td>
            <td valign="top"><?php $cat=$categories->getById($row['categoryId']); echo $cat['title'];?></td>
            <td valign="top"><?php echo $row['weight']; ?></td>
            <td valign="top">
      			<a href="krishiobject.php?groupType=<?=$_GET['groupType']?>&id=<?php echo $row['id']; ?>">Edit</a> /      			
      			<a href="#" onclick="delete_confirmation('manage_diary.php?id=<?php echo $row['id']; ?>&groupType=<?php echo $_GET['groupType'];?>&delete');">Delete</a>
        	</td>
  		</tr>
  	
	<?php }?>
</table>
