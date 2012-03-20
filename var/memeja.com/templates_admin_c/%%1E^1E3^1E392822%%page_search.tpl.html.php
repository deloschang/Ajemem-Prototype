<?php /* Smarty version 2.6.7, created on 2011-09-08 09:14:26
         compiled from admin/achievements/page_search.tpl.html */ ?>

<!-- Template: admin/achievements/page_search.tpl.html Start 08/09/2011 09:14:26 --> 
 <div id="c_search">
	<div class="box box-50 altbox">
		<div class="boxin">
			<div class="header"><h3>Search  </h3></div>
			<form name="search_images" id="search_images" class="basic" method="post" action="javascript:void(0);">
			    <div class="inner-form">
				   <dl>
						<dt><label for="user">User :</label></dt>
						<dd>
						  <input type="text" name="user" id="user"  value="" class="txt" />
						</dd>
						<dt></dt>
						<dd>
						  <input class="button altbutton" type="button" name="btm" value="Search" onClick="search_list();"/>
						</dd>
				   </dl>
			    </div>
			</form>
		</div>
	</div>
	<div id="achievements_list_page"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/achievements/show_page.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
</div>
<?php echo '
<script type="text/javascript">
	function search_list(){
		var user=$(\'#user\').val();
		//alert(user);
		var qstart = \'';  echo $this->_tpl_vars['sm']['next_prev']->start;  echo '\';
		var url="http://memeja.com/flexyadmin/achievements/list_page";
		$.post(url,{"user":user,"page":"achievements","choice":"list_page","qstart":qstart,"chk":1,"ce":0 },function(res){
			//alert(res);
			$(\'#achievements_list_page\').html(res);
			css_even_odd();
		 });
	 }
</script>	
'; ?>

<!-- Template: admin/achievements/page_search.tpl.html End --> 