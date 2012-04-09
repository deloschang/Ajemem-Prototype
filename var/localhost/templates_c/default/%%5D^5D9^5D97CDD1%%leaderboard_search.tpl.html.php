<?php /* Smarty version 2.6.7, created on 2012-04-01 01:07:58
         compiled from leaderboard/leaderboard_search.tpl.html */ ?>

<!-- Template: leaderboard/leaderboard_search.tpl.html Start 01/04/2012 01:07:58 --> 
 <div id="u_search">
	 <!--<a href="javascript:void(0)" onclick="leaderboard('duels');">MOST DUELS OWN</a>
	 &nbsp;<a href="javascript:void(0)" onclick="leaderboard('exp_point');">MOST EXP POINT GAIN</a>
	 &nbsp;<a href="javascript:void(0)" onclick="leaderboard('ques_won');">MOST QUESTION OF THE WEEK OWN</a>
	 &nbsp;<a href="javascript:void(0)" onclick="leaderboard('achievements');">MOST ACHIEVEMENTS</a>-->
	<div class="fltlft" id="tab">
		<div class="fltlft <?php if ($this->_tpl_vars['sm']['tab'] == 1): ?>selected<?php else: ?>unselected<?php endif; ?>" onclick="leaderboard('duels','1');">
			<a href="javascript:void(0);" >MOST DUELS WON</a>
		</div>
		<div class="fltlft <?php if ($this->_tpl_vars['sm']['tab'] == 2): ?>selected<?php else: ?>unselected<?php endif; ?>" onclick="leaderboard('exp_point','2');">
			<a href="javascript:void(0);" >MOST EXP POINT GAIN</a>
		</div>
		<div class="fltlft <?php if ($this->_tpl_vars['sm']['tab'] == 3): ?>selected<?php else: ?>unselected<?php endif; ?>" onclick="leaderboard('ques_won','3');">
			<a href="javascript:void(0);" >MOST QUESTION OF THE WEEK WON</a>
		</div>
		<div class="fltlft <?php if ($this->_tpl_vars['sm']['tab'] == 4): ?>selected<?php else: ?>unselected<?php endif; ?>" onclick="leaderboard('achievements','4');">
			<a href="javascript:void(0);" >MOST ACHIEVEMENTS</a>
		</div>
	</div>
	<div class="clear"></div>

    <div id="searchuser">
	<fieldset style="width: 320px" >
	    <legend><b>Search User:</b></legend>
	<!--<div><h3>Search User </h3></div>-->
	<form name="usearch" id="usearch" class="basic" method="post" action="javascript:void(0);">
	    <div class="inner-form">
		<table>
		    <tr>
		    <td><label>Username:</label></td>
		    <td>
		    <input type="text" name="uname" id="uname"  value="" class="txt" onKeyup="return serachByEnter(event);" onclick="javascript:clear_me(this.id);"/>
		    </td>
		    <td>
		    <input  type="button" name="btm" value="Search" onclick="user_search();"/>
		    </td>
		    </tr>
		    <tr>
			<td colspan="3">
			   <span class="error" generated="true"  id="hsid"></span>
			</td>
		    </tr>
		</table>
	    </div>
	</form>
	</fieldset>
    </div>
    <div id="leaderboard_leaderboard" style="float:left;" >
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "leaderboard/leaderboard_listall.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
    <div id="leaderboard_profile" style="float:right;"></div>

<?php echo '
<script type="text/javascript">
    function user_search(){
		var lb_flag=\'';  echo $this->_tpl_vars['sm']['lb_flag'];  echo '\';
		var uname=$(\'#uname\').val();
		var url="http://localhost/index.php";
		$.post(url,{"page":"leaderboard","choice":"leaderboard","uname":uname,"lb_flag":lb_flag,chk:1,ce:0 },function(res){
		   $(\'#leaderboard_leaderboard\').html(res);
		 });
     }
    function serachByEnter(event){
	if(event.keyCode == 13){
	    $(\'#uname\').blur();
	    user_search();
	    return false;
	 }
     }
    function clear_me(obj){
		$("#hsid").html(\'\');
     }
    $(document).ready(function(){
		$("#uname").autocomplete(\'http://localhost/index.php?page=leaderboard&choice=auto_comp&ce=0\',{
		    delay: 500
		 });

		// For tab system
		$(\'#tab div\').mouseover(function(){
			if($(this).hasClass(\'selected\'));
			else
				$(this).removeClass(\'unselected\').addClass(\'hover\');
		 }).mouseout(function(){
			if($(this).hasClass(\'selected\'));
			else
			$(this).removeClass(\'hover\').addClass(\'unselected\');
		 });
		/*.click(function(){
			$(\'#tab div\').removeClass(\'selected\').addClass(\'unselected\');
			$(this).removeClass(\'unselected\').removeClass(\'hover\').addClass(\'selected\');
		 });*/
		// End

     });
	function leaderboard(lb_flag,tab){
		var url="http://localhost/index.php";
		$.post(url,{"page":"leaderboard","choice":"leaderboard","lb_flag":lb_flag,chk:1,ce:0,tab:tab },function(res){
			$(\'#u_search\').html(res);
		 });
	 }

</script>
<style type="text/css">
	#tab div	{
		margin-right:2px;
		font-weight:bold;
	 }
	.fltlft	{
		float:left;
	 }
	.unselected	{
		background-color:#AAD8F3;
		width:auto;
		height:23px;
		text-align:center;
		padding-top:7px;
	 }
	.hover	{
		background-color:#CAD8F3;
		height:23px;
		width:auto;
		text-align:center;
		padding-top:7px;
	 }
	.selected	{
		background-color:#4D79A6;
		width:auto;
		height:23px;
		text-align:center;
		padding-top:7px;
	 }
	a{
		text-decoration:none;
	 }
	.borderyes	{
		border:#000000 solid 1px;
	 }
	.hndptr:hover{
		background:#CAD8F3;
	 }
</style>
'; ?>

</div>

<!-- Template: leaderboard/leaderboard_search.tpl.html End --> 