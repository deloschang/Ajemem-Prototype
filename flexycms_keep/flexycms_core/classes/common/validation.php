<?php
class validator {
	function validate($validate_data_arr) {
        $vali_obj = new validator; 
		$error = array ();
		for ($i = 0; $i < count($validate_data_arr); $i ++) {
			$cur_validation = $validate_data_arr[$i];
			$args = join(",", array_slice($cur_validation, 4));
			$cond = $vali_obj->$cur_validation[1] ($cur_validation[2], $args);
			if (!$cond)
				$error[$cur_validation[0]] .= "   ".$cur_validation[3]."\n";
		}
		/*foreach($error as $k => $v){
				$final_error[$k] = "<img src='/images/ani-man7.gif' width=35 height=35 title='$v'>";	
		}
		*/
		return $error;
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
	function checkEmail($field) {
		return (preg_match('/^\w+(\.\w+)*@\w+(\.\w+)*\.\w{2,3}$/', $field));
	}
	function isEqual($field1, $field2) {
		return $field1 === $field2;
	}
	function checkValidemail($field) {
		if ($field == '') {
			return 1;
		} else {
			return (preg_match('/^\w+(\.\w+)*@\w+(\.\w+)*\.\w{2,3}$/', $field));
		}
	}
	function isEmpty($field) {
		$field = trim($field);
		return ($field != '');
	}
	function checkLength($field, $args = '') {
		if ($args) {
			list ($min, $max) = split(",", $args);
		}
		if (strlen($field) < $min) {
			return 0;
		} else
			if (strlen($field) > $max) {
				return 0;
			} else {
				return 1;
			}
	}
}
