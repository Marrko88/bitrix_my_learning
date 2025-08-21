<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
\Bitrix\Main\EventManager::getInstance()->registerEventHandler(
    'crm',
    'onEntityDetailsTabsInitialized',
    'mk_customtab',
    'Mk\\CustomTab',
    'onEntityDetailsTabsInitialized'
);
echo "OK!";