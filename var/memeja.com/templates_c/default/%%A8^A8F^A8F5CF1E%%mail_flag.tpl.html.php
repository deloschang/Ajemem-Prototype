<?php /* Smarty version 2.6.7, created on 2011-10-14 20:32:55
         compiled from meme/mail_flag.tpl.html */ ?>

<!-- Template: meme/mail_flag.tpl.html Start 14/10/2011 20:32:55 --> 
 Hi Admin,
<br><br><b><?php echo $_SESSION['fname'];  if ($_SESSION['mname']): ?> <?php echo $_SESSION['mname'];  endif; ?> <?php echo $_SESSION['lname']; ?>
</b> has flagged to below meme : <br><br>
<table>
	<tr>
		<td colspan="2"><img src="http://memeja.com/image/orig/meme/<?php echo $this->_tpl_vars['sm']['image']; ?>
" alt="No image available"></td>
	</tr>
	<tr>
		<td>
			<table>
				<tr>
					<td><b>User email:</b></td>
					<td><?php echo $_SESSION['email']; ?>
</td>
				</tr>
				<tr>
					<td><b>Title:</b></td>
					<td><?php echo $this->_tpl_vars['sm']['title']; ?>
</td>
				</tr>
				<tr>
					<td><b>Category:</b></td>
					<td><?php echo $this->_tpl_vars['cat']; ?>
</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br><br><br><br>
Regards,<br>
Admin

<!-- Template: meme/mail_flag.tpl.html End --> 