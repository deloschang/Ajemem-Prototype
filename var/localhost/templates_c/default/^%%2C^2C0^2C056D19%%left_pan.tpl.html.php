<?php /* Smarty version 2.6.7, created on 2011-12-30 11:52:34
         compiled from user/left_pan.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'user/left_pan.tpl.html', 12, false),array('function', 'get_mod', 'user/left_pan.tpl.html', 49, false),)), $this); ?>
<?php $this->_cache_serials['/opt/lampp/htdocs/flexycms/../var/localhost/templates_c/default/^%%2C^2C0^2C056D19%%left_pan.tpl.html.inc'] = '5a6ba29b41ebd1fcad229c177f5c4e6f';  if ($_SESSION['id_user']): ?>
<table style="margin-top:0px" >
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
		<td><b><?php echo ((is_array($_tmp=$_SESSION['username'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
<span id="left_pan_level"> L<?php echo $_SESSION['level']; ?>
</span></b></td>
    </tr>
    <tr>
		<td><b>
		
				<span id="ranking_number">Rank #<?php if ($_SESSION['exp_rank']):  echo $_SESSION['exp_rank'];  else: ?>N/A<?php endif; ?></span>
		 <span id="total_xp" style="font-size:7px"><?php if ($_SESSION['exp_point']): ?>(<?php echo $_SESSION['exp_point']; ?>
 XP)<?php endif; ?></span></b>
		 <br/>
				<span id="trailing_all">
		 <b><span id="trailing_ranking_number" style="font-size:10px"> Rank #<?php echo $_SESSION['one_less_rank']; ?>
</span></b>
		<b><span id="trailing_exp" style="font-size:7px">(<?php if ($_SESSION['one_less_exp']):  echo $_SESSION['one_less_exp'];  else: ?>0<?php endif; ?> XP)</span></b> 	
		 <span id="trailing_user"><?php if ($_SESSION['one_less_user']):  echo $_SESSION['one_less_user'];  else: ?>---<?php endif; ?></span> 
		 </span>
		 
		</td>
    </tr>
    <!--
    <tr>
		<td><a href="javascript:void(0);">Account Setting</a></td>
    </tr>-->
    
    <tr>

    </tr>
    
    <tr>
    
		<td>
		</td>
    </tr>
    <tr>
		<td>
		<div id="my_meme_list" >
			<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:5a6ba29b41ebd1fcad229c177f5c4e6f#0}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_meme_list','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:5a6ba29b41ebd1fcad229c177f5c4e6f#0}';}?>

		</div>
		</td>
    </tr>
	<tr>
		<td>
		<div id="my_favorites" >
			<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:5a6ba29b41ebd1fcad229c177f5c4e6f#1}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_favorites','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:5a6ba29b41ebd1fcad229c177f5c4e6f#1}';}?>

		</div>
		</td>
    </tr>
	<tr>     </tr>
	
</table>
<?php endif; ?>
