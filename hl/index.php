<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Config\Option;

if(!Loader::includeModule('highloadblock')){
    return;
}



$hlBlockId = Option::get("otus.options", "MATERIL_TYPS",2);
$objHlblock = HL\HighloadBlockTable::getById($hlBlockId)->fetch(); //определяем объект hl-блока
$materialsTypesEntity = HL\HighloadBlockTable::compileEntity([
        'ID' => 1,
        'NAME' =>   'ProductMarkingCodeGroup',
        'TABLE_NAME' => 'b_hlsys_marking_code_group',
]);//генерация класса
$materialsTypesEntityClass = $materialsTypesEntity->getDataClass();


$raw = $materialsTypesEntityClass::getList([
    'filter' => [
//        '%UF_CODE' => 'steel',
    ],
    'select' => [
        'UF_NAME',
        'ID',
    ]
])->fetchAll();


foreach($raw as $r){
    p($r);
}
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");