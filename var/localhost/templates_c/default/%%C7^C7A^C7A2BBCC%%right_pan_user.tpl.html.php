<?php /* Smarty version 2.6.7, created on 2012-06-11 00:39:48
         compiled from manage/right_pan_user.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'manage/right_pan_user.tpl.html', 5, false),)), $this); ?>
<?php if ($_SESSION['id_user']): ?>
<link rel="stylesheet" type="text/css" href="http://localhost/templates/css_theme/mainpg.css"/>

		<div id= "other_user_name"><?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['username'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</div>
			<div id="changePhoto">
				<?php if ($this->_tpl_vars['sm']['fb_pic_normal']): ?>
				<img src="<?php echo $this->_tpl_vars['sm']['fb_pic_normal']; ?>
">
				<?php else: ?>
				<img src="http://localhost/image/thumb/avatar/<?php if ($this->_tpl_vars['sm']['avatar']):  echo $this->_tpl_vars['sm']['avatar'];  else:  if ($this->_tpl_vars['sm']['gender'] == 'M'): ?>memeja_male.png<?php else: ?>memeja_female.png<?php endif;  endif; ?>"/>
				<?php endif; ?>
			</div>


		
					
		<div id="more_user_ranking_info">
		<span id="rank">Rank</span>
		<span id="more_ranking_number"><?php if ($this->_tpl_vars['sm']['exp_rank']):  echo $this->_tpl_vars['sm']['exp_rank'];  else: ?>N/A<?php endif; ?></span>
		
		 <div id="total_xp" ><?php if ($this->_tpl_vars['sm']['exp_point']):  echo $this->_tpl_vars['sm']['exp_point'];  endif; ?>
		 <span style="font-size:8px; position:relative; bottom:5px;">XP</span></div>
		 </div>
		 
		<div id="my_meme_list">
				    
		<b>My Memes</b>
        <div id="liked_memes">
	    

		    <?php if ($this->_tpl_vars['sm']['res']): ?>
			<?php unset($this->_sections['cur']);
$this->_sections['cur']['name'] = 'cur';
$this->_sections['cur']['loop'] = is_array($_loop=$this->_tpl_vars['sm']['res']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cur']['show'] = true;
$this->_sections['cur']['max'] = $this->_sections['cur']['loop'];
$this->_sections['cur']['step'] = 1;
$this->_sections['cur']['start'] = $this->_sections['cur']['step'] > 0 ? 0 : $this->_sections['cur']['loop']-1;
if ($this->_sections['cur']['show']) {
    $this->_sections['cur']['total'] = $this->_sections['cur']['loop'];
    if ($this->_sections['cur']['total'] == 0)
        $this->_sections['cur']['show'] = false;
} else
    $this->_sections['cur']['total'] = 0;
if ($this->_sections['cur']['show']):

            for ($this->_sections['cur']['index'] = $this->_sections['cur']['start'], $this->_sections['cur']['iteration'] = 1;
                 $this->_sections['cur']['iteration'] <= $this->_sections['cur']['total'];
                 $this->_sections['cur']['index'] += $this->_sections['cur']['step'], $this->_sections['cur']['iteration']++):
$this->_sections['cur']['rownum'] = $this->_sections['cur']['iteration'];
$this->_sections['cur']['index_prev'] = $this->_sections['cur']['index'] - $this->_sections['cur']['step'];
$this->_sections['cur']['index_next'] = $this->_sections['cur']['index'] + $this->_sections['cur']['step'];
$this->_sections['cur']['first']      = ($this->_sections['cur']['iteration'] == 1);
$this->_sections['cur']['last']       = ($this->_sections['cur']['iteration'] == $this->_sections['cur']['total']);
?>
			<?php $this->assign('x', $this->_tpl_vars['sm']['res'][$this->_sections['cur']['index']]); ?>
			
			<a class="meme_gallery" data-fancybox-group="other_user_meme" id="other_user_meme<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" onclick="show_details('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');" href="http://localhost/image/orig/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
">
			
			<img src="http://localhost/image/thumb/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" style="width: 60px;height: 60px;cursor: pointer;"/></a>
			
			<?php if (( ( $this->_sections['cur']['iteration'] % 3 ) == 0 )): ?>

			<?php endif; ?>
			
			<?php endfor; endif; ?>
			
			
			<?php else: ?>
			No meme found
			<?php endif; ?>
        </div>
		
		<b>
		    Favorites
		</b>
		
<div id="liked_memes">

			<?php if ($this->_tpl_vars['sm']['res_favorite']): ?>
			<?php unset($this->_sections['cur']);
$this->_sections['cur']['name'] = 'cur';
$this->_sections['cur']['loop'] = is_array($_loop=$this->_tpl_vars['sm']['res_favorite']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cur']['show'] = true;
$this->_sections['cur']['max'] = $this->_sections['cur']['loop'];
$this->_sections['cur']['step'] = 1;
$this->_sections['cur']['start'] = $this->_sections['cur']['step'] > 0 ? 0 : $this->_sections['cur']['loop']-1;
if ($this->_sections['cur']['show']) {
    $this->_sections['cur']['total'] = $this->_sections['cur']['loop'];
    if ($this->_sections['cur']['total'] == 0)
        $this->_sections['cur']['show'] = false;
} else
    $this->_sections['cur']['total'] = 0;
if ($this->_sections['cur']['show']):

            for ($this->_sections['cur']['index'] = $this->_sections['cur']['start'], $this->_sections['cur']['iteration'] = 1;
                 $this->_sections['cur']['iteration'] <= $this->_sections['cur']['total'];
                 $this->_sections['cur']['index'] += $this->_sections['cur']['step'], $this->_sections['cur']['iteration']++):
$this->_sections['cur']['rownum'] = $this->_sections['cur']['iteration'];
$this->_sections['cur']['index_prev'] = $this->_sections['cur']['index'] - $this->_sections['cur']['step'];
$this->_sections['cur']['index_next'] = $this->_sections['cur']['index'] + $this->_sections['cur']['step'];
$this->_sections['cur']['first']      = ($this->_sections['cur']['iteration'] == 1);
$this->_sections['cur']['last']       = ($this->_sections['cur']['iteration'] == $this->_sections['cur']['total']);
?>
			<?php $this->assign('x', $this->_tpl_vars['sm']['res_favorite'][$this->_sections['cur']['index']]); ?>
			
			<a class="meme_gallery" data-fancybox-group="other_fav_meme" id="meme_fav_image<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" onclick="show_details('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');" href="http://localhost/image/orig/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
">
			
			<img src="http://localhost/image/thumb/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" style="width: 60px;height: 60px;cursor: pointer;"/></a>
			
			<?php if (( ( $this->_sections['cur']['iteration'] % 3 ) == 0 )): ?>

			<?php endif; ?>	
			<?php endfor; endif; ?>
			<?php else: ?>
			<b>
			Go Honor Some Memes!
			</b>
			<?php endif; ?>

<?php endif; ?>
</div>
</div>