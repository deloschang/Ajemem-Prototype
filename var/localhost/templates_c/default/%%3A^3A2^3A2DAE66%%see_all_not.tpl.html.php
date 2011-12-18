<?php /* Smarty version 2.6.7, created on 2011-10-17 05:11:18
         compiled from manage/see_all_not.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'manage/see_all_not.tpl.html', 6, false),)), $this); ?>

<!-- Template: manage/see_all_not.tpl.html Start 17/10/2011 05:11:18 --> 
 <?php $this->assign('x', $this->_tpl_vars['util']->get_values_from_config('NOTIFY_TYPE')); ?>
<?php if (count($_from = (array)$this->_tpl_vars['sm']['not'])):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
<div id="grp_not_dt<?php echo $this->_tpl_vars['k']; ?>
">
<?php if (((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A %e,%Y") : smarty_modifier_date_format($_tmp, "%A %e,%Y")) == ((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A %e,%Y") : smarty_modifier_date_format($_tmp, "%A %e,%Y"))): ?>
Today
<?php elseif (((is_array($_tmp=time()-24*60*60)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A %e,%Y") : smarty_modifier_date_format($_tmp, "%A %e,%Y")) == ((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A %e,%Y") : smarty_modifier_date_format($_tmp, "%A %e,%Y"))): ?> 
Yesterday
<?php else: ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A %e,%Y") : smarty_modifier_date_format($_tmp, "%A %e,%Y")); ?>

<?php endif; ?>
    <div style="border: 1px solid gainsboro;width: 50%;"></div><br />
    <?php if (count($_from = (array)$this->_tpl_vars['i'])):
    foreach ($_from as $this->_tpl_vars['k1'] => $this->_tpl_vars['i1']):
?>
    <div class="not_dtl" id="not<?php echo $this->_tpl_vars['i1']['id_notification']; ?>
">
	    <span style="float:left;"> <img src="http://localhost/image/thumb/avatar/<?php if ($this->_tpl_vars['sm']['userinfo'][$this->_tpl_vars['i1']['id_user']]['avatar']):  echo $this->_tpl_vars['sm']['userinfo'][$this->_tpl_vars['i1']['id_user']]['avatar'];  elseif ($this->_tpl_vars['sm']['userinfo'][$this->_tpl_vars['i1']['id_user']]['gender'] == 'M'): ?>memeje_male.jpg<?php else: ?>memeje_female.jpg<?php endif; ?>" style="width: 40px;height: 40px;"/></span>


	    <span style="vertical-align:top;"><b><?php echo $this->_tpl_vars['sm']['userinfo'][$this->_tpl_vars['i1']['id_user']]['fname']; ?>
 <?php echo $this->_tpl_vars['sm']['userinfo'][$this->_tpl_vars['i1']['id_user']]['lname']; ?>
</b> 
<?php if ($this->_tpl_vars['i1']['notification_type'] == 2 || $this->_tpl_vars['i1']['notification_type'] == 3): ?>
<a href="http://localhost/duels/list_duels" style="text-decoration:none;"><?php echo $this->_tpl_vars['x'][$this->_tpl_vars['i1']['notification_type']]; ?>
</a>
<?php elseif ($this->_tpl_vars['i1']['notification_type'] == 5): ?>
<a href="http://localhost/user/friend_req_list" style="text-decoration:none;"><?php echo $this->_tpl_vars['x'][$this->_tpl_vars['i1']['notification_type']]; ?>
</a>
<?php elseif ($this->_tpl_vars['i1']['notification_type'] == 1): ?>
<a href="http://localhost/user/all_friends" style="text-decoration:none;"><?php echo $this->_tpl_vars['x'][$this->_tpl_vars['i1']['notification_type']]; ?>
</a>
<?php elseif ($this->_tpl_vars['i1']['notification_type'] == 6): ?>
<a href="http://localhost/manage/tagged_meme" style="text-decoration:none;"><?php echo $this->_tpl_vars['x'][$this->_tpl_vars['i1']['notification_type']]; ?>
</a>
<?php else: ?>
<?php echo $this->_tpl_vars['x'][$this->_tpl_vars['i1']['notification_type']]; ?>

<?php endif; ?>
&emsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['i1']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p")); ?>
</span>

	    <span id="rm_img" style="vertical-align:top;float:right;display:none;cursor: pointer;" onclick="remove_not('<?php echo $this->_tpl_vars['i1']['id_notification']; ?>
');"><img src="http://localhost/spad/site_image/delete.png" title="Remove"/></span>
    </div>
    <div style="height:3px;"></div>
    <?php endforeach; endif; unset($_from); ?><br />
</div>
<?php endforeach; endif; unset($_from); ?>
<?php echo '
<script type="text/javascript">
    $(document).ready(function(){
	    $(".not_dtl").mouseenter(function(){
		$(this).find("#rm_img").show();
	     }).mouseleave(function(){
		$(this).find("#rm_img").hide();
	     });

     });
    function remove_not(id_not){
	var url = "http://localhost/manage/see_all_notification";
	$.post(url, {ce:0,id_not:id_not },function(data){
		($("#not"+id_not).parent().find(".not_dtl").length==1)?$("#not"+id_not).parent().hide():$("#not"+id_not).remove();
	 });
     }
</script>
<style type="text/css">
    .not_dtl{
	height:42px;
	background-color: gainsboro;
	width: 50%;
     }
</style>
'; ?>


<!-- Template: manage/see_all_not.tpl.html End --> 