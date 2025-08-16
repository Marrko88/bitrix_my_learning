<?php
$_SERVER["DOCUMENT_ROOT"] = "/var/www/u3205002/data/www/my-bitrix-mmk.ru";
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);

// помечаем, что работаем из крона
define("BX_CRONTAB_SUPPORT", true);
define("BX_CRONTAB", true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
file_put_contents($_SERVER["DOCUMENT_ROOT"]."/local/logs/agent_from_cron.log", SITE_ID." DB=".COption::GetOptionString("main","server_name")."\n", FILE_APPEND);

file_put_contents($_SERVER["DOCUMENT_ROOT"]."/local/cron_test.log", date('c')."\n", FILE_APPEND);
file_put_contents($_SERVER["DOCUMENT_ROOT"]."/local/logs/agent_from_cron.log", date('c')." cron\n", FILE_APPEND);
// запустить очередь агентов
CAgent::CheckAgents();

// (опционально) системные штуки: рассылки/бэкапы и т.п.
// require($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/tools/backup.php");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");

