<?php

function smarty_modifier_localdatetime($conv_fr_time,$conv_fr_zon=0,$conv_to_zon=0)
{
        $cd = strtotime($conv_fr_time);
        $gmdate = date('Y-m-d H:i:s', mktime(date('H',$cd),date('i',$cd)-($conv_fr_zon*60),date('s',$cd),date('m',$cd),date('d',$cd),date('Y',$cd)));              
        $gm_timestamp = strtotime($gmdate);
        $finaldate = date('Y-m-d H:i:s', mktime(date('H',$gm_timestamp ),date('i',$gm_timestamp )+($conv_to_zon*60),date('s',$gm_timestamp ),date('m',$gm_timestamp ),date('d',$gm_timestamp ),date('Y',$gm_timestamp )));
        return $finaldate;
}

/* vim: set expandtab: */

?>
