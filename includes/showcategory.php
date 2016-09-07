<style>

	.related{ margin-top:1px}

	.trips{}

</style>



<link rel="stylesheet" type="text/css" href="css/detail.css"/>



<?php //include("includes/breadcrumb.php"); ?>

<? $url=$_GET['url'];

$act=$groups->getByAlias($url); $actGet=$conn->fetchArray($act);

?>

<div class="contentHdr">

<h2><?php echo $actGet['name']; ?></h2></div>

<div class="content">

	

    <div class="">

    	<?php /*?><p style="margin:0px 0 10px 0;"><img src="<?=CMS_GROUPS_DIR.$actGet['image'];?>" width="718" height="270" /></p>
		<?php echo $actGet['contents']; ?><?php */?>

	</div>

    <?php /*?><div class="contentHdr" style="margin-top:30px"><h2><?php echo $actGet['name']; ?></h2></div><?php */?>

    <div id="bodydetail">

    	<div id="trip-box">

        	<div id="trip-box-in">

        		<? $activity=$actGet['name']; ?>
				<? 	if($actGet['activity']!="Default")
					{
						$tri="select * from groups where activity='$activity' order by weight"; $trip=mysql_query($tri);
					}
					else
					{
						$test=mysql_query("select * from groups where activity='$activity' order by weight"); $testtori=mysql_fetch_array($test);
						if($testtori['linkType']=="Activity")
						{
						//echo "hi";
						$sql="select name from groups where activity='$activity' order by weight"; $sql1=mysql_query($sql);
						$i=1; $tri="select * from groups where activity IN (";
						while($res=mysql_fetch_array($sql1))
						{
							$na=$res['name'];
							if($i==1)
								$tri=$tri."'$na'";	
							else
								$tri=$tri.", "."'$na'";
							$i++;
						}
						$tri=$tri.") order by weight";
						}
						else
						{
							//echo "hello";
							$tri="select * from groups where activity='$activity' order by weight"; $trip=mysql_query($tri);	
						}
						$trip=mysql_query($tri);
					}
					//echo $tri;
				while($tripsGet=mysql_fetch_assoc($trip))

				{?>

                	<div class="trip-box">

							<h4>

								<a title="" href="<?=$tripsGet['urlname'];?>">

									<img src="<?=CMS_GROUPS_DIR.$tripsGet['image'];?>" width="217" height="180" style="border-radius:4px;">

									<?=$tripsGet['name'];?>

								</a>

							</h4>

                            <p style="margin-top:3px;"><b>Product Code:</b> <?=$tripsGet['code'];?></p>

                            <?php /*?><p><b>Product Price:</b> <?=$tripsGet['price'];?></p><?php */?>
							<?php /*?><p class="enq"><?=substr(strip_tags($tripsGet['shortcontents']), 0, 100);?>...</p><?php */?>

                            <div style="margin-top:10px;">

                            	<a class="view" href="<?=$tripsGet['urlname'];?>">View Detail</a>

                                <a class="enquiry" href="order-<?=$tripsGet['urlname'];?>">Order Now</a>

                            </div>

                            

						</div>

                <? }?>

                <div style="clear:both"></div>

                

        	</div>

        </div>

    

	</div>



</div>

