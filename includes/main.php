<!-- Slider -->
<div class="slider">
    <div class="container">
        <div class="row" style="margin-left:0">
            <div class="span9 offset1" style="margin-left:0;">
                <div class="flexslider">
                    <ul class="slides">
                        <?
                        	$slider=$groups->getByParentId(SLIDER);
							while($sliderGet=$conn->fetchArray($slider))
							{?>
								<li>
                                    <img src="<?=CMS_GROUPS_DIR.$sliderGet['image'];?>">
                                    <p class="flex-caption"><?=$sliderGet['shortcontents'];?></p>
                                </li>	
							<? }
						?>
                    </ul>
                </div>
            </div>
            <div class="span3 offset1" style="margin-left:2%; margin-top:1%">
    <div class="testimonials-title">
     	<h3 style="">प्रकाशन / प्रसारण</h3>
  	</div>
	<div class="row">
        <div style="margin-top:15px;" class="testimonial-list span3">
            <div class="tabbable tabs-below">
                <div class="tab-content">
                    <div class="show-links">
                        	<ul>
                            	<? 
								$pub=$groups->getByParentId(1009);
								while($pubGet=$conn->fetchArray($pub))
								{?>
                              		<li><a href="<?=$pubGet['urlname'];?>"><?=$pubGet['name'];?></a></li>
                              	<? }?>      
                            </ul>
                        </div>
                    
                </div>
               
           </div>
        </div>
    </div>
</div>
        </div>
    </div>
</div>

<!--welcome message-->
<div class="presentation container" style="margin-top:5px;">
	<? $welcome=$groups->getById(WELCOME); $welcomeGet=$conn->fetchArray($welcome); ?>
    <h2 style="color:#1F9B00"><?=$welcomeGet['name'];?></h2>
    <p style="font-size:17px; text-align:justify; color:">
   		<?=$welcomeGet['shortcontents'];?> <br />
        <a class="violet" href="<?=$welcomeGet['urlname'];?>" style="float:right">[ विस्तृत ]</a>
    </p>
</div>

<div class="presentation container" style="margin-top:5px;">
    <p style="font-size:17px; text-align:justify; color:">
 		<div style="border-top:1px dashed #ddd;"></div>
    </p>
</div>

<!-- message -->
<div class="testimonials container" style="margin-top:12px; padding-bottom:0;">
    
    <div class="span4" style="margin-left:8px;">
		<? $msg=$groups->getById(MESSAGE); $msgGet=$conn->fetchArray($msg); ?>
    	<div class="testimonials-title">
        	<h3 style=""><?=$msgGet['name'];?></h3>
    	</div>
    	<div class="row">
            <div class="testimonial-list span4" style="margin-top:15px;">
                <div class="tabbable tabs-below">
                    <div class="tab-content">
                        <div class="tab-pane active" id="A">
                            <img src="<?=CMS_GROUPS_DIR.$msgGet['image'];?>" title="<?=$msgGet['name'];?>" alt="<?=$msgGet['name'];?>" style="margin: 0.8% 2% 0 1%;width: 33%;">
                            <p style="text-align:justify; font-size:17px">
                                <?=$msgGet['shortcontents'];?>...<br />
                                <a class="violet" href="<?=$msgGet['urlname'];?>">[ विस्तृत ]</a>
                            </p>
                        </div>
                        
                    </div>
                   
               </div>
            </div>
    	</div>
    </div>
    
    <div class="span4" style="margin-left:8px;">
		<? $off=$groups->getById(OFFICER); $offGet=$conn->fetchArray($off); ?>
    	<div class="testimonials-title">
        	<h3 style=""><?=$offGet['name'];?></h3>
    	</div>
    	<div class="row">
            <div class="testimonial-list span4" style="margin-top:15px;">
                <div class="tabbable tabs-below">
                    <div class="tab-content">
                        <div class="tab-pane active" id="A">
                            <img src="<?=CMS_GROUPS_DIR.$offGet['image'];?>" title="<?=$offGet['name'];?>" alt="<?=$offGet['name'];?>" style="margin: 0.8% 2% 0 1%;width: 33%;">
                            <p style="text-align:justify; font-size:17px">
                                <?=$offGet['shortcontents'];?>...<br />
                                <a class="violet" href="<?=$offGet['urlname'];?>">[ विस्तृत ]</a>
                            </p>
                        </div>
                        
                    </div>
                   
               </div>
            </div>
    	</div>
    </div>
    
    <div class="span4" style="margin-left:8px;">
		<? $notice=$groups->getById(NOTICE); $noticeGet=$conn->fetchArray($notice); ?>
    	<div class="testimonials-title">
        	<h3 style=""><?=$noticeGet['name'];?></h3>
    	</div>
    	<div class="row">
            <div class="testimonial-list span4" style="margin-top:15px;">
                <div class="tabbable tabs-below">
                    <div class="tab-content">
                        <div class="tab-pane active" id="A">
                            <p style="text-align:justify; font-size:17px">
                                <?=$noticeGet['shortcontents'];?>...<br />
                                <a class="violet" href="<?=$noticeGet['urlname'];?>">[ विस्तृत ]</a>
                            </p>
                        </div>
                        
                    </div>
                   
               </div>
            </div>
    	</div>
    </div>
    
</div>

<div class="presentation container" style="margin-top:5px;">
    <p style="font-size:17px; text-align:justify; color:">
 		<div style="border-top:1px dashed #ddd;"></div>
    </p>
</div>

<!-- Site Description -->
<!--<div class="presentation container">
    <h2>We are <span class="violet">Andia</span>, a super cool design agency.</h2>
    <p>We design beautiful websites, logos and prints. Your project is safe with us.</p>
</div>-->

<!-- Services -->
<div class="what-we-do container">
    <h2 class="publication_title">हाम्रो प्रकाशन</h2>
    <div class="row">
        <? $service=$groups->getByParentIdWithLimit(PUBLICATION, 4);
		while($serviceGet=$conn->fetchArray($service))
		{?>
        	<div class="service span3">
            	<a href="<?=$serviceGet['urlname'];?>" style="padding:0; background:none">
                	<img src="<?=CMS_GROUPS_DIR.$serviceGet['image'];?>" style="width:100%; border-radius:15px 0px;" />
              	</a>
        	</div>
        <? }?>
    </div>
</div>