<style>
	.show-links ul{ margin:0; padding:0;}
	.show-links ul li{ margin:9px 5px; border-bottom:1px solid #cdcdcd; list-style:none}
	.show-links ul li:last-child{ border-bottom:none}
	.show-links ul li a{ color:#5d5d5d; font-size:14px}
	.show-links ul li a:hover{ color:#9d426b}
</style> 
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="span12">
                <i class="icon-flag page-title-icon"></i>
                <h2><?php echo $pageName; ?></h2>
                <div style="margin-top:1%; margin-left:2%; float:right"><? include("includes/breadcrumb.php");?></div>
            </div>
        </div>
    </div>
</div>

<!-- Conetnt Full Width Text -->
<div class="services-full-width container">
    <div class="row">
        <div class="services-full-width-text span12">
            <p>
            	<?
                	$content=$groups->getById($pageId);
					$contentGet=$conn->fetchArray($content);
					echo $contentGet['contents'];
					
					$sub=$groups->getByParentId($pageId);
					if(mysql_num_rows($sub)>0)
					{?>
                    	<div class="widget span5">                      
                         	<div class="show-links">
                             	<ul>
								<? while($subGet=$conn->fetchArray($sub))
								{
									if($pageId==LINKS)
										$link=$subGet['contents'];
									else
										$link=$subGet['urlname'];?>
                                    <li>
                                        <a href="<?=$link;?>" <? if($pageId==LINKS) echo 'target="_blank"';?> title="<?=$subGet['name'];?>">
                                            <?=$subGet['name'];?>
                                        </a>
                                    </li>
								<? }?>
								</ul>
                           	</div>
                   		</div>	
					<? }
				?>
            </p>
        </div>
    </div>
</div>