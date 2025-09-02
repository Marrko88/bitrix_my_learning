<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

use Bitrix\Main\Loader;
use Bitrix\Crm\Service\Container;

if (!Loader::includeModule("crm")) {
    return;
}

$id =11;
$Model = new \CCrmDeal();
$newDealId = $Model->Delete($id);

echo 'Delete: ' . $id . '<br>';





$Factory = Container::getInstance()->getFactory(\CCrmOwnerType::Deal);

if (!$Factory) {
    die('Модуль CRM не создан!');
}

$existDeal = 4;
$DealItem = $Factory->getItem($existDeal);

if (!$DealItem) {
    die('Сделка #' . $DealItem . ' не найдена или нет прав');
}

$dealDeleteOperation = $Factory->getDeleteOperation($DealItem);
$deleteResult = $dealDeleteOperation->launch();


echo 'Сделка удалена';








require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");