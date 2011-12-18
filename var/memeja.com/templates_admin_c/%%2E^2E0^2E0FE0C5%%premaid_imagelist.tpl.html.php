<?php /* Smarty version 2.6.7, created on 2011-09-30 15:50:36
         compiled from admin/meme/premaid_imagelist.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/meme/premaid_imagelist.tpl.html', 38, false),array('modifier', 'count', 'admin/meme/premaid_imagelist.tpl.html', 41, false),)), $this); ?>
<?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('PREMADE_CATEGORY'));  $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div id="dv1">
<div class="box box-75 altbox">
    <div class="boxin">
        <div class="header">
            <h3>Premade ImageList (<?php echo $this->_tpl_vars['sm']['next_prev']->total; ?>
)</h3>
            <a class="button" href="javascript:void(0);" onclick="add_images();">Add Images</a>
	   <?php if ($this->_tpl_vars['sm']['list']): ?> <input type="button" class="button" name="delImg" value="Delete"onclick="deleteAll('chkbox_image','');"/><?php endif; ?>
        </div>
	 <input type="hidden" name="htot" id="rtot" value='<?php echo $this->_tpl_vars['sm']['next_prev']->total; ?>
'/>
        <input type="hidden" id="qstart" value="<?php echo $this->_tpl_vars['sm']['qstart']; ?>
"/>
        <div class="content">
            <table cellspacing="0">
            <thead>
	    <th>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="chk_all" id="chk_all" onclick="checkUncheck('chkbox_image');" title="Check to select all images"/></th>
            	<th>Image</th>
                <th>Category</th>
		<th>Add Date</th>
		<th>Action</th>
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
		    <td>
			  <input type="checkbox" name="chk_box" id="chk<?php echo $this->_tpl_vars['x']['id_premade_image']; ?>
" value="<?php echo $this->_tpl_vars['x']['id_premade_image']; ?>
" class="chkbox_image"/>
		    </td>
		    <td>
			<?php $this->assign('pth', $this->_tpl_vars['img_path']['premade_image']); ?>
			<?php $this->assign('imgnm', "<img src='http://memeja.com/".($this->_tpl_vars['pth'])."/".($this->_tpl_vars['x']).".img_name' height='110px' width='110px'/>"); ?>

			<img src="http://memeja.com/<?php echo $this->_tpl_vars['pth']; ?>
/<?php echo $this->_tpl_vars['x']['img_name']; ?>
" height="70px" width="70px" />
		    </td>
		    <td><?php echo $this->_tpl_vars['category'][$this->_tpl_vars['x']['id_category']]; ?>
</td>
		    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
</td>
		    <td>
			<img src="http://memeja.com/templates/css_theme/img/led-ico/pencil.png" alt="edit" title="Edit" onclick="edit_premadeImages('<?php echo $this->_tpl_vars['x']['id_premade_image']; ?>
');" style="cursor:pointer;"/>
			<!--<img src="http://memeja.com/templates/css_theme/img/led-ico/delete.png" alt="delete" title="Delete" onclick="delete_premadeImages('<?php echo $this->_tpl_vars['x']['id_premade_image']; ?>
','<?php echo $this->_tpl_vars['x']['image']; ?>
','<?php echo count($this->_tpl_vars['sm']['list']); ?>
');"/>-->
		    </td>
		</tr>
            <?php endfor; else: ?>
		<tr>
		    <td colspan="5">
		    No Images Found.
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
	function add_images(){
	     var url="http://memeja.com/flexyadmin/index.php";
	    $.fancybox.showActivity();
	    $.post(url,{"page":"meme","choice":"addImages",ce:0 },function(response){
		    $.fancybox(response);
	     });
	 }
	function edit_premadeImages(id){
	    qstart=$(\'#qstart\').val();
	    var url="http://memeja.com/flexyadmin/index.php";
	    $.fancybox.showActivity();
	    $.post(url,{"page":"meme","choice":"edit_premadeImages","id":id,"qstart":qstart,ce:0 },function(response){
		    $.fancybox(response);
	     });
	 }
	function delete_premadeImages(id_premade_image,image,no){
	    var q=$(\'#qstart\').val();
	    var url="http://memeja.com/flexyadmin/";
	    var conf=confirm(\'Are you sure to delete this record?\');
	    if(conf){
		var limit = \'';  echo $this->_tpl_vars['sm']['limit'];  echo '\';
		if($(\'#qstart\').val()!=\'\'){
		    var q = $(\'#qstart\').val();
		 }else{
		    var q = 0;
		 }
		$.post(url,{"page":"meme","choice":"delete_premadeImages",ce:0,"id_premade_image":id_premade_image,"image":image,"qstart":q,"limit":limit,no:no },function(res){
		    $("#meme_list_premadeImages").html(res);
		 });
	     }else
		return false;
	 }
	
	function checkUncheck(cls){
	    if(document.getElementById("chk_all").checked==true){
		$(\'.\'+cls).each(function(){
		    $(this).attr(\'checked\',\'checked\');
		 });
	     }else{
		$(\'.\'+cls).each(function(){
		    $(this).removeAttr(\'checked\');
		 });
	     }
	 }
	
	function deleteAll(cls,chc){
	    var rshow=parseInt(\'';  echo $this->_tpl_vars['sm']['limit'];  echo '\');
	    var qstrt=parseInt(\'';  echo $this->_tpl_vars['sm']['qstart'];  echo '\');
	    var keys=\'\';
	    var i=0;
	    $(\'.\'+cls).each(function(){
		if($(this).is(\':checked\')){
		    keys +=","+$(this).val();
		    i++;
		 }
	     });
	    keys=keys.substr(1);
	    var rtot = parseInt($("#rtot").val()) - i;
	    if(rtot){
		var qs = (rtot%rshow)!=0 || (qstrt!=rtot) || (qstrt==0 && rtot==0) ? \'\': parseInt(Math.floor((rtot-1))/rshow)*rshow;
	     }	
	    if(qs===""){
		qs=qstrt;
	     }//alert(qs);return false;
	    if(!keys){
		alert("Select atleast one checkbox.");
		return false;
	     }else{if(chc==\'\'){
		    chc=confirm("Are you sure want to delete selected Image(s) ?","deleteAll",cls);
		 }
		if(chc){
		    list_premadeImages(\'for_del\',\'\',keys,qs);return true;
		 }else{
		    return false;
		 }
	     }
	    
	 }
	function list_premadeImages(fordel,x,keys,qs){
	    var url="http://memeja.com/flexyadmin/index.php";
	    $.post(url,{"page":"meme","choice":"deleteAll",ce:0,"id_premade_image":keys,qstart:qs },function(res){
		    $("#meme_list_premadeImages").html(res);
		 });
	 }
</script>
'; ?>
