<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2011-09-30 20:57:43
         compiled from duels/list_duels.tpl.html */ ?>

<!-- Template: duels/list_duels.tpl.html Start 30/09/2011 20:57:43 --> 
 <?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div  style="margin-left: 232px"><input type="button" value="Challenge" onclick="inviteduelusers();"/><br></div>
<div id="duel_list">
<form name="duels">
   <center>
    <?php if ($this->_tpl_vars['sm']['res_active']): ?>
    <fieldset style=" background-color:#CAD8F3;width: 550px;border:12px solid gainsboro;">
	 <legend ><b>Active Challenges</b></legend>
	    <?php unset($this->_sections['cur']);
$this->_sections['cur']['name'] = 'cur';
$this->_sections['cur']['loop'] = is_array($_loop=$this->_tpl_vars['sm']['res_active']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	    <?php $this->assign('x', $this->_tpl_vars['sm']['res_active'][$this->_sections['cur']['index']]); ?>

	    <?php if ($_SESSION['id_user'] == $this->_tpl_vars['x']['duelled_to']): ?>
	    <div >
		    <div style="float:left">
			    <div style="margin-left: 150px" class="pimg"><img src="http://memeja.com/image/thumb/avatar/<?php if ($this->_tpl_vars['x']['duelledto_avatar']):  echo $this->_tpl_vars['x']['duelledto_avatar'];  else: ?>memeje_male.jpg<?php endif; ?>" height="50px" width="50px" /></div>
			    <div style="margin-left: 150px">YOU </div>
			    
		    </div>
		    <div>
			  <div height="50" width="50">
				<table>
					<tr>	
						<td>
							<div class="pimg"><img src="http://memeja.com/image/thumb/avatar/<?php if ($this->_tpl_vars['x']['duelledby_avatar']):  echo $this->_tpl_vars['x']['duelledby_avatar'];  else: ?>memeje_male.jpg<?php endif; ?>" height="50px" width="50px"/></div>
						</td>
					</tr>
					<tr>
						<td><?php echo $this->_tpl_vars['x']['duelledby_name']; ?>
</td>
					</tr>
				</table>
			  </div>
		    </div>
		    <div style="float:left">
			    <div style="margin-left: 150px;height: 20px;">
				<?php if ($this->_tpl_vars['x']['is_accepted'] == '0'): ?>
				    <input type="button" id="acpt" name="accept" value="Accept"  onClick="acpt_chall(1,'<?php echo $this->_tpl_vars['x']['id_duel']; ?>
','<?php echo $this->_tpl_vars['x']['duelled_by']; ?>
','<?php echo $this->_tpl_vars['x']['duelled_to']; ?>
');"/>
				    <input type="button" id="ign"  name="ignore" value="Ignore" onClick="acpt_chall(2,'<?php echo $this->_tpl_vars['x']['id_duel']; ?>
','<?php echo $this->_tpl_vars['x']['duelled_by']; ?>
');"/>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['x']['is_accepted'] == '1' && $this->_tpl_vars['x']['duelled_meme'] == ""): ?><input type="button" value="Post Meme" onClick="post_meme();"/> <?php endif; ?>
			    </div>
		    </div>
		    <br/><br/><div style="border: 1px solid gray;"></div> <br/>
	    </div>
	   
	    <?php else: ?>
	    <div>
		<div style="float:left">
		     <div style="margin-left: 150px" class="pimg"><img src="http://memeja.com/image/thumb/avatar/<?php if ($this->_tpl_vars['x']['duelledby_avatar']):  echo $this->_tpl_vars['x']['duelledby_avatar'];  else: ?>memeje_male.jpg<?php endif; ?>" height="50px" width="50px" /></div>
		    <div style="margin-left: 150px">YOU  </div>
		   
		</div>
		<div>
		    <div>
			<table>
				<tr>
					<td>			
						<div><img src="http://memeja.com/image/thumb/avatar/<?php if ($this->_tpl_vars['x']['duelledto_avatar']):  echo $this->_tpl_vars['x']['duelledto_avatar'];  else: ?>memeje_male.jpg<?php endif; ?>" height="50px" width="50px"/></div>
					</td>
				</tr>
				<tr><td><?php echo $this->_tpl_vars['x']['duelledto_name']; ?>
</td></tr>
			</table>						
		    </div>
		    <div style="margin-left: 190px;"><?php if ($this->_tpl_vars['x']['is_accepted'] == '0'): ?>Waiting to approve.<?php endif; ?></div>
		</div>
		<div style="float:left">
		    <div style="margin-left: 150px;height:20px">
			<?php if ($this->_tpl_vars['x']['is_accepted'] == '1' && $this->_tpl_vars['x']['own_meme'] == ""): ?><input type="button" value="Post Meme" onClick="post_meme();"/><?php endif; ?> 
		    </div>
		</div>
		<br/><br/><div style="border: 1px solid gray;"></div><br/>
	    </div>
	    <?php endif; ?>
	<?php endfor; endif; ?>
	</fieldset>
    <?php else: ?>
	<fieldset style="background-color:#CAD8F3;width: 550px;height: 120px;border:12px solid gainsboro;">
	    <legend><b>Active Challenges</b></legend>
	    <h2>No Active Challenges.</h2> 
	</fieldset>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['sm']['res_complete']): ?>
     <fieldset style="background-color:#CAD8F3;width: 550px;border:12px solid gainsboro;">
	 <legend><b>Completed Challenges</b></legend>
	    <?php unset($this->_sections['cur']);
$this->_sections['cur']['name'] = 'cur';
$this->_sections['cur']['loop'] = is_array($_loop=$this->_tpl_vars['sm']['res_complete']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	    <?php $this->assign('x', $this->_tpl_vars['sm']['res_complete'][$this->_sections['cur']['index']]); ?>

		<?php if ($_SESSION['id_user'] == $this->_tpl_vars['x']['duelled_to']): ?>
		    <div>
			<div style="float:left">
			    <div style="margin-left: 150px" class="pimg"><img src="http://memeja.com/image/thumb/avatar/<?php if ($this->_tpl_vars['x']['duelledto_avatar']):  echo $this->_tpl_vars['x']['duelledto_avatar'];  else: ?>memeje_male.jpg<?php endif; ?>" height="50px" width="50px" /></div>
			    <div style="margin-left: 150px">YOU </div>
			</div>
			<div>
			    <div class="pimg"><img src="http://memeja.com/image/thumb/avatar/<?php if ($this->_tpl_vars['x']['duelledby_avatar']):  echo $this->_tpl_vars['x']['duelledby_avatar'];  else: ?>memeje_emale.jpg<?php endif; ?>" height="50px" width="50px" /></div>
			    <div style="margin-left: 190px;"><?php echo $this->_tpl_vars['x']['duelledby_name']; ?>
</div>
			</div>
			
			<br/><br/><div style="border: 1px solid gray;"></div> <br/>
		    </div>
		<?php else: ?>
		    <div >
			<div style="float:left">
			    <div style="margin-left: 150px" class="pimg"><img src="http://memeja.com/image/thumb/avatar/<?php if ($this->_tpl_vars['x']['duelledby_avatar']):  echo $this->_tpl_vars['x']['duelledby_avatar'];  else: ?>memeje_male.jpg<?php endif; ?>" height="50px" width="50px" /></div>
			    <div style="margin-left: 150px">YOU</div>
			</div>
			<div>
			    <div class="pimg"><img src="http://memeja.com/image/thumb/avatar/<?php if ($this->_tpl_vars['x']['duelledto_avatar']):  echo $this->_tpl_vars['x']['duelledto_avatar'];  else: ?>memeje_male.jpg<?php endif; ?>" height="50px" width="50px"/></div>
			    <div style="margin-left: 190px;"><?php echo $this->_tpl_vars['x']['duelledto_name']; ?>
</div>
			</div>
			<br/><br/><div style="border: 1px solid gray;"></div> <br/>
		    </div>
		<?php endif; ?>
	    <?php endfor; endif; ?>
     </fieldset>
    <?php else: ?>
    <fieldset style="background-color:#CAD8F3;width: 550px;height: 120px;border:12px solid gainsboro;">
	 <legend><b>Completed Challenges</b></legend>
		<h2>No Completed Challenges.</h2> 
    </fieldset>
    <?php endif; ?>
   </center>
</form>
</div>
<?php echo '
<script type="text/javascript">
    function acpt_chall(i,id_duel,duelled_by,duelled_to,id_user){
	if(i==1){
	    var fld="is_accepted";
	 }else{
	    var fld="is_ignored";
	 }
	var url="http://memeja.com/index.php";
	$.post(url,{"page":"duels","choice":"accept_challange",fld:fld,id_duel:id_duel,duelled_by:duelled_by,duelled_to:duelled_to,ce:0 },function(res){
	    if(res==1){
		window.location.reload();
	     }else{
		window.location.reload();
		 //$("#duel_list").html(res);
	     }
	 
	 });
     }
    function post_meme(){
		window.location="http://memeja.com/meme/addMeme/duel/1";
     }
    
    function inviteduelusers(){
		// Checking can user send duel invitation or not 
		var url="http://memeja.com/duels/getfriends/ce/0/flg_duel/1";
		var httpRequest = new XMLHttpRequest();
		httpRequest.open(\'POST\', url, false);

		httpRequest.send(); // this blocks as request is synchronous
		if (httpRequest.status == 200) {
			x=httpRequest.responseText;
		 } 
		if(x==1)
			var flag_duel=1;
		else 
			var flag_duel=0;
		// end
		$.fancybox.showActivity();
		url = "http://memeja.com/duels/invitefriends/";
		$.post(url,{ce:0,\'flag_duel\':flag_duel },function(res){
		   $.fancybox(res,{
				\'onComplete\': function() {
				var url = "http://memeja.com/index.php?page=duels&choice=getfriends&ce=0";
				$("#get_friends").autocomplete({json_url:url,height:6 });
				 }
			 });
		 });
	 }
</script>
<style type="text/css">
.pimg{
	height:60px;
 }
</style>
'; ?>


=======
<?php /* Smarty version 2.6.7, created on 2011-09-30 20:57:43
         compiled from duels/list_duels.tpl.html */ ?>

<!-- Template: duels/list_duels.tpl.html Start 30/09/2011 20:57:43 --> 
 <?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div  style="margin-left: 232px"><input type="button" value="Challenge" onclick="inviteduelusers();"/><br></div>
<div id="duel_list">
<form name="duels">
   <center>
    <?php if ($this->_tpl_vars['sm']['res_active']): ?>
    <fieldset style=" background-color:#CAD8F3;width: 550px;border:12px solid gainsboro;">
	 <legend ><b>Active Challenges</b></legend>
	    <?php unset($this->_sections['cur']);
$this->_sections['cur']['name'] = 'cur';
$this->_sections['cur']['loop'] = is_array($_loop=$this->_tpl_vars['sm']['res_active']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	    <?php $this->assign('x', $this->_tpl_vars['sm']['res_active'][$this->_sections['cur']['index']]); ?>

	    <?php if ($_SESSION['id_user'] == $this->_tpl_vars['x']['duelled_to']): ?>
	    <div >
		    <div style="float:left">
			    <div style="margin-left: 150px" class="pimg"><img src="http://memeja.com/image/thumb/avatar/<?php if ($this->_tpl_vars['x']['duelledto_avatar']):  echo $this->_tpl_vars['x']['duelledto_avatar'];  else: ?>memeje_male.jpg<?php endif; ?>" height="50px" width="50px" /></div>
			    <div style="margin-left: 150px">YOU </div>
			    
		    </div>
		    <div>
			  <div height="50" width="50">
				<table>
					<tr>	
						<td>
							<div class="pimg"><img src="http://memeja.com/image/thumb/avatar/<?php if ($this->_tpl_vars['x']['duelledby_avatar']):  echo $this->_tpl_vars['x']['duelledby_avatar'];  else: ?>memeje_male.jpg<?php endif; ?>" height="50px" width="50px"/></div>
						</td>
					</tr>
					<tr>
						<td><?php echo $this->_tpl_vars['x']['duelledby_name']; ?>
</td>
					</tr>
				</table>
			  </div>
		    </div>
		    <div style="float:left">
			    <div style="margin-left: 150px;height: 20px;">
				<?php if ($this->_tpl_vars['x']['is_accepted'] == '0'): ?>
				    <input type="button" id="acpt" name="accept" value="Accept"  onClick="acpt_chall(1,'<?php echo $this->_tpl_vars['x']['id_duel']; ?>
','<?php echo $this->_tpl_vars['x']['duelled_by']; ?>
','<?php echo $this->_tpl_vars['x']['duelled_to']; ?>
');"/>
				    <input type="button" id="ign"  name="ignore" value="Ignore" onClick="acpt_chall(2,'<?php echo $this->_tpl_vars['x']['id_duel']; ?>
','<?php echo $this->_tpl_vars['x']['duelled_by']; ?>
');"/>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['x']['is_accepted'] == '1' && $this->_tpl_vars['x']['duelled_meme'] == ""): ?><input type="button" value="Post Meme" onClick="post_meme();"/> <?php endif; ?>
			    </div>
		    </div>
		    <br/><br/><div style="border: 1px solid gray;"></div> <br/>
	    </div>
	   
	    <?php else: ?>
	    <div>
		<div style="float:left">
		     <div style="margin-left: 150px" class="pimg"><img src="http://memeja.com/image/thumb/avatar/<?php if ($this->_tpl_vars['x']['duelledby_avatar']):  echo $this->_tpl_vars['x']['duelledby_avatar'];  else: ?>memeje_male.jpg<?php endif; ?>" height="50px" width="50px" /></div>
		    <div style="margin-left: 150px">YOU  </div>
		   
		</div>
		<div>
		    <div>
			<table>
				<tr>
					<td>			
						<div><img src="http://memeja.com/image/thumb/avatar/<?php if ($this->_tpl_vars['x']['duelledto_avatar']):  echo $this->_tpl_vars['x']['duelledto_avatar'];  else: ?>memeje_male.jpg<?php endif; ?>" height="50px" width="50px"/></div>
					</td>
				</tr>
				<tr><td><?php echo $this->_tpl_vars['x']['duelledto_name']; ?>
</td></tr>
			</table>						
		    </div>
		    <div style="margin-left: 190px;"><?php if ($this->_tpl_vars['x']['is_accepted'] == '0'): ?>Waiting to approve.<?php endif; ?></div>
		</div>
		<div style="float:left">
		    <div style="margin-left: 150px;height:20px">
			<?php if ($this->_tpl_vars['x']['is_accepted'] == '1' && $this->_tpl_vars['x']['own_meme'] == ""): ?><input type="button" value="Post Meme" onClick="post_meme();"/><?php endif; ?> 
		    </div>
		</div>
		<br/><br/><div style="border: 1px solid gray;"></div><br/>
	    </div>
	    <?php endif; ?>
	<?php endfor; endif; ?>
	</fieldset>
    <?php else: ?>
	<fieldset style="background-color:#CAD8F3;width: 550px;height: 120px;border:12px solid gainsboro;">
	    <legend><b>Active Challenges</b></legend>
	    <h2>No Active Challenges.</h2> 
	</fieldset>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['sm']['res_complete']): ?>
     <fieldset style="background-color:#CAD8F3;width: 550px;border:12px solid gainsboro;">
	 <legend><b>Completed Challenges</b></legend>
	    <?php unset($this->_sections['cur']);
$this->_sections['cur']['name'] = 'cur';
$this->_sections['cur']['loop'] = is_array($_loop=$this->_tpl_vars['sm']['res_complete']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	    <?php $this->assign('x', $this->_tpl_vars['sm']['res_complete'][$this->_sections['cur']['index']]); ?>

		<?php if ($_SESSION['id_user'] == $this->_tpl_vars['x']['duelled_to']): ?>
		    <div>
			<div style="float:left">
			    <div style="margin-left: 150px" class="pimg"><img src="http://memeja.com/image/thumb/avatar/<?php if ($this->_tpl_vars['x']['duelledto_avatar']):  echo $this->_tpl_vars['x']['duelledto_avatar'];  else: ?>memeje_male.jpg<?php endif; ?>" height="50px" width="50px" /></div>
			    <div style="margin-left: 150px">YOU </div>
			</div>
			<div>
			    <div class="pimg"><img src="http://memeja.com/image/thumb/avatar/<?php if ($this->_tpl_vars['x']['duelledby_avatar']):  echo $this->_tpl_vars['x']['duelledby_avatar'];  else: ?>memeje_emale.jpg<?php endif; ?>" height="50px" width="50px" /></div>
			    <div style="margin-left: 190px;"><?php echo $this->_tpl_vars['x']['duelledby_name']; ?>
</div>
			</div>
			
			<br/><br/><div style="border: 1px solid gray;"></div> <br/>
		    </div>
		<?php else: ?>
		    <div >
			<div style="float:left">
			    <div style="margin-left: 150px" class="pimg"><img src="http://memeja.com/image/thumb/avatar/<?php if ($this->_tpl_vars['x']['duelledby_avatar']):  echo $this->_tpl_vars['x']['duelledby_avatar'];  else: ?>memeje_male.jpg<?php endif; ?>" height="50px" width="50px" /></div>
			    <div style="margin-left: 150px">YOU</div>
			</div>
			<div>
			    <div class="pimg"><img src="http://memeja.com/image/thumb/avatar/<?php if ($this->_tpl_vars['x']['duelledto_avatar']):  echo $this->_tpl_vars['x']['duelledto_avatar'];  else: ?>memeje_male.jpg<?php endif; ?>" height="50px" width="50px"/></div>
			    <div style="margin-left: 190px;"><?php echo $this->_tpl_vars['x']['duelledto_name']; ?>
</div>
			</div>
			<br/><br/><div style="border: 1px solid gray;"></div> <br/>
		    </div>
		<?php endif; ?>
	    <?php endfor; endif; ?>
     </fieldset>
    <?php else: ?>
    <fieldset style="background-color:#CAD8F3;width: 550px;height: 120px;border:12px solid gainsboro;">
	 <legend><b>Completed Challenges</b></legend>
		<h2>No Completed Challenges.</h2> 
    </fieldset>
    <?php endif; ?>
   </center>
</form>
</div>
<?php echo '
<script type="text/javascript">
    function acpt_chall(i,id_duel,duelled_by,duelled_to,id_user){
	if(i==1){
	    var fld="is_accepted";
	 }else{
	    var fld="is_ignored";
	 }
	var url="http://memeja.com/index.php";
	$.post(url,{"page":"duels","choice":"accept_challange",fld:fld,id_duel:id_duel,duelled_by:duelled_by,duelled_to:duelled_to,ce:0 },function(res){
	    if(res==1){
		window.location.reload();
	     }else{
		window.location.reload();
		 //$("#duel_list").html(res);
	     }
	 
	 });
     }
    function post_meme(){
		window.location="http://memeja.com/meme/addMeme/duel/1";
     }
    
    function inviteduelusers(){
		// Checking can user send duel invitation or not 
		var url="http://memeja.com/duels/getfriends/ce/0/flg_duel/1";
		var httpRequest = new XMLHttpRequest();
		httpRequest.open(\'POST\', url, false);

		httpRequest.send(); // this blocks as request is synchronous
		if (httpRequest.status == 200) {
			x=httpRequest.responseText;
		 } 
		if(x==1)
			var flag_duel=1;
		else 
			var flag_duel=0;
		// end
		$.fancybox.showActivity();
		url = "http://memeja.com/duels/invitefriends/";
		$.post(url,{ce:0,\'flag_duel\':flag_duel },function(res){
		   $.fancybox(res,{
				\'onComplete\': function() {
				var url = "http://memeja.com/index.php?page=duels&choice=getfriends&ce=0";
				$("#get_friends").autocomplete({json_url:url,height:6 });
				 }
			 });
		 });
	 }
</script>
<style type="text/css">
.pimg{
	height:60px;
 }
</style>
'; ?>


>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
<!-- Template: duels/list_duels.tpl.html End --> 