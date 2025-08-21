<?php


namespace Local\EventHandlers\Crm;

use Relay\Event;

class LiadEvents
{
    public static function onBeforeCrmLeadAdd(&$arFields){
        if(empty($arFields['SOURCE_ID']) || $arFields['SOURCE_ID'] === 'CALL'){
            $arFields['SOURCE_ID'] = '1';
        }
    }
}