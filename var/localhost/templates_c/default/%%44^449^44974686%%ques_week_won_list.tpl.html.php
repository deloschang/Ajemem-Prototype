<?php /* Smarty version 2.6.7, created on 2011-10-24 08:59:10
         compiled from leaderboard/ques_week_won_list.tpl.html */ ?>
<div id="leaderboard_lb_ques_won">
<div class="box box-75 altbox">
    <div class="boxin">
	<input type="hidden" name="htot" id="rtot" value='<?php echo $this->_tpl_vars['sm']['next_prev']->total; ?>
'/>
        <input type="hidden" id="qstart" value="<?php echo $this->_tpl_vars['sm']['qstart']; ?>
"/>
        <div class="content">
	    <table  align="center" cellpadding="10" border="1" width="345px;">
		<thead>
		    <th colspan="3" align="center">MOST QUESTION OF THE WEEK WON</th>
		</thead>
		<thead>
		    <th>Position</th>
		    <th align="center">Username</th>
		    <th>Question Won</th>
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
			<tr id="uqid<?php echo $this->_tpl_vars['x']['id_user']; ?>
" class="hndptr" upi="<?php echo $this->_sections['cur']['iteration']+$this->_tpl_vars['sm']['qstart']; ?>
" lid_user="<?php echo $this->_tpl_vars['x']['id_user']; ?>
" lpos="<?php echo $this->_sections['cur']['iteration']+$this->_tpl_vars['sm']['qstart']; ?>
">
			    <td><?php echo $this->_sections['cur']['iteration']+$this->_tpl_vars['sm']['qstart']; ?>
</td>
			    <td><?php echo $this->_tpl_vars['x']['email']; ?>
</td>
			    <td><?php echo $this->_tpl_vars['x']['ques_week_won']; ?>
</td>
			</tr>
		    <?php endfor; else: ?>
			<tr>
			    <td colspan="3">
			    No Question Found.
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

<?php echo '
<script type="text/javascript">
    $(document).ready(function(){
	$(".hndptr").mouseenter(function(){
	    show_profile($(this).attr(\'lid_user\'),$(this).attr(\'lpos\'));
	 });
	
     });
   var id_user=\'';  echo $this->_tpl_vars['sm']['id_user'];  echo '\';
	 if(id_user){
	    var uid=\'uqid\'+id_user;
	    $("#"+uid).css({"color":"red" });
     }
    function show_profile(id_user,pos){
	    var url="http://localhost/";
	    $.post(url,{"page":"leaderboard","choice":"show_profile","id":id_user,pos:pos,ce:0 },function(res){
		  $("#leaderboard_profile").html(res);
	     });
     }

</script>
'; ?>


