<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$mods = \Bitrix\Main\ModuleManager::getInstalledModules();
foreach ($mods as $id => $ar) {
    echo $id . ' : ' . $ar['MODULE_NAME'] . '<br>';
}
