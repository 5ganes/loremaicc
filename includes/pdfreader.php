<? 
	$url=$_GET['url'];
	$pdf=$groups->getByURLName($url);
	//$pdfGet=$conn->fetchArray($pdf);
?>
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="span12">
                <i class="icon-flag page-title-icon"></i>
                <h2><?=$pdf['name'];?></h2>
            </div>
        </div>
    </div>
</div>

<!-- Services Full Width Text -->
<div class="services-full-width container">
    <div class="row">
        <div class="services-full-width-text span12">
            <p>
            	<object data="<?=CMS_FILES_DIR.$pdf['contents'];?>" type="application/pdf" width="100%" height="100%">
                 	<p>It appears you don't have a PDF plugin for this browser.
                  	No biggie... you can <a href="<?=CMS_FILES_DIR.$pdf['contents'];?>">click here to
                  	download the PDF file.</a></p>
            	</object>		
            </p>
        </div>
    </div>
</div>