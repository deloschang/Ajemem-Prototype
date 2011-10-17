<?php /* Smarty version 2.6.7, created on 2011-09-19 23:57:51
         compiled from admin/manage/show_points.tpl.html */ ?>

<!-- Template: admin/manage/show_points.tpl.html Start 19/09/2011 23:57:51 --> 
 <?php $this->assign('allot_points', $this->_tpl_vars['util']->get_values_from_config('ALLOT_POINTS')); ?>
<div id="manage_show_points">
<div class="box box-75 altbox" id="dt">
    <div class="boxin" style="width:500px">
    <div class="header" id ="to_replace">
        <h3>Point Details</h3>
	<a class="button" href="javascript:void(0);"  onclick="allot_points();" >Allot Points</a>
	    </div>
        <div class="content">
	    
		<table cellspacing="0">
		    <thead>
			<th> Point Type</th>
			<th>Points</th>
			<th colspan="2">Action</th>
		    </thead>
		     <tbody>
				<?php unset($this->_sections['cur']);
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
			    <tr>
				    <td>
					   <?php echo $this->_tpl_vars['allot_points'][$this->_tpl_vars['x']['point_type']]; ?>

				    </td>
				    <td>
					   <?php echo $this->_tpl_vars['x']['points']; ?>

			    	    </td>
				    <td>
					 <img src="http://memeja.com/templates/css_theme/img/led-ico/pencil.png" alt="edit" title="Edit" onclick="edit_point('<?php echo $this->_tpl_vars['x']['id_allot']; ?>
');" style="cursor:pointer;"/>
				    </td>
				    <td>
					<img src="http://memeja.com/templates/css_theme/img/led-ico/delete.png" alt="delete" title="Delete" onclick="del_point('<?php echo $this->_tpl_vars['x']['id_allot']; ?>
');" style="cursor:pointer;"/>
				    </td>
			    </tr>
			    <?php endfor; else: ?>
			    <tr><td colspan="4">No Points Found</td></tr>
			<?php endif; ?>
		 </tbody>   
		</table>
        </div>
    </div>
</div>
</div>
<?php echo '
    <script type="text/javascript">
	function allot_points(){
	    var url="http://memeja.com/flexyadmin/index.php";
	    $.fancybox.showActivity();
	    $.post(url,{"page":"manage","choice":"allot_points","ce":"0" },function(res){
		show_fancybox(res); 
		$.fancybox.resize();
	     });
	 }
	function edit_point(id){
	    var url="http://memeja.com/flexyadmin/index.php";
	    $.fancybox.showActivity();
	    $.post(url,{"page":"manage","choice":"edit_point","id":id,ce:0 },function(response){
		show_fancybox(response);
	     });
	 }
	function del_point(id){
	    var url="http://memeja.com/flexyadmin/index.php";
	    var conf=confirm(\'Are you sure to delete ?\');
	    if(conf){
		$.post(url,{"page":"manage","choice":"del_point","id":id,ce:0 },function(response){
		$("#manage_show_points").html(response);
		 });
	      }else{
		return false;
	      }
	    }
     </script>

'; ?>


<!-- Template: admin/manage/show_points.tpl.html End --> 