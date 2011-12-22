<?php /* Smarty version 2.6.7, created on 2011-12-22 04:43:26
         compiled from leaderboard/show_profile.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'leaderboard/show_profile.tpl.html', 47, false),)), $this); ?>
<?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div id="leaderboard_profile">
        <div style="background-color: #CAD8F3;width:281px;" >
	    <table  align="center">
		<tr>
		    <td>
		     <table>
			</tr>
			    <td>
				<div style="height:100px;width:100px"><img src="http://localhost/image/thumb/avatar/<?php if ($this->_tpl_vars['sm']['res']['0']['avatar']):  echo $this->_tpl_vars['sm']['res']['0']['avatar'];  else:  if ($this->_tpl_vars['sm']['res']['0']['gender'] == 'M'): ?>memeje_male.jpg<?php else: ?>memeje_female.jpg<?php endif;  endif; ?>" width="<?php echo $this->_tpl_vars['img_path']['thumb_width']; ?>
" height="<?php echo $this->_tpl_vars['img_path']['thumb_height']; ?>
" />
				</div>
			
			    </td>
			    <?php if ($this->_tpl_vars['sm']['nofrndbtn'] != 1): ?>
				    <td align="left">
				    <?php if (( $_SESSION['id_user'] != $this->_tpl_vars['sm']['res']['0']['id_user'] )): ?>
					<?php if ($this->_tpl_vars['sm']['reqst_to']['req_status'] != 1): ?>
					    <?php if (! $this->_tpl_vars['sm']['reqst_to']['requested_by']): ?>
						<?php if ($this->_tpl_vars['sm']['request_by_oth']['0']['requested_to'] && $this->_tpl_vars['sm']['request_by_oth']['0']['req_oth'] != 1): ?>
						    <div id="addfd"><input type="button" value="respond friend request" onClick="res_frnd_request('<?php echo $this->_tpl_vars['sm']['res']['0']['id_user']; ?>
');"></div>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['sm']['request_by_oth']['0']['req_oth'] != '0' && $this->_tpl_vars['sm']['request_by_oth']['0']['req_oth'] != '1'): ?>
						    <div id="addfd"><input type="button" value="Add Friend" onClick="add_friend('<?php echo $this->_tpl_vars['sm']['res']['0']['id_user']; ?>
','<?php echo $this->_tpl_vars['sm']['request_by_oth']['0']['req_oth']; ?>
','<?php echo $this->_tpl_vars['sm']['request_by_oth']['0']['id_frnd_request']; ?>
');"></div>
						<?php endif; ?>
					    <?php endif; ?>
					    <?php if ($this->_tpl_vars['sm']['reqst_to']['requested_by']): ?>
						<div id="addfd"><input type="button" value="<?php if ($this->_tpl_vars['sm']['reqst_to']['req_status'] != '0'): ?>Add Friend <?php else: ?>Friend Request Sent<?php endif; ?>" onClick="add_friend('<?php echo $this->_tpl_vars['sm']['res']['0']['id_user']; ?>
','<?php echo $this->_tpl_vars['sm']['reqst_to']['req_status']; ?>
','<?php echo $this->_tpl_vars['sm']['reqst_to']['id_frnd_request']; ?>
');"<?php if ($this->_tpl_vars['sm']['reqst_to']['req_status'] == '0'): ?>disabled="disabled"<?php endif; ?>/></div>
					    <?php endif; ?>
					<?php endif; ?>
				    <?php endif; ?>
				    </td>
			    <?php endif; ?>
                          </tr>
			</table>
		       </td>
		</tr>
	    </table>
	    <table>
		<tr><td colspan="2" align="center"><font size="3px;"><?php echo $this->_tpl_vars['sm']['res']['0']['email']; ?>
</font></td></tr>
		<tr>
		    <td align="right"><b>Gender:</b></td>
		    <td><?php if ($this->_tpl_vars['sm']['res']['0']['gender'] == M): ?> Male<?php else: ?>Female<?php endif; ?></td>
		</tr>
		<tr>
		    <td align="right"><b>Last login:</b></td>
		    <td><nobr><?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['res']['0']['last_login'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y %H:%m:%S") : smarty_modifier_date_format($_tmp, "%m-%d-%Y %H:%m:%S")); ?>
</nobr></td>
		</tr>
		<tr>
		    <td align="right"><b>DOB:</b></td>
		    <td><nobr><?php if ($this->_tpl_vars['sm']['res']['0']['dob']):  echo ((is_array($_tmp=$this->_tpl_vars['sm']['res']['0']['dob'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y"));  else: ?>NA<?php endif; ?></nobr></td>
		</tr>
		<tr>
		    <td align="right"><b>Achievement rank:</b></td>
		    <td><?php echo $this->_tpl_vars['sm']['ach']; ?>
 </td>
		</tr>
		<tr>
		    <td align="right"><b>Question of the week won:</b></td>
		    <td><?php echo $this->_tpl_vars['sm']['res']['0']['ques_week_won']; ?>
 </td>
		</tr>
		<tr>
		    <td align="right"><b>Duels won:</b></td>
		    <td><?php echo $this->_tpl_vars['sm']['res']['0']['duels_won']; ?>
 </td>
		</tr>
		<tr>
		    <td align="right"><b>Experience point:</b></td>
		    <td><?php echo $this->_tpl_vars['sm']['res']['0']['exp_point']; ?>
 </td>
		</tr>
	    </table>
        </div>
</div>
<?php if ($this->_tpl_vars['sm']['nofrndbtn'] != 1): ?>
<?php echo '
<script type="text/javascript">
   
    function add_friend(id_user,req_status,id_frnd_request){
	//alert("iduser:"+id_user+"  req_status="+req_status+"  id_req="+id_frnd_request);//return false;
	var url="http://localhost/";
	$.post(url,{"page":"leaderboard","choice":"addFriend","id":id_user,req_status:req_status,id_frnd_request:id_frnd_request,ce:0 },function(res){
	    //alert(res);
	    if(res==1){
		$("#addfd").html(\'<input type="button" value="friend request sent" disabled="disabled"/>\');
	     }    
	 });
     }
    function res_frnd_request(id_user){
	var url="http://localhost/";
	$.post(url,{"page":"user","choice":"conf_frnd_request","id":id_user,ce:0 },function(res){
	   // alert(res);
	    if(res==1){
		$("#addfd").html(\'\');
	     }    
	 });
     }
</script>
'; ?>

<?php endif; ?>