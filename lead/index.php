<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
use Bitrix\Main\Loader;
use Bitrix\Crm\Service\Container;

if(!Loader::includeModule("crm")){
    return;
}

//$rawLeads = \Bitrix\Crm\LeadTable::getList([
//    'select' => [
//        'ID',
//        'TITLE',
//        'UF_TEST_CRM_LEAD'
//    ]
//])->fetchAll();
//
//foreach ($rawLeads as $lead) {
//    p($lead);
//}



//Получение лидов
//$order = [
//    'TITLE' =>'ASC',
//];
//
//$dealFilter = [
//    'ID'=>[1,9,4]
//];
//$select = [
//        'ID',
//        'TITLE',
//        'UF_TEST_CRM_LEAD'
//    ];
//
//$dealFactory = Container::getInstance()->getFactory(\CCrmOwnerType::Lead);
//$dealItems = $dealFactory->getItems([
//    'filter' => $dealFilter,
//    'order' => $order,
//    'select' => $select,
//    'order' => $order,
//
//]);


$order = [
    'TITLE' =>'ASC',
];

$dealFilter = [

];
$select = [
    'ID',
    'TITLE',

];

$dealFactory = Container::getInstance()->getFactory(1036);
$dealItems = $dealFactory->getItems([
    'filter' => $dealFilter,
    'order' => $order,
    'select' => $select,


]);

foreach ($dealItems as $dealItem) {
    p($dealItem->getData());
}



require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");