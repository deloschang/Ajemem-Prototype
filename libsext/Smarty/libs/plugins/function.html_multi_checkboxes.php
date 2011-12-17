<<<<<<< HEAD
<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {html_multi_checkboxes} function plugin
 *
 * File:       function.html_multi_checkboxes.php<br>
 * Type:       function<br>
 * Name:       html_checkboxes<br>
 * Date:       24.Feb.2003<br>
 * Purpose:    Prints out a list of checkbox input types<br>
 * Input:<br>
 *           - name       (optional) - string default "checkbox"
 *           - values     (required) - array
 *           - options    (optional) - associative array
 *           - checked    (optional) - array default not set
 *           - separator  (optional) - ie <br> or &nbsp;
 *           - output     (optional) - the output next to each checkbox
 *           - assign     (optional) - assign the output as an array to this variable
 *           - columns    (optional) - create final output as multi column output.
 * Examples:
 * <pre>
 * {html_multi_checkboxes values=$ids output=$names}
 * {html_multi_checkboxes values=$ids name='box' separator='<br>' output=$names}
 * {html_multi_checkboxes values=$ids checked=$checked separator='<br>' output=$names}
 * </pre>
 * @author     Christopher Kvarme <christopher.kvarme@flashjab.com>
 * @author credits to Monte Ohrt <monte@ispi.net>
 * @version    1.0
 * @param array
 * @param Smarty
 * @return string
 * @uses smarty_function_escape_special_chars()
 */
function smarty_function_html_multi_checkboxes($params, &$smarty)
{
    require_once $smarty->_get_plugin_filepath('shared','escape_special_chars');
    $name = 'checkbox';
    $values = null;
    $options = null;
    $selected = null;
    $separator = '';
    $labels = true;
    $output = null;
    $extra = '';
	$columns = 0;
	$minspace = 0;
	$width = '100%';

    foreach($params as $_key => $_val) {
        switch($_key) {
            case 'name':
            case 'separator':
                $$_key = $_val;
                break;
            case 'width':
                $$_key = $_val;
                break;
			case 'minspace':
                $$_key = $_val.' px';
                break;
            case 'columns':
                $$_key = $_val;
                break;

            case 'labels':
                $$_key = (bool)$_val;
                break;

            case 'options':
                $$_key = (array)$_val;
                break;

            case 'values':
            case 'output':
                $$_key = array_values((array)$_val);
                break;

            case 'checked':
            case 'selected':
                $selected = array_map('strval', array_values((array)$_val));
                break;

            case 'checkboxes':
                $smarty->trigger_error('html_checkboxes: the use of the "checkboxes" attribute is deprecated, use "options" instead', E_USER_WARNING);
                $options = (array)$_val;
                break;

            case 'assign':
                break;

            default:
                if(!is_array($_val)) {
                    $extra .= ' '.$_key.'="'.smarty_function_escape_special_chars($_val).'"';
                } else {
                    $smarty->trigger_error("html_checkboxes: extra attribute '$_key' cannot be an array", E_USER_NOTICE);
                }
                break;
        }
    }

    if (!isset($options) && !isset($values))
        return ''; /* raise error here? */

    settype($selected, 'array');
    $_html_result = array();

    if (is_array($options)) {
        foreach ($options as $_key=>$_val) {
            $_html_result[] = smarty_function_html_multi_checkboxes_output($name, $_key, $_val, $selected, $extra, $separator, $labels);
		}
    } else {
        foreach ($values as $_i=>$_key) {
            $_val = isset($output[$_i]) ? $output[$_i] : '';
            $_html_result[] = smarty_function_html_multi_checkboxes_output($name, $_key, $_val, $selected, $extra, $separator, $labels);
        }
    }

	if ($columns>0) {
		$_rows = ceil(count($_html_result)/$columns);
		$old_html_result = $_html_result;
		$_html_result = "";
		$_html_result[] = "<table width='$width'><tr><td valign='top' class='multi_table_td'>";
		$i = 1;
		foreach ($old_html_result as $_i=>$_key) {
			$_len = strlen($_key);
			$_html_result[] = $_key;
			if ($i%$_rows == 0) {
				$_html_result[] = "</td><td valign='top'  class='multi_table_td'>";
			} else {
				$_html_result[] = "<br>";
			}
			$i++;
		}
		$_html_result[] = "</td></tr></table>";
	}

    if(!empty($params['assign'])) {
        $smarty->assign($params['assign'], $_html_result);
    } else {
        return implode("\n",$_html_result);
    }

}
function smarty_function_html_multi_checkboxes_output($name, $value, $output, $selected, $extra, $separator, $labels) {
    static $cnt=0;
    $_output = '';
    if ($labels) $_output .= '<div>';
    $_output .= '<Input type="checkbox" name="'
        . smarty_function_escape_special_chars($name) . '[]" id=id'.$cnt++.' value="'
        . smarty_function_escape_special_chars($value) . '"';

    if (in_array((string)$value, $selected)) {
        $_output .= ' checked="checked"';
    }
    $_output .= $extra . ' />' . $output;
    if ($labels) $_output .= '</div>';
    $_output .=  $separator;

    return $_output;
}

?>
=======
<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {html_multi_checkboxes} function plugin
 *
 * File:       function.html_multi_checkboxes.php<br>
 * Type:       function<br>
 * Name:       html_checkboxes<br>
 * Date:       24.Feb.2003<br>
 * Purpose:    Prints out a list of checkbox input types<br>
 * Input:<br>
 *           - name       (optional) - string default "checkbox"
 *           - values     (required) - array
 *           - options    (optional) - associative array
 *           - checked    (optional) - array default not set
 *           - separator  (optional) - ie <br> or &nbsp;
 *           - output     (optional) - the output next to each checkbox
 *           - assign     (optional) - assign the output as an array to this variable
 *           - columns    (optional) - create final output as multi column output.
 * Examples:
 * <pre>
 * {html_multi_checkboxes values=$ids output=$names}
 * {html_multi_checkboxes values=$ids name='box' separator='<br>' output=$names}
 * {html_multi_checkboxes values=$ids checked=$checked separator='<br>' output=$names}
 * </pre>
 * @author     Christopher Kvarme <christopher.kvarme@flashjab.com>
 * @author credits to Monte Ohrt <monte@ispi.net>
 * @version    1.0
 * @param array
 * @param Smarty
 * @return string
 * @uses smarty_function_escape_special_chars()
 */
function smarty_function_html_multi_checkboxes($params, &$smarty)
{
    require_once $smarty->_get_plugin_filepath('shared','escape_special_chars');
    $name = 'checkbox';
    $values = null;
    $options = null;
    $selected = null;
    $separator = '';
    $labels = true;
    $output = null;
    $extra = '';
	$columns = 0;
	$minspace = 0;
	$width = '100%';

    foreach($params as $_key => $_val) {
        switch($_key) {
            case 'name':
            case 'separator':
                $$_key = $_val;
                break;
            case 'width':
                $$_key = $_val;
                break;
			case 'minspace':
                $$_key = $_val.' px';
                break;
            case 'columns':
                $$_key = $_val;
                break;

            case 'labels':
                $$_key = (bool)$_val;
                break;

            case 'options':
                $$_key = (array)$_val;
                break;

            case 'values':
            case 'output':
                $$_key = array_values((array)$_val);
                break;

            case 'checked':
            case 'selected':
                $selected = array_map('strval', array_values((array)$_val));
                break;

            case 'checkboxes':
                $smarty->trigger_error('html_checkboxes: the use of the "checkboxes" attribute is deprecated, use "options" instead', E_USER_WARNING);
                $options = (array)$_val;
                break;

            case 'assign':
                break;

            default:
                if(!is_array($_val)) {
                    $extra .= ' '.$_key.'="'.smarty_function_escape_special_chars($_val).'"';
                } else {
                    $smarty->trigger_error("html_checkboxes: extra attribute '$_key' cannot be an array", E_USER_NOTICE);
                }
                break;
        }
    }

    if (!isset($options) && !isset($values))
        return ''; /* raise error here? */

    settype($selected, 'array');
    $_html_result = array();

    if (is_array($options)) {
        foreach ($options as $_key=>$_val) {
            $_html_result[] = smarty_function_html_multi_checkboxes_output($name, $_key, $_val, $selected, $extra, $separator, $labels);
		}
    } else {
        foreach ($values as $_i=>$_key) {
            $_val = isset($output[$_i]) ? $output[$_i] : '';
            $_html_result[] = smarty_function_html_multi_checkboxes_output($name, $_key, $_val, $selected, $extra, $separator, $labels);
        }
    }

	if ($columns>0) {
		$_rows = ceil(count($_html_result)/$columns);
		$old_html_result = $_html_result;
		$_html_result = "";
		$_html_result[] = "<table width='$width'><tr><td valign='top' class='multi_table_td'>";
		$i = 1;
		foreach ($old_html_result as $_i=>$_key) {
			$_len = strlen($_key);
			$_html_result[] = $_key;
			if ($i%$_rows == 0) {
				$_html_result[] = "</td><td valign='top'  class='multi_table_td'>";
			} else {
				$_html_result[] = "<br>";
			}
			$i++;
		}
		$_html_result[] = "</td></tr></table>";
	}

    if(!empty($params['assign'])) {
        $smarty->assign($params['assign'], $_html_result);
    } else {
        return implode("\n",$_html_result);
    }

}
function smarty_function_html_multi_checkboxes_output($name, $value, $output, $selected, $extra, $separator, $labels) {
    static $cnt=0;
    $_output = '';
    if ($labels) $_output .= '<div>';
    $_output .= '<Input type="checkbox" name="'
        . smarty_function_escape_special_chars($name) . '[]" id=id'.$cnt++.' value="'
        . smarty_function_escape_special_chars($value) . '"';

    if (in_array((string)$value, $selected)) {
        $_output .= ' checked="checked"';
    }
    $_output .= $extra . ' />' . $output;
    if ($labels) $_output .= '</div>';
    $_output .=  $separator;

    return $_output;
}

?>
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
