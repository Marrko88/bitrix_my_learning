<?php
declare(strict_types = 1);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

function division (float $a, float $b): int
{
 return $a / $b;
}

division(2,6);
//$APPLICATION->IncludeComponent("mk:crm_simpleform", "", [
//    'RESPONSIBLE_ID' => 1,
//]);
//echo "ttt1";
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");