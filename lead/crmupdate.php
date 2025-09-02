<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

use Bitrix\Main\Loader;
use Bitrix\Crm\Service\Container;

if (!Loader::includeModule("crm")) {
    return;
}


//$dealFields =[
//    'TITLE' => 'Обновленная сделка тестовая, старое ядро'
//];
//
//$newDealModel = new \CCrmDeal();
//$newDealId = $newDealModel->Update(13, $dealFields);
//
//echo 'ID: ' . 13 . '<br>';





$Factory = Container::getInstance()->getFactory(\CCrmOwnerType::Deal);

if (!$Factory) {
    die('Модуль CRM не создан!');
}

$existDeal = 5;

$DealItem = $Factory->getItem($existDeal);
$DealItem->set('TITLE','обновленная сделка 5 crm D7!!!');
$DealItem->set('OPPORTUNITY',50000);

$dealAddOperation = $Factory->getUpdateOperation($DealItem);
$updateResult = $dealAddOperation->launch();

if ($updateResult->isSuccess()) {
    echo 'Сделка обновлена: ID ' . $updateResult->getId();
} else {
    echo 'Ошибка обновления: ' . implode('; ', $updateResult->getErrorMessages());
}







require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");