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

		<script type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate .'/lib/jquery-1.3.2.min.js'); ?>"</script>
		<script type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate .'/lib/jquery.tools.js'); ?>" ></script>
    	<script type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate .'/lib/cufon.js'); ?>"></script>
    	<script type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate .'/lib/jquery.custom.js'); ?>"></script>

		
    </head>
    <body>
        <div id="wrap">
            <div id="logo">
                <h1><a href="#"><?php echo $helements[1]['configvalue'] ; ?></a></h1>
                <h4><a href="#"><small><?php echo $helements[2]['configvalue'] ; ?></small></a></h4>
				<div class="top_right_corner"><div class="top_right_font">
				<a href="<?php ViewHelper::createLinkUrl('language/set', 'en-us'); ?>"> English</a> &nbsp &nbsp
				<a href="<?php ViewHelper::createLinkUrl('language/set', 'es-hn'); ?>"><?php echo htmlentities("Español"); ?></a> 				
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
                </div>
                <div id="header">
                    
					 <div id="slider_bg">
								<div class="waveshow">
									<img src="<?php ViewHelper::createStaticUrl($currentTemplate .'/css/images/header1.jpg');?> " alt="" title="Some Text 1 Goes Here" />
									<img src="<?php ViewHelper::createStaticUrl($currentTemplate .'/css/images/header2.jpg');?> " alt="" title="Some Text 2 Goes Here" />
									<img src="<?php ViewHelper::createStaticUrl($currentTemplate .'/css/images/header3.jpg');?> " alt="" title="Some Text 3 Goes Here" />									
								</div> <!-- waveshow -->
							</div> <!-- slider_bg -->				
                </div>

                <div id="index_content">
                    <div class="index_left">
                        <div class="mini_box_top"></div>
                        <div class="mini_box_bg">
                            <div class="mini_left">
                                <img src="<?php ViewHelper::createStaticUrl($currentTemplate .'/css/images/pastors1.jpg');?>" alt="" title="" />        
                            </div>
                            <div class="mini_right">
                                <h3>Pastors </h3>
                                <p><a href="#">Rev. Jose Romero </a><br />
                                <?php echo htmlentities($helements[3]['configvalue']) ; ?><br />
                                <br />
                                <a href="#">Rev. Marsol Romero.</a><br />
                                Marisol Romero is a worship leader and a women of god, vigilant in the church issues. </p>
                                <div class="read"><a href="http://localhost/mahanaim/post/view/pastor-jose-romero">read more</a></div>
                            </div>
                            <div style="clear: both"></div>
                        </div>
                        <div class="mini_box_bot"></div>

                        <div class="pad"></div>

                        <div class="mini_box_top"> </div>
                        <div class="mini_box_bg">
                            <div class="mini_left1">
                                <h3>Church Activities</h3>
                                <p><a href="#">Vestibulum vel lacus eget nisl </a><br />
                                <?php echo $helements[4]['configvalue'] ; ?><br />
                                <br />
                                <a href="#">Duis in tellus vel ipsum </a><br />
                                bibendum gravida.  Vestibulum tempor </p>  
                                <div class="read"><a href="#">read more</a></div> 
                            </div>
							<div class="mini_left1">
                                <h3>Activities</h3>
                                <p><a href="#">Vestibulum vel lacus eget nisl </a><br />
                                <?php echo $helements[4]['configvalue'] ; ?><br />
                                <br />
                                <a href="#">Duis in tellus vel ipsum </a><br />
                                bibendum gravida.  Vestibulum tempor </p>  
                                <div class="read"><a href="#">read more</a></div> 
                            </div>
                            
                            <div style="clear: both"></div>
                        </div>
                        <div class="mini_box_bot"></div>



                    </div>

                    <div class="index_right">
                        
                        <h2>Activities this Month</h2>
						<ul class="ls">
                            <li><a href="#">Sunday Worship: 11:30 am</a></li>
                            <li><a href="#">Royal Rangers:Tue 7:30 pm</a></li>
                            <li><a href="#">Ladies Ministries</a></li>
                        </ul>
						 <?php echo $template; ?>
						<br><h2>Recent Posts</h2>
                        <?php require_once 'HomePageTemplate.php'; ?>    
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
                            <h3>About Us</h3><?php require_once $navigationPath; ?> </div>
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
