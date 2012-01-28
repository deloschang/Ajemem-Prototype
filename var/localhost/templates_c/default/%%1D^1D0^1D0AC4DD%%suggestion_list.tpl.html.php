<?php /* Smarty version 2.6.7, created on 2011-11-13 03:42:41
         compiled from manage/suggestion_list.tpl.html */ ?>

<!-- Template: manage/suggestion_list.tpl.html Start 13/11/2011 03:42:41 --> 
 <?php unset($this->_sections['cur']);
$this->_sections['cur']['name'] = 'cur';
$this->_sections['cur']['loop'] = is_array($_loop=$this->_tpl_vars['sm']['feature']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<?php $this->assign('x', $this->_tpl_vars['sm']['feature'][$this->_sections['cur']['index']]); ?>
<div>
    <fieldset style=" background-color:#CAD8F3;width: 550px;margin-left: 250px;border:7px solid gainsboro;" >
    <legend><b><?php echo $this->_tpl_vars['x']['title']; ?>
:</b></legend>
	    <table border="0">
		<tr>
		    <td align="left"><?php echo $this->_tpl_vars['x']['description']; ?>
</td>
		</tr>
		<tr>
		    <td>
			<div id="sug<?php echo $this->_tpl_vars['x']['id_feature']; ?>
" class="xyz" style="display: none"><textarea id="suggest<?php echo $this->_tpl_vars['x']['id_feature']; ?>
" row="5" cols="67"></textarea>
			<input type="button" name="save" value="Save"  onClick="insert_suggestion('<?php echo $this->_tpl_vars['x']['id_feature']; ?>
')"/><input type="reset" name="rese" value="cancel" onClick="cancel_suggestion('<?php echo $this->_tpl_vars['x']['id_feature']; ?>
')"/>
			 </div>
		    </td>
		</tr>
		<tr>
		    <td><div id="bt<?php echo $this->_tpl_vars['x']['id_feature']; ?>
" class="xxxx" style="margin-left:0px;"><a  href="javascript:void(0);" onclick="suggest('<?php echo $this->_tpl_vars['x']['id_feature']; ?>
');">suggest</a> </div></td>
		</tr>
		<tr>
		    <td>
		       <span class="error" generated="true"  id="hfid<?php echo $this->_tpl_vars['x']['id_feature']; ?>
"></span>
		    </td>
		</tr>
	</table>
    </fieldset>
</div>
<?php endfor; else: ?>
<div>
     No Features Found.
</div>
<?php endif; ?>

<?php echo '
<script type="text/javascript">
    function suggest(id_feature){
	var uid="sug"+id_feature;
	var but="bt"+id_feature;
	$(".xyz").hide();
	$(".xxxx").show();
	$("#"+uid).slideToggle(\'slow\');
	$("#"+but).slideToggle(\'slow\');
	
     }
    function insert_suggestion(id_feature){
	var id="suggest"+id_feature;
	var hfid="hfid"+id_feature;
	var suggestion=$("#"+id).val();
	if(suggestion!=""){
	    var url="http://localhost/index.php";
	    $.post(url,{"page":"manage","choice":"insert_suggestion",suggestion:suggestion,id_feature:id_feature,ce:0 },function(res){
		if(res){
		    //setTimeout($("#"+hfid).html("thanks for giving your suggestion"),1000)
		    cancel_suggestion(id_feature);
		 }
	     });
	 }else{
	    alert("You have not give any suggestion ");
	    return false;
	 }
	
    
     }
    
    function cancel_suggestion(id_feature){
	var uid="sug"+id_feature;
	var but="bt"+id_feature;
	var id="suggest"+id_feature;
	$("#"+id).val("");
	$("#"+uid).slideToggle(\'slow\');
	$("#"+but).slideToggle(\'slow\');

     }
    
</script>
'; ?>


<!-- Template: manage/suggestion_list.tpl.html End --> 