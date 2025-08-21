<?php


namespace Local\EventHandlers\Crm;

class LeadEvents
{
    public static function onBeforeCrmLeadAdd(&$arFields){
        if(empty($arFields['SOURCE_ID']) || $arFields['SOURCE_ID'] === 'CALL'){
            $arFields['SOURCE_ID'] = '1';
        }
    }
}