<?php /* Smarty version 2.6.7, created on 2011-09-19 23:58:41
         compiled from admin/question/list.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'admin/question/list.tpl.html', 13, false),array('modifier', 'date_format', 'admin/question/list.tpl.html', 36, false),)), $this); ?>

<!-- Template: admin/question/list.tpl.html Start 19/09/2011 23:58:41 --> 
 <?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div id="ques">
<div class="box box-75 altbox" style="width:1000px">
    <div class="boxin">
	<div class="header">
            <h3>Question List</h3>
            <a class="button" href="javascript:void(0);" onclick="add_que();">Add Question</a>
	    <a class="button" href="javascript:void(0);" onclick="del_que();">Delete</a>
	  </div>
	   <input type="hidden" id="qstart" value="<?php echo $this->_tpl_vars['sm']['qstart']; ?>
"/>
	   <input type="hidden" id="count" value="<?php echo count($this->_tpl_vars['sm']['list']); ?>
"/>
	   <input type="hidden" id="limit" value="<?php echo $this->_tpl_vars['sm']['limit']; ?>
"/>
        <div class="content">
            <table cellspacing="0">
            <thead>
		<th><input type="checkbox"  id="0" onclick="checkall(this);"/></th>
		<th>Image</th>
            	<th>Question</th>
                <th>Title</th>
		<th>Quiz Start</th>
		<th>Quiz End</th>
		<th>Edit</th>
            </thead>
            <tbody>
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
            <tr>
            	<td><input type="checkbox" id="<?php echo $this->_tpl_vars['x']['id_question']; ?>
" onclick="check(this)" /></td>
            	<td>
		    <img src="http://memeja.com/<?php echo $this->_tpl_vars['img_path']['ques_thumb']; ?>
/<?php echo $this->_tpl_vars['x']['img_name']; ?>
" height="70px" width="70px" />
		</td>
                <td><?php echo $this->_tpl_vars['x']['question']; ?>
</td>
		<td><?php echo $this->_tpl_vars['x']['title']; ?>
</td>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['start_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
</td>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['end_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
</td>
		<td>
                    <img src="http://memeja.com/templates/css_theme/img/led-ico/pencil.png" alt="edit" title="Edit" onclick="edit_que('<?php echo $this->_tpl_vars['x']['id_question']; ?>
');" style="cursor: pointer;"/>
                </td>
            </tr>
            <?php endfor; else: ?>
            <tr>
                <td colspan="5">
		    No question Found.
                </td>
            </tr>
            <?php endif; ?>
            </tbody>
            </table>
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
    </div>
</div>
</div>
<?php echo '
    <script type="text/javascript">
	var id_s="";
	function add_que(){
	    //var url="http://memeja.com/flexyadmin/question/add";
	    var url="http://memeja.com/flexyadmin/index.php";
	    $.fancybox.showActivity();
	    $.post(url,{"page":"question","choice":"add","ce":"0" },function(res){
		show_fancybox(res);
	     });
	 }
	function checkall(obj){
	    if($(\'#count\').val()==0){
		document.getElementById(\'0\').checked=false;
		alert("No More record to select");
		return false;
	     }
	    id_s ="";
	    var checked = obj.checked;
	    var col = document.getElementsByTagName("INPUT");
	    for (var i=0;i<col.length;i++) {
		if(col[i].getAttribute(\'type\')=="checkbox"){
		    col[i].checked= checked;
		    if(col[i].checked){
			id_s += col[i].getAttribute(\'id\') + ",";
		     }else{
			id_s ="";
		     }
		 }
	     }
	 }
	function check(obj){
	    if(obj.checked){
	     id_s += obj.getAttribute(\'id\') + ",";
	     }else{
	     document.getElementById(\'0\').checked=false;
	     id_s = id_s.replace(obj.getAttribute(\'id\') + ",","");
	     }
	 }
	function edit_que(id){
	    var qstart=$(\'#qstart\').val();
	    var url="http://memeja.com/flexyadmin/index.php";
	    $.fancybox.showActivity();
	    $.post(url,{"page":"question","choice":"edit_que","id":id,"qstart":qstart,ce:0 },function(response){
		show_fancybox(response);
	     });
	 }
	function del_que(){
	    var qstart=$(\'#qstart\').val();
	    var count=$(\'#count\').val();
	    var limit=$(\'#limit\').val();
	    var url="http://memeja.com/flexyadmin/index.php";
	    if(id_s==""){
		var msg=confirm(\'Please select record to delete\');
		return false;
	     }
	    var conf=confirm(\'Are you sure to delete ?\');
	    if(conf){
		var limit = \'';  echo $this->_tpl_vars['sm']['limit'];  echo '\';
		if($(\'#qstart\').val()!=\'\'){
		    qstart = $(\'#qstart\').val();
		 }else{
		    qstart = 0;
		 }
		$.post(url,{"page":"question","choice":"del_que","id":id_s,"limit":limit,"count":count,"qstart":qstart,ce:0 },function(response){
		$("#ques").html(response);
		 });
	      }else{
		return false;
	      }
	    }
    </script>
'; ?>


<!-- Template: admin/question/list.tpl.html End --> 