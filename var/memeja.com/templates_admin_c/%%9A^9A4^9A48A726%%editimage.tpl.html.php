<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2011-09-19 23:47:40
         compiled from admin/meme/editimage.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/meme/editimage.tpl.html', 8, false),)), $this); ?>

<!-- Template: admin/meme/editimage.tpl.html Start 19/09/2011 23:47:40 --> 
 <?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('PREMADE_CATEGORY')); ?>
Image:<b><?php echo $this->_tpl_vars['sm']['res']['0']['image']; ?>
</b><br>
<label for="category">Category:</label>
<select name="categery" id="ucategory">
    <!--<option value="">--Select--</option>-->
    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['category'],'selected' => $this->_tpl_vars['sm']['res']['0']['id_category']), $this);?>

</select><br>
<input type="button" value="update" onclick="update_category('<?php echo $this->_tpl_vars['sm']['res']['0']['id_premade_image']; ?>
','<?php echo $this->_tpl_vars['sm']['res']['0']['id_category']; ?>
');"/>
<?php echo '
<script type="text/javascript">
  function update_category(id,idc){
      qstart=\'';  echo $this->_tpl_vars['sm']['qstart'];  echo '\';
      var id_category=$(\'#ucategory\').val();
      if(id_category==idc){
	  $.fancybox.close();
       }else{
	  var url="http://memeja.com/flexyadmin/index.php";
	    $.post(url,{"page":"meme","choice":"update_category",id_category:id_category,"id":id,"qstart":qstart,ce:0 },function(response){
		     $("#meme_list_premadeImages").html(response);
	     });
	      $.fancybox.close();
	  
       }
      
   }
	
  
</script>
'; ?>


=======
<?php /* Smarty version 2.6.7, created on 2011-09-19 23:47:40
         compiled from admin/meme/editimage.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/meme/editimage.tpl.html', 8, false),)), $this); ?>

<!-- Template: admin/meme/editimage.tpl.html Start 19/09/2011 23:47:40 --> 
 <?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('PREMADE_CATEGORY')); ?>
Image:<b><?php echo $this->_tpl_vars['sm']['res']['0']['image']; ?>
</b><br>
<label for="category">Category:</label>
<select name="categery" id="ucategory">
    <!--<option value="">--Select--</option>-->
    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['category'],'selected' => $this->_tpl_vars['sm']['res']['0']['id_category']), $this);?>

</select><br>
<input type="button" value="update" onclick="update_category('<?php echo $this->_tpl_vars['sm']['res']['0']['id_premade_image']; ?>
','<?php echo $this->_tpl_vars['sm']['res']['0']['id_category']; ?>
');"/>
<?php echo '
<script type="text/javascript">
  function update_category(id,idc){
      qstart=\'';  echo $this->_tpl_vars['sm']['qstart'];  echo '\';
      var id_category=$(\'#ucategory\').val();
      if(id_category==idc){
	  $.fancybox.close();
       }else{
	  var url="http://memeja.com/flexyadmin/index.php";
	    $.post(url,{"page":"meme","choice":"update_category",id_category:id_category,"id":id,"qstart":qstart,ce:0 },function(response){
		     $("#meme_list_premadeImages").html(response);
	     });
	      $.fancybox.close();
	  
       }
      
   }
	
  
</script>
'; ?>


>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
<!-- Template: admin/meme/editimage.tpl.html End --> 