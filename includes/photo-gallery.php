<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="span12">
                <i class="icon-flag page-title-icon"></i>
                <h2>Photo Gallery / AICC, Hariharbhawan, Lalitpur</h2>
            </div>
        </div>
    </div>
</div>
<br />
<!-- Photo Gallery -->
<div class="what-we-do container">
    <div class="row">
        <? $gallery=$groups->getByParentId(PHOTO_GLLERY);
		while($galleryGet=$conn->fetchArray($gallery))
		{?>
        	<div class="service span3" style="border-bottom:none; background:none">
            	<p>
                	<a href="<?=$galleryGet['urlname'];?>" style="padding:0; background:none">
                	<img src="<?=CMS_GROUPS_DIR.$galleryGet['image'];?>" style="width:100%; 
                    border-radius:15px 0px; min-width:270px; min-height:208px" /></a>
              	</p>
              	<p style="margin: -45px 0 0 0;">
                	<a href="<?=$galleryGet['urlname'];?>"><?=$galleryGet['name'];?></a>
             	</p>
        	</div>
        <? }?>
    </div>
</div>