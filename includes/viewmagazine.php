<?php
$mag=$groups->getById(1171);
$magGet=$conn->fetchArray($mag);
?>
<script type="text/javascript" src="pdfviewer/jquery.min.1.7.js"></script>
<script type="text/javascript" src="pdfviewer/modernizr.2.5.3.min.js"></script>
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="span12">
                <i class="icon-flag page-title-icon"></i>
                <h2><?php echo $magGet['name']; ?></h2>
            </div>
        </div>
    </div>
</div>

<!-- Services Full Width Text -->
<div class="services-full-width container">
    <div class="row">
        <div class="services-full-width-text span12">
            <p>
            	<div class="flipbook-viewport">
                    <div class="container" style="border:1px solid">
                        <div class="flipbook">
                        	<?
							$pdf=$groups->getByParentId($magGet['id']);
							while($pdfGet=$conn->fetchArray($pdf))
							{?>
                            	<div>
                                	<img src="<?=CMS_GROUPS_DIR.$pdfGet['image'];?>" />
                                </div>
                            <? }?>
                        </div>
                    </div>
                </div>
            </p>
        </div>
    </div>
</div>

<script type="text/javascript">

function loadApp() {

	// Create the flipbook

	$('.flipbook').turn({
		
			display: 'single',
			
			// Width

			width:1170,
			
			// Height

			height:1440,

			// Elevation

			elevation: 50,
			
			// Enable gradients

			gradients: true,
			
			// Auto center this flipbook

			autoCenter: true

	});
}

// Load the HTML4 version if there's not CSS transform

yepnope({
	test : Modernizr.csstransforms,
	yep: ['pdfviewer/turn.js'],
	nope: ['pdfviewer/turn.html4.min.js'],
	both: ['pdfviewer/basic.css'],
	complete: loadApp
});

</script>