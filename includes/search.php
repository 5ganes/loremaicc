<ul>
    <p><span style="font-weight:bold; font-size:20px; text-decoration:underline">Search Details</span></p>
    <?
    //$keyword=utf8_encode($_POST['keyword']); //echo $keyword; die();
	if(!empty($keyword))
	{
	$sql="select * from diary where categoryId='4' and (name like '%$keyword%' or urlname like '%$keyword%' or phone like '%$keyword%' or fax like '%$keyword%' or email like '%$keyword%' or website like '%$keyword%') order by weight";
	
	$result=mysql_query($sql);
	//echo $sql;
	?>
	
	<table width="100%"  border="0" cellpadding="4" cellspacing="0">
        <tr bgcolor="#F1F1F1" class="tahomabold11">
            <td width="1">&nbsp;</td>
            <td><strong>S.N.</strong></td>
            <td><b>Organization</b></td>
            <td><b>Phone</b></td>
            <td><b>Fax</b></td>
            <td><b>Email</b></td>
            <td><b>Website</b></td>
        </tr>
        <?
        $counter=0; $i=0;
        while($row=$conn->fetchArray($result))
        {?>
            <tr <?php if($i%2 != 0) echo 'bgcolor="#F7F7F7"'; else echo 'bgcolor="#FFFFFF"'; ?>>
                <td valign="top">&nbsp;</td>
                <td valign="top"><?=++$i;?></td>
                <td valign="top"><?= $row['name'] ?></td>
                <td valign="top"><?=$row['phone'];?></td>
                <td valign="top"><?=$row['fax'];?></td>
                <td valign="top"><?=$row['email'];?></td>
                <td valign="top"><?=$row['website'];?></td>
            </tr>
        <? }?>
    </table>
    
    <? }
	else
		echo '<span style="color:red;">Please Enter a Keyword</span>';?>
    
</ul>