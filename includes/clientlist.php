<style>
	.content ul{ margin:14px}
	.content ul li{background: url("images/common_midCtnr_listArrow.png") no-repeat scroll 0 1px rgba(0, 0, 0, 0);
    font-size: 13px;
    margin: 5px;
    padding: 6px 0 0 12px;}
</style>
<?php //include("includes/breadcrumb.php"); ?>
<div class="contentHdr">

	<h2>Our Clients are:</h2>

</div>

<div class="content">
	<ul>
		<? $client=$groups->getByParentId(241);
		while($clientGet=$conn->fetchArray($client))
		{?>
        	<li style=""><?=$clientGet['name'];?></li>	
       	<? }?> 
	</ul>
</div>