<?php


use Bitrix\Main\Loader;
use Bitrix\Crm\DealTable;
use Bitrix\Main\Type\DateTime;

function CloseOverdueDealsAgent()
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'].'/agent_test.log', date('Y-m-d H:i:s')." АГЕНТ ЗАПУЩЕН\n", FILE_APPEND);

    if(!\Bitrix\Main\Loader::includeModule("crm")){
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/agent_test.log', "CRM не подключен\n", FILE_APPEND);
        return "CloseOverdueDealsAgent();";
    }

    $today = new \Bitrix\Main\Type\DateTime();
    $res = \Bitrix\Crm\DealTable::getList([
        'filter' => [
            '<CLOSEDATE' => $today,
            '!STAGE_SEMANTIC_ID' => ['S', 'F'],
        ],
        'select' => ['ID', 'ASSIGNED_BY_ID', 'TITLE', 'CLOSEDATE', 'STAGE_ID'],
    ]);
    $found = false;
    while($deal = $res->fetch()){
        $found = true;
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/agent_test.log', "Найдена: ID {$deal['ID']}, CLOSEDATE: {$deal['CLOSEDATE']}, STAGE_ID: {$deal['STAGE_ID']}\n", FILE_APPEND);

        \CCrmDeal::Update($deal['ID'], [
            'STAGE_ID' => 'UC_YUZSEV',
        ]);
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/agent_test.log', "Обновил сделку {$deal['ID']}\n", FILE_APPEND);
    }
    if (!$found) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/agent_test.log', "Не найдено подходящих сделок\n", FILE_APPEND);
    }
    return "CloseOverdueDealsAgent();";
}

