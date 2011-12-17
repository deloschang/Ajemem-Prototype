<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2011-09-19 23:46:52
         compiled from admin/meme/imglist.tpl.html */ ?>

<!-- Template: admin/meme/imglist.tpl.html Start 19/09/2011 23:46:52 --> 
 <?php if ($this->_tpl_vars['sm']['res']):  unset($this->_sections['cur']);
$this->_sections['cur']['name'] = 'cur';
$this->_sections['cur']['loop'] = is_array($_loop=$this->_tpl_vars['sm']['res']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <?php $this->assign('x', $this->_tpl_vars['sm']['res'][$this->_sections['cur']['index']]); ?>
    <span><b><?php echo $this->_tpl_vars['x']['image']; ?>
<br></b></span>
<?php endfor; endif;  endif; ?>
<br>
<input type="button" value="Done" onclick="get_imglist();"/>
<?php echo '
<script type="text/javascript">
	function get_imglist(){
	    var url="http://memeja.com/flexyadmin/index.php";
	    $.post(url,{"page":"meme","choice":"list_premadeImages","chk":1,ce:0 },function(res){
		$(\'#meme_list_premadeImages\').html(res);
	     });
	     $.fancybox.close();
	 }
</script>
'; ?>


=======
<?php /* Smarty version 2.6.7, created on 2011-09-19 23:46:52
         compiled from admin/meme/imglist.tpl.html */ ?>

<!-- Template: admin/meme/imglist.tpl.html Start 19/09/2011 23:46:52 --> 
 <?php if ($this->_tpl_vars['sm']['res']):  unset($this->_sections['cur']);
$this->_sections['cur']['name'] = 'cur';
$this->_sections['cur']['loop'] = is_array($_loop=$this->_tpl_vars['sm']['res']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <?php $this->assign('x', $this->_tpl_vars['sm']['res'][$this->_sections['cur']['index']]); ?>
    <span><b><?php echo $this->_tpl_vars['x']['image']; ?>
<br></b></span>
<?php endfor; endif;  endif; ?>
<br>
<input type="button" value="Done" onclick="get_imglist();"/>
<?php echo '
<script type="text/javascript">
	function get_imglist(){
	    var url="http://memeja.com/flexyadmin/index.php";
	    $.post(url,{"page":"meme","choice":"list_premadeImages","chk":1,ce:0 },function(res){
		$(\'#meme_list_premadeImages\').html(res);
	     });
	     $.fancybox.close();
	 }
</script>
'; ?>


>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
<!-- Template: admin/meme/imglist.tpl.html End --> 