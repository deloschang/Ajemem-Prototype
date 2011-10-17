<?php /* Smarty version 2.6.7, created on 2011-09-30 15:50:30
         compiled from admin/user/search_user.tpl.html */ ?>

<!-- Template: admin/user/search_user.tpl.html Start 30/09/2011 15:50:30 --> 
 	<div class="box box-50 altbox">
		<div class="boxin">
			<div class="header"><h3>Search </h3></div>
			<form name="search" id="search_user" class="basic" method="post" action="javascript:void(0);">
			    <div class="inner-form">
				    <dl>
					<dt><label for="Email">Email:</label></dt>
					<dd>
					<input type="text" name="email" id="email" value="<?php echo $_REQUEST['email']; ?>
" class="txt" />
				       </dd>
				       <dt><label for="Stat">Status:</label></dt>
					<dd>
					<input type="Checkbox" name="stat1" id="stat1" value="1" onclick="usearch_list(1);"/>Active
					<input type="Checkbox" name="stat2" id="stat2" value="0" onclick="usearch_list(1);"/>Inactive
					<dt></dt>
					<dd>
					<input class="button altbutton" type="button" name="btm" value="Search" onclick="usearch_list(1);"/>
					<input class="button altbutton" type="button" name="res" value="Reset" onclick="default_search();"/>

					</dd>
				    </dl>
			    </div>
			</form>
		</div>
	</div>
	<div id="user_user_listing"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/user/user_details.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>

<?php echo '
<script type="text/javascript">
function usearch_list(ctr){
	var stat="";
	var email=$(\'#email\').val();
	if($("#stat1").is(":checked")){
	   stat += $("#stat1").val() +",";
	 }
	if($("#stat2").is(":checked")){
	   stat += $("#stat2").val() +",";
	 }
	var url="http://memeja.com/flexyadmin/index.php";
	if(ctr==0) {
	    var qstart = $(\'#q\').val();
	 }else {
	    var qstart = 0;
	 }
	$.post(url,{"page":"user","choice":"user_listing",qstart:qstart,u_search:"1",email:email,stat:stat,ce:0 },function(res){
		$(\'#user_user_listing\').html(res);
	 });
 }
function default_search(){
	$(\'#email\').val("");
	$("#stat1").attr("checked",false);
	$("#stat2").attr("checked",false);
	usearch_list(1);
 }
</script>
'; ?>


<!-- Template: admin/user/search_user.tpl.html End --> 