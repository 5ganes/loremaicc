<style>

	.related{ margin-top:1px}
	.features{ margin:0}
	.features ol{ margin:0}
	.features ol li{ }
	.trips{}

</style>



<link rel="stylesheet" type="text/css" href="css/detail.css"/>



<div class="contentHdr">

<h2><?php echo $pageName; ?></h2>

</div>



<? $trip=$groups->getById($pageId); $tripGet=$conn->fetchArray($trip);?>



<div class="content">

	

    <div class="">

    	<p style="margin:7px 9px 0 0; float:left">

        	<a href="<?=CMS_GROUPS_DIR.$tripGet['image'];?>" target="_blank">

        		<img src="<?=CMS_GROUPS_DIR.$tripGet['image'];?>" width="420" height="340" />

        	</a>

      	</p>
		<!--<p style="margin:2px 0 4px 0"><b>Product Code: </b><?=$tripGet['code'];?></p>-->
		<div class="features"><?php echo $tripGet['contents'];?></div>
        
        <div style="margin-top:6px;">

            <a class="enquiry" href="order-<?=$tripGet['urlname'];?>">Order Now</a>
            <div style="clear:both"></div>

        </div>

        <div style="clear:both"></div>

        

		<? if(!empty($tripGet['itineraryy']))

		{?>

        	<p style="font-weight:bold; margin:8px 0; font-size:14px">Trip Itinerary</p>

            <?=$tripGet['itinerary'];?>

		<? }?>

    	

        

    </div>

    

    <div class="contentHdr" style="margin-top:30px"><h2>Related Products</h2></div>

    

    <div id="bodydetail">

  

    	<div id="trip-box">

        	<div id="trip-box-in">

        		<? $act=$tripGet['activity']; ?>

				<? $t=mysql_query("select * from groups where linkType='Product' and activity='$act' order by weight");

				while($tGet=mysql_fetch_assoc($t))

				{?>

                

                	<div class="trip-box">

							<h4>

								<a title="" href="<?=$tGet['urlname'];?>">

									<img src="<?=CMS_GROUPS_DIR.$tGet['image'];?>" width="217" height="180" style="border-radius:4px;" />

									<?=$tGet['name'];?>

								</a>

							</h4>

							<p style="margin-top:3px;"><b>Product Code:</b> <?=$tGet['code'];?></p>

                            <?php /*?><p><b>Product Price:</b> <?=$tGet['price'];?></p><?php */?>

							<?php /*?><p class="enq"><?=substr(strip_tags($tGet['shortcontents']), 0, 100);?>...</p><?php */?>

                            

                            <div style="margin-top:10px;">

                            	<a class="view" href="<?=$tGet['urlname'];?>">View Detail</a>

                                <a class="enquiry" href="order-<?=$tGet['urlname'];?>">Order Now</a>
                                <div style="clear:both"></div>

                            </div>

                            

						</div>

                <? }?>

                <div style="clear:both"></div>

                

        	</div>

        </div>

    

	</div>



</div>

