<?php
class common {
	/*
	* Executes and SQL statement and returns an array of rows
	* the key of each row is the id_fld and the value is the value of val_fld
	* a collected from the database
	*
	* Pass an array $err as the fourth argument to get any error
	* messages recorded
	*
	*/
	function get_rows_as_assoc($sql, $id_fld1, $val_fld1, & $err) {
		$rows = getrows($sql, $err);
		if (count($rows) < 1)
		return array ();
		foreach ($rows as $row) {
			if (!is_array($val_fld1)) {
				$retarr[$row[$id_fld1]] = $row[$val_fld1];
			} else {
				foreach ($val_fld1 as $val) {
					$retarr[$row[$id_fld1]][$val] = $row[$val];
				}
			}
		}
		return $retarr;
	}
	function arrange_details_for_tpl($array_arrange, $key_field, $array1_reqd, $array2, $suffix) {
		foreach ($array_arrange as $row) {
			if (!$collected[$row[$key_field]]) {
				$new_rows[] = $row;
				$collected[$row[$key_field]] = 1;
			} else {
				$count = count($new_rows);
				foreach ($array2 as $field) {
					$new_rows[$count][$field.$suffix] = $row[$field];
					foreach ($array1_reqd as $fld) {
						$new_rows[$count][$fld] = $row[$fld];
					}
				}

			}
		}
		return $new_rows;
	}
	/*
	This function sets the session variables sort by and sort order for use by the Next Previous class for sorting
	call eg set_sort_pref['employee']
	*/
	function set_sort_pref($session_name_space, $def_sort_field, $type) {
		if (empty ($_SESSION[$session_name_space]['sort_by']))
			 $_SESSION[$session_name_space]['sort_by'] = $def_sort_field;
		if (!isset ($_SESSION[$session_name_space]['sort_order']))
			$_SESSION[$session_name_space]['sort_order'] = $type;
		if (isset($_REQUEST['sort_by'])) {
			if (isset($_REQUEST['sort_by']) || isset($def_sort_field)) {
				if ($_SESSION[$session_name_space]['sort_by'] == $_REQUEST['sort_by']) {
					$_SESSION[$session_name_space]['sort_order'] = ($_SESSION[$session_name_space]['sort_order'] == 'DESC') ? 'ASC' : 'DESC';
				} else {
					$_SESSION[$session_name_space]['sort_order'] = $type;
					$_SESSION[$session_name_space]['sort_by'] = isset($_REQUEST['sort_by'])?$_REQUEST['sort_by']:$def_sort_field;
				}
			}
		}
		/*else{
			  $_SESSION[$session_name_space]['sort_by'] = $def_sort_field ;
		}*/
		$sort_order = $_SESSION[$session_name_space]['sort_order'];
		return $sort_order;
	}


	function check_under_dev() {
		global $smarty;
		if (!defined("DEVELOPER_HOST")) {
		}
	}

	function check_permissions($role) {
		global $smarty;
		switch ($role) {
			case 'ADMIN' :
				if ($_SESSION['is_admin'] != 1) {
					$smarty->append("messages", getmessage('not_authorised', 'en'));
					$smarty->display("common/home.tpl.html");
					exit;
				}
				break;
			default :
		}
	}

	function util() {
		// use this area to set up any environment constants that you may need 
		$this->SERVER_ADDR = $_SERVER['SERVER_ADDR'];
	}
	function get_values_from_config($key, $sortby="") {
		if ($sortby) {
			$new = $GLOBALS['conf'][$key];
			asort($new);
			reset($new);
			return $new;
		} else {
//			print_r($GLOBALS['conf'][$key]);
			return $GLOBALS['conf'][$key];
		}
	}
	function get_values_from_config_reverse($key) {
		global $conf;
		return array_flip($conf[$key]);
	}
	/*
	* Collects values from the config file
	* Additionaly can be used to add some more values to the
	* options . typically needed when we have
	* conf['someparameter'][0] = yes
	* conf['someparameter'][1] = no
	*
	* and we wish to have another option like
	* conf['someparameter'][-1] = Don't care
	*/
	function append_to_values_from_config($key) {
		$retarr = $this->get_values_from_config($key);
		if (func_num_args() > 1) {
			$args = func_get_args();
			array_shift($args);
			$end = count($args);
			$start = 0;
			while ($start < $end) {
				if (is_array($args[$start])) {
					$retarr = array_merge($args[$start]);
				} else {
					$retarr[$args[$start]] = $args[++ $start];
				}
				$start ++;
			}
		}
		return $retarr;
	}

	function append_to_db_lookup_list($id_fld, $val_fld, $tbl, $ids_arr = "0") {
		$retarr = $this->get_db_lookup_list($id_fld, $val_fld, $tbl, $ids_arr);
		if (func_num_args() > 4) {
			$myargs = array_slice(func_get_args(), 3);
			$pairs = count($myargs) / 2;
			for ($i = 0; $i < $pairs; $i ++) {
				$retarr[$myargs[$i]] = $myargs[($i +1)];
			}
		}
		ksort($retarr);
		return $retarr;
	}

	function get_db_lookup_list($id_fld, $val_fld, $tbl, $ids_arr = "0", $where = "") {
		$sql = " SELECT $id_fld, $val_fld FROM ".TABLE_PREFIX."$tbl  $where  ORDER BY $val_fld ";
		if ($ids_arr) {
			if (is_array($ids_arr)) {
				$sql .= " WHERE $id_fld IN (".join(",", $ids_arr).") ";
			}
		}
		//echo "$sql";
		$rows = getrows($sql, $err);
		if ($err)
		return array (join('\n', $err));
		foreach ($rows as $row) {
			$ret_arr[$row[$id_fld]] = $row[$val_fld];
		}
		return $ret_arr;
	}

	function search_from_db($tbl, $wherecond = "0") {
		$sql = " SELECT * FROM ".TABLE_PREFIX."$tbl";
		if ($wherecond)
		$sql .= " WHERE $wherecond ";
		$rows = getrows($sql,$err);
		return $rows;
	}

	function search_from_db1($tbl1, $tbl2, $wherecond = "0", $key = "0") {
		$sql = " SELECT * FROM ".TABLE_PREFIX."$tbl1 ,".TABLE_PREFIX."$tbl2";
		if ($wherecond)
		$sql .= " WHERE $wherecond ";

		if ($key)
		$sql .= " AND ".TABLE_PREFIX."$tbl1.$key =".TABLE_PREFIX."$tbl2.$key";

		$rows = getrows($sql,$err);
		return $rows;
	}

	/*
	A week is defined to start from a particualar day ( eg. Monday ).
	Given a date , this function returns the date of the week starting day .
	*/
	function get_week_start($datetime, $week_start_day) {
		$year = strftime("%Y", $datetime);
		$week = strftime("%V", $datetime);
		$day = strftime("%w", $datetime);
		$target_date = mktime(0, 0, 0, date("m", $datetime), date("d", $datetime), date("Y", $datetime));
		while (strftime('%w', $target_date) != $week_start_day) {
			$target_date -= 60 * 60 * 24 * 1;
		}
		return $target_date;
	}

	function validate($validate_data_arr) {
		print_r($validate_data_arr);exit;
		$error = array ();
		for ($i = 0; $i < count($validate_data_arr); $i ++) {
			$cur_validation = $validate_data_arr[$i];
			$args = join(",", array_slice($cur_validation, 4));
			$cond = common::$cur_validation[1] ($cur_validation[2], $args);
			if (!$cond)
			$error[$cur_validation[0]] .= "   ".$cur_validation[3]."\n";
		}
		print_r($error);exit;
		return $error;

	}

	function isEmpty($field) {
		return (!empty($field));
	}

	function isDigit($field) {
		return (is_numeric($field));
	}

	function isAlphaNumeric($field) {
		return (preg_match('/^[a-zA-Z0-9]+$/', $field));
	}

	function checkQuotes($field) {
		return (!preg_match('/[\'\"]+/', $field));
	}

	function isAlpha($fields) {
		return (preg_match('/^[a-zA-Z]+$/', $fields));
	}

	function isAlphaSpace($field) {
		return (preg_match('/^[a-zA-Z\s]+$/', $field));
	}
}
 
class user_templates {
	function get_mod($arg,$smarty='',$action='0') {
		$module = $arg['mod'];
		$mgr = $arg['mgr'];
		$obj_name = "obj_".$module.'_'.(empty ($mgr) ? $module : $mgr);
		if(!empty($action)){
			$obj_name = 'action_'.$obj_name ;
		}
		if(!$smarty){
			$smarty = &$GLOBALS['smarty'];
		}
		if (!isset ($GLOBALS[$obj_name])) {
			include_once (AFIXI_CORE.'modules/module_manager.php');
			include_files('modules/'.$module);
			include_files('modules/'.$module.'/business');
			if (defined('ADMIN')) {
				include_files('modules/'.$module.'/admin/');
				$class_name = empty ($mgr) ? "admin_".$module : "admin_".$mgr;			
			} else {
				$class_name = empty ($mgr) ? $module."_mod_manager" : $mgr.'_manager';
			}
		//	print $class_name;
			$GLOBALS[$obj_name] = new $class_name ($smarty, $GLOBALS['_output'], $GLOBALS['_input'], $module);
		}
		if($action!=='0')$GLOBALS[$obj_name]->action_obj = 1;
		return $GLOBALS[$obj_name]->run($arg);

	}
}
