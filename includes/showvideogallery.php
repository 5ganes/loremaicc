<link rel="stylesheet" href="css/jqvideobox.css" type="text/css" />
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

<?php
$i = 0;
$pagename = $pageUrlName."/";
$sql = "SELECT * FROM groups WHERE parentId = '$pageId' ORDER BY id DESC";

/*$newsql = $sql;
$limit = PAGING_LIMIT;
include("includes/pagination.php");
$return = Pagination($sql, "");

$arr = explode(" -- ", $return);
$start = $arr[0];
$pagelist = $arr[1];
$count = $arr[2];
$newsql .= " LIMIT $start, $limit";*/
$result = mysql_query($sql);
?>

<div class="services-full-width container">
    <div class="row" style="margin-left:5%;">
        <div class="services-full-width-text span12">
            <p>
				<?
                while($row = $conn -> fetchArray($result))
                {
                    $i++;
                    ?>
                    <div class="span3" style="margin-left:0; margin-bottom:10px; min-height:300px;">
                        <iframe id="video" width="245" height="170" src="<?=$row['shortcontents'];?>" frameborder="1" allowfullscreen></iframe>
                        <h4 style="margin:0; padding:0 20px 0 0;"><?=$row['name'];?></h4>
                        <p style="margin:0; padding:0 25px 0 0"><?=$row['contents'];?></p>
                    </div>  
               <? }?>
			</p>
        </div>
    </div>
</div>