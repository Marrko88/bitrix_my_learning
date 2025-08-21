<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\UI\Extension;
Extension::load("ui.grid");

$gridId = "CRM_CUSTOM_TAB_GRID_".$arParams["ENTITY_ID"];
$rows = [];

foreach ($arResult["ROWS"] as $item) {
    $rows[] = [
        'data' => [
            'ID' => $item['ID'],
            'TITLE' => $item['TITLE'],
            'DATE_CREATE' => $item['DATE_CREATE'],
        ]
    ];
}

$columns = [
    ['id' => 'ID', 'name' => 'ID', 'default' => true],
    ['id' => 'TITLE', 'name' => 'Название', 'default' => true],
    ['id' => 'DATE_CREATE', 'name' => 'Дата', 'default' => true],
];

$APPLICATION->IncludeComponent(
    'bitrix:main.ui.grid',
    '',
    [
        'GRID_ID' => $gridId,
        'COLUMNS' => $columns,
        'ROWS' => $rows,
        'SHOW_ROW_CHECKBOXES' => false,
        'NAV_OBJECT' => null,
        'TOTAL_ROWS_COUNT' => count($rows),
        'SHOW_PAGINATION' => false,
        'SHOW_TOTAL_COUNTER' => false,
        'SHOW_PAGESIZE' => false,
        'SHOW_ACTION_PANEL' => false,
        'ALLOW_COLUMNS_SORT' => false,
        'ALLOW_ROWS_SORT' => false,
        'ALLOW_COLUMNS_RESIZE' => true,
        'ALLOW_HORIZONTAL_SCROLL' => true,
        'ALLOW_SORT' => false,
        'ALLOW_PIN_HEADER' => true,
        'AJAX_MODE' => 'Y',
    ]
);