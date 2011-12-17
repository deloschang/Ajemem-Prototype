<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2011-09-30 20:57:50
         compiled from meme/dueled_meme.tpl.html */ ?>

<!-- Template: meme/dueled_meme.tpl.html Start 30/09/2011 20:57:50 --> 
 <?php echo '
<script type="text/javascript">
	function show_details(id_meme){
		$.fancybox.showActivity();
		var url = "http://memeja.com/meme/meme_details/";
		$.post(url,{ce:0,id:id_meme },function(res){
			show_fancybox(res);
		 });
    	 }
	function show_tmp_details(id_meme){
		$.fancybox.showActivity();
		var url = "http://memeja.com/meme/meme_details/";
		$.post(url,{ce:0,id:id_meme,fg:1 },function(res){
			show_fancybox(res);
		 });
	 }
</script>
<style type="text/css">
    .divs{
	height:100px;
	width: 100px;
	border: 1px solid;
     }
</style>
'; ?>

<table align="center">
	<?php if ($this->_tpl_vars['sm']['fg']): ?>
		<?php $this->assign('own_id', $_SESSION['id_user']); ?>
		<?php $this->_foreach['nm'] = array('total' => count($_from = (array)$this->_tpl_vars['sm']['user_info']), 'iteration' => 0);
if ($this->_foreach['nm']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['nm']['iteration']++;
?>
			<?php if ($this->_tpl_vars['own_id'] != $this->_tpl_vars['k']): ?>
			<tr>
				<td>
					<div align="center" >
						<?php if ($this->_tpl_vars['sm']['meme_info_tmp'][$this->_tpl_vars['own_id']]['is_transfered_to_meme'] == 1): ?>
						 1<div class="divs" onClick="show_details('<?php echo $this->_tpl_vars['sm']['meme_info'][$this->_tpl_vars['own_id']]['id_meme']; ?>
')"> <img src="http://memeja.com/image/thumb/meme/<?php echo $this->_tpl_vars['sm']['meme_info'][$this->_tpl_vars['own_id']]['image']; ?>
" height="100px;" width="100px;"/></div><br/>
						<?php elseif (@ isset ( $this->_tpl_vars['sm']['meme_info_tmp'][$this->_tpl_vars['own_id']] )): ?>
						  2<div class="divs" onClick="show_tmp_details('<?php echo $this->_tpl_vars['sm']['meme_info_tmp'][$this->_tpl_vars['own_id']]['id_duel_meme']; ?>
')"> <img src="http://memeja.com/image/orig/duel/<?php echo $this->_tpl_vars['sm']['meme_info_tmp'][$this->_tpl_vars['own_id']]['image']; ?>
" height="100px;" width="100px;"/></div><br/>
						<?php else: ?>
						   3 <div class="divs">Not yet posted.</div><br/>
						<?php endif; ?>
						<span>Posted by:<b>You</b></span><br/>
					</div>
				</td>
				<td>VS</td>
				<td>
					<div>
						<?php if ($this->_tpl_vars['sm']['meme_info_tmp'][$this->_tpl_vars['k']]['is_transfered_to_meme'] == 1): ?>
						 1 <div class="divs" onClick="show_details('<?php echo $this->_tpl_vars['sm']['meme_info'][$this->_tpl_vars['k']]['id_meme']; ?>
')"><img src="http://memeja.com/image/thumb/meme/<?php echo $this->_tpl_vars['sm']['meme_info'][$this->_tpl_vars['k']]['image']; ?>
" height="100px;" width="100px;"/></div><br/>
						<?php elseif (@ isset ( $this->_tpl_vars['sm']['meme_info_tmp'][$this->_tpl_vars['k']] )): ?>
						   2<div class="divs" onClick="show_tmp_details('<?php echo $this->_tpl_vars['sm']['meme_info_tmp'][$this->_tpl_vars['k']]['id_duel_meme']; ?>
')"><img src="http://memeja.com/image/orig/duel/<?php echo $this->_tpl_vars['sm']['meme_info_tmp'][$this->_tpl_vars['k']]['image']; ?>
" height="100px;" width="100px;"/></div><br/>
						<?php else: ?>
						   3<div class="divs">Not yet posted.</div><br />
						<?php endif; ?>
						<span>Posted by:<b><?php echo $this->_tpl_vars['i']['fname'];  if ($this->_tpl_vars['i']['mname']): ?> <?php echo $this->_tpl_vars['i']['mname'];  else: ?> <?php endif;  echo $this->_tpl_vars['i']['lname']; ?>
</b></span><br/>
					</div>
				</td>
			</tr>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
		No duels found.
		<?php endif; ?>
</table>

=======
<?php /* Smarty version 2.6.7, created on 2011-09-30 20:57:50
         compiled from meme/dueled_meme.tpl.html */ ?>

<!-- Template: meme/dueled_meme.tpl.html Start 30/09/2011 20:57:50 --> 
 <?php echo '
<script type="text/javascript">
	function show_details(id_meme){
		$.fancybox.showActivity();
		var url = "http://memeja.com/meme/meme_details/";
		$.post(url,{ce:0,id:id_meme },function(res){
			show_fancybox(res);
		 });
    	 }
	function show_tmp_details(id_meme){
		$.fancybox.showActivity();
		var url = "http://memeja.com/meme/meme_details/";
		$.post(url,{ce:0,id:id_meme,fg:1 },function(res){
			show_fancybox(res);
		 });
	 }
</script>
<style type="text/css">
    .divs{
	height:100px;
	width: 100px;
	border: 1px solid;
     }
</style>
'; ?>

<table align="center">
	<?php if ($this->_tpl_vars['sm']['fg']): ?>
		<?php $this->assign('own_id', $_SESSION['id_user']); ?>
		<?php $this->_foreach['nm'] = array('total' => count($_from = (array)$this->_tpl_vars['sm']['user_info']), 'iteration' => 0);
if ($this->_foreach['nm']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['nm']['iteration']++;
?>
			<?php if ($this->_tpl_vars['own_id'] != $this->_tpl_vars['k']): ?>
			<tr>
				<td>
					<div align="center" >
						<?php if ($this->_tpl_vars['sm']['meme_info_tmp'][$this->_tpl_vars['own_id']]['is_transfered_to_meme'] == 1): ?>
						 1<div class="divs" onClick="show_details('<?php echo $this->_tpl_vars['sm']['meme_info'][$this->_tpl_vars['own_id']]['id_meme']; ?>
')"> <img src="http://memeja.com/image/thumb/meme/<?php echo $this->_tpl_vars['sm']['meme_info'][$this->_tpl_vars['own_id']]['image']; ?>
" height="100px;" width="100px;"/></div><br/>
						<?php elseif (@ isset ( $this->_tpl_vars['sm']['meme_info_tmp'][$this->_tpl_vars['own_id']] )): ?>
						  2<div class="divs" onClick="show_tmp_details('<?php echo $this->_tpl_vars['sm']['meme_info_tmp'][$this->_tpl_vars['own_id']]['id_duel_meme']; ?>
')"> <img src="http://memeja.com/image/orig/duel/<?php echo $this->_tpl_vars['sm']['meme_info_tmp'][$this->_tpl_vars['own_id']]['image']; ?>
" height="100px;" width="100px;"/></div><br/>
						<?php else: ?>
						   3 <div class="divs">Not yet posted.</div><br/>
						<?php endif; ?>
						<span>Posted by:<b>You</b></span><br/>
					</div>
				</td>
				<td>VS</td>
				<td>
					<div>
						<?php if ($this->_tpl_vars['sm']['meme_info_tmp'][$this->_tpl_vars['k']]['is_transfered_to_meme'] == 1): ?>
						 1 <div class="divs" onClick="show_details('<?php echo $this->_tpl_vars['sm']['meme_info'][$this->_tpl_vars['k']]['id_meme']; ?>
')"><img src="http://memeja.com/image/thumb/meme/<?php echo $this->_tpl_vars['sm']['meme_info'][$this->_tpl_vars['k']]['image']; ?>
" height="100px;" width="100px;"/></div><br/>
						<?php elseif (@ isset ( $this->_tpl_vars['sm']['meme_info_tmp'][$this->_tpl_vars['k']] )): ?>
						   2<div class="divs" onClick="show_tmp_details('<?php echo $this->_tpl_vars['sm']['meme_info_tmp'][$this->_tpl_vars['k']]['id_duel_meme']; ?>
')"><img src="http://memeja.com/image/orig/duel/<?php echo $this->_tpl_vars['sm']['meme_info_tmp'][$this->_tpl_vars['k']]['image']; ?>
" height="100px;" width="100px;"/></div><br/>
						<?php else: ?>
						   3<div class="divs">Not yet posted.</div><br />
						<?php endif; ?>
						<span>Posted by:<b><?php echo $this->_tpl_vars['i']['fname'];  if ($this->_tpl_vars['i']['mname']): ?> <?php echo $this->_tpl_vars['i']['mname'];  else: ?> <?php endif;  echo $this->_tpl_vars['i']['lname']; ?>
</b></span><br/>
					</div>
				</td>
			</tr>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
		No duels found.
		<?php endif; ?>
</table>

>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
<!-- Template: meme/dueled_meme.tpl.html End --> 