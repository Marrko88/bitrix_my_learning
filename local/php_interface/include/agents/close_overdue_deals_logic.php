<?php

file_put_contents($_SERVER['DOCUMENT_ROOT'].'/agent_test.log', date('Y-m-d H:i:s')." LOGIC CONNECTED\n", FILE_APPEND);
if (!\Bitrix\Main\Loader::includeModule("crm")) {
    file_put_contents($_SERVER['DOCUMENT_ROOT'].'/agent_test.log', "CRM не подключен\n", FILE_APPEND);
    return;
}

$today = new \Bitrix\Main\Type\DateTime();
$res = \Bitrix\Crm\DealTable::getList([
    'filter' => [
        '<CLOSEDATE' => $today,
        '!STAGE_SEMANTIC_ID' => ['S', 'F'],
    ],
    'select' => ['ID', 'ASSIGNED_BY_ID', 'TITLE', 'CLOSEDATE', 'STAGE_ID'],
]);
