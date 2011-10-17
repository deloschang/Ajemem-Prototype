<?php /* Smarty version 2.6.7, created on 2011-09-08 09:14:26
         compiled from admin/achievements/show_page.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ucfirst', 'admin/achievements/show_page.tpl.html', 34, false),array('modifier', 'capitalize', 'admin/achievements/show_page.tpl.html', 35, false),)), $this); ?>
<div id="dv1">
<div class="box box-75 altbox" style="width:1500px">
    <div class="boxin" style="width:1500">
        <div class="header" style="width:1500">
            <h3>Visitors on pages(<?php echo $this->_tpl_vars['sm']['next_prev']->total; ?>
)</h3>
            </div>
        <input type="hidden" id="qstart" value="<?php echo $this->_tpl_vars['sm']['qstart']; ?>
"/>
        <div class="content">
            <table cellspacing="0">
                <thead>
					<th>Name</th>
					<th>user</th>
					<th>Home page</th>
                    <th>Make a meme</th>
                    <th>Funny</th>
					<th>Feature</th>
					<th>Love</th>
					<th>Trees</th>
					<th>Everyday</th>
					<th>Random</th>
					<th>Top memes</th>
					<th>Add caption</th>
					<th>Leaderboard</th>
					<th>What is memeja</th>
					<th>About us</th>
					<th>Visit all pages</th>
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
							<td><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['fname'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['x']['lname'])) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</td>
							<!--<td><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['fname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp, true) : smarty_modifier_capitalize($_tmp, true)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['x']['lname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp, true) : smarty_modifier_capitalize($_tmp, true)); ?>
</td> -->
							<td><?php echo $this->_tpl_vars['x']['email']; ?>
</td>
							<td><?php echo $this->_tpl_vars['x']['home_page']; ?>
</td>
							<td><?php echo $this->_tpl_vars['x']['maka_a_meme']; ?>
</td>
							<td><?php echo $this->_tpl_vars['x']['funny']; ?>
</td>
							<td><?php echo $this->_tpl_vars['x']['feature']; ?>
</td>
							<td><?php echo $this->_tpl_vars['x']['love']; ?>
</td>
							<td><?php echo $this->_tpl_vars['x']['trees']; ?>
</td>
							<td><?php echo $this->_tpl_vars['x']['everyday']; ?>
</td>
							<td><?php echo $this->_tpl_vars['x']['random']; ?>
</td>
							<td><?php echo $this->_tpl_vars['x']['top_memes']; ?>
</td>
							<td><?php echo $this->_tpl_vars['x']['add_caption']; ?>
</td>
							<td><?php echo $this->_tpl_vars['x']['leaderboard']; ?>
</td>
							<td><?php echo $this->_tpl_vars['x']['what_is_memeja']; ?>
</td>
							<td><?php echo $this->_tpl_vars['x']['aboutus']; ?>
</td>
							<td><?php echo $this->_tpl_vars['x']['visitall']; ?>
</td>
			</tr>
						<?php endfor; else: ?>
						<tr>
							 <td colspan="13">
							  No Page information.
							 </td>
						</tr>
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