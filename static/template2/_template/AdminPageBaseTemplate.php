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
		<link href="<?php ViewHelper::createStaticUrl($currentTemplate . '/flexigrid/css/flexigrid/flexigrid.css');?>" rel="stylesheet" type="text/css" media="screen" />
		<link href="<?php ViewHelper::createStaticUrl($currentTemplate . '/lib/ui-lightness/jquery-ui-1.8.9.custom.css');?>" rel="stylesheet" type="text/css" />
		<link href="<?php ViewHelper::createStaticUrl($currentTemplate . '/css/print1.css');?>" rel="stylesheet" type="text/css" media="print" />
		<!-- Begin JavaScript -->

		<script type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate .'/lib/jquery-1.4.4.min.js');?>"></script>
		<script type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate .'/lib/jquery.tools.js');?>"></script>
    	<script type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate. '/lib/cufon.js');?>"></script>
    	<script type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate. '/lib/jquery-ui-1.8.9.custom.min.js');?>"></script>
		<script type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate. '/lib/jquery-ui-timepicker-addon.js');?>"></script>
		<script type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate .'/flexigrid/flexigrid.pack.js');?>"></script>
		<script language="javascript" type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate . '/js/jquery/jquery.validate.min.js');?>"></script>
		
    </head>
    <body>
        <div id="bg_top">
            <div id="header">
                <div id="logo">
                    <h1><a href="#"><?php echo $helements[1]['configvalue'] ; ?></a></h1>
                    <a href="#"><small><?php echo $helements[2]['configvalue'] ; ?></small></a>
					<div class="top_right_corner"><div class="top_right_font">  <a href="#"> <?php if(User::IsLoggedIn()){echo 'Welcome ' . User::email(); } ?> </a></div>
				</div>
                </div>

                <div id="menu">
                     <?php if (User::IsLoggedIn()) {?>
               	<ul>
				 <?php if(User::IsAllowed("event")){ ?>	
					<li><a href="<?php ViewHelper::createLinkUrl("event", 'index'); ?>"> Events</a></span></li> <?php }?>
				 <?php if(User::IsAllowed("article")){ ?>	
					<li><a href="<?php ViewHelper::createLinkUrl("article", 'index'); ?>"> Articles</a></span></li> <?php }?>
				 <?php if (User::IsAllowed("file")){ ?>	
					<li><a href="<?php ViewHelper::createLinkUrl("file", 'index'); ?>"> Files</a></span></li><?php }?>
				 <?php if (User::IsAllowed("user")){ ?>	
					<li><a href="<?php ViewHelper::createLinkUrl("user", 'index'); ?>"> Users</a></span></li><?php }?>
				 <?php if (User::IsAllowed("menu")){ ?>	
					<li><a href="<?php ViewHelper::createLinkUrl("menu", 'index'); ?>"> Menu</a></span></li><?php }?>
				 <?php if (User::IsAllowed("config")){ ?>	
					<li><a href="<?php ViewHelper::createLinkUrl("config", 'index'); ?>"> Setup</a></span></li><?php }?>
						
					<li><a href="<?php ViewHelper::createLinkUrl("admin", 'logout'); ?>"> Logout</a></span></li>
				</ul>
				<?php }?>
                </div>
            </div>
            <div id="content">
                <div id="main_bg">
                    <div id="main">
                        <div class="text_box">
                            <div class="index_text_bg">
                                <div class="index_left"><div class="news"><?php require_once 'AdminPageTemplate.php'; ?></div></div>
                                <div class="index_right">
                                    <div class="news"><h4></h4><?php require_once $navigationPath; ?></div></div>
                                <div style="clear: both"></div>
                            </div>
                            <div style="clear: both"></div>
                        </div>

                    </div>
                </div>


                <div id="footer">
                    <div id="footer_bot"><div class="red_hr"></div>
                        <p>Copyright  2011. <a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a> | </p> 
                    </div>
                </div>
            </div>


        </div>
    </body>
</html>
