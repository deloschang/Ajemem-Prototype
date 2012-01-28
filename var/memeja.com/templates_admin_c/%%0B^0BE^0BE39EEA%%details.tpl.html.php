<?php /* Smarty version 2.6.7, created on 2011-09-19 23:33:23
         compiled from admin/user/details.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/user/details.tpl.html', 26, false),)), $this); ?>

<!-- Template: admin/user/details.tpl.html Start 19/09/2011 23:33:23 --> 
 <div id="user_detail_user">
    <div class="box box-70 altbox">
	<div class="boxin">
	    <div class="header">
		<h3>
		     Profile Details
		</h3>
	    </div>
	    <div class="content">
		<table cellspacing="0">
		    <tr>
			<th>Name:</th><td><?php echo $this->_tpl_vars['sm']['res']['fname']; ?>
 <?php echo $this->_tpl_vars['sm']['res']['lname']; ?>
</td>
		    </tr>
		    <tr>
			<th>Email:</th><td><a title="Email <?php echo $this->_tpl_vars['sm']['res']['email']; ?>
 " href="mailto:<?php echo $this->_tpl_vars['sm']['res']['email']; ?>
"><?php echo $this->_tpl_vars['sm']['res']['email']; ?>
</a></td>
		    </tr>
		    <tr>
			<th>Password:</th><td><?php echo $this->_tpl_vars['sm']['res']['password']; ?>
</td>
		    </tr>
		     <tr>
			<th>Status:</th><td><?php if ($this->_tpl_vars['sm']['res']['user_status'] == 1): ?>Active <?php else: ?>Inactive<?php endif; ?></td>
		    </tr>
		    <tr>
			<th>Dob:</th><td><?php if ($this->_tpl_vars['sm']['res']['dob']):  echo ((is_array($_tmp=$this->_tpl_vars['sm']['res']['dob'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y"));  else: ?>N/A<?php endif; ?></td>
		    </tr>
		    <tr>
			<th>Gender:</th><td><?php if ($this->_tpl_vars['sm']['res']['gender'] == M): ?>Male<?php elseif ($this->_tpl_vars['sm']['res']['gender'] == F): ?>Female<?php else: ?>N/A<?php endif; ?></td>
		    </tr>
		    <tr>
			<th>Last Login Time:</th><td><?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['res']['last_login'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y %H:%M:%S") : smarty_modifier_date_format($_tmp, "%m-%d-%Y %H:%M:%S")); ?>
</td>
		    </tr>
		    <tr>
			<th>Signup Date:</th><td><?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['res']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
</td>
		    </tr>
		    <tr>
			<th>Login Ip:</th><td><?php if ($this->_tpl_vars['sm']['res']['ip'] == ""): ?>N/A<?php else:  echo $this->_tpl_vars['sm']['res']['ip'];  endif; ?></td>
		    </tr>
		</table>
	    </div>
	</div>
    </div>
<!-- Template: admin/user/details.tpl.html End --> 