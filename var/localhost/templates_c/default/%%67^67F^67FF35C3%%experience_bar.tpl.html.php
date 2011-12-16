<?php /* Smarty version 2.6.7, created on 2011-12-16 08:52:16
         compiled from user/experience_bar.tpl.html */ ?>

<!-- Template: user/experience_bar.tpl.html Start 16/12/2011 08:52:16 --> 
 <div style="padding:5px 5px 5px 5px">
    <strong>Experience Points (<?php echo $_SESSION['exp_point']; ?>
): <font color="#ffffff"> <?php echo $this->_tpl_vars['sm']['points']; ?>
%</font></strong><br />
    <div style="width:720px; border:5px  solid #cccccc;background-color:#f2f2f2;border-radius:8px;">
	 <div style="width:<?php echo $this->_tpl_vars['sm']['points']; ?>
%; height:20px; background-color:#66CC00; color:#fff;">
	     <font color="Blue"></font>
	 </div>
    </div>
</div>

<!-- Template: user/experience_bar.tpl.html End --> 