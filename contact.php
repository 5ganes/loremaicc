<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>Agriculture Information & Communucation Center</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Sans">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lobster">-->
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
        <link rel="shortcut icon" href="assets/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

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
        <div class="container">
            <div class="header row">
                <div class="span12">
                    <div class="navbar">
                        <div class="navbar-inner">
                            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </a>
                            <h1>
                                <a class="brand" href="index.php"><img src="assets/img/logo.png" style="width:100%" /></a>
                            </h1>
                            <div class="nav-collapse collapse">
                                <ul class="nav pull-right">
                                    <li class="current-page">
                                        <a href="index.php"><i class="icon-home"></i><br />Home</a>
                                    </li>
                                    <li>
                                        <a href="portfolio.php"><i class="icon-user"></i><br />About Us</a>
                                        <ul>
                                        	<li><a href="">our mission</a></li>
                                            <li><a href="">our vision</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon-phone"></i><br />Organization</a>
                                    </li>
                                    <li>
                                        <a href="services.php"><i class="icon-book"></i><br />Publications</a>
                                    </li>
                                    <li>
                                        <a href="about.php"><i class="icon-user-md"></i><br />Human Resource</a>
                                    </li>
                                    <li>
                                        <a href="about.php"><i class="icon-group"></i><br />Gallery</a>
                                    </li>
                                    <li>
                                        <a href="about.php"><i class="icon-star"></i><br />Notice</a>
                                    </li>
                                    <li>
                                        <a href="about.php"><i class="icon-link"></i><br />Links</a>
                                    </li>
                                    <li>
                                        <a href="about.php"><i class="icon-user"></i><br />Feedback</a>
                                    </li>
                                    <li>
                                        <a href="contact.php"><i class="icon-envelope-alt"></i><br />Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Title -->
        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <i class="icon-envelope-alt page-title-icon"></i>
                        <h2>Contact Us /</h2>
                        <p>Here is how you can contact us</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Us -->
        <div class="contact-us container">
            <div class="row">
                <div class="contact-form span7">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper <a href="">suscipit lobortis</a> nisl ut aliquip ex ea commodo consequat.</p>
                    <form method="post" action="assets/sendmail.php">
                        <label for="name" class="nameLabel">Name</label>
                          <input id="name" type="text" name="name" placeholder="Enter your name...">
                        <label for="email" class="emailLabel">Email</label>
                          <input id="email" type="text" name="email" placeholder="Enter your email...">
                        <label for="subject">Subject</label>
                          <input id="subject" type="text" name="subject" placeholder="Your subject...">
                        <label for="message" class="messageLabel">Message</label>
                          <textarea id="message" name="message" placeholder="Your message..."></textarea>
                        <button type="submit">Send</button>
                    </form>
                </div>
                <div class="contact-address span5">
                    <h4>We Are Here</h4>
                    <div class="map"></div>
                    <h4>Address</h4>
                    <p>Via Principe Amedeo 9 <br> 10100, Torino, TO, Italy</p>
                    <p>Phone: 0039 333 12 68 347</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="widget span3">
                        <h4>About Us</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.</p>
                        <p><a href="">Read more...</a></p>
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
                            	<li><a href="www.krishighar.com">Krishighar.com</a></li>
                                <li><a href="">Important Link2</a></li>
                                <li><a href="">Important Link3</a></li>
                                <li><a href="">Important Link4</a></li>
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
                        <h4>Contact Us</h4>
                        <p><i class="icon-map-marker"></i> Agriculture Information and Communication Centre
                        	Address: Hariharbhawan, Lalitpur</p>
                        <p><i class="icon-phone"></i> Phone: +977-1-5522248, 5525617</p>
                        <p><i class="icon-phone"></i> Fax: +977-1-5522258</p>
                        
                        <p><i class="icon-envelope-alt"></i> Email: <a href="">agroinfo@wlink.com.np</a></p>
                    </div>
                </div>
                <div class="footer-border"></div>
                <div class="row">
                    <div class="copyright span4">
                        <p>Copyright 2015 Agriculture Information and Communication Centre - All rights reserved. Proudy Powered by: <a href="www.krishighar.com">Team Krishighar</a>.</p>
                    </div>
                    <div class="social span8">
                        <a class="facebook" href="" title="Facebook Page"></a>
                        <a class="twitter" href="" title="Twitter"></a>
                        <a class="googleplus" href="" title="Google Plus"></a>
                        <a class="youtube" href="" title="Youtube Channel"></a>
                        <a class="skype" href="" title="Skype"></a>
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
