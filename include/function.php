<?php
    function toRuDate($date){
        $timestamp = strtotime($date);
        return date('d.m.Y H:i:s',$timestamp);
    }
 ?>
