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

<!-- Services Full Width Text -->
<div class="services-full-width container">
    <div class="row">
        <div class="services-full-width-text span12">
            <p>
            	<?
                	$content=$groups->getById($pageId);
					$contentGet=$conn->fetchArray($content);
					echo $contentGet['contents'];
				?>
            </p>
        </div>
    </div>
</div>