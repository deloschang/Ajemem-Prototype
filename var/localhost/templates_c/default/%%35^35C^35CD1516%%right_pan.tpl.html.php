<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2012-06-11 00:58:13
         compiled from user/right_pan.tpl.html */ ?>

<!-- Template: user/right_pan.tpl.html Start 11/06/2012 00:58:13 --> 
=======
<?php /* Smarty version 2.6.7, created on 2012-06-11 02:16:57
         compiled from user/right_pan.tpl.html */ ?>

<!-- Template: user/right_pan.tpl.html Start 11/06/2012 02:16:57 --> 
>>>>>>> 5bf977c9a1fccb50ac9b1a4eadb4749659f5d673
=======
<?php /* Smarty version 2.6.7, created on 2012-06-12 03:05:08
         compiled from user/right_pan.tpl.html */ ?>

<!-- Template: user/right_pan.tpl.html Start 12/06/2012 03:05:08 --> 
>>>>>>> a5133832599c541bdf2df7acaece67cc8cdc0116
=======
<?php /* Smarty version 2.6.7, created on 2012-06-12 20:00:15
         compiled from user/right_pan.tpl.html */ ?>

<!-- Template: user/right_pan.tpl.html Start 12/06/2012 20:00:15 --> 
>>>>>>> 7b5f054f749573e2c4b326012bfdeddbaf8f1b61
=======
<?php /* Smarty version 2.6.7, created on 2012-06-13 07:52:47
         compiled from user/right_pan.tpl.html */ ?>

<!-- Template: user/right_pan.tpl.html Start 13/06/2012 07:52:47 --> 
>>>>>>> ac4211d0e074165145718401fe01962755d00891
=======
<?php /* Smarty version 2.6.7, created on 2012-06-13 09:27:35
         compiled from user/right_pan.tpl.html */ ?>

<!-- Template: user/right_pan.tpl.html Start 13/06/2012 09:27:35 --> 
>>>>>>> 5c7946b7a5a01a5faefe62be6a80d7f56cefbb03
=======
<?php /* Smarty version 2.6.7, created on 2012-06-13 23:58:28
         compiled from user/right_pan.tpl.html */ ?>

<!-- Template: user/right_pan.tpl.html Start 13/06/2012 23:58:28 --> 
>>>>>>> 3e35044fbd7c15464e5a989ca87f488cee86e77e
 
<span id="right_pan">
=======
<?php /* Smarty version 2.6.7, created on 2012-06-11 04:51:51
         compiled from user/right_pan.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_mod', 'user/right_pan.tpl.html', 113, false),)), $this); ?>
<?php $this->_cache_serials['C:/xampp/htdocs/flexycms/../var/localhost/templates_c/default\%%35^35C^35CD1516%%right_pan.tpl.html.inc'] = '275f963937ebc5980c9bef03b1a1915e'; ?>
<!-- Template: user/right_pan.tpl.html Start 11/06/2012 04:51:51 --> 
 <span id="right_pan">
<!--
<?php if ($_SESSION['id_user']): ?>
<fieldset style="width:40%;align:center;">
    <legend><b><h3>Search meme</h3></b></legend>
    <form>
	    <table>
		<tr>
		    <td class="dec">Username:</td>
		    <td><input type="text" name="muname" id="muname" value="<?php echo $_REQUEST['muname']; ?>
"/></td>
		</tr>
		<tr>
		    <td class="dec">Title:</td>
		    <td><input type="text" name="mtitle" id="mtitle" value="<?php echo $_REQUEST['mtitle']; ?>
"/></td>
		</tr>
	    </table>
	<input type="submit" value="Search"/>
    </form>
</fieldset>
<?php endif; ?>
>>>>>>> test2


<?php if ($_SESSION['id_user']): ?>  <!-- If not logged in, then don't show -->
<<<<<<< HEAD
	<!--<div class="fbfrnd">
		<a href="javascript:void(0);" onclick="invitePopup();" class="facebook">Invite Facebook Friends </a>
	</div>-->
<?php endif; ?>

<?php if ($_SESSION['id_user']): ?>
    <a href="javascript:void(0);" onclick="show_memeje_frnds();">Find friends in Memeja to add</a><br />
    <div id="show_profile_info" style="position: fixed;background-color:white;border: 1px solid #CAD8F3;"></div>
    
    <div>
		<br>
		<a href="http://localhost/manage/suggestion">Suggestions</a>
		</br>
	</div>
	    
	

=======
<!--
	<div class="fbfrnd">
		<a href="javascript:void(0);" onclick="invitePopup();" class="facebook">Invite Your Facebook Friends!</a>
	</div>
<br/>

<?php endif; ?>

<?php if ($_SESSION['id_user']): ?>
    <a href="javascript:void(0);" onclick="show_memeje_frnds();">Find Friends on Memeja</a><br/>
    <div id="show_profile_info" style="position: fixed;background-color:white;border: 1px solid #CAD8F3;"></div>
>>>>>>> test2
<?php endif; ?>
-->
</span>
<?php echo '
<script type="text/javascript">

// Find friends in Memeja to add
function show_memeje_frnds(){
	var url="http://localhost/index.php";
	$.post(url,{page:"user",choice:"get_memeje_frnds",ce:0 },function(res){
		//show_fancybox(res);
		 $.fancybox(res,{
			centerOnScroll:true,
			hideOnOverlayClick:false,
			onCleanup : function (){
				 $("#show_profile_info").html("");
			 }
		     });
	 })
 }

function invitePopup() {
	var z;
	var url="http://localhost/index.php?page=user&choice=get_sent_users&ce=0";
	var httpRequest = new XMLHttpRequest();
	httpRequest.open(\'POST\', url, false);
	httpRequest.send();
	if (httpRequest.status == 200) {
		z=httpRequest.responseText;
	 }
	FB.login(function(response) {
		if (response.session) {
			// user successfully logged in
			FB.ui({
				method:\'fbml.dialog\',
				fbml: (
				\'<fb:request-form method="post" action="http://localhost/user/invited/p/';  echo $_REQUEST['page']; ?>
/c/<?php echo $_REQUEST['choice'];  if ($_REQUEST['cat']): ?>/cat/<?php echo $_REQUEST['cat'];  endif;  echo '/*" type="Memeje"\' +
				\'content="Share your thoughts through memes <fb:req-choice url=\\\'http://localhost/\\\' label=\\\'Accept\\\' />" >\' +
				\'<fb:multi-friend-selector bypass="cancel" showborder="false" actiontext="Invite Your Friends!" exclude_ids="\'+z+\'"  max="20" rows="2" cols="3" email_invite="false" import_external_friends="false" condensed="false" uid=""/> \'+
				\'</fb:request-form>\'
				),
				size: { \'width\':\'485\', height:480 }, \'width\':\'485\', height:480
			 });

			$(".FB_UI_Dialog").css(\'width\', \'485px\'); // 80% of window width  $(window).width()*0.65
		 } else {
			// user cancelled login
		 }
	 });

</script>
'; ?>


<?php echo '<?php'; ?>

function _check_user()<?php echo $this->_tpl_vars['link']; ?>

echo 777777; 
	  <?php echo '?>'; ?>


<!--

<br/>
	<div class="fbfrnd">
		<a href="javascript:void(0);" onclick="invitePopup();" class="facebook">Invite Your Facebook Friends! </a>
	</div>
<br>
<?php if ($_SESSION['id_user']): ?>
    <a href="javascript:void(0);" onclick="show_memeje_frnds();">Find Friends on Memeja</a><br />
    <div id="show_profile_info" style="position: fixed;background-color:white;border: 1px solid #CAD8F3;"></div>
    <div >
		<br>
		<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:275f963937ebc5980c9bef03b1a1915e#0}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'user','mgr' => 'user','choice' => 'friend_list','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:275f963937ebc5980c9bef03b1a1915e#0}';}?>

    </div>

<?php endif;  echo '
<script type="text/javascript">

function show_memeje_frnds(){
	var url="http://localhost/index.php";
	$.post(url,{page:"user",choice:"get_memeje_frnds",ce:0 },function(res){//alert(res);
		//show_fancybox(res);
		 $.fancybox(res,{
			centerOnScroll:true,
			hideOnOverlayClick:false,
			onCleanup : function (){
				 $("#show_profile_info").html("");
			 }
		     });
	 })
 }
function invitePopup() {
	var z;
	var url="http://localhost/index.php?page=user&choice=get_sent_users&ce=0";
	var httpRequest = new XMLHttpRequest();
	httpRequest.open(\'POST\', url, false);
	httpRequest.send();
	if (httpRequest.status == 200) {
		z=httpRequest.responseText;
	 }
	FB.login(function(response) {
		if (response.session) {
			// user successfully logged in
			FB.ui({
				method:\'fbml.dialog\',
				fbml: (
				\'<fb:request-form method="post" action="http://localhost/user/invited/p/';  echo $_REQUEST['page']; ?>
/c/<?php echo $_REQUEST['choice'];  if ($_REQUEST['cat']): ?>/cat/<?php echo $_REQUEST['cat'];  endif;  echo '/*" type="Memeje"\' +
				\'content="Share your thoughts through memes <fb:req-choice url=\\\'http://localhost/\\\' label=\\\'Accept\\\' />" >\' +
				\'<fb:multi-friend-selector bypass="cancel" showborder="false" actiontext="Invite Your Friends!" exclude_ids="\'+z+\'"  max="20" rows="2" cols="3" email_invite="false" import_external_friends="false" condensed="false" uid=""/> \'+
				\'</fb:request-form>\'
				),
				size: { \'width\':\'485\', height:480 }, \'width\':\'485\', height:480
			 });

			$(".FB_UI_Dialog").css(\'width\', \'485px\'); // 80% of window width  $(window).width()*0.65
		 } else {
			// user cancelled login
		 }
	 });

 }

</script>
'; ?>

<!-- Template: user/right_pan.tpl.html End --> 