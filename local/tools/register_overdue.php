<?php

$_SERVER["DOCUMENT_ROOT"] = "/var/www/u3205002/data/www/my-bitrix-mmk.ru";
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
define("BX_CRONTAB_SUPPORT", true);
define("BX_CRONTAB", true);

require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php";

// удалим все старые записи
$rs = CAgent::GetList([], ['NAME' => '\Local\Crm\OverdueDealsAgent::run();']);
while ($a = $rs->Fetch()) { CAgent::Delete($a['ID']); }

// NEXT = текущее время минус 60 сек в "битриксовом" формате
$next = \Bitrix\Main\Type\DateTime::createFromTimestamp(time() - 60)->toString();

// добавляем под модулем main, РЕЖИМ — через интервал (period = "N")
$id = CAgent::AddAgent(
    "\\Local\\Crm\\OverdueDealsAgent::run();",
    "main",   // не crm
    "N",      // ВАЖНО: через заданный интервал
    60,       // интервал (сек)
    "",       // datecheck
    "Y",      // активен
    $next,    // дата следующего запуска
    100       // сортировка
);

echo "AGENT_ID=".$id."\n";
