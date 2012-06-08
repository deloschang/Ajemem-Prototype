<?php /* Smarty version 2.6.7, created on 2012-06-08 07:39:45
         compiled from user/left_pan.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'user/left_pan.tpl.html', 5, false),array('function', 'get_mod', 'user/left_pan.tpl.html', 52, false),)), $this); ?>
<?php $this->_cache_serials['C:/xampp/htdocs/flexycms/../var/localhost/templates_c/default\^%%2C^2C0^2C056D19%%left_pan.tpl.html.inc'] = '00585a4a7b20b4c6cf71acf636c7dc8d';  if ($_SESSION['id_user']): ?>
<table style="margin-top:0px; margin-left:5px;" >
<tr>
		<td><span style="font-weight:bold; font-size:28px; padding-top:5px;"><?php echo ((is_array($_tmp=$_SESSION['username'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</span>
		<span id="left_pan_level" style="font-size:14px; color:#ACACA5; margin-left:2px;"> L<?php echo $_SESSION['level']; ?>
</span></td>
    </tr>
    
    <tr>
		<td valign="top">
			<div id="changePhoto" style="margin-top:1px">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "user/avatar.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
		</td>
    </tr>
     
    <tr>
		<td>
		
					
		<div id="user_ranking_info" style="background-color: #4ebaff; -moz-border-radius: 10px; -webkit-border-radius: 10px; border-radius: 10px; font-family:Verdana; font-weight:bold; color:white; width:90px;height:72px; margin-top:10px; margin-left:5px; text-align:center;" >
		<span id="ranking_number" style="font-family:Verdana; font-size:48px; "><?php if ($_SESSION['exp_rank']):  echo $_SESSION['exp_rank'];  else: ?>N/A<?php endif; ?></span>
		
		 <div id="total_xp" style="font-size:14px; margin-left:12px; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; position:relative; bottom:3px;"><?php if ($_SESSION['exp_point']):  echo $_SESSION['exp_point'];  endif; ?>
		 <span style="font-size:8px; position:relative; bottom:5px;">XP</span></div>
		 </div>
		 
				<div id="other_user_ranking_info" class="softcorner native num_videos" style="background-color: #aad450; -moz-border-radius: 10px; -webkit-border-radius: 10px; border-radius: 10px; width:90px;height:70px; text-align:center; font-family:Verdana; font-weight:bold; color:white; position:relative; left:100px;bottom:70px;" >
		<span id="trailing_all">
		 <span id="trailing_ranking_number" style="font-family:Verdana; font-size:40px;"><?php echo $_SESSION['one_less_rank']; ?>
</span>
		<div id="trailing_exp" style="-moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; font-size:12px; position:relative; bottom:4px; margin-left:12px;"><?php if ($_SESSION['one_less_exp']):  echo $_SESSION['one_less_exp'];  else: ?>0<?php endif; ?>
		 <span style="font-size:8px; position:relative; bottom:3px;">XP</span></div>
		 <div id="trailing_user" style="font-size:8px; position:relative; bottom:4px;"><?php if ($_SESSION['one_less_user']):  echo $_SESSION['one_less_user'];  else: ?>---<?php endif; ?></div> 
		 </div>
		</td>
    </tr>
    <!--
    <tr>
		<td><a href="javascript:void(0);">Account Setting</a></td>
    </tr>-->
    
<!--    <tr>-->
<!---->

<!--    </tr>-->
    <tr>
		<td>
		<div id="my_meme_list" style="margin-top:-60px;">
			<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:00585a4a7b20b4c6cf71acf636c7dc8d#0}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_meme_list','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:00585a4a7b20b4c6cf71acf636c7dc8d#0}';}?>

		</div>
		</td>
    </tr>
	<tr>
		<td>
		<div id="my_favorites" >
			<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:00585a4a7b20b4c6cf71acf636c7dc8d#1}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_favorites','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:00585a4a7b20b4c6cf71acf636c7dc8d#1}';}?>

		</div>
		<br><br> 
			<!-- send a mail from the "Suggestions" hyperlink -->
			<a href="mailto:karanchitnis92@gmail.com?Subject=Memeja%20suggestion">Suggestions</a>
		</br></br>
		</td>
    </tr>
	<tr>     </tr>	
</table>
<?php endif; ?>
