<?php /* Smarty version 2.6.7, created on 2011-09-19 23:28:49
         compiled from admin/meme/search_meme.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/meme/search_meme.tpl.html', 36, false),)), $this); ?>
<div id="c_search">
	<div class="box box-50 altbox">
	    <div class="boxin">
		<div class="header"><h3>Search Memes </h3></div>
		<form name="search_memes" id="search_memes" class="basic" method="post" action="http://memeja.com/flexyadmin/meme/meme_listing">
		    <div class="inner-form">
			<dl>
		    <dt><label for="user" class="memesrch">User:</label></dt>
			<dd>
			    <input type="text" name="id_user" class="txt"/>
			</dd>
		    <dt>
			<label for="title" class="memesrch">Meme Title:</label>
		    </dt>
			<dd>
			    <input type="text" name="title" class="txt"/>
			</dd>
		    <dt>
			<label for="type" class="memesrch">Type:</label>
		    </dt>
			<dd>
			    <select name="type">
				<option value=''>--Select--</option>
				<option value='1'>Duels</option>
				<option value='2'>Questions</option>
				<option value='3'>Memes</option>
			    </select>
			</dd>
		    <dt>
			<label for="category" class="memesrch">Category:</label>
		    </dt>
			<dd>
			    <select name="category">
				<option value=''>--Select--</option>
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['util']->get_values_from_config('CATEGORY')), $this);?>

			    </select>
			</dd>
		    <dt>
			<label for="add_date" class="memesrch">Start Date:</label>
		    </dt>
			<dd>
			    <input type="text" id="st_date" name="st_date" class="txt"/>
			</dd>
		    <dt>
			<label for="end_date" class="memesrch">End Date:</label>
		    </dt>
			<dd>
			    <input type="text" id="end_date" name="end_date" class="txt"/>
			</dd>
		    <dt></dt>
			    <dd>
			    <input type="button" id="srch_btn" value="Search" class="button altbutton"/>
			    </dd>
		</dl>
		    </div>
		</form>
	    </div>
	</div>
</div>
<div id="meme_meme_listing" style="clear: both;">
	    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/meme/meme_list.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php echo '
<style type="text/css">
    .memesrch{
	font-size: 14px;
	font-weight: bold;
     }
</style>
<script type="text/javascript">
    $(document).ready(function(){
	$(\'#st_date\').datepicker({
		dateFormat: "mm-dd-yy",changeMonth:\'true\',changeYear:\'true\',yearRange:\'-19:10\'
	  }); 
	 $(\'#end_date\').datepicker({
		dateFormat: "mm-dd-yy",changeMonth:\'true\',changeYear:\'true\',yearRange:\'-19:10\'
	  });
     });
    $("#srch_btn").click(function(){
	$("#search_memes").submit();
     });
</script>
'; ?>
