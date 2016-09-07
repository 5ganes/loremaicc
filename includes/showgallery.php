<!--jquery for gallery light box-->
<!--<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" />-->
<link rel="stylesheet" href="lightbox/lightbox.css" type="text/css" media="screen" />

<link href='http://fonts.googleapis.com/css?family=Fredoka+One|Open+Sans:400,700' rel='stylesheet' type='text/css'>
<script src="lightbox/jquery-1.7.2.min.js"></script>
<script src="lightbox/jquery-ui-1.8.18.custom.min.js"></script>
<script src="lightbox/jquery.smooth-scroll.min.js"></script>
<script src="lightbox/lightbox.js"></script>

<script>
  jQuery(document).ready(function($) {
      $('a').smoothScroll({
        speed: 1000,
        easing: 'easeInOutCubic'
      });

      $('.showOlderChanges').on('click', function(e){
        $('.changelog .old').slideDown('slow');
        $(this).fadeOut();
        e.preventDefault();
      })
  });

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2196019-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!--jquery for gallery light box end-->

<?php //include("includes/breadcrumb.php"); ?>


<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="span12">
                <i class="icon-flag page-title-icon"></i>
                <h2><?php echo $pageName; ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="services-full-width container">
    <div class="row">
        <div class="services-full-width-text span12">

			<div style="margin-bottom:15px; margin-left:12px;">
				<?php 
                $i = 0;
                $pagename = $pageUrlName."/";
                $sql = "SELECT * FROM groups WHERE parentId = $pageId ORDER BY id DESC";
                
                $newsql = $sql;
                
                $limit = PAGING_LIMIT;
                
                include("includes/pagination.php");
                $return = Pagination($sql, "");
                
                
                $arr = explode(" -- ", $return);
                
                $start = $arr[0];
                $pagelist = $arr[1];
                /*$count = $arr[2];*/
                
                $newsql .= " LIMIT $start, 15";
                
                $result = mysql_query($newsql);
                $displayPerRow = 5;
                while ($galleryRow = $conn->fetchArray($result))
                {
                ++$i;
                ?>
                <div class="imageRow" style="background:none; margin:0px; padding:0px; width:231px; float:left; padding-top:5px; padding-bottom:5px;">
                    <div class="set" style="background:none; margin:0px; padding:0px; width:215px">
                            <div class="single" style="float:left; margin-left:10px; margin-bottom:0px; background:none; float:left; width:205px;
                            <?php if($i%$displayPerRow != 0) echo ' margin-right:5px;'; ?> line-height:10px;">
                                    <a style="" rel="lightbox-gallery" href="<?= CMS_GROUPS_DIR . $galleryRow['image'] ?>" 
                                    title="<?php echo $galleryRow['shortcontents']; ?>">
                                            <img src="<?=CMS_GROUPS_DIR.$galleryRow['image']; ?>"alt="<?= $galleryRow['shortcontents']; ?>" 													
                                            title="<?= $galleryRow['shortcontents'];?>" style="margin-top:8px; margin-bottom:8px;border-color:#333;
                                            width:195px; height:155px;" />
                                    </a>
                            </div>
                            <?php if($i%$displayPerRow ==0){ ?>
                                    <!--<div style="clear:both;"></div>-->
                            <?php } ?>
                    </div>
                </div>
				<?php }?>
				<div style=" clear:both;"></div>
			</div>

			<?php
				if($count > $limit)
					echo $pagelist;
			?>
			<div style="clear:both;"></div>

		</div>
    </div>
</div>