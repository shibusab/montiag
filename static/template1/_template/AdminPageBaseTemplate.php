<?php require_once './utility/ViewHelper.php'; require_once './lib/User.php'; $helements= ViewHelper::GetHomePageElements(); $currentTemplate=Registry::get('currenttemplate');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title><?php echo $helements[0]['configvalue'] ?></title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <link href="<?php ViewHelper::createStaticUrl($currentTemplate . '/css/styles.css');?>" rel="stylesheet" type="text/css" media="screen" />
		<link href="<?php ViewHelper::createStaticUrl($currentTemplate . '/css/table.css');?>" rel="stylesheet" type="text/css" media="screen" />
		<link href="<?php ViewHelper::createStaticUrl($currentTemplate . '/flexigrid/css/flexigrid/flexigrid.css');?>" rel="stylesheet" type="text/css" media="screen" />
		<link href="<?php ViewHelper::createStaticUrl($currentTemplate . '/css/print1.css');?>" rel="stylesheet" type="text/css" media="print" />
		
		<!-- Begin JavaScript -->

		<script type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate .'/lib/jquery-1.3.2.min.js');?>"></script>
		<script type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate . '/lib/jquery.tools.js');?>"></script>
    	<script type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate. '/lib/cufon.js');?>"></script>
    	<script type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate. '/lib/jquery.custom.js');?>"></script>
		<script type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate .'/flexigrid/flexigrid.pack.js');?>"></script>
		<script language="javascript" type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate . '/js/jquery/jquery.validate.min.js');?>"></script>
		
    </head>
    <body>
        <div id="wrap">
            <div id="logo">
                <h1><a href="#"><?php echo $helements[1]['configvalue'] ; ?></a></h1>
                <h4><a href="#"><small><?php echo $helements[2]['configvalue'] ; ?></small></a></h4>
				<div class="top_right_corner"><div class="top_right_font">		</div>
				</div>
				
            </div>

            <div id="content_top"></div>
            <div id="content">
                <div id="menu">
				<?php if (User::IsLoggedIn()) {?>
               	<ul>
				 <?php if(User::IsAllowed("articles")){ ?>	
					<li><a href="<?php ViewHelper::createLinkUrl("articles", 'index'); ?>"> Articles</a></span></li> <?php }?>
				 <?php if (User::IsAllowed("files")){ ?>	
					<li><a href="<?php ViewHelper::createLinkUrl("files", 'index'); ?>"> Files</a></span></li><?php }?>
				 <?php if (User::IsAllowed("users")){ ?>	
					<li><a href="<?php ViewHelper::createLinkUrl("users", 'index'); ?>"> Users</a></span></li><?php }?>
				 <?php if (User::IsAllowed("menus")){ ?>	
					<li><a href="<?php ViewHelper::createLinkUrl("menus", 'index'); ?>"> Menu</a></span></li><?php }?>
					
					<li><a href="<?php ViewHelper::createLinkUrl("admin", 'logout'); ?>"> Logout</a></span></li>
				</ul>
				<?php }?>
                </div>
                <div id="index_content">
                    <div class="contact_left">
                        <div class="contact_left_top"></div>
                        <div class="contact_left_bg">
                         <?php require_once 'AdminPageTemplate.php'; ?>
						<div style="clear: both"></div>
                        </div>
						<div class="contact_left_bot"></div>
                    </div>
					
                    <div class="contact_right">
                        <div class="contact_right_top"></div>
                        <div class="bg_right">
                        <div class="contact_right_bg about">
                        <h3>Menu</h3>
                        <div class="bor_right"></div>
                        <div class="rightpanel"><?php require_once $navigationPath; ?></div>
                        <div style="clear: both"></div>
                        </div>
                        </div>
                        <div class="contact_right_bot"></div>
                    </div>
                    <div style="clear: both"></div>
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
