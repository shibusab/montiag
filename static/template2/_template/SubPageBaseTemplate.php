<?php require_once './utility/ViewHelper.php';$helements= ViewHelper::GetHomePageElements(); 	$currentTemplate=Registry::get('currenttemplate');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title><?php echo $helements[0]['configvalue'] ?></title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
		<link href="<?php ViewHelper::createStaticUrl($currentTemplate . '/css/styles.css');?>" rel="stylesheet" type="text/css" media="screen" />
		<link href="<?php ViewHelper::createStaticUrl($currentTemplate . '/css/images/styles.css');?>" rel="stylesheet" type="text/css" />
		<link href="<?php ViewHelper::createStaticUrl($currentTemplate . '/css/print1.css');?>" rel="stylesheet" type="text/css" media="print" />
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
					<a href="<?php ViewHelper::createLinkUrl('language/set', 'es-hn'); ?>"> <?php echo htmlentities("Español"); ?></a> 	<br>
							
					</div>
				</div>
                </div>

                <div id="menu">
                     <?php $pages=ViewHelper::ListPages(2); //(DEBUG=='1')? ViewHelper::LogString("Listing Top Menus in SubPage template"):"";?>
           		<ul>
					<?php foreach ($pages as $page) 
						  {?><li><a href="<?php ViewHelper::createLinkUrl($page['tag'], 'index'); ?>"> <?php echo $page['menu'] ?> </a></span></li><?php } ?>
				</ul>
                </div>
            </div>
            <div id="content">
                <div id="main_bg">
                    <div id="main">
                        <div class="text_box">
                            <div class="index_text_bg">
                                <div class="index_left"><div class="news"><?php require_once 'SubPageTemplate.php'; ?></div></div>
                                <div class="index_right"><div class="news"><h4><?php echo MINISTRIES; ?></h4><?php require_once $navigationPath; ?></div></div>
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

                    <div class="foot_col1">
                          <?php echo "&nbsp"; ?>  
                    </div>
                    <div class="foot_col2"><a><ul><?php echo html_entity_decode(htmlentities($helements[13]['configvalue'])) ; ?></ul></a></div>
<div class="foot_col3"><?php echo html_entity_decode($helements[14]['configvalue']) ; ?> </div>
                    <div class="foot_col4">
                        <p class="black"> <?php echo $helements[6]['configvalue'] ; ?><br />
						<?php echo $helements[7]['configvalue'] ; ?><br />
						Phone: <?php echo $helements[8]['configvalue'] ; ?><br />
						Email:<?php echo $helements[5]['configvalue'] ; ?></p><br />
                       
                    </div>

                    <div id="footer_bot">
                        <div class="red_hr"></div>
                          <p><?php echo htmlentities(COPYRIGHT) ;?> | <a href="#"><?php echo htmlentities(PRIVACY_POLICY) ;?></a> | <a href="#"><?php echo htmlentities(TERMS_OF_USE) ; //(DEBUG=='1')? ViewHelper::LogString("Completed Loading Sub Page Template"):"";?></a> </p> 
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
