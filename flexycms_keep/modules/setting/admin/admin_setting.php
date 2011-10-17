<?php

class admin_setting extends setting_manager {

    function admin_setting(&$smarty, &$_output, &$_input) {

	$this->setting_manager($smarty, $_output, $_input, 'setting');
	$this->obj_setting = new setting;
	$this->setting_bl = new setting_bl;
    }

    function get_module_name() {
	return 'setting';
    }

    function get_manager_name() {
	return 'setting';
    }

    function _default() {
	return $this->_listing();
    }

    function _test() {
	$this->_output['tpl'] = 'admin/setting/test';
    }

##################################################
##################################################
##################################################

    function _listing() {
	if (!$_SESSION['id_developer']) {
	    $cond = " WHERE is_editable=1 ";
	    $this->_output['tpl'] = 'admin/setting/listing';
	} else {
	    $cond = '';
	    $this->_output['tpl'] = 'admin/setting/dev_listing';
	}
	$sql = "SELECT * FROM " . TABLE_PREFIX . "config" . $cond . " ORDER BY	name,id_seq ";
	$this->_output['res'] = getrows($sql, $err);
    }

##################################################
##################################################
##################################################

    function _add() {
	$sql.=get_search_sql('config', '');
	if ($this->_input['id_config']) {
	    $sql.= " WHERE id_config = '" . $this->_input['id_config'] . "' LIMIT 1";
	    $this->_output['section'] = getsingleindexrow($sql);
	    $this->_output['add_section'] = 1;
	} else {
	    $sql.=" GROUP BY name";
	    $this->_output['section'] = getindexrows($sql, 'name', 'name');
	}
	$this->_output['f_type'] = array("text" => "Text", "radio" => "Radio", "checkbox" => "Checkbox", "dropdown" => "Drop Down");
	$this->_output['tpl'] = 'admin/setting/dev_add';
    }

##################################################
##################################################
##################################################

    function _edit() {
	$sql = "SELECT * FROM " . TABLE_PREFIX . "config GROUP BY name";
	$this->_output['section'] = getindexrows($sql, 'name', 'name');
	$sql_config = get_search_sql('config', "id_config = '" . $this->_input['id_config'] . "' LIMIT 1");
	$res = getrows($sql_config, $err);
	$this->_output['res'] = $res[0];
	$this->_output['f_type'] = array("text" => "Text", "radio" => "Radio", "checkbox" => "Checkbox", "dropdown" => "Drop Down");
	$this->_output['tpl'] = 'admin/setting/dev_add';
    }

##################################################
##################################################
##################################################

    function _update_config() {
	$sectype = $this->_input['sectype'];
	//print_r($this->_input[$sectype]);exit;
	//$usql='';
	foreach ($this->_input[$sectype] as $key => $value) {
	    if ($_SESSION['id_developer']) {
		if (is_array($this->_input[$sectype][$key][$key])) {
		    $this->_input[$sectype][$key][$key] = implode(",", $this->_input[$sectype][$key][$key]);
		}
		$usql = "UPDATE " . TABLE_PREFIX . "config SET value='" . $this->_input[$sectype][$key][$key] . "',comment='" . $this->_input[$sectype][$key]['comment'] . "' WHERE id_config=" . $key;
	    } else {
		if (is_array($value)) {
		    $value = implode(",", $value);
		}
		$usql = "UPDATE " . TABLE_PREFIX . "config SET value='" . $value . "' WHERE id_config=" . $key;
	    }
	    //print $usql;exit;
	    execute($usql, $err);
	}
	//print $usql;exit;
	$this->write_config('ajax');
    }

##################################################
##################################################
##################################################

    function _delete_config() {
	ob_clean();
	$keys = stripslashes($this->_input['keys']);
	$keys = trim($keys, ',');
	//print $keys;exit;
	$dsql = "DELETE FROM " . TABLE_PREFIX . "config WHERE id_config IN(" . $keys . ")";
	execute($dsql, $err);
	$this->write_config('ajax');
    }

##################################################
##################################################
##################################################

    function _set_config() {
	//print_r($this->_input);exit;
	//print_r($this->_input['sec']);exit;//[name] => IMAGE_PATH [ckey] => d [value] => d
	ob_clean();
	$cond = " ckey='" . $this->_input['sec']['ckey'] . "' LIMIT 1";
	$csql = get_search_sql('config', $cond);
	$cres = getsingleindexrow($csql);
	if ($cres['name'] == $this->_input['sec']['name']) {
	    print "no";
	    exit;
	} else {
	    //$this->_input['sec']['name']=trim($this->_input['sec']['name'],' ');
	    $this->_input['sec']['name'] = str_replace(" ", "_", trim($this->_input['sec']['name']));
	    $this->_input['sec']['name'] = strtoupper($this->_input['sec']['name']);
	    $this->obj_setting->insert($this->_input['sec']);
	    $this->write_config('ajax');
	}
    }

##################################################
##################################################
##################################################

    function _edit_config() {
	//print_r($this->_input);exit;
	//print_r($this->_input['sec']);exit;//[name] => IMAGE_PATH [ckey] => d [value] => d
	ob_clean();
	$cond = " ckey='" . $this->_input['sec']['ckey'] . "' AND id_config != '" . $this->_input['id_config'] . "' LIMIT 1";
	$csql = get_search_sql('config', $cond);
	$cres = getsingleindexrow($csql);
	if ($cres['name'] == $this->_input['sec']['name']) {
	    print "no";
	    exit;
	} else {
	    $this->_input['sec']['name'] = strtoupper($this->_input['sec']['name']);
	    $this->obj_setting->edit_config($this->_input['sec'], $this->_input['id_config']);
	    $this->write_config('ajax');
	}
    }

##################################################
##################################################
##################################################

    function write_config($p='') {
	$sql = "SELECT * FROM " . TABLE_PREFIX . "config ORDER BY name,id_config";
	$res = getrows($sql, $err);
	foreach ($res as $key => $val) {
	    $sampleData[$val['name']][$val['ckey']] = $val['value'];
	}
	/* $st=mysql_query($sql);
	  while($res1=mysql_fetch_assoc($st)){
	  $sampleData[$res1['name']][$res1['ckey']]=$res1['value'];
	  } */

	//print APP_ROOT.'flexycms/configs/'.$_SERVER['HTTP_HOST'].'/config.ini.php';exit;
	$f = $this->write_ini_file($sampleData, APP_ROOT . 'flexycms/configs/' . SITE_USED . '/config.ini.php');
	//$f=$this->write_ini_file($sampleData, APP_ROOT.'/pjconfig.ini.php');
	if ($p) {
	    print LBL_ADMIN_SITE_URL . "index.php/setting/listing";
	} else {
	    redirect(LBL_ADMIN_SITE_URL . "index.php/setting/listing");
	}
    }

##################################################
##################################################
##################################################

    function write_ini_file($assoc_arr, $path, $has_sections=TRUE) {
	$content = "";
	if ($has_sections) {
	    foreach ($assoc_arr as $key => $elem) {
		if ($content)
		    $content .= "\n";
		$content .= "[" . $key . "]\n";
		foreach ($elem as $key2 => $elem2) {
		    if (is_array($elem2)) {
			for ($i = 0; $i < count($elem2); $i++) {
			    $content .= $key2 . "[] = \"" . $elem2[$i] . "\"\n";
			}
		    } else if ($elem2 == "")
			$content .= $key2 . " = \n";
		    else
			$content .= $key2 . " = \"" . $elem2 . "\"\n";
		}
	    }
	}else {
	    foreach ($assoc_arr as $key => $elem) {
		if (is_array($elem)) {
		    for ($i = 0; $i < count($elem); $i++) {
			$content .= $key2 . "[] = \"" . $elem[$i] . "\"\n";
		    }
		} else if ($elem == "")
		    $content .= $key2 . " = \n";
		else
		    $content .= $key2 . " = \"" . $elem . "\"\n";
	    }
	}
	if (!$handle = fopen($path, 'w')) {
	    return false;
	}
	if (!fwrite($handle, $content)) {
	    return false;
	}
	fclose($handle);
	return true;
    }

##################################################
##################################################
##################################################

    function _reorder() {
	//print $this->_input['tab'];exit;
	$ordered = explode(',', $this->_input['tab']);
	$cnt = count($ordered);
	for ($i = 0; $i < $cnt; $i++) {
	    $j = $i + 1;
	    $sql = "UPDATE " . TABLE_PREFIX . "config SET id_seq = " . $j . " WHERE id_config = " . $ordered[$i];
	    execute($sql, $err);
	}
    }

    //Added By Parwesh For Message Management
    ##################################################
    ## _msg_list () : List Of Messages ###############
    ##################################################
    function _msg_list($flag='', $ser_msg_name='') {
	$uri = 'flexyadmin/index.php/setting/msg_list';
	$ser_msg_name = $this->_input['ser_msg_name'] ? $this->_input['ser_msg_name'] : '';
	$flag = $this->_input['flag'] ? $this->_input['flag'] : $flag;
	//$cond1 = "lang_code = '".$GLOBALS['conf']['LANGUAGE']['English']."'";
	$cond1 = "1";
	if ($ser_msg_name) {
	    $cond1.=" AND (key_name like '%" . $ser_msg_name . "%' OR key_value like '%" . $ser_msg_name . "%')";
	    $uri.="/ser_msg_name/" . $ser_msg_name;
	}

	$this->_output['uri'] = $uri;
	$this->_output['type'] = "extra";  // no, extra, nextprev, advance, normal, box
	$this->_output['ajax'] = "1";
	$this->_output['pg_header'] = "Message Listing";
	$this->_output['sort_by'] = "lang_code";

	$this->_output['field'] = array("key_name" => array("Message Key", 1), "key_value" => array("Message Value", 1), "lang_code" => array("Language", 1));

	$this->_output['links'][] = array("Edit", "", "id_message", LBL_SITE_URL . "templates/css_theme/img/led-ico/pencil.png", "function" => "edit_msg");
	if ($_SESSION['id_developer']) {
	    $this->_output['links'][] = array("Delete", "", "key_name", LBL_SITE_URL . "templates/css_theme/img/led-ico/delete.png", "function" => "delete_msg");
	}

	$this->_output['limit'] = $GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
	$sql = get_search_sql("message", $cond1);
	//print $sql;exit;
	$this->_output['sql'] = $sql;

	if ($this->_input['pg'] || $ser_msg_name || $flag) {
	    $this->setting_bl->page_listing($this, "admin/setting/msg_list");
	} else {
	    $this->setting_bl->page_listing($this, "admin/setting/msg_search");
	}
    }

    ##################################################
    ## _add_msg () : Open Form To Add Message ########
    ##################################################

    function _add_msg() {
	$this->_output['language'] = $GLOBALS['conf']['LANGUAGE'];
	$sel_lang = isset($this->_input['lang_code']) ? $this->_input['lang_code'] : $GLOBALS['conf']['LANGUAGE']['English'];
	$this->_output['sel_lang'] = $sel_lang;
	if (!$this->_input['chk']) {
	    $this->_output['tpl'] = 'admin/setting/add_msg_main';
	} else {
	    $cond = "key_name = '" . strtoupper($this->_input['key_name']) . "' AND lang_code ='" . $sel_lang . "'";
	    $sql = get_search_sql("message", $cond);
	    $res = mysql_fetch_assoc(mysql_query($sql));
	    $this->_output['row'] = $res;
	    $this->_output['tpl'] = 'admin/setting/add_msg_new';
	}
    }

    ##################################################
    ## _insert_msg () : Insert A New Message #########
    ##################################################

    function _insert_msg() {
	ob_clean();
	$data = $this->_input['msg'];
	//echo"<pre>";print_r($data);exit;
	if ($data['key_name']) {
	    $sql = $this->obj_setting->insert_msg($data);
	    //print $sql;exit;
	    mysql_query($sql);
	    print mysql_insert_id();
	    $this->write_file();
	    exit;
	} else {
	    print 0;
	    exit;
	}
    }

    ##################################################
    ## _update_msg() : Updated Message ###############
    ##################################################

    function _update_msg() {
	$data = $this->_input['msg'];
	$sql = $this->obj_setting->edit_msg($data, $this->_input['id_message']);
	mysql_query($sql);
	$this->write_file();
    }

    ##################################################
    ## _edit_msg () : Open Form Edit Message #########
    ##################################################

    function _edit_msg() {
	$cond = "id_message = '" . $this->_input['id_msg'] . "' ";
	$sql = get_search_sql("message", $cond);
	$res = mysql_fetch_assoc(mysql_query($sql));
	$this->_output['row'] = $res;
	$this->_output['language'] = $GLOBALS['conf']['LANGUAGE'];
	$this->_output['sel_lang'] = $res['lang_code'];
	$this->_output['tpl'] = 'admin/setting/add_msg_main';
    }

    ##################################################
    ## _update_msg() : Updated Message ###############
    ##################################################

    function _delete_msg() {
	$sql = $this->obj_setting->delete_msg($this->_input['key_name']);
	mysql_query($sql);
	$this->write_file();
	//print APP_ADMIN_ROOT_URL."index.php/page-setting-choice-msg_list-msg-delete";
	$this->_msg_list(1, $this->_input['ser_msg_name']);
    }

    ##################################################
    ## check_duplicate_key() : Check Duplicate Key ###
    ##################################################

    function _check_duplicate_key() {
	ob_clean();
	$msg_key = $this->_input['msg_key'];
	$cond = "key_name = '" . strtoupper($msg_key) . "' LIMIT 1";
	$sql = get_search_sql("message", $cond);
	$rs = mysql_query($sql);
	if ($rs) {
	    $res = mysql_fetch_assoc($rs);
	    if ($res) {
		print "err::1";
	    } else {
		print true;
	    }
	} else {
	    print true;
	}
	exit;
    }

    ##################################################
    ## write_file() : Write data from table to file ##
    ##################################################

    function write_file() {
	$fp = fopen(AFIXI_ROOT . "configs/" . SITE_USED . "/message_constant.php", "w");
	$sql = get_search_sql("message", "");
	$res = getrows($sql, $err);
	$line = "<?php\n/* This is a system generated file. Please do not modified it manually */\n";
	foreach ($res as $key => $val) {
	    $key_lang_code = $val['key_name'] . "_" . strtoupper($val['lang_code']);
	    $line .= "define('" . $key_lang_code . "','" . addslashes($val['key_value']) . "');" . "\n";
	}
	$line .="?>";
	fwrite($fp, $line);
	fclose($fp);
    }
}
