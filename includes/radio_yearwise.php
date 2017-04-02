<style type="text/css">
	@font-face {
		font-family: "Preeti";
		src: url(font/Preeti.ttf) format("truetype");
	}
	.preetie { 
		font-family: "Preeti", Verdana, Tahoma;
	}
</style>
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="span12">
                <i class="icon-flag page-title-icon"></i>
                <h2>
                	<?php $page = $groups->getByURLName($_GET['url']); echo $page['name']; $pageId = $page['id']; ?>
                </h2>
                <div style="margin-top:1%; margin-left:2%; float:right"><? include("includes/breadcrumb.php");?></div>
            </div>
        </div>
    </div>
</div>

<!-- Services Full Width Text -->
<div class="services-full-width container" style="margin-top:0">
    <div class="row">
        <div class="services-full-width-text span12">
            <p>
            	<div class="magazine">
                
                	<div class="magazinesidebar">
                      	<ul>
                        	<h4 style="padding-left: 0">
                        		<?php $parent = $conn->fetchArray($groups->getById($page['parentId'])); echo $parent['name'];?>
                        	</h4>
                        	<?
                            $cat=$groups->getByParentId($parent['id']);
							while($catGet=$conn->fetchArray($cat))
							{?>
                        		<li>
                                	<a href="radio/<?=$catGet['urlname'];?>">
										<?=$catGet['name'];?>
                                  	</a>
                              	</li>
                        	<? }?>
                        </ul>
                   	</div>
                  	<div class="magazinefile">
                  		<div class="audio">
		                	<ul>
		                    	<?php
		                    	$audio=$groups->getByParentIdWithOrder($pageId, 'weight','DESC');
		                        while($audioGet=$conn->fetchArray($audio))
								{?>
		                    		<li style="list-style: disc">
		                            	<div class="audiotitle">
		                                	<?=$audioGet['name'];?>
		                                </div>
		                                <div class="audiofile">
		                        			<audio controls>
		                              		<source src="<?=CMS_FILES_DIR.$audioGet['contents'];?>" type="audio/mp3">
		                                	<source src="<?=CMS_FILES_DIR.$audioGet['contents'];?>" type="audio/wma">
		                                	<source src="<?=CMS_FILES_DIR.$audioGet['contents'];?>" type="audio/wav">
		                            		</audio>
		                        		</div>
		                                <div style="clear:both"></div>
		                            </li>
		                    	<? }?>
		                    </ul>
		                </div>
                  	</div>
                 	<div style="clear:both"></div>
                            
                </div>
            </p>
        </div>
    </div>
</div>