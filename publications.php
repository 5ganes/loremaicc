<? include('clientobjects.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>

	Agriculture Information and Communication Center-

    <?php if($pageName!=""){ echo $pageName;}else if(isset($_GET['action'])){ echo $_GET['action'];}else{ echo "Home";}?>

</title>

<? include('baselocation.php'); ?>

<link href="css/main_styles.css" rel="stylesheet" type="text/css" />

<link href="css/accordion_styles.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery.min.1.4.2.js"></script>

<script type="text/javascript" src="js/ddaccordion.js">

/***********************************************

* Accordion Content script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)

* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts

* This notice must stay intact for legal use

***********************************************/

</script>



<script type="text/javascript">

	ddaccordion.init({

		headerclass: "submenuheader", //Shared CSS class name of headers group

		contentclass: "submenu", //Shared CSS class name of contents group

		revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"

		mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover

		collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 

		defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content

		onemustopen: true, //Specify whether at least one header should be open always (so never all headers closed)

		animatedefault: false, //Should contents open by default be animated into view?

		persiststate: true, //persist state of opened contents within browser session?

		toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]

		togglehtml: ["", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)

		animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"

		oninit:function(headers, expandedindices){ //custom code to run when headers have initalized

			//do nothing

		},

		onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed

			//do nothing

		}

	})

</script>



</head>



<body>



<div id="wrapper">

  	<div id="bodyCtnr">

    	<? include_once('header.php'); ?>
    
    	<div id="bodyMidCtnr">

     	

            <div class="bodyMidLeft">

                
				<? if(isset($_GET['url'])){ $url=$_GET['url']; $act=$groups->getByAlias($url); $actGet=$conn->fetchArray($act); }?>
                <? if($actGet['linkType']=="Activity")
				{?>

				<div class="featuredActivities">
					
                    <h1 style="line-height:30px;"><?=$actGet['name'];?></h1>

                    <ul class="bodyMidLeftLists">

                        <? $activity=$actGet['name']; $cat=mysql_query("select * from groups where activity='$activity' and linktype='Activity' order by weight");

                        while($catGet=$conn->fetchArray($cat))

                        {?>

                            <li><a href="category-<?=$catGet['urlname'];?>.html"><?=$catGet['name'];?></a></li>

                        <? }?>

                    </ul>

                </div>

                <? }?>

                <div class="featuredActivities">

                    <h1>Information Categories</h1>

                    <ul class="bodyMidLeftLists">

                        <? $cat=$groups->getByParentIdWithLimit(1005, 20);

                        while($catGet=$conn->fetchArray($cat))

                        {?>

                            <li><a href="<?=$catGet['urlname'];?>"><?=$catGet['name'];?></a></li>

                        <? }?>

                    </ul>

                </div>

                
                <?php /*?><div class="catalog"><a href="catalog.html"><img src="images/download.png" /></a></div><?php */?>

                <div class="featuredActivities">

                    <!--<h1>WATCH ONLINE</h1>-->

                    <div>

                    	<? $tube=$groups->getById(272); $tubeGet=$conn->fetchArray($tube); ?>    

                        <iframe class="youtube-player" width="255" style="margin-top:3px;" height="225" src="<?=$tubeGet['contents'];?>" allowfullscreen frameborder="0"></iframe>

                 	</div>

                </div>

                

                <div class="featuredActivities" style="margin-top:7px;">

                    <div>    

                        <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fkrishighar%2F301098699990696&amp;width=292&amp;height=264&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:264px;" allowTransparency="true"></iframe>

                 	</div>

                </div>

                
            </div> <!-- 'bodyMidLeft' end -->

 	

    	<div class="bodyMidRight">

            <div class="contentHdr">
                <h2>Our Publications</h2>
            </div>
            <style>
				.content ul{ margin:0; padding:0;}
				.content ul li{ float:left; margin-right:10px}
          	</style>
            <div class="content">
                <ul>
				<?php
                	$pub=$groups->getById(1009); $pubGet=$conn->fetchArray($pub); echo $pubGet['contents'];
					$pubSub=$groups->getByParentId($pubGet['id']);
					while($pubSubGet=$conn->fetchArray($pubSub))
  					{?>
            			<li><a href=""><img src="<?=CMS_GROUPS_DIR.$pubSubGet['image'];?>" width="130" height="105" /></a></li>
            		<? }?>
            		<div style="clear:both"></div>
                </ul>
            </div>

  		</div> <!-- 'bodyMidRight' ends -->

    

    </div> <!-- 'bodyMidCtnr' ends -->
  
  </div> <!-- 'bodyCtnr' ends -->

  <div id="footerCtnr">

    <? include_once('footer.php'); ?>

  </div>

</div> <!-- 'wrapper' ends -->

</body>

</html>