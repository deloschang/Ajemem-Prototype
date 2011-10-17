<?php /* Smarty version 2.6.7, created on 2011-10-14 19:32:49
         compiled from user/memeje_friends.tpl.html */ ?>

<!-- Template: user/memeje_friends.tpl.html Start 14/10/2011 19:32:49 --> 
 <link rel="stylesheet" type="text/css" href="http://memeja.com/templates/css_theme/filter.css"/>

<div align="center">
      <h2>Add friends to memeje friend list </h2>
      <div> You have currently <?php if ($this->_tpl_vars['sm']['frnds_cnt']): ?><b><?php echo $this->_tpl_vars['sm']['frnds_cnt']; ?>
</b><?php else: ?>no<?php endif; ?> friend<?php if ($this->_tpl_vars['sm']['frnds_cnt'] > 1): ?>s<?php endif; ?></div>
      <div id="search" >
        <label for="filter">Find friends</label> <input type="text" name="filter" value="" id="filter" />
      </div>
      <div id="result" style="width:600px;overflow: auto; height: 250px;border-width: .2em; border-style: ridge;border-color: #000; " >
		<?php unset($this->_sections['cur']);
$this->_sections['cur']['name'] = 'cur';
$this->_sections['cur']['loop'] = is_array($_loop=$this->_tpl_vars['sm']['frnds']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<?php $this->assign('f', $this->_tpl_vars['sm']['frnds'][$this->_sections['cur']['index']]); ?>
		<div class="each_record in_txt">
			<table border='0' width='160'>
				<tr  pidusr="<?php echo $this->_tpl_vars['f']['id_user']; ?>
" class="pinfo">
					<td width="60" height="60">
						<div class='photo_container'><img src="http://memeja.com/image/thumb/avatar/<?php if ($this->_tpl_vars['f']['avatar']):  echo $this->_tpl_vars['f']['avatar'];  else:  if ($this->_tpl_vars['f']['gender'] == 'M'): ?>memeje_male.jpg<?php else: ?>memeje_female.jpg<?php endif;  endif; ?>" height="60px" width="60px"/><input type="checkbox" name="sel[]" value="<?php echo $this->_tpl_vars['f']['id_user']; ?>
" class='tick_chkbox'></div>
					</td>
					<td class='frend_name'><span class="filt_txt"><?php echo $this->_tpl_vars['f']['fname']; ?>
<br><?php if ($this->_tpl_vars['f']['mname']):  echo $this->_tpl_vars['f']['mname']; ?>
<br><?php endif;  echo $this->_tpl_vars['f']['lname']; ?>
</span></td>
				</tr>
			</table>
		</div>
		<?php endfor; endif; ?>
      </div>
      <div><input type="button" name="send_req" value="Add as friends" onclick="add_memeje_frnds();"></div>
      <input type="hidden" id="frndpg" value="-1">
</div>
<?php echo '
<script src="http://memeja.com/templates/flexyjs/filter.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">

	function add_memeje_frnds(){
		var ids=\'\';
		var i=0;
		$(\'.tick_chkbox\').each(function(){
			if($(this).is(\':checked\')){
			    if(ids==""){
				 ids =$(this).val();
			     }else{
				ids +=","+$(this).val();
			     }
			    i++;
			 }
		 });
		var url="http://memeja.com/index.php";
		$.post(url,{"page":"user","choice":"add_memeje_frnds","ids":ids,ce:0 },function(res){
			if(res){
			    $.fancybox.close();
			 }
		 })
	 }
	function loadjscssfile(filename, filetype){
		if (filetype=="js"){ //if filename is a external JavaScript file
			var fileref=document.createElement(\'script\')
			fileref.setAttribute("type","text/javascript")
			fileref.setAttribute("src", filename)
		 }
		else if (filetype=="css"){ //if filename is an external CSS file
			var fileref=document.createElement("link")
			fileref.setAttribute("rel", "stylesheet")
			fileref.setAttribute("type", "text/css")
			fileref.setAttribute("href", filename)
		 }
		if (typeof fileref!="undefined")
			document.getElementsByTagName("head")[0].appendChild(fileref)
	 }
	function show_profile_info(id_user){
		var url="http://memeja.com/";
		$.post(url,{"page":"leaderboard","choice":"show_profile","id":id_user,ce:0,"nofrndbtn":1 },function(res){
		    if($("#frndpg").val()==\'-1\')
			    $("#show_profile_info").css(\'z-index\',\'99999\').html(res);
		    else
			    $("#show_profile_info").html(\'\');
		 });
	 }
	$(document).ready(function(){
	    $(".pinfo").mouseenter(function(){
		show_profile_info($(this).attr(\'pidusr\'));

	     }).mouseleave(function(){
		$("#show_profile_info").html(\'\');

	     });
	 });
</script>
<style type="text/css">
	.each_record{
		margin-left:10px;
		margin-right:20px;
		margin-top:20px;
		float:left;
	 }
</style>
'; ?>


<!-- Template: user/memeje_friends.tpl.html End --> 