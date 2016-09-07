<style>

	.listTitle{}

	.listTitle a

	{

    	color: #FF0000;

    	font-family: tahoma;

    	font-size: 16px;

    	text-decoration: none;

	}

</style>

<link rel="stylesheet" type="text/css" href="css/detail.css"/>


<div class="contentHdr">

	<h2>Search Details:</h2></div>

	<div class="content">
    
   		<div id="bodydetail">
    		<div id="trip-box">
        		<div id="trip-box-in">
					<?php
                    	$keyword=$_POST['keyword'];
                    	//$keyword=explode(" ",$keyword); echo $keyword;
                        $s = "select DISTINCT * from groups where linkType='Product' and (`name` LIKE '$keyword%' OR shortcontents LIKE '$keyword%' OR contents like '$keyword%') 
						order by weight";
                        $sql=mysql_query($s);
                        $numRows= mysql_num_rows($sql);
                    	
						while($pGet=mysql_fetch_assoc($sql))
						{?>
		
							<div class="trip-box">
		
									<h4>
		
										<a title="" href="<?=$pGet['urlname'];?>">
		
											<img src="<?=CMS_GROUPS_DIR.$pGet['image'];?>" width="217" height="180" style="border-radius:4px;">
		
											<?=$pGet['name'];?>
		
										</a>
		
									</h4>
		
									<p style="margin-top:3px;"><b>Product Code:</b> <?=$pGet['code'];?></p>
		
									<?php /*?><p><b>Product Price:</b> <?=$tripsGet['price'];?></p><?php */?>
									<?php /*?><p class="enq"><?=substr(strip_tags($tripsGet['shortcontents']), 0, 100);?>...</p><?php */?>
		
									<div style="margin-top:10px;">
		
										<a class="view" href="<?=$pGet['urlname'];?>">View Detail</a>
		
										<a class="enquiry" href="order-<?=$pGet['urlname'];?>">Order Now</a>
		
									</div>
		
									
		
								</div>
		
						<? }?>
                        
                        <? if($numRows==0) echo "<h3>No Search Results are Found !!!</h3>"; ?>
                        
                        <div style="clear:both"></div>
                        
                	</div>
             	</div>
           	</div>
					
  	</div>
    
    
    


<?php /*?><div class="content">
<?php

$keyword=$_POST['keyword'];

$keyword=explode(" ",$keyword);

$arrlen=count($kwords);

$tablenames=array('groups');

$arrtbllen=count($tablenames);

$nums=0;

if(!empty($keyword)){

foreach($keyword as $ex)

{
	foreach($tablenames as $tb)
	{

		$s = "select DISTINCT * from $tb where linkType='Product' and (`name` LIKE '$ex%' OR shortcontents LIKE '$ex%' OR contents like '$ex%') order by weight";

		$sql=mysql_query($s);

		$numRows= mysql_num_rows($sql);

		$nums+=$numRows;

		while($row=mysql_fetch_array($sql))

		{		

		?>

		<div style="padding:5px 0" class="listTitle"><br/>

    <?php

    if ($row['linkType'] == "Link")

		{

			echo "<a href='" . $row['contents'] . "' >";

		}

		else if ($row['linkType'] == "File")

		{

			echo "<a href='" . CMS_FILES_DIR . $row['contents'] . "' >";

		}

		else if ($row['linkType'] == "Activity")

		{

			echo "<a href='"."activity-".$row['urlname'].".html"."'>";

		}

		else if ($row['linkType'] == "Destination")

		{	

			echo "<a href='"."destination-".$row['urlname'].".html"."'>";

		}  

		else if ($row['linkType'] == "Region")

		{
			
			echo "<a href='"."region-".$row['urlname'].".html"."'>";

		}  

		else

		{

			echo "<a href='".$row['urlname']."'>";

		}

		echo $row['name'] . "</a>";

    ?>

    </div>

    <?php if($row['linkType'] != "Link" || $row['linkType'] != "File"){ ?>

    <div id="news"> <? echo substr(strip_tags($row['shortcontents']), 0, 500); ?> </div>

    <?php } ?>
    
		<?php			

	 }		

	}

}

?>

<?php

if($nums<1)

{

	echo "<br/><br/><h3> No search result found!!!</h3>";

}

?>

<?php
}

else {

	echo "<h2> Please Enter the keyword for Searching !!</h2>";

}

?>

</div><?php */?>