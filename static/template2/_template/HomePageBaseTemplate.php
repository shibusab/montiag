<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php require_once './utility/ViewHelper.php';$helements= ViewHelper::GetHomePageElements(); 	$currentTemplate=Registry::get('currenttemplate');?>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $helements[0]['configvalue'] ?></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="<?php ViewHelper::createStaticUrl($currentTemplate . '/css/styles.css');?>" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php ViewHelper::createStaticUrl($currentTemplate . '/css/print1.css');?>" rel="stylesheet" type="text/css" media="print" />
<script type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate . '/lib/jquery-1.3.2.min.js');?>"></script>
<script type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate . '/lib/easySlider1.7.js');?>"></script>	
	
<script type="text/javascript">
$(document).ready(function(){	
	$("#slider").easySlider({
	auto: true, 
	continuous: true,
	pause: 5000,
	numeric: false
	});
});	
</script>

</head>
    <body>
        <div id="bg_top">
            <div id="header">
                <div id="logo">
                    <h1><a href="#"><?php echo $helements[1]['configvalue'] ; ?></a></h1>
                    <a href="#"><small><?php echo $helements[2]['configvalue'] ; ?></small></a>
					<br><a href="#"><?php if(User::IsLoggedIn()){echo 'Welcome ' . User::email(); } ?></a>
					<div class="top_right_corner"><div class="top_right_font">
						<a href="<?php ViewHelper::createLinkUrl('language/set', 'en-us'); ?>"> English</a> &nbsp &nbsp
						<a href="<?php ViewHelper::createLinkUrl('language/set', 'es-hn'); ?>"> <?php echo htmlentities("Español"); ?></a> 				
					</div>
					</div>
				
                </div>

                <div id="menu">
                    <?php $pages=ViewHelper::ListPages(2); ?>
           		<ul>
					<?php foreach ($pages as $page) 
						  {?><li><a href="<?php ViewHelper::createLinkUrl($page['tag'], 'index'); ?>"> <?php echo $page['menu'] ?> </a></span></li><?php } ?>
				</ul>
                </div>
            </div>
            <div id="content">
            <div id="main_bg">
            <div id="main">
			<div id="slider">
			<ul>				
				<li><img src="<?php ViewHelper::createStaticUrl($currentTemplate . '/images/scroll/easter.jpg');?>" alt="Mahanim Worship" /></li>
				<li><img src="<?php ViewHelper::createStaticUrl($currentTemplate . '/images/scroll/scroll1.jpg');?>" alt="Mahanim Worship" /></li>
				<li><img src="<?php ViewHelper::createStaticUrl($currentTemplate . '/images/scroll/scroll2.jpg');?>" alt="Royal Rangers" /></li>
				<li><img src="<?php ViewHelper::createStaticUrl($currentTemplate . '/images/scroll/scroll3.jpg');?>" alt="Royal Rangers" /></li>
				<li><img src="<?php ViewHelper::createStaticUrl($currentTemplate . '/images/scroll/scroll4.jpg');?>" alt="Worship Service" /></li>
							
			</ul>
			</div>
			<br>
			 <div id="preview_bg">		
				<p><div class="pullquote_left"> <?php echo html_entity_decode($helements[12]['configvalue']) ; ?> </div></p>
			</div>				
					
                        <div style="clear: both"></div> 
                        <div class="text_box">
                            <div class="col3">
                                <div class="col1_3">
                                    <h3><?php echo htmlentities(PASTORS) ;?> </h3>
                                    <a href="" class="pirobox_gal" title="Pastors Pictures"><img src="<?php ViewHelper::createStaticUrl($currentTemplate .'/images/pastors.jpg');?>" alt=""  /></a>
									<h3><br> Rev. Jose Romero <br> Rev. Marisol Romero</h3>
                                    <p><?php echo html_entity_decode($helements[3]['configvalue']) ; ?> </p>
                                    <div class="read"><a href="<?php ViewHelper::createLinkUrl('post', $helements[3]['hyperlink']) ?>"><?php echo htmlentities(READ_MORE) ;?></a></div>
                                </div>
                                <div class="col2_3">
                                    <h3><?php echo htmlentities(ABOUT_US) ;?></h3>
                                   <a href="<?php ViewHelper::createStaticUrl($currentTemplate .'/images/church.jpg');?>" class="pirobox_gal" title="About Us"><img src="<?php ViewHelper::createStaticUrl($currentTemplate .'/images/church.jpg');?>" alt="" class="pirobox_gal" title="Second Image Screenshot" /></a>
                                    <p><?php echo html_entity_decode($helements[10]['configvalue']) ; ?> </p>
                                    <div class="read"><a href="<?php ViewHelper::createLinkUrl('post', $helements[10]['hyperlink']) ?>"><?php echo htmlentities(READ_MORE) ;?></a></div>
                                </div>
                                <div class="col3_3">
                                    <h3><?php echo htmlentities(MISSIONS) ;?> </h3>
                                    <a href="<?php ViewHelper::createStaticUrl($currentTemplate .'/css/images/gal3.jpg');?>" class="pirobox_gal" title="Third Image Screenshot"><img src="<?php ViewHelper::createStaticUrl($currentTemplate .'/css/images/pic4.jpg');?>" alt="" title="" /></a>
                                    <p><?php echo html_entity_decode($helements[11]['configvalue']) ; ?> </p>
                                   <div class="read"><a href="<?php ViewHelper::createLinkUrl('post', $helements[11]['hyperlink']) ?>"><?php echo htmlentities(READ_MORE) ;?></a></div>
                                </div>
                                <div style="clear: both"></div>
                            </div>

                            <div class="index_text_bg">
                                <div class="index_left">
								<h2> <?php echo htmlentities(RECENT_POSTS) ;?> </h2>
                                     <?php require_once 'HomePageTemplate.php'; ?>  
                                </div>
                                <div class="index_right">
                                    <img src="<?php ViewHelper::createStaticUrl($currentTemplate .'/css/images/notebook.png');?>" alt="" title="" style="float: left; padding-right: 10px;" />
                                    <h2><?php echo htmlentities(EVENTS); ;?></h2>
									<?php require_once 'events.php';?>
                                   
                                </div>
                                <div style="clear: both"></div>
                            </div>



                            <div style="clear: both"></div>
                        </div>

                    </div>
                </div>


                <div id="footer">
                    <div class="foot_col1"><h1><?php echo htmlentities(FOOTER_MINISTRIES) ;?></h1></div>
                    <div class="foot_col2"><h1><?php echo htmlentities(REGULAR_PROGRAMS) ;?></h1></div>
					<div class="foot_col3"><h1><?php echo htmlentities(FOOTER_LINK2) ;?></h1></div>
                    <div class="foot_col4"><h1><?php echo htmlentities(FOOTER_ADDRESS) ;?></h1></div>
                    <div class="red_hr"></div>

                    <div class="foot_col1"><?php require_once $navigationPath; ?> </div>
               
                    
                    <div class="foot_col2"><a><ul><?php echo html_entity_decode($helements[13]['configvalue']) ; ?></ul></a></div>
					<div class="foot_col3"><?php echo html_entity_decode($helements[14]['configvalue']) ; ?> </div>
                    <div class="foot_col4">
                        <p class="black"> <?php echo html_entity_decode($helements[6]['configvalue']) ; ?><br />
						 <?php echo $helements[7]['configvalue'] ; ?><br />
						Phone: <?php echo $helements[8]['configvalue'] ; ?><br />
						Email:<?php echo $helements[5]['configvalue'] ; ?></p><br />
                    </div>

                    <div id="footer_bot">
                        <div class="red_hr"></div>
                        <p><?php echo htmlentities(COPYRIGHT) ;?> | <a href="#"><?php echo htmlentities(PRIVACY_POLICY) ;?></a> | <a href="#"><?php echo htmlentities(TERMS_OF_USE) ;?></a> </p> 
	                </div>
				</div>
                </div>
            </div>
    </body>
</html>
