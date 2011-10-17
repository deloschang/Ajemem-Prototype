<?php /* Smarty version 2.6.7, created on 2011-09-19 23:49:24
         compiled from admin/cms/listing.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_checkboxes', 'admin/cms/listing.tpl.html', 60, false),)), $this); ?>

<!-- Template: admin/cms/listing.tpl.html Start 19/09/2011 23:49:24 --> 
 <?php echo '
<script type="text/javascript">
	$(document).ready(function(){
		$("#searchq").autocomplete(\'http://memeja.com/flexyadmin/cms/auto_name/ce/0\',{
				delay: 500
		 });
	 });
	function geturl(id){
		var url = "http://memeja.com/flexyadmin/index.php";
		$(\'#mymodal\').load(url,{"page":"cms","choice":"geturl",ce:0,"id_content":id },function(){
		$("#mymodal").prepend(\'<div align="right"><a href="javascript:void(0);" onclick="closebox();">Close</a></div>\');
		 });
		cal_position(200,400,1);
	 }
	function closebox() {
		$("#mymodal").html(\'\');
		$.unblockUI(); 
	 }
	function cal_position(h, w) {
		var viewportwidth;
		var viewportheight;
		if (typeof window.innerWidth != \'undefined\') {
			viewportwidth = window.innerWidth,
			viewportheight = window.innerHeight
		 } else if (typeof(document.documentElement) != \'undefined\' && typeof(document.documentElement.clientWidth)!=\'undefined\' && document.documentElement.clientWidth != 0) {
			viewportwidth = document.documentElement.clientWidth,
			viewportheight = document.documentElement.clientHeight
		 } else {
			viewportwidth = document.getElementsByTagName(\'body\')[0].clientWidth,
			viewportheight = document.getElementsByTagName(\'body\')[0].clientHeight
		 }
		if (viewportheight < h) {
			var t=0;	
			var scroll_mode = \'scroll\';
			h=viewportheight;
		 } else {
			var t=(viewportheight-h)/2;
			var scroll_mode = \'auto\';
		 }
		var l=(viewportwidth-w)/2;
		$.blockUI({ message: $(\'#mymodal\'), css: {position:\'fixed\', top:+t+\'px\', left:+l+\'px\', width:+w+\'px\', height:+h+\'px\', overflow:scroll_mode }  });
	 }
</script>
'; ?>


                    
<div id="search_box" class="box box-50 altbox" style="width:350px">
<div class="boxin">
        <div class="header">
            <h3>Search Content</h3>

        </div>
        <form class="fields" id="search" action="http://memeja.com/flexyadmin/cms/search" method="post">
            <fieldset>
			<dl>
				<dt><label for="search:">Search:</label></dt>
                <dd><input id="searchq" class="txt" type="text" name="searchq" size="22" value="<?php if ($this->_tpl_vars['sm']['search_item']):  echo $this->_tpl_vars['sm']['search_item']; ?>
 <?php endif; ?>" /></dd><br />
				<?php echo smarty_function_html_checkboxes(array('name' => 'stype','options' => $this->_tpl_vars['sm']['check'],'selected' => $this->_tpl_vars['sm']['sel'],'separator' => "<br />"), $this);?>

                <label style="display: none;" class="error" generated="true" for="stype[]"><br>This field is required.</label>
                <div class="sep">
                    <input class="button" type="submit" value="Search" />
                </div>
             </dl>
            </fieldset>
        </form>
    </div>
</div>
<?php $this->assign('conf', $this->_tpl_vars['util']->get_values_from_config('LANGUAGE')); ?>
<div id="box1" class="box box-50 altbox" style="width:450px">
    <div class="boxin">
        <div class="header">
            <h3>Content Listing</h3>
            <a class="button" href="http://memeja.com/flexyadmin/cms/add">Add New</a>
        </div>
        <div id="box1-tabular" class="content">
        <div id="mymodal"></div>
           <?php if ($this->_tpl_vars['sm']['list']): ?> 
            <table cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <td class="tc">Actions</td>

                    </tr>
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
                    <tr class="first">
                        <th><?php echo $this->_tpl_vars['x']['name']; ?>
</th>
                        <td class="tc">
                        	<ul class="actions">
                                <li>
                                	<a class="ico" href="http://memeja.com/flexyadmin/cms/edit/code/<?php echo $this->_tpl_vars['x']['cmscode']; ?>
" title="edit">
                                    	<img src="http://memeja.com/templates/css_theme/img/led-ico/pencil.png" alt="edit" />
                                    </a>
                                </li>
                                <li>
                                	<a class="ico" href="http://memeja.com/flexyadmin/cms/delete/code/<?php echo $this->_tpl_vars['x']['cmscode']; ?>
" title="delete">
                                    	<img src="http://memeja.com/templates/css_theme/img/led-ico/delete.png" alt="delete"  onclick="return confirm('Are you sure to delete this content ?');"/>
                                    </a>
                                </li>
                               <!-- <li>
                                	<a class="ico" href="javascript:void(0);" title="geturl">
                                    	<img src="http://memeja.com/templates/css_theme/img/led-ico/highlighter.png" alt="Get URL"  onclick="geturl('<?php echo $this->_tpl_vars['x']['id_content']; ?>
');"/>
                                    </a>
                                    <div id="show_url"></div>
                                </li> -->
<!--                                <li>
                                	<a class="ico" href="javascript:void(0);" title="Block">
                                    	<img src="http://memeja.com/templates/admin_images/led-ico/delete.png" alt="Block" />
                                    </a>
                                </li>
-->                            </ul>
                        </td>
                    </tr>
                <?php endfor; endif; ?> 
                </tbody>
            </table>
            <?php else: ?>
            		No Records Found...
            <?php endif; ?>
      </div>
    </div>
</div>
<?php echo '
<script type="text/javascript" >
	$(\'#search\').validate({
		rules:{
			\'search-q\':\'required\',
			\'stype[]\':\'required\'
		 }
	 });
</script>
'; ?>


<!-- Template: admin/cms/listing.tpl.html End --> 