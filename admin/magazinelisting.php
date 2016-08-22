<table width="100%" border="0" cellspacing="0" cellpadding="2">
  	<tr>
    	<td colspan="7" class="heading2">
			<?php
			if (!isset($_GET['groupType']))
			{
				echo "Showing Magazines";
			}
			else
			{
				echo "Showing Magazines of Year " . $year;
			}
			?>
       	</td>
  	</tr>
  	<tr bgcolor="#F1F1F1">
    	<td class="tahomabold11" style="width:80px;">S.No</td>
    	<td class="tahomabold11">Name</td>
   	 	<td class="tahomabold11">Published Year</td>
        <td class="tahomabold11">Published Month</td>
        <td class="tahomabold11">Publish</td>
    	<td class="tahomabold11">Weight</td>
    	<td class="tahomabold11">Action</td>
  	</tr>
  	<?php
	$counter = 0;
	if (!isset($selectedGroupType))
	{
		//if(!empty($selectedGroupType))
		//$result = $magazine->getByParentIdAndType(0, $selectedGroupType);
	}
	else
	{
		$result = $magazine->getByYear($year);
	}

	while ($result && $row = $conn->fetchArray($result))
	{
		$counter++;
		?>
  		<tr <?php if ($counter % 2 == 0) { echo "bgcolor='#F7F7F7'";} ?>>
            <td valign="top"><?php echo $counter; ?></td>
            <td valign="top"><?php echo $row['name']; ?></td>
            <td valign="top"><?php echo $row['year'];?></td>
            <td valign="top"><?php echo $row['month'];?></td>
            <td valign="top"><?php echo $row['publish'];?></td>
            <td valign="top"><?php echo $row['weight']; ?></td>
            <td valign="top">
      			<a href="magazine.php?groupType=<?=$_GET['groupType']?>&id=<?php echo $row['id']; ?>">Edit</a> /      			
      			<a href="#" onclick="delete_confirmation('manage_magazine.php?id=<?php echo $row['id']; ?>&groupType=<?php echo $_GET['groupType'];?>&delete');">Delete</a>
        	</td>
  		</tr>
  	
	<?php }?>
</table>
