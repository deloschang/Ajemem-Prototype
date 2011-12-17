<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2011-09-19 07:01:47
         compiled from duels/invitefriends.tpl.html */ ?>
<script type="text/javascript" src="http://memeja.com/templates/flexyjs/js/jquery.multiautocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="http://memeja.com/templates/css_theme/multiautocomplete.css"/>
<?php if ($this->_tpl_vars['sm']['duel_flag'] || ! $_SESSION['friends']): ?>
    <div align="center" style="font-size: 16px;color:red;">
	No more users for duel.
    </div>
<?php else: ?>
    <div align="center">
	    <label style="font-size: 16px;">Invite users to duel.</label>
    </div>
<?php endif; ?>
	<div style="width: 310px;height:310px;">
	    <select multiple="multiple" style="display: none;" id="get_friends" name="select2[]"></select>
	</div>
	<div align="center">
	    <input type="button" value="Invite" onclick="send_duelinvitation_to();"/>
	</div>
<?php echo '
<script type="text/javascript">
var flg="';  echo $_SESSION['flg_duel'];  echo '";
    function send_duelinvitation_to(){
	var ids = $("#get_friends").val();
	if(!ids){
	    alert("Select atleast one user to send invitation.");
	    return false;
	 }
	var url = "http://memeja.com/duels/send_duelinvitation_to";
	$.post(url,{ids:ids,ce:0 },function(data){
	    $.fancybox.close();
	    //alert("Your duel invitation sent to these users.");
	    window.location.reload();
	 });
     }
</script>
'; ?>
=======
<?php /* Smarty version 2.6.7, created on 2011-09-19 07:01:47
         compiled from duels/invitefriends.tpl.html */ ?>
<script type="text/javascript" src="http://memeja.com/templates/flexyjs/js/jquery.multiautocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="http://memeja.com/templates/css_theme/multiautocomplete.css"/>
<?php if ($this->_tpl_vars['sm']['duel_flag'] || ! $_SESSION['friends']): ?>
    <div align="center" style="font-size: 16px;color:red;">
	No more users for duel.
    </div>
<?php else: ?>
    <div align="center">
	    <label style="font-size: 16px;">Invite users to duel.</label>
    </div>
<?php endif; ?>
	<div style="width: 310px;height:310px;">
	    <select multiple="multiple" style="display: none;" id="get_friends" name="select2[]"></select>
	</div>
	<div align="center">
	    <input type="button" value="Invite" onclick="send_duelinvitation_to();"/>
	</div>
<?php echo '
<script type="text/javascript">
var flg="';  echo $_SESSION['flg_duel'];  echo '";
    function send_duelinvitation_to(){
	var ids = $("#get_friends").val();
	if(!ids){
	    alert("Select atleast one user to send invitation.");
	    return false;
	 }
	var url = "http://memeja.com/duels/send_duelinvitation_to";
	$.post(url,{ids:ids,ce:0 },function(data){
	    $.fancybox.close();
	    //alert("Your duel invitation sent to these users.");
	    window.location.reload();
	 });
     }
</script>
'; ?>
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
