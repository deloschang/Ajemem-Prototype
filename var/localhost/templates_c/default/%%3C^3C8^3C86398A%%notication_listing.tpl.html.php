<?php /* Smarty version 2.6.7, created on 2011-12-28 13:16:16
         compiled from manage/notication_listing.tpl.html */ ?>
<?php $this->assign('x', $this->_tpl_vars['util']->get_values_from_config('NOTIFY_TYPE')); ?>
<?php if ($this->_tpl_vars['sm']['result']['notifications']): ?>
<?php $this->_foreach['not'] = array('total' => count($_from = (array)$this->_tpl_vars['sm']['result']['notifications']), 'iteration' => 0);
if ($this->_foreach['not']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['not']['iteration']++;
?>
    <?php if ($this->_tpl_vars['i']['notification_type'] == 1): ?>
	<div class="not">
	    <span class="outline_image"> <img src="http://localhost/image/thumb/avatar/<?php if ($this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['avatar']):  echo $this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['avatar'];  elseif ($this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['gender'] == 'M'): ?>memeje_male.jpg<?php else: ?>memeje_female.jpg<?php endif; ?>" style="width: 40px;height: 40px;"/></span>
	    <span><b><?php echo $this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['fname']; ?>
 <?php echo $this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['lname']; ?>
</b><a href="http://localhost/user/all_friends/" class="rmv_uline"> <?php echo $this->_tpl_vars['x'][$this->_tpl_vars['i']['notification_type']]; ?>
</a></span>
	</div>
    <?php elseif ($this->_tpl_vars['i']['notification_type'] == 2): ?>
	<div class="not">
	    <span class="outline_image"> <img src="http://localhost/image/thumb/avatar/<?php if ($this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['avatar']):  echo $this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['avatar'];  elseif ($this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['gender'] == 'M'): ?>memeje_male.jpg<?php else: ?>memeje_female.jpg<?php endif; ?>" style="width: 40px;height: 40px;"/></span>
	    <span><b><?php echo $this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['fname']; ?>
 <?php echo $this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['lname']; ?>
</b> <a href="http://localhost/duels/list_duels" class="rmv_uline"><?php echo $this->_tpl_vars['x'][$this->_tpl_vars['i']['notification_type']]; ?>
</a></span>
	</div>
    <?php elseif ($this->_tpl_vars['i']['notification_type'] == 3): ?>
    <div class="not" style="padding-right:5px;padding-left:5px;">
	   <span class="outline_image"> <img src="http://localhost/image/thumb/avatar/<?php if ($this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['avatar']):  echo $this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['avatar'];  elseif ($this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['gender'] == 'M'): ?>memeje_male.jpg<?php else: ?>memeje_female.jpg<?php endif; ?>" width="40" height="44" /></span>
	   <span style="vertical-align:top;"><b><?php echo $this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['fname']; ?>
 <?php echo $this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['lname']; ?>
</b> <a href="http://localhost/duels/list_duels" class="rmv_uline"><?php echo $this->_tpl_vars['x'][$this->_tpl_vars['i']['notification_type']]; ?>
</a></span>
	</div>
	<?php elseif ($this->_tpl_vars['i']['notification_type'] == 5): ?>
	<div class="not">
	    <span class="outline_image"> <img src="http://localhost/image/thumb/avatar/<?php if ($this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['avatar']):  echo $this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['avatar'];  elseif ($this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['gender'] == 'M'): ?>memeje_male.jpg<?php else: ?>memeje_female.jpg<?php endif; ?>" style="width: 40px;height: 40px;"/></span>
	    <span><b><?php echo $this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['fname']; ?>
 <?php echo $this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['lname']; ?>
</b><a href="http://localhost/user/friend_req_list" class="rmv_uline" title="See friend request" class="rmv_uline"> <?php echo $this->_tpl_vars['x'][$this->_tpl_vars['i']['notification_type']]; ?>
</a></span>
	</div>
    	<?php elseif ($this->_tpl_vars['i']['notification_type'] == 4): ?>
	<div class="not">
	    <span> <img src="http://localhost/image/thumb/avatar/<?php if ($_SESSION['avatar']):  echo $_SESSION['avatar'];  elseif ($_SESSION['gender'] == 'M'): ?>memeje_male.jpg<?php else: ?>memeje_female.jpg<?php endif; ?>" /></span>
	   <span>You   <?php echo $this->_tpl_vars['x'][$this->_tpl_vars['i']['notification_type']]; ?>
</span>
	</div>
	<?php elseif ($this->_tpl_vars['i']['notification_type'] == 6): ?>
	<div class="not">
	    <span class="outline_image"> <img src="http://localhost/image/thumb/avatar/<?php if ($this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['avatar']):  echo $this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['avatar'];  elseif ($this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['gender'] == 'M'): ?>memeje_male.jpg<?php else: ?>memeje_female.jpg<?php endif; ?>" style="width: 40px;height: 40px;"/></span>
	    <span><b><?php echo $this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['fname']; ?>
 <?php echo $this->_tpl_vars['sm']['result']['user_info'][$this->_tpl_vars['i']['id_user']]['lname']; ?>
</b><a href="http://localhost/manage/tagged_meme" class="rmv_uline"> <?php echo $this->_tpl_vars['x'][$this->_tpl_vars['i']['notification_type']]; ?>
</a></span>
	</div>
    <?php endif; ?>
    <div style="border:1px solid gray;"></div>
<?php endforeach; endif; unset($_from); ?>
<div class="see_all_not">
	    See All Notifications
</div>
<?php else: ?>
    No Notification found
<?php endif; ?>
<?php echo '
<script type="text/javascript">
	$(".see_all_not").click(function(){
	    var url = "http://localhost/manage/see_all_notification";
	    window.location = url;
	 });
</script>
<style type="text/css">
    .not{
	height:47px;
	margin-top:1px;
     }
    .outline_image{
	float:left;
     }
    .see_all_not{
	background-color: gainsboro;
	text-align: center;
	font-weight:bold;
	cursor: pointer;
     }
    .rmv_uline{
	text-decoration:none;
     }
</style>
'; ?>
