<?php /* Smarty version 2.6.7, created on 2011-12-31 12:51:33
         compiled from question/this_week_question.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'question/this_week_question.tpl.html', 15, false),)), $this); ?>

<!-- Template: question/this_week_question.tpl.html Start 31/12/2011 12:51:33 --> 
 <?php if ($this->_tpl_vars['sm']['week_quest']): ?>
<table align="center" style="background-color: #B2B2B2">
    <tr style="height:50px;">
	<td height="50px">
<!-- a href="http://localhost/question/que_details/id/<?php echo $this->_tpl_vars['sm']['week_quest']['id_question']; ?>
" -->
<a href="http://localhost/question/answer_to_ques/idq/<?php echo $this->_tpl_vars['sm']['week_quest']['id_question']; ?>
">
<img src="http://localhost/image/thumb/question/<?php echo $this->_tpl_vars['sm']['week_quest']['img_name']; ?>
" height="70px;" width="70px;"/></a></td>
	<td height="50px">
	    <h2>
<a href="http://localhost/question/answer_to_ques/idq/<?php echo $this->_tpl_vars['sm']['week_quest']['id_question']; ?>
" style="text-decoration:none;">
<!-- a href="http://localhost/question/que_details/id/<?php echo $this->_tpl_vars['sm']['week_quest']['id_question']; ?>
"  style="text-decoration:none;" --><center>Questions of the week</center></h2></a><br>
	    <b><?php echo $this->_tpl_vars['sm']['week_quest']['title']; ?>
</b><br>
		<?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['week_quest']['question'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 50) : smarty_modifier_truncate($_tmp, 50)); ?>
<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://localhost/question/answer_to_ques/idq/<?php echo $this->_tpl_vars['sm']['week_quest']['id_question']; ?>
">...  See All Answer</a>
	</td>
    </tr>
</table>
	
<?php endif; ?>

<!-- Template: question/this_week_question.tpl.html End --> 