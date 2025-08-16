<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->IncludeComponent("mk:crm_simpleform", "", [
    'RESPONSIBLE_ID' => 1,
]);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");