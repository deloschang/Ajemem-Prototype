<?php /* Smarty version 2.6.7, created on 2011-09-19 23:28:49
         compiled from admin/meme/meme_list.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/meme/meme_list.tpl.html', 42, false),)), $this); ?>
<?php echo $this->_tpl_vars['sm']['sql']; ?>

<?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY'));  $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div id="dv1">
<div class="box box-100 altbox">
    <div class="boxin">
        <div class="header">
	    <h3>Meme List (<?php echo $this->_tpl_vars['sm']['next_prev']->total; ?>
)</h3>
            <a class="button" href="javascript:void(0);" onclick="add_images();">Delete</a>
        </div>
        <input type="hidden" id="qstart" value="<?php echo $this->_tpl_vars['sm']['qstart']; ?>
"/>
        <div class="content">
            <table cellspacing="0">
		    <thead>
			<th>Check/Uncheck<br/>&nbsp;&nbsp;&nbsp;<input type="checkbox" id="chk_unchk" />
			</th>
			<th>Image</th>
			<th>Title</th>
			<th>Category</th>
			<th>Total Honour</th>
			<th>Total Dishonour</th>
			<th>Add Date</th>
			<th>Action</th>
		    </thead>
		    <tbody>

		    <?php unset($this->_sections['cur']);
$this->_sections['cur']['name'] = 'cur';
$this->_sections['cur']['loop'] = is_array($_loop=$this->_tpl_vars['sm']['list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		    <?php $this->assign('x', $this->_tpl_vars['sm']['list'][$this->_sections['cur']['index']]); ?>
			 <tr>
			    <td>
				  <input type="checkbox" name="chk_box" id="chk<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" value="<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" class="chkbox_image"/>
			    </td>
			    <td>
				<img src="http://memeja.com/<?php echo $this->_tpl_vars['img_path']['image_thumb']; ?>
meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" alt="<?php echo $this->_tpl_vars['x']['image']; ?>
"/>
			    </td>
			    <td>
				<nobr/><?php echo $this->_tpl_vars['x']['title']; ?>

			    </td>
			    <td><?php echo $this->_tpl_vars['category'][$this->_tpl_vars['x']['category']]; ?>
</td>
			    <td><?php echo $this->_tpl_vars['x']['tot_honour']; ?>
</td>
			    <td><?php echo $this->_tpl_vars['x']['tot_dishonour']; ?>
</td>
			    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
</td>
			    <td>
				<img src="http://memeja.com/templates/css_theme/img/led-ico/delete.png" alt="delete" title="Delete" onclick="delete_meme('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');"/>
			    </td>
			</tr>
		    <?php endfor; else: ?>
			<tr>
			    <td colspan="5">
			    No Meme Found.
			    </td>
			</tr>
		    <?php endif; ?>
		    </tbody>
            </table>
		<?php if ($this->_tpl_vars['sm']['type'] == 'advance'): ?>
	    <div class="pagination_adv">
	        <?php echo $this->_tpl_vars['sm']['next_prev']->generateadv(); ?>

	    </div>
	<?php elseif ($this->_tpl_vars['sm']['type'] == 'box'): ?>
	    <div class="pagination_box">
	        <div align="center"><?php echo $this->_tpl_vars['sm']['next_prev']->generate(); ?>
</div>
	    </div>
	<?php elseif ($this->_tpl_vars['sm']['type'] == 'normal'): ?>
	    <div class="pagination">
	        <div align="center"><?php echo $this->_tpl_vars['sm']['next_prev']->generate(); ?>
</div>
	    </div>
	<?php elseif ($this->_tpl_vars['sm']['type'] == 'nextprev'): ?>
	    <div class="pagination">
	        <div align="center"><?php echo $this->_tpl_vars['sm']['next_prev']->onlynextprev(); ?>
</div>
	    </div>
	<?php elseif ($this->_tpl_vars['sm']['type'] == 'extra'): ?>
	    <div class="pagination_box">
	        <div align="center"><?php echo $this->_tpl_vars['sm']['next_prev']->generateextra(); ?>
</div>
	    </div>
	<?php else: ?>
	    <?php if ($this->_tpl_vars['sm']['type'] != 'no'): ?>
	        <div>
	            <div align="center"><?php echo $this->_tpl_vars['sm']['next_prev']->generate(); ?>
</div>
	        </div>
	    <?php endif; ?>
	<?php endif; ?>
        </div>
    </div>
</div>
</div>