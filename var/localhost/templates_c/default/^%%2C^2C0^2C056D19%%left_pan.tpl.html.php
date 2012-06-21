<?php /* Smarty version 2.6.7, created on 2012-06-21 02:32:06
         compiled from user/left_pan.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'user/left_pan.tpl.html', 5, false),)), $this); ?>
<?php if ($_SESSION['id_user']): ?>

		<div id= "user_name" class="nohighlight">
			<a href ="/?id=<?php echo $_SESSION['dupe_username']; ?>
"><?php echo ((is_array($_tmp=$_SESSION['fname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</a>
			<div class="nav_menu" style="top:37px; left:728px;">
				<div class="hover_menu_contents">
					<ul class="nav_menu_list">
						<li>
							<a href="javascript:void(0); onclick="fb_logout();">Logout</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
					
		<!--<div id="user_ranking_info">
		
		<!-- <div id="total_xp" ><?php if ($_SESSION['exp_point']):  echo $_SESSION['exp_point'];  endif; ?>
		 <span style="font-size:8px; position:relative; bottom:5px;">XP</span></div>
		 </div>
		 
		 
		<div id="other_user_ranking_info" class="softcorner native num_videos">
		<div id="trailing_user"><?php if ($_SESSION['one_less_user']):  echo $_SESSION['one_less_user'];  else: ?>---<?php endif; ?></div>
		<span id="trailing_all"> </span>
		 <span id="trailing_ranking_number"><?php echo $_SESSION['one_less_rank']; ?>
</span>
		<!--<div id="trailing_exp" style="-moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; font-size:12px; position:relative; bottom:4px; margin-left:12px;"><?php if ($_SESSION['one_less_exp']):  echo $_SESSION['one_less_exp'];  else: ?>0<?php endif; ?>
		 <span style="font-size:8px; position:relative; bottom:3px;">XP</span></div>
		</div>-->
		<!--<a href="javascript:void(0);">Account Setting</a>
		  
			
		<!--    <tr>-->
		<!---->
	
     	<br><br> 
			<!-- send a mail from the "Suggestions" hyperlink 
			<a href="mailto:karanchitnis92@gmail.com?Subject=Memeja%20suggestion">Suggestions</a>
		</br></br>-->
		
				
<?php endif; ?>
