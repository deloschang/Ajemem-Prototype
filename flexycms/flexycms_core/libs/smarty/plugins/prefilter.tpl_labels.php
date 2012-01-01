<?php
/*
* Smarty plugin 
* -------------------------------------------------------------
* File:     prefilter.tpl.php
* Type:     prefilter
* Name:     tpl_labels
* Purpose:  Adds template name and date of compilation
*           Convert Labels identified with defined values in the labels file.
* Revision 1.1:
* 			If the template have "{* nofilter file='debug' *}" tag, It will not include the debug template.
* 			If the template have "{* notag *}" tag, It will not include comment tag  template.
* * -------------------------------------------------------------
*/
function smarty_prefilter_tpl_labels($source, &$smarty) {
	// Add the template name and date of compilation
	$compiled_date = date('d/m/Y H:i:s');
	$nodebug = preg_match('/{\*([\s]+)*nofilter([\s]+)*file([\s]+)*=([\s]+)*"debug"([\s]+)*\*}/i',$source,$matches);
	$nodebug = 1; // Hardcoded by Pati since we dont want to use it now.
	$notag = preg_match('/{\*([\s]+)*notag([\s]+)*\*}/i',$source,$mat);
	if($nodebug){
		if(!$notag){			
			$comment_start = "\n<!-- Template: ".$smarty->_current_file." Start ".$compiled_date." --> \n ";
			$comment_end = "\n<!-- Template: ".$smarty->_current_file." End --> \n";


			$start_tag_position = preg_match('/{\*([\s]+)*start_tag([\s]+)*\*}/i',$source,$mat);
			$end_tag_position = preg_match('/{\*([\s]+)*end_tag([\s]+)*\*}/i',$source,$mat);

			if ($start_tag_position) {
				$source = preg_replace('/{\*([\s]+)*start_tag([\s]+)*\*}/i',$comment_start,$source);
			} else {
					$source = $comment_start.$source;
			}
			if ($end_tag_position) {
				$source = preg_replace('/{\*([\s]+)*end_tag([\s]+)*\*}/i',$comment_end,$source);

			} else {
				$source .= $comment_end;
			}
		}
	}else{		
		$debug_source = include_debug($smarty->_current_file);
		if($notag){	
			$source .= $debug_source;
		}else{		
			$comment_start = "\n<!-- Template: ".$smarty->_current_file." Start ".$compiled_date." -->\n";
			$source = $comment_start.$debug_source.$source;
			$comment_end = "\n<!-- Template: ".$smarty->_current_file." End --> \n";
			$source .= $comment_end;
		}
	}	
	
	// replace labels if any in the template  
	//$labels_filename = $_SERVER['SERVER_NAME'].'.labels.php';

	include_once (AFIXI_ROOT.'labels/labels.php');
	//include_once(APP_ROOT."labels/$labels_filename");
	$lbl_file = AFIXI_ROOT.'labels/'.preg_replace('/\./', '_', $smarty->_current_file).'.php';
	
	//print_r($lbl_file);
	
	if (!file_exists($lbl_file)) {
		//$smarty->trigger_error ("Could not locate labels file $lbl_file for this template");
		@ touch($lbl_file);
	} else {
		include_once ($lbl_file); 
	} 

	$source = preg_replace('/{([\s]+)*myinclude([\s]+)*file([\s]+)*=([\s]+)*/', '{include file=', str_replace(array ("}"), ' }', $source));
	$source = preg_replace_callback('/{include file=.*?[\s]+/si', 'change', $source);
	
	// Match up 
	$replace = preg_match_all("/##([^#]*)##/im", $source, $matches);
	
	// If there are matched items...
	if ($replace) {
		$patterns_raw = array_unique($matches[1]);
				
		foreach ($patterns_raw as $pattern_raw) {
			if($pattern_raw != ''){
			
				// Creates ##LBL_SITE_URL## /i like pattern
				$patterns[] = '/##'.$pattern_raw.'##/i';
				$replacements[] = constant($pattern_raw);
			}
		}
		//print_r($replacements);
		$result = preg_replace($patterns, $replacements, $source);
		
		return $result;
	} else {
		return $source;
	}
}

function include_debug($current_file ){
	$root_dir = is_file(AFIXI_ROOT."../templates/".$_SESSION['AFIXI_THEME']."/common/debug".TEMPLATE_EXTENSION) ? $_SESSION['AFIXI_THEME'] : 'default';
	if ($current_file != "$root_dir/common/debug".TEMPLATE_EXTENSION) {
		$id = rand(5, 500);
		$debug_source = "{myinclude file='common/debug' id='".$id."' }";
	}
	return $debug_source;
}

function change($matches) {
	$tpl_name = trim(preg_replace('/{include file=/', ' ', (str_replace(array ("'", '"'), '', $matches[0]))));
	if ($tpl_name == '$content') {
		return '{include file=$content ';
	} else {
		$root_dir = is_file(AFIXI_ROOT."../templates/".$_SESSION['AFIXI_THEME'].'/'.$tpl_name.TEMPLATE_EXTENSION) ? $_SESSION['AFIXI_THEME'] : 'default';
		return '{include file="'.$tpl_name.TEMPLATE_EXTENSION.'" ';
	}
}

?>
