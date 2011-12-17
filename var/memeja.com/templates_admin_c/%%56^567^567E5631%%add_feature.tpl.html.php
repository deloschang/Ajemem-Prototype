<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2011-09-19 23:57:41
         compiled from admin/manage/add_feature.tpl.html */ ?>

<!-- Template: admin/manage/add_feature.tpl.html Start 19/09/2011 23:57:41 --> 
 <div id="regdiv">
<?php echo '
<script type="text/javascript">
	var  validator1;
       function validate_feature(){
		    validator1 = $(\'#form1\').validate(
		   {
			   rules:{
				   \'form[title]\':{
					   required:true
				    },
				   \'form[description]\':{
					   required:true
				    }
				 },messages:{
				   \'form[title]\':{
					   required:flexymsg.required
				    },
				   \'form[desc]\':{
					   required:flexymsg.required
				    }
			    }
		    });var x = validator1.form();
		   return x;
    }
</script>
'; ?>

<?php if ($this->_tpl_vars['sm']['res']): ?><b>Edit the feature</b><?php else: ?><b>Add a feature</b><?php endif; ?><br />
<form name="form1" id="form1" method="post" action="<?php if ($this->_tpl_vars['sm']['res']): ?>http://memeja.com/flexyadmin/manage/update_feature/id/<?php echo $this->_tpl_vars['sm']['res']['id_feature'];  else: ?>http://memeja.com/flexyadmin/manage/insert_feature<?php endif; ?>" onSubmit="return validate_feature();">
	<center>
      <table style="border:1px;border-color:cyan">
		<tr>
			<td>Title</td>
			<td><input type="text" name="form[title]" value="<?php echo $this->_tpl_vars['sm']['res']['title']; ?>
"/></td>
		</tr>
        <tr>
			<td>Description</td>
			<td><textarea name="form[description]" rows=10 cols=23 value="<?php echo $this->_tpl_vars['sm']['res']['descriptio']; ?>
"><?php echo $this->_tpl_vars['sm']['res']['description']; ?>
</textarea></td>
		</tr>
		<tr><td>&nbsp;&nbsp;</td>
			<td><input type="submit" class="button altbutton" name="sub"  id="btn" value="<?php if ($this->_tpl_vars['sm']['res']):  if ($this->_tpl_vars['sm']['err']): ?>Submit<?php else: ?>Update<?php endif;  else: ?>Submit<?php endif; ?>" class="btn"/></td>
		</tr>
    </table>
  </center>
</form>
</div>

=======
<?php /* Smarty version 2.6.7, created on 2011-09-19 23:57:41
         compiled from admin/manage/add_feature.tpl.html */ ?>

<!-- Template: admin/manage/add_feature.tpl.html Start 19/09/2011 23:57:41 --> 
 <div id="regdiv">
<?php echo '
<script type="text/javascript">
	var  validator1;
       function validate_feature(){
		    validator1 = $(\'#form1\').validate(
		   {
			   rules:{
				   \'form[title]\':{
					   required:true
				    },
				   \'form[description]\':{
					   required:true
				    }
				 },messages:{
				   \'form[title]\':{
					   required:flexymsg.required
				    },
				   \'form[desc]\':{
					   required:flexymsg.required
				    }
			    }
		    });var x = validator1.form();
		   return x;
    }
</script>
'; ?>

<?php if ($this->_tpl_vars['sm']['res']): ?><b>Edit the feature</b><?php else: ?><b>Add a feature</b><?php endif; ?><br />
<form name="form1" id="form1" method="post" action="<?php if ($this->_tpl_vars['sm']['res']): ?>http://memeja.com/flexyadmin/manage/update_feature/id/<?php echo $this->_tpl_vars['sm']['res']['id_feature'];  else: ?>http://memeja.com/flexyadmin/manage/insert_feature<?php endif; ?>" onSubmit="return validate_feature();">
	<center>
      <table style="border:1px;border-color:cyan">
		<tr>
			<td>Title</td>
			<td><input type="text" name="form[title]" value="<?php echo $this->_tpl_vars['sm']['res']['title']; ?>
"/></td>
		</tr>
        <tr>
			<td>Description</td>
			<td><textarea name="form[description]" rows=10 cols=23 value="<?php echo $this->_tpl_vars['sm']['res']['descriptio']; ?>
"><?php echo $this->_tpl_vars['sm']['res']['description']; ?>
</textarea></td>
		</tr>
		<tr><td>&nbsp;&nbsp;</td>
			<td><input type="submit" class="button altbutton" name="sub"  id="btn" value="<?php if ($this->_tpl_vars['sm']['res']):  if ($this->_tpl_vars['sm']['err']): ?>Submit<?php else: ?>Update<?php endif;  else: ?>Submit<?php endif; ?>" class="btn"/></td>
		</tr>
    </table>
  </center>
</form>
</div>

>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
<!-- Template: admin/manage/add_feature.tpl.html End --> 