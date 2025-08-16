<?php

$_SERVER["DOCUMENT_ROOT"] = "/var/www/u3205002/data/www/my-bitrix-mmk.ru";
require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";

$agents = \CAgent::GetList(['ID' => 'ASC'], []);
while ($a = $agents->Fetch()) {
    echo $a['NAME'] . ' | MODULE:' . $a['MODULE_ID'] . ' | SITE:' . $a['SITE_ID'] . ' | NEXT:' . $a['NEXT_EXEC'] . "\n";
}
