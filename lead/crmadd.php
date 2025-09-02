<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

use Bitrix\Main\Loader;
use Bitrix\Crm\Service\Container;

if (!Loader::includeModule("crm")) {
    return;
}
$dealFactory = Container::getInstance()->getFactory(\CCrmOwnerType::Deal);

if (!$dealFactory) {
    die('Модуль CRM не создан!');
}

$newDealItem = $dealFactory->createItem();
$newDealItem->set('TITLE','Test crm D7!!!');
$newDealItem->set('OPPORTUNITY',10000);

$dealAddOperation = $dealFactory->getAddOperation($newDealItem);
$addResult = $dealAddOperation->launch();


echo 'ID  новой сделки на D7: ' . $addResult->getId() .PHP_EOL;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");