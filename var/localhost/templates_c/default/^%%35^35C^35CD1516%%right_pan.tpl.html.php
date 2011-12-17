<?php /* Smarty version 2.6.7, created on 2011-12-17 09:52:44
         compiled from user/right_pan.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_mod', 'user/right_pan.tpl.html', 34, false),)), $this); ?>
<?php $this->_cache_serials['C:/xampp/htdocs/flexycms/../var/localhost/templates_c/default\^%%35^35C^35CD1516%%right_pan.tpl.html.inc'] = '33854f0ae27451b4ceb56b4fa9827a8b'; ?>
<!-- Template: user/right_pan.tpl.html Start 17/12/2011 09:52:44 --> 
 <br/>
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
</br>
<?php if ($_SESSION['id_user']): ?>  <!-- If not logged in, then don't show -->
	<div class="fbfrnd">
		<a href="javascript:void(0);" onclick="invitePopup();" class="facebook">Invite Facebook Friends </a>
	</div>
<br>
<?php endif; ?>
<?php if ($_SESSION['id_user']): ?>
    <a href="javascript:void(0);" onclick="show_memeje_frnds();">Find friends in Memeja to add</a><br />
    <div id="show_profile_info" style="position: fixed;background-color:white;border: 1px solid #CAD8F3;"></div>
    <div >
		<br>
		<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:33854f0ae27451b4ceb56b4fa9827a8b#0}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'user','mgr' => 'user','choice' => 'friend_list','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:33854f0ae27451b4ceb56b4fa9827a8b#0}';}?>

    </div>
    <div>
		<br>
		<a href="http://localhost/manage/suggestion">Suggestions</a>
    </div>
	<div>
	    <br>
	    <?php if ($this->caching && !$this->_cache_including) { echo '{nocache:33854f0ae27451b4ceb56b4fa9827a8b#1}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'paypal','mgr' => 'paypal','choice' => 'form'), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:33854f0ae27451b4ceb56b4fa9827a8b#1}';}?>

	</div>
<?php endif; ?>
<?php echo '
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
				\'<fb:multi-friend-selector bypass="cancel" showborder="false" actiontext="Invite your friends to this network." exclude_ids="\'+z+\'"  max="20" rows="2" cols="3" email_invite="false" import_external_friends="false" condensed="false" uid=""/> \'+
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