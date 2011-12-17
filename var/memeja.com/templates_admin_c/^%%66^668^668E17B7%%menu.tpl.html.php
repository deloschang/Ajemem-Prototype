<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2011-09-30 15:51:28
         compiled from admin/menu.tpl.html */ ?>

<!-- Template: admin/menu.tpl.html Start 30/09/2011 15:51:28 --> 
 	<div id="nav_list_cont">
		<ul id="nav_list">
            <li class="border">
            	<a href="http://memeja.com/flexyadmin/" title="Go to Home" class="menu_head">Home</a>
            </li>
            <li class="border">
            	<a href="#" class="menu_head">Management</a>
                <ul style="visibility: hidden;">
                    <li>
                        <div class="nav-col">
                            <a href="http://memeja.com/flexyadmin/meme/list_premadeImages"<?php if ($_REQUEST['page'] == 'meme' && $_REQUEST['choice'] == 'list_premadeImages'): ?>class="current"<?php endif; ?>>Premade Images</a>
                            <a href="http://memeja.com/flexyadmin/cms/list"<?php if ($_REQUEST['page'] == 'cms' && $_REQUEST['choice'] == 'listing'): ?>class="current"<?php endif; ?>>Content</a>
                            <a href="http://memeja.com/flexyadmin/question/list"<?php if ($_REQUEST['page'] == 'question' && $_REQUEST['choice'] == 'list'): ?>class="current"<?php endif; ?>>Question</a>
                            <!--<a href="http://memeja.com/flexyadmin/manage/list"<?php if ($_REQUEST['page'] == 'manage' && $_REQUEST['choice'] == 'list'): ?>class="current"<?php endif; ?>>Badges</a>-->
			    <a href="http://memeja.com/flexyadmin/achievements/list_badge"<?php if ($_REQUEST['page'] == 'achievements' && $_REQUEST['choice'] == 'list_badge'): ?>class="current"<?php endif; ?>>Badges</a>
			    <a href="http://memeja.com/flexyadmin/manage/list_feature"<?php if ($_REQUEST['page'] == 'manage' && $_REQUEST['choice'] == 'list_feature'): ?>class="current"<?php endif; ?>>Features</a>

			    
			    <a href="http://memeja.com/flexyadmin/manage/show_points"<?php if ($_REQUEST['page'] == 'manage' && $_REQUEST['choice'] == 'show_points'): ?>class="current"<?php endif; ?>>Show Points</a>
		    </div>			
			<div class="nav-col Last">
			   
			    <?php if ($_SESSION['id_developer']): ?>
				<!--
				<a href="http://memeja.com/flexyadmin/achievements/list_page"<?php if ($_REQUEST['page'] == 'achievements' && $_REQUEST['choice'] == 'list_page'): ?>class="current"<?php endif; ?>>Pages</a>
				<a href="http://memeja.com/flexyadmin/manage/list_glory"<?php if ($_REQUEST['page'] == 'manage' && $_REQUEST['choice'] == 'list_glory'): ?>class="current"<?php endif; ?>>Glory</a>
				<a href="http://memeja.com/flexyadmin/manage/glory_list"<?php if ($_REQUEST['page'] == 'manage' && $_REQUEST['choice'] == 'glory_list'): ?>class="current"<?php endif; ?>>Glory Details</a>
				<a href="http://memeja.com/flexyadmin/meme/meme_listing"<?php if ($_REQUEST['page'] == 'meme' && $_REQUEST['choice'] == 'meme_listing'): ?>class="current"<?php endif; ?>>Memes</a>
				<a href="http://memeja.com/flexyadmin/manage/list/opt/ok"<?php if ($_REQUEST['page'] == 'manage' && $_REQUEST['choice'] == 'list'): ?>class="current"<?php endif; ?>>glory_icon_badges</a>
				<a href="http://memeja.com/flexyadmin/question/cron_question" <?php if ($_REQUEST['page'] == 'question' && $_REQUEST['choice'] == 'cron_question'): ?>class="current"<?php endif; ?>>cron_question</a>
				
				<a href="http://memeja.com/flexyadmin/meme/show_flag"<?php if ($_REQUEST['page'] == 'meme' && $_REQUEST['choice'] == 'show_flag'): ?>class="current"<?php endif; ?>>Flags</a>
				<a href="http://memeja.com/flexyadmin/module/form_module"<?php if ($_REQUEST['page'] == 'module' && $_REQUEST['choice'] == 'form_module'): ?>class="current"<?php endif; ?>>Module</a>
				<a href="http://memeja.com/flexyadmin/template/show"<?php if ($_REQUEST['page'] == 'template' && $_REQUEST['choice'] == 'show'): ?>class="current"<?php endif; ?>>Template</a>
				-->
			    <?php endif; ?>
			</div>
                    </li>			
                </ul>
            </li>
            <li class="border">
            	<a href="#" class="menu_head">Listing</a>
                <ul class="three-col" style="visibility: hidden;">
                    <li>
                        <div class="nav-col Last">
                         	<!--<a href="http://memeja.com/flexyadmin/user/listing"<?php if ($_REQUEST['page'] == 'user' && $_REQUEST['choice'] == 'listing'): ?>class="current"<?php endif; ?>>User Logs</a>-->
                         	<a href="http://memeja.com/flexyadmin/user/user_listing"<?php if ($_REQUEST['page'] == 'user' && $_REQUEST['choice'] == 'user_listing'): ?>class="current"<?php endif; ?>>User List</a>
                         	<a href="http://memeja.com/flexyadmin/user/log_list"<?php if ($_REQUEST['page'] == 'user' && $_REQUEST['choice'] == 'log_list'): ?>class="current"<?php endif; ?>>User Logs</a>
                         	
			</div>
                    </li>
                </ul>
            </li>
            <li class="border">
            	<a href="#" class="menu_head">Settings</a>
                <ul class="three-col" style="visibility: hidden;">
                    <li>
                        <div class="nav-col Last">
                         	 <a href="http://memeja.com/flexyadmin/setting/listing"<?php if ($_REQUEST['page'] == 'setting' && $_REQUEST['choice'] == 'listing'): ?>class="current"<?php endif; ?>>Config</a>
                             <!--<a href="http://memeja.com/flexyadmin/setting/msg_list"class="current">Message</a>-->
</div>
                    </li>
                </ul>
            </li>
            <li class="border">
            	<a class="menu_head" href="http://memeja.com/" target="_blank">Go to User Site &gt;&gt;</a>
            </li>
        </ul>
    </div>

=======
<?php /* Smarty version 2.6.7, created on 2011-09-30 15:51:28
         compiled from admin/menu.tpl.html */ ?>

<!-- Template: admin/menu.tpl.html Start 30/09/2011 15:51:28 --> 
 	<div id="nav_list_cont">
		<ul id="nav_list">
            <li class="border">
            	<a href="http://memeja.com/flexyadmin/" title="Go to Home" class="menu_head">Home</a>
            </li>
            <li class="border">
            	<a href="#" class="menu_head">Management</a>
                <ul style="visibility: hidden;">
                    <li>
                        <div class="nav-col">
                            <a href="http://memeja.com/flexyadmin/meme/list_premadeImages"<?php if ($_REQUEST['page'] == 'meme' && $_REQUEST['choice'] == 'list_premadeImages'): ?>class="current"<?php endif; ?>>Premade Images</a>
                            <a href="http://memeja.com/flexyadmin/cms/list"<?php if ($_REQUEST['page'] == 'cms' && $_REQUEST['choice'] == 'listing'): ?>class="current"<?php endif; ?>>Content</a>
                            <a href="http://memeja.com/flexyadmin/question/list"<?php if ($_REQUEST['page'] == 'question' && $_REQUEST['choice'] == 'list'): ?>class="current"<?php endif; ?>>Question</a>
                            <!--<a href="http://memeja.com/flexyadmin/manage/list"<?php if ($_REQUEST['page'] == 'manage' && $_REQUEST['choice'] == 'list'): ?>class="current"<?php endif; ?>>Badges</a>-->
			    <a href="http://memeja.com/flexyadmin/achievements/list_badge"<?php if ($_REQUEST['page'] == 'achievements' && $_REQUEST['choice'] == 'list_badge'): ?>class="current"<?php endif; ?>>Badges</a>
			    <a href="http://memeja.com/flexyadmin/manage/list_feature"<?php if ($_REQUEST['page'] == 'manage' && $_REQUEST['choice'] == 'list_feature'): ?>class="current"<?php endif; ?>>Features</a>

			    
			    <a href="http://memeja.com/flexyadmin/manage/show_points"<?php if ($_REQUEST['page'] == 'manage' && $_REQUEST['choice'] == 'show_points'): ?>class="current"<?php endif; ?>>Show Points</a>
		    </div>			
			<div class="nav-col Last">
			   
			    <?php if ($_SESSION['id_developer']): ?>
				<!--
				<a href="http://memeja.com/flexyadmin/achievements/list_page"<?php if ($_REQUEST['page'] == 'achievements' && $_REQUEST['choice'] == 'list_page'): ?>class="current"<?php endif; ?>>Pages</a>
				<a href="http://memeja.com/flexyadmin/manage/list_glory"<?php if ($_REQUEST['page'] == 'manage' && $_REQUEST['choice'] == 'list_glory'): ?>class="current"<?php endif; ?>>Glory</a>
				<a href="http://memeja.com/flexyadmin/manage/glory_list"<?php if ($_REQUEST['page'] == 'manage' && $_REQUEST['choice'] == 'glory_list'): ?>class="current"<?php endif; ?>>Glory Details</a>
				<a href="http://memeja.com/flexyadmin/meme/meme_listing"<?php if ($_REQUEST['page'] == 'meme' && $_REQUEST['choice'] == 'meme_listing'): ?>class="current"<?php endif; ?>>Memes</a>
				<a href="http://memeja.com/flexyadmin/manage/list/opt/ok"<?php if ($_REQUEST['page'] == 'manage' && $_REQUEST['choice'] == 'list'): ?>class="current"<?php endif; ?>>glory_icon_badges</a>
				<a href="http://memeja.com/flexyadmin/question/cron_question" <?php if ($_REQUEST['page'] == 'question' && $_REQUEST['choice'] == 'cron_question'): ?>class="current"<?php endif; ?>>cron_question</a>
				
				<a href="http://memeja.com/flexyadmin/meme/show_flag"<?php if ($_REQUEST['page'] == 'meme' && $_REQUEST['choice'] == 'show_flag'): ?>class="current"<?php endif; ?>>Flags</a>
				<a href="http://memeja.com/flexyadmin/module/form_module"<?php if ($_REQUEST['page'] == 'module' && $_REQUEST['choice'] == 'form_module'): ?>class="current"<?php endif; ?>>Module</a>
				<a href="http://memeja.com/flexyadmin/template/show"<?php if ($_REQUEST['page'] == 'template' && $_REQUEST['choice'] == 'show'): ?>class="current"<?php endif; ?>>Template</a>
				-->
			    <?php endif; ?>
			</div>
                    </li>			
                </ul>
            </li>
            <li class="border">
            	<a href="#" class="menu_head">Listing</a>
                <ul class="three-col" style="visibility: hidden;">
                    <li>
                        <div class="nav-col Last">
                         	<!--<a href="http://memeja.com/flexyadmin/user/listing"<?php if ($_REQUEST['page'] == 'user' && $_REQUEST['choice'] == 'listing'): ?>class="current"<?php endif; ?>>User Logs</a>-->
                         	<a href="http://memeja.com/flexyadmin/user/user_listing"<?php if ($_REQUEST['page'] == 'user' && $_REQUEST['choice'] == 'user_listing'): ?>class="current"<?php endif; ?>>User List</a>
                         	<a href="http://memeja.com/flexyadmin/user/log_list"<?php if ($_REQUEST['page'] == 'user' && $_REQUEST['choice'] == 'log_list'): ?>class="current"<?php endif; ?>>User Logs</a>
                         	
			</div>
                    </li>
                </ul>
            </li>
            <li class="border">
            	<a href="#" class="menu_head">Settings</a>
                <ul class="three-col" style="visibility: hidden;">
                    <li>
                        <div class="nav-col Last">
                         	 <a href="http://memeja.com/flexyadmin/setting/listing"<?php if ($_REQUEST['page'] == 'setting' && $_REQUEST['choice'] == 'listing'): ?>class="current"<?php endif; ?>>Config</a>
                             <!--<a href="http://memeja.com/flexyadmin/setting/msg_list"class="current">Message</a>-->
</div>
                    </li>
                </ul>
            </li>
            <li class="border">
            	<a class="menu_head" href="http://memeja.com/" target="_blank">Go to User Site &gt;&gt;</a>
            </li>
        </ul>
    </div>

>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
<!-- Template: admin/menu.tpl.html End --> 