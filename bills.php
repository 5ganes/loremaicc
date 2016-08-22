<? include("clientobjects.php"); ?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>Agriculture Information & Communucation Center</title>
        <? include("baselocation.php"); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/prettyPhoto/css/prettyPhoto.css">
        <link rel="stylesheet" href="assets/css/flexslider.css">
        <link rel="stylesheet" href="assets/css/font-awesome.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="images/title.ico">
		
        <!--css and jquery fils for dropdown menubar-->
        <link href="css/ddsmoothmenu.css" rel="stylesheet" type="text/css" media="screen" />
		<script src="js/slide.js"></script>
        <script src="js/slides.min.jquery.js"></script>
        <script type="text/javascript" src="js/ddsmoothmenu.js"></script>
   		
		<script type="text/javascript">
			ddsmoothmenu.init({
				mainmenuid: "smoothmenu1", //Menu DIV id
				orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
				classname: 'ddsmoothmenu', //class added to menu's outer DIV
				//customtheme: ["#804000", "#482400"],
				contentsource: "markup", //"markup" or ["container_id", "path_to_menu_file"]
				speed:5000
			})
		</script>
        <!--end of menubar jquery and css-->
        
    </head>

    <body>
    	<div id="fb-root"></div>
			<script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        	</script>

        <!-- Header -->
        <div class="container" style="width:100%">
            <div class="header row" style="width:100%">
                <div class="span12" style="width:100%">
                    <div class="navbar">
                        <div class="navbar-inner" style="background:#2d842d">
                            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </a>
                            <h1>
                                <a class="brand" href="index.php"><img src="assets/img/logo.png" style="width:100%" /></a>
                            </h1>
                            <div class="nav-collapse collapse">
                            	<div id="menu">
        							<div>
                            			<div id="smoothmenu1" class="ddsmoothmenu">
                                    		<? createMenu(0, "Header"); ?>
                               			</div>
                                 	</div>
                              	</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--main content dynamic part-->
		<div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <i class="icon-flag page-title-icon"></i>
                        <h2>भुक्तानीका लागि प्राप्त विलहरुको सार्वजनिकरण</h2>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Services Full Width Text -->
        <div class="services-full-width container">
            <div class="row">
                <div class="services-full-width-text span12">
                    	<style> table{ min-width:270px; width:95%} table tr th{ font-size:15px} table tr td{} </style>
                        <table align="center" border="1" cellspacing="0" cellpadding="7" style="margin-left:30px">
  
    
   
    
    <tbody>
    <tr>
      <th align="center">सि.नं</th>
      <th align="center">विवरण</th>
      <th align="center">ब.उ.शि.नं.</th>
      <th align="center">खर्च शिर्षक</th>
      <th align="center">खरिद प्रक्रिया</th>
      <th align="center">प्यान नं</th>
      <th align="center">भुक्तानी पाउने व्यक्ति/ संस्था</th>
      <th align="center">बिल / निवेदन प्राप्त भएको मिति</th>
      <th align="center">रकम</th>
      <th align="center">कैफियत</th>
      <th align="center">अप्लोड समय</th>
       
    </tr>
    <? $bill=mysql_query("select * from bills order by weight"); $i=0;
	while($billGet=mysql_fetch_array($bill))
	{?>
    	<tr bgcolor="#DFDFDF">
            <td align="center"><?=++$i;?></td>
            <td align="center"><?=$billGet['description'];?></td>
            <td align="center"><?=$billGet['busn'];?></td>
            <td align="center"><?=$billGet['spentTitle'];?></td>
            <td align="center"><?=$billGet['buying'];?></td>
            <td align="center"><?=$billGet['panNo'];?></td>
            <td align="center"><?=$billGet['paymentReceiver'];?></td>
            <td align="center"><?=$billGet['billDate']?></td>
            <td align="center"><?=$billGet['amount'];?></td>
            <td align="center"><?=$billGet['remarks'];?></td>
            <td align="center"><?=$billGet['onDate'];?></td>
    	</tr>
  	<? }?>
       
    </tbody>
    </table>
                    
                </div>
            </div>
        </div>
        
        
        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="widget span3">
                        <? $about=$groups->getById(ABOUTAICC); $aboutGet=$conn->fetchArray($about); ?>
                        <h4><?=$aboutGet['name'];?></h4>
                        <p><?=substr($aboutGet['shortcontents'],0,280);?></p>
                        <p><a href="<?=$aboutGet['urlname'];?>">Read more...</a></p>
                    </div>
                    <div class="widget span3">
                        <h4>Important Links</h4>
						<style>
							.show-links ul{ margin:0; padding:0;}
							.show-links ul li{ margin:9px 5px; border-bottom:1px solid #cdcdcd; list-style:none}
							.show-links ul li:last-child{ border-bottom:none}
							.show-links ul li a{ color:#5d5d5d; font-size:14px}
							.show-links ul li a:hover{ color:#9d426b}
                      	</style>                       
                        <div class="show-links">
                        	<ul>
                            	<? $link=$groups->getByParentIdWithLimit(LINKS,6);
								while($linkGet=$conn->fetchArray($link))
								{?>
                                	<li><a href="<?=$linkGet['contents'];?>" target="_blank" title="<?=$linkGet['name'];?>"><?=$linkGet['name'];?></a></li>
                            	<? }?>
                            </ul>
                        </div>
                    </div>
                    <div class="widget span3">
                        <h4>Connect With Us</h4>
                        <div class="facebook">
                        	<div class="fb-like-box" data-href="https://www.facebook.com/krishighar" data-width="250" data-height="205" data-colorscheme="light" data-show-faces=
                            "true" data-header="true" data-stream="false" data-show-border="true"></div>
                        </div>
                    </div>
                    <div class="widget span3">
                        <? $contact=$groups->getById(CONTACT); $contactGet=$conn->fetchArray($contact); ?>
                        <h4><?=$contactGet['name'];?></h4>
                        <?=$contactGet['shortcontents'];?>
                        
                    </div>
                </div>
                <div class="footer-border"></div>
                <div class="row">
                    <div class="copyright span4">
                        <p>Copyright 20<?=date("y");?>. Agriculture Information and Communication Centre - All rights reserved. Proudy Powered by: <a href="http://www.krishighar.com">Team Krishighar</a>.</p>
                    </div>
                    <div class="social span8">
                        <a class="facebook" href="https://www.facebook.com/krishighar" title="Facebook Page"></a>
                        <a class="twitter" href="https://www.twitter.com/krishighar" title="Twitter"></a>
                        <a class="googleplus" href="https://www.googleplus.com/krishighar" title="Google Plus"></a>
                        <a class="youtube" href="https://www.youtube.com/krishighar" title="Youtube Channel"></a>
                        <a class="skype" href="https://www.skype.com/krishighar" title="Skype"></a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.8.2.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.flexslider.js"></script>
        <!--<script src="assets/js/jquery.tweet.js"></script>-->
        <!--<script src="assets/js/jflickrfeed.js"></script>-->
        <!--<script src="http://maps.google.com/maps/api/js?sensor=true"></script>-->
        <script src="assets/js/jquery.ui.map.min.js"></script>
        <script src="assets/js/jquery.quicksand.js"></script>
        <!--<script src="assets/prettyPhoto/js/jquery.prettyPhoto.js"></script>-->
        <script src="assets/js/scripts.js"></script>

    </body>

</html>