<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2011-09-20 02:20:37
         compiled from user/friend_req_list.tpl.html */ ?>

<!-- Template: user/friend_req_list.tpl.html Start 20/09/2011 02:20:37 --> 
 <?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div id="user_friend_req_list">
    <table >
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
	    <tr>
		<td>
		    <img src="http://memeja.com/<?php echo $this->_tpl_vars['img_path']['avtar_thumb'];  echo $this->_tpl_vars['x']['avatar']; ?>
" />
		</td>
		<td valign="top">
		   <?php echo $this->_tpl_vars['x']['fname']; ?>
 <?php echo $this->_tpl_vars['x']['mname']; ?>
 <?php echo $this->_tpl_vars['x']['lname']; ?>

		</td>
		<td align="right" valign="top">
		    <input type="button" value="Confirm" name="confirm" onclick="confirm('<?php echo $this->_tpl_vars['x']['id_user']; ?>
')" style="cursor:pointer;"/>
		    <input type="button" value="Not Now" name="not_now" onclick="not_now('<?php echo $this->_tpl_vars['x']['id_user']; ?>
')" style="cursor:pointer;"/>
		    
		</td>
	    </tr>
     <?php endfor; else: ?>
		<tr><td colspan="3">No friend request found.</td></tr>
     <?php endif; ?>
    </table>
</div>

<?php echo '
<script type="text/javascript">
   function confirm(id){
       var url="http://memeja.com/index.php";
       $.post(url,{"page":"user","choice":"conf_frnd_request","id":id,"ce":0 },function(res){
	   window.location.reload();
        });
    }
   function not_now(id){
      var url="http://memeja.com/index.php";
       $.post(url,{"page":"user","choice":"rej_frnd_request","id":id,"ce":0 },function(res){
	   window.location.reload();
        });
    }
</script>
'; ?>


=======
<?php /* Smarty version 2.6.7, created on 2011-09-20 02:20:37
         compiled from user/friend_req_list.tpl.html */ ?>

<!-- Template: user/friend_req_list.tpl.html Start 20/09/2011 02:20:37 --> 
 <?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div id="user_friend_req_list">
    <table >
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
	    <tr>
		<td>
		    <img src="http://memeja.com/<?php echo $this->_tpl_vars['img_path']['avtar_thumb'];  echo $this->_tpl_vars['x']['avatar']; ?>
" />
		</td>
		<td valign="top">
		   <?php echo $this->_tpl_vars['x']['fname']; ?>
 <?php echo $this->_tpl_vars['x']['mname']; ?>
 <?php echo $this->_tpl_vars['x']['lname']; ?>

		</td>
		<td align="right" valign="top">
		    <input type="button" value="Confirm" name="confirm" onclick="confirm('<?php echo $this->_tpl_vars['x']['id_user']; ?>
')" style="cursor:pointer;"/>
		    <input type="button" value="Not Now" name="not_now" onclick="not_now('<?php echo $this->_tpl_vars['x']['id_user']; ?>
')" style="cursor:pointer;"/>
		    
		</td>
	    </tr>
     <?php endfor; else: ?>
		<tr><td colspan="3">No friend request found.</td></tr>
     <?php endif; ?>
    </table>
</div>

<?php echo '
<script type="text/javascript">
   function confirm(id){
       var url="http://memeja.com/index.php";
       $.post(url,{"page":"user","choice":"conf_frnd_request","id":id,"ce":0 },function(res){
	   window.location.reload();
        });
    }
   function not_now(id){
      var url="http://memeja.com/index.php";
       $.post(url,{"page":"user","choice":"rej_frnd_request","id":id,"ce":0 },function(res){
	   window.location.reload();
        });
    }
</script>
'; ?>


>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
<!-- Template: user/friend_req_list.tpl.html End --> 