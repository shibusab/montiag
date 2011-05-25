<?php require_once './utility/ViewHelper.php';$helements= ViewHelper::GetHomePageElements(); $currentTemplate=Registry::get('currenttemplate')?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title><?php echo $helements[0]['configvalue'] ?></title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <link href="<?php ViewHelper::createStaticUrl($currentTemplate . '/css/styles.css');?>" rel="stylesheet" type="text/css" media="screen" />
		<link href="<?php ViewHelper::createStaticUrl($currentTemplate . '/css/print1.css');?>" rel="stylesheet" type="text/css" media="print" />
		
		<!-- Begin JavaScript -->

		<script type="text/javascript" src="$currentTemplate/lib/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="$currentTemplate/lib/jquery.tools.js"></script>
    	<script type="text/javascript" src="$currentTemplate/lib/cufon.js"></script>
    	<script type="text/javascript" src="$currentTemplate/lib/jquery.custom.js"></script>
		
    </head>
    <body>
        <div id="wrap">
            <div id="logo">
                <h1><a href="#"><?php echo $helements[1]['configvalue'] ; ?></a></h1>
                <h4><a href="#"><small><?php echo $helements[2]['configvalue'] ; ?></small></a></h4>
				<div class="top_right_corner"><div class="top_right_font">
				<a href="<?php ViewHelper::createLinkUrl('language/set', 'en-us'); ?>"> English</a> &nbsp &nbsp
				<a href="<?php ViewHelper::createLinkUrl('language/set', 'es-hn'); ?>"> <?php echo htmlentities("Español"); ?></a> 				
				</div>
				</div>
            </div>

            <div id="content_top"></div>
            <div id="content">
                <div id="menu">
                     <?php $pages=ViewHelper::ListPages(2); ?>
           		<ul>
					<?php foreach ($pages as $page) 
						  {?><li><a href="<?php ViewHelper::createLinkUrl($page['tag'], 'index'); ?>"> <?php echo $page['menu'] ?> </a></span></li><?php } ?>
				</ul>
                </div>
                <div id="index_content">
                    <div class="contact_left"><div class="news"><?php require_once 'SubPageTemplate.php'; ?></div></div>
                    <div class="contact_right">
						<div class="contact_right_top"></div>
                        <div class="bg_right">
                            <div class="contact_right_bg about">
                            
                                <h3>News and Announcements</h3>
                                <div class="bor_right"></div>

                                 <div class="rightpanel"><?php require_once $navigationPath; ?></div>
                                <div style="clear: both"></div>
                            </div>
                        </div>
                        <div class="contact_right_bot"></div>
                    </div>
                    <div style="clear: both"></div>
                </div>

<div id="footer_box">
                    <div id="footer_box_top"></div>
                    <div id="footer_box_bg">
                        <div class="foot_col1">
                            <h3>Contact Information</h3>
                            <div class="pad_left" style="background: url(images/home.png) no-repeat left center">
                                <?php echo $helements[6]['configvalue'] ; ?>
                            </div>
                            <div class="pad_left">
                               <?php echo $helements[7]['configvalue'] ; ?>
                            </div>
							<br>
                            <div class="pad_left" style="background: url(images/phone.png) no-repeat left center">
                                Phone: <?php echo $helements[8]['configvalue'] ; ?>
                            </div>
                            <div class="pad_left">
                                
                            </div>
                            <div class="pad_left" style="background: url(images/contact.png) no-repeat left center">
                              Email: <?php echo $helements[5]['configvalue'] ; ?>
                            </div>
                        </div>
                        <div class="foot_col2">
                            <h3> </h3>
                            
                        </div>
                        <div class="foot_col3">
                            <h3>About Us</h3>
                         							
                        </div>
                        <div class="foot_col4">
                            <h3>Follow Us</h3>
                            <div class="link1"><a href="#">Subscribe to Blog</a></div>
                            <div class="link1"><a href="#">Contact Us</a></div>
                              
                        </div>
                        <div style="clear: both"></div>
                    </div>
                    <div id="footer_box_bot"></div>
                </div>
            </div>
            <div id="content_bot"></div>
        </div>
        <div id="footer">
                <div class="red_hr"></div>
                <p>Copyright  2011. <a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a> | <a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional"><abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a> | <a href="http://jigsaw.w3.org/css-validator/check/referer" title="This page validates as CSS"><abbr title="Cascading Style Sheets">CSS</abbr></a></p>
                
                </p>
            </div>
    </body>
</html>
