<?php /* Smarty version 2.6.7, created on 2012-07-07 05:33:36
         compiled from manage/my_meme_list.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'manage/my_meme_list.tpl.html', 44, false),)), $this); ?>
<?php echo '
<link rel="stylesheet" type="text/css" href="http://localhost/templates/css_theme/mainpg.css"/>

<script type="text/javascript">
    function show_details(id_meme){
		//$.fancybox.showActivity();
		$.ajax({
			url: "http://localhost/meme/meme_details",
			type:"POST",
			data: "ce=0&id="+id_meme
	<!--		success: function(res){-->
	<!--		    $.fancybox(res,{-->
	<!--			centerOnScroll:true,-->
	<!--			onComplete : function (){-->
	<!--			    $.fancybox.resize();-->
	<!--			 }-->
	<!--		     });-->
	<!--		 }-->
		 });
     }
	
	function remove_tag(id_meme,facebook_id){
		var url = "http://localhost/user/remove_tag";
		
		$.post(url, {ce:0, id:id_meme, facebook_id:facebook_id }, function(res){
			$(\'#meme_tagged\'+id_meme).html(\'\');
			$(\'#meme_tagged\'+id_meme+\'x\').hide();
		 });
	 }
</script>

'; ?>

<div id ="user_memes" >
<?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div id = "liked_memes">
		<!-- width of meme in CSS -->
		
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
		
			<?php if ($this->_tpl_vars['sm']['flg'] == 1): ?>
				<a class="meme_gallery" data-fancybox-group="fav_meme" id="meme_fav_image<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" onclick="show_details('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');" href="http://localhost/image/orig/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
">
			
				<img src="http://localhost/image/thumb/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" style="width: 60px;height: 60px;cursor: pointer;"/></a>
		
			<?php elseif ($this->_tpl_vars['sm']['flg'] == 2): ?>
				<a class="meme_gallery" data-fancybox-group="my_meme" id="meme_tagged<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" onclick="show_details('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');" href="http://localhost/image/orig/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
">
			
				<img src="http://localhost/image/thumb/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" style="width: 60px;height: 60px;cursor: pointer;"/></a>
				<span><a href="javascript:void(0);" id="meme_tagged<?php echo $this->_tpl_vars['x']['id_meme']; ?>
x" onclick="remove_tag('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
', '<?php echo $_SESSION['uid']; ?>
');">X</a></span>
				
				<div id="description" style="display: none;">		
					<div>
						Created by <a href="/?id=<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['dupe_username']; ?>
"><?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['username']; ?>
</a>
						
						<?php if ($this->_tpl_vars['x']['who_was_tagged']): ?>
						<div>Tagged: 
								<?php $this->_foreach['cur_meme'] = array('total' => count($_from = (array)$this->_tpl_vars['x']['who_was_tagged']), 'iteration' => 0);
if ($this->_foreach['cur_meme']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['x']):
        $this->_foreach['cur_meme']['iteration']++;
?>
									<span>
										<img src="https://graph.facebook.com/<?php echo $this->_tpl_vars['x']['tagged']; ?>
/picture"/>
										<?php echo $this->_tpl_vars['x']['tag_name']; ?>

									</span>
								<?php endforeach; endif; unset($_from); ?></div>
						<?php endif; ?>
						
						<div class="fb-comments" id="inner" data-href='http://memeja.com/?id=<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['dupe_username']; ?>
&meme=<?php echo $this->_tpl_vars['x']['id_meme']; ?>
' data-num-posts="10" data-width="400"></div>
					</div>
				</div>
			<?php else: ?>
				<a class="meme_gallery" data-fancybox-group="my_meme" id="my_meme_image<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" onclick="show_details('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');" href="http://localhost/image/orig/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
">
			
				<img src="http://localhost/image/thumb/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" style="width: 60px;height: 60px;cursor: pointer;"/></a>
				
				<div id="description" style="display: none;">		
					<div>
						Created by <a href="/?id=<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['dupe_username']; ?>
"><?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['username']; ?>
</a>
						<?php if ($this->_tpl_vars['x']['who_was_tagged']): ?>
						<div>Tagged: 
								<?php $this->_foreach['cur_meme'] = array('total' => count($_from = (array)$this->_tpl_vars['x']['who_was_tagged']), 'iteration' => 0);
if ($this->_foreach['cur_meme']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['x']):
        $this->_foreach['cur_meme']['iteration']++;
?>
									<span>
										<img src="https://graph.facebook.com/<?php echo $this->_tpl_vars['x']['tagged']; ?>
/picture"/>
										<?php echo $this->_tpl_vars['x']['tag_name']; ?>

									</span>
								<?php endforeach; endif; unset($_from); ?></div>
						<?php endif; ?>
						
						<div class="fb-comments" id="inner" data-href='http://memeja.com/?id=<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['dupe_username']; ?>
&meme=<?php echo $this->_tpl_vars['x']['id_meme']; ?>
' data-num-posts="10" data-width="400"></div>
					</div>
				</div>
			<?php endif; ?>
			<?php endfor; endif; ?>
				<?php if ($_SESSION['profile']): ?>
					<a id="create_meme" href="http://localhost/meme/addMeme" title="Create-A-Meme!"><img src="http://localhost/templates/images/tag.png" id="tagg"/></a>
				<?php else: ?>
					<a id="create_meme" href="http://localhost/meme/addMeme" title="Create-A-Meme!"><img src="http://localhost/templates/images/add.png" id="add"/></a>
				<?php endif; ?>
		<?php else: ?>
			<?php if ($this->_tpl_vars['sm']['flg'] == 1): ?>
				<b>No liked memes. Memeja still loves you though</b>
				<?php if ($_SESSION['profile']): ?>
					<a id="create_meme" href="http://localhost/meme/addMeme" title="Create-A-Meme!"><img src="http://localhost/templates/images/tag.png" id="tagg"/></a>
				<?php else: ?>
					<a id="create_meme" href="http://localhost/meme/addMeme" title="Create-A-Meme!"><img src="http://localhost/templates/images/add.png" id="add"/></a>
				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['sm']['flg'] == 2): ?>
				<b>No tags. Lonely Memeja is lonely </b>
				<?php if ($_SESSION['profile']): ?>
					<a id="create_meme" href="http://localhost/meme/addMeme" title="Create-A-Meme!"><img src="http://localhost/templates/images/tag.png" id="tagg"/></a>
				<?php else: ?>
					<a id="create_meme" href="http://localhost/meme/addMeme" title="Create-A-Meme!"><img src="http://localhost/templates/images/add.png" id="add"/></a>
				<?php endif; ?>
			<?php else: ?>
				<b>
					No memes created. 
				</b>
				<?php if ($_SESSION['profile']): ?>
					<a id="create_meme" href="http://localhost/meme/addMeme" title="Create-A-Meme!"><img src="http://localhost/templates/images/tag.png" id="tagg"/></a>
				<?php else: ?>
					<a id="create_meme" href="http://localhost/meme/addMeme" title="Create-A-Meme!"><img src="http://localhost/templates/images/add.png" id="add"/></a>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['sm']['res']): ?>
		    <?php if ($this->_tpl_vars['sm']['flg'] == 1): ?>
				<a href="http://localhost/manage/my_favorites/"></a>
		    <?php elseif ($this->_tpl_vars['sm']['flg'] == 2): ?>
				<a href="http://localhost/manage/tagged_meme/"></a>
		    <?php elseif ($this->_tpl_vars['sm']['flg'] == 3): ?>
				<a href="http://localhost/manage/dueled_meme/">View all</a>
		    <?php else: ?>
				<a href="http://localhost/manage/my_meme_list/"></a>
		    <?php endif; ?>
		<?php endif; ?>
</div>
</div>
