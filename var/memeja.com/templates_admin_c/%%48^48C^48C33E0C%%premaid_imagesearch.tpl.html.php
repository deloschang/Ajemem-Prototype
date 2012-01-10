<?php /* Smarty version 2.6.7, created on 2011-09-30 15:50:36
         compiled from admin/meme/premaid_imagesearch.tpl.html */ ?>

<!-- Template: admin/meme/premaid_imagesearch.tpl.html Start 30/09/2011 15:50:36 --> 
 <div id="c_search">
	<div class="box box-50 altbox">
	    <div class="boxin">
		<div class="header"><h3>Search Images </h3></div>
		<form name="search_images" id="search_images" class="basic" method="post" action="javascript:void(0);">
		    <div class="inner-form">
			<dl>
			    <dt><label for="Image">Image :</label></dt>
			    <dd>
			    <input type="text" name="image" id="image"  value="" class="txt" onKeyup="return serachByEnter(event);"/>
			    </dd>
			    <dt><label for="add_date">Date :</label></dt>
			    <dd>
			    <input type="text" name="add_date" id="add_date"  value="" class="txt" onKeyup="return serachByEnter(event);"/>
			    </dd>
			    <dt></dt>
			    <dd>
			    <input class="button altbutton" type="button" name="btm" value="Search" onclick="list_Images();"/>
			    </dd>
			</dl>
		    </div>
		</form>
	    </div>
	</div>
	<div id="meme_list_premadeImages"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/meme/premaid_imagelist.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
</div>
<?php echo '
<script type="text/javascript">
    $(document).ready(function(){
	$(\'#add_date\').datepicker({
		dateFormat: "mm-dd-yy",changeMonth:\'true\',changeYear:\'true\',yearRange:\'-19:10\'
	  }); 
     });
    
function list_Images(){
	var add_date=$(\'#add_date\').val();
	var img=$(\'#image\').val();
	var url="http://memeja.com/flexyadmin/index.php";
	$.post(url,{"page":"meme","choice":"list_premadeImages","image":img,add_date:add_date,chk:1,ce:0 },function(res){
		$(\'#meme_list_premadeImages\').html(res);
	 });
 }
function serachByEnter(event){
	if(event.keyCode == 13){
		$(\'#add_date\').blur();
		$(\'#image\').blur();
	      list_Images();
	       return false;                
        }
     }
</script>
'; ?>


<!-- Template: admin/meme/premaid_imagesearch.tpl.html End --> 