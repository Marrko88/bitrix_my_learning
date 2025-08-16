<?php
// Регистрирую классы, обработчики событий

use Bitrix\Main\Loader;
Loader::registerAutoLoadClasses(
    "mk_customtab",
    [
        "Mk\\CustomTab" => "lib/CustomTab.php",
        "Mk\\CustomEntityTable" => "lib/customentitytable.php",
    ]
);