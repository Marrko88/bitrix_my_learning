<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Config\Option;

if(!Loader::includeModule('highloadblock')){
    return;
}

$TypeBlock = HL\HighloadBlockTable::getList([
    'filter' => [
        'NAME' => 'MatrialsTypes',
    ]
])->fetch();

$materialsTypesEntity = HL\HighloadBlockTable::compileEntity($TypeBlock);
$typesEntityClass = $materialsTypesEntity->getDataClass();


$materialsFields= [
    'UF_NAME' => 'Свинец',
    'UF_XML_ID' => 'LEAD'
];


$result = $typesEntityClass::add($materialsFields);


echo $result->getId();


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");