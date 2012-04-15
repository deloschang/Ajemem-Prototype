<?php /* Smarty version 2.6.7, created on 2012-04-15 03:42:20
         compiled from manage/my_meme_list.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'manage/my_meme_list.tpl.html', 44, false),)), $this); ?>
<?php echo '
<script type="text/javascript">
    function show_details(id_meme){
	//$.fancybox.showActivity();
	$.ajax({
		url: "http://localhost/meme/meme_details",
		type:"POST",
		data: "ce=0&id="+id_meme,
		async:false,
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
</script>
'; ?>

<?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<fieldset style=" background-color:#CAD8F3; width: 200px; margin-left:0px" >
	    <legend>
		<b>
		    <?php if ($this->_tpl_vars['sm']['flg'] == 1): ?>
		    Recently Honored Memes
		    <?php elseif ($this->_tpl_vars['sm']['flg'] == 2): ?>
		    Tagged Meme
		    <?php else: ?>
		    My Memes
		    <?php endif; ?>:
		</b>
	    </legend>
	    <table>
		<tr>
		    <td>
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
			
			<?php elseif ($this->_tpl_vars['sm']['flg'] == 2):  else: ?>
			<a class="meme_gallery" data-fancybox-group="my_meme" id="my_meme_image<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" onclick="show_details('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');" href="http://localhost/image/orig/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
">
			
			<img src="http://localhost/image/thumb/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" style="width: 60px;height: 60px;cursor: pointer;"/></a>
			<?php endif; ?>
			
			<?php if (( ( $this->_sections['cur']['iteration'] % 3 ) == 0 )): ?>
		    </td>
		</tr>
		<tr>
		    <td>
			<?php endif; ?>
			
			<?php endfor; endif; ?>
			<?php else: ?>
			No meme found
			<?php endif; ?>
		    </td>
		</tr>
		<?php if ($this->_tpl_vars['sm']['res']): ?>
		    <?php if ($this->_tpl_vars['sm']['flg'] == 1): ?>
			<tr><td align="right"><a href="http://localhost/manage/my_favorites/"></a></td></tr>
		    <?php elseif ($this->_tpl_vars['sm']['flg'] == 2): ?>
			<tr><td align="right"><a href="http://localhost/manage/tagged_meme/">View all</a></td></tr>
		    <?php elseif ($this->_tpl_vars['sm']['flg'] == 3): ?>
			<tr><td align="right"><a href="http://localhost/manage/dueled_meme/">View all</a></td></tr>
		    <?php else: ?>
			<tr><td align="right"><a href="http://localhost/manage/my_meme_list/"></a></td></tr>
		    <?php endif; ?>
		<?php endif; ?>
	    </table>
</fieldset>