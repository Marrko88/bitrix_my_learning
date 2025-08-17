<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->IncludeComponent("company:testgrid", "", []);
echo "ttt";
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
