<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (!\Bitrix\Main\Loader::includeModule('crm')) {
    die('Модуль CRM не подключен');
}

use Bitrix\Crm\StatusTable;

$result = StatusTable::getList([
    'filter' => ['ENTITY_ID' => 'SOURCE'],
    'select' => ['STATUS_ID', 'NAME']
]);
while ($row = $result->fetch()) {
    echo htmlspecialchars($row['STATUS_ID']).' — '.htmlspecialchars($row['NAME']).'<br>';
}

