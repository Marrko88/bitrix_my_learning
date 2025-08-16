<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

\Bitrix\Main\UI\Extension::load("ui.buttons");
\Bitrix\Main\UI\Extension::load("main.ui.grid");
\Bitrix\Main\UI\Extension::load("main.ui.filter");

$APPLICATION->IncludeComponent(
    "bitrix:main.ui.filter",
    "",
    [
        "FILTER_ID" => "MY_GRID_FILTER",
        "GRID_ID" => "MY_GRID",
        "FILTER" => [
            ["id" => "NAME", "name" => "Название", "type" => "text", "default" => true],
        ],
        "ENABLE_LABEL" => true,
    ]
);

echo '<br>';

$APPLICATION->IncludeComponent(
    "bitrix:main.ui.grid",
    "",
    [
        "GRID_ID" => "MY_GRID",
        "COLUMNS" => $arResult["HEADERS"],
        "ROWS" => $arResult["ROWS"],
        "NAV_OBJECT" => $arResult["NAV_OBJECT"],
        "TOTAL_ROWS_COUNT" => $arResult["TOTAL_ROWS_COUNT"],
        "SHOW_ROW_CHECKBOXES" => false,
        "SHOW_GRID_SETTINGS_MENU" => true,
        "SHOW_NAVIGATION_PANEL" => true,
        "SHOW_PAGINATION" => true,
        "SHOW_SELECTED_COUNTER" => false,
        "SHOW_TOTAL_COUNTER" => true,
        "ALLOW_COLUMNS_SORT" => true,
    ]
);

?>

<br>
<a class="ui-btn ui-btn-primary" href="?export=excel">Экспорт в Excel</a>
