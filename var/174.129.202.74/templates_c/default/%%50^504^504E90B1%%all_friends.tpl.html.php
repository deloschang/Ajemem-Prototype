<?php /* Smarty version 2.6.7, created on 2011-10-15 11:07:53
         compiled from user/all_friends.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'user/all_friends.tpl.html', 8, false),)), $this); ?>
<?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div id="user_all_friends" >
    <h2>My Friends</h2>
    <div style="border: 1px solid black;width: 40%;"></div>
	<input type="hidden" name="htot" id="rtot" value='<?php echo $this->_tpl_vars['sm']['next_prev']->total; ?>
'/>
        <input type="hidden" id="qstart" value="<?php echo $this->_tpl_vars['sm']['qstart']; ?>
"/>
	<input type="hidden" id="count" value="<?php echo count($this->_tpl_vars['sm']['list']); ?>
"/>
        <div class="content">
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
		<div style="width:40%" class="ind_frnd" id_user="<?php echo $this->_tpl_vars['x']['id_user']; ?>
">
		    <span style="float:right;display: none;cursor: pointer;" onclick="remove_frnd('<?php echo $this->_tpl_vars['x']['id_user']; ?>
','<?php echo $this->_tpl_vars['x']['memeje_friends']; ?>
');" ><img src="http://memeja.com/spad/site_image/delete.png" title="Remove"/></span>
		    <table border="0" width="300px">
			<tr>
			    <td width="100" height="90">
				    <img src="http://memeja.com/<?php echo $this->_tpl_vars['img_path']['avtar_thumb'];  if ($this->_tpl_vars['x']['avatar']):  echo $this->_tpl_vars['x']['avatar'];  else:  if ($this->_tpl_vars['x']['gender'] == 'M'): ?>memeje_male.jpg<?php else: ?>memeje_female.jpg<?php endif;  endif; ?>" width="80" height="80"/>
			    </td>
			    <td>
				<h3><?php echo $this->_tpl_vars['x']['name']; ?>
 <?php echo $this->_tpl_vars['x']['mname'];  echo $this->_tpl_vars['x']['lname']; ?>
</h3><br/>
				    <?php if ($this->_tpl_vars['x']['address']): ?>$x.address<?php endif; ?>
			    </td>
			</tr>
		    </table>
		</div>
	    <?php if (! $this->_sections['cur']['last']): ?>
	    <div style="clear:both;border: 1px solid gainsboro;width: 40%;"></div>
	    <?php endif; ?>
	    <div style="clear:both;"></div>
	    <?php endfor; else: ?>
		<br>No friend found.
	    <?php endif; ?>
	    <br/>
        </div>
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
    <div id="frnd_profile" style="float:right;position: relative;top:-200px;"></div>
<?php echo '
<script type="text/javascript">
    $(document).ready(function(){
	    $(".ind_frnd").mouseenter(function(){
		show_user_profile($(this).attr(\'id_user\'));
		$(this).css(\'background-color\',\'gainsboro\');
		$(this).find("span").show();
	     }).mouseleave(function(){
		$("#frnd_profile").html(\'\');
		$(this).css(\'background-color\',\'white\');
		$(this).find("span").hide();
	     });
     });
    function remove_frnd(id_user,frnds){
	var count=$(\'#count\').val();
	var cur_id_usr = "';  echo $_SESSION['friends'];  echo '";
	var ssn_id_usr = "';  echo $_SESSION['id_user'];  echo '";
	var ssn_usr_frnds = (","+cur_id_usr+",").replace(","+id_user+",",",");
	var rm_from_frnds = (","+frnds+",").replace(","+ssn_id_usr+",",",");
	var qstart=\'';  echo $this->_tpl_vars['sm']['qstart'];  echo '\';
	var limit= \'';  echo $this->_tpl_vars['sm']['limit'];  echo '\';
	var conf=confirm(\'Are you sure to delete ?\');
	var url="http://memeja.com/index.php";
	if(conf){
	    $.post(url,{"page":"user","choice":"remove_frnd","id_user":id_user,"ssnfrnds":ssn_usr_frnds,"rmvdfrnds":rm_from_frnds,"limit":limit,"qstart":qstart,"count":count,ce:0 },function(res){
		//alert(res);
		$("#user_all_friends").html(res);
		window.location.reload();
		 });
	 }
     }
    function show_user_profile(id_user){
	    var url="http://memeja.com/";
	    $.post(url,{"page":"leaderboard","choice":"show_profile","id":id_user,ce:0 },function(res){
		    $("#frnd_profile").html(res);
	     });
     }
</script>
<style type="text/css">
    .ind_frnd{
	float: left;
     }
</style>
'; ?>
