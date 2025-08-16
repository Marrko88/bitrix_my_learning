<?php

// === Обязательная подготовка окружения для CLI ===
$_SERVER["DOCUMENT_ROOT"] = "/var/www/u3205002/data/www/my-bitrix-mmk.ru";
$_SERVER["REQUEST_METHOD"] = "CLI";
$_SERVER["REMOTE_ADDR"] = "127.0.0.1";
$_SERVER["SERVER_NAME"] = "my-bitrix-mmk.ru";
$_SERVER["HTTP_HOST"] = "my-bitrix-mmk.ru";
define("SITE_ID", "s1");

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
define("NO_AGENT_STATISTIC", true);
define("DisableEventsCheck", true);
define("BX_CRONTAB_SUPPORT", true);
define("BX_CRONTAB", true);

// Подключаем ядро (без вывода HTML)
ob_start();
require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";
ob_end_clean();

// Выводим список агентов одной строкой на запись
$agents = \CAgent::GetList(['ID' => 'ASC'], []);
while ($a = $agents->Fetch()) {
    echo $a['ID'] . ' | ' . $a['NAME'] . ' | MODULE:' . $a['MODULE_ID'] . ' | SITE:' . ($a['SITE_ID'] ?: 'NULL') . ' | NEXT:' . $a['NEXT_EXEC'] . ' | ACTIVE:' . $a['ACTIVE'] . "\n";
}
