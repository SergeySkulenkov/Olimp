<?php
    function toRuDate($date){
        $timestamp = strtotime($date);
        return date('d.m.Y H:i:s',$timestamp);
    }
    function getStrPart($str,$len){
        $order = array ("\r\n","\n","\r");
        if(mb_strlen($str, 'UTF-8')<=$len){
            return  str_replace($order, " ", $str);
        }
        $string = mb_substr($str,0,$len,'UTF-8');
        $pos = mb_strrpos($string," ",0,'UTF-8');
        $string = mb_substr($string,0,$pos,'UTF-8')."...";
        

        return str_replace($order, " ", $string);
    }
 ?>
