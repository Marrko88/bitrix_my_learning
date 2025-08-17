<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вывод данных списков car");

use Bitrix\Main\Loader;
use Bitrix\Iblock\Iblock;
Loader::includeModule("iblock");
$iblockId= 17;
$iblockElementId= 39;

//$arFilter=['IBLOCK_ID'=>$iblockId, 'ACTIVE'=>'Y'];
//$arSelect = ['ID', 'NAME', 'CODE', 'PROPERTY_MODEL'];
//
//$res = CIBlockElement::GetList([], $arFilter,false, [], $arSelect);
//while($arRes = $res->fetch()){
//    p($arRes);
//}



//
//$arElementsProps =[
//    'MODEL'=>'X5'
//];
//
//$arIblockFilds = [
//    'IBLOCK_ID' => $iblockId,
//    'NAME' => 'New element',
//    'PROPERTY_VALUES' => $arElementsProps,
//];
//
//$obIblockElement = new \CIblockElement();
//$obIblockElement->Add($arIblockFilds);


//$iblock = Iblock::wakeUp($iblockId);
//
//$element = $iblock->getEntityDataClass()::getByPrimary(
//    $iblockElementId,
//    ['select'=>['NAME', 'MODEL']]
//)->fetchObject();
//
//$name = $element->get('NAME');
//echo 'NAME';
//p($name);
//
//$model = $element->get('MODEL')->getValue();
//echo 'MODEL';
//p($model);


//$elements = \Bitrix\Iblock\Elements\ElementCarTable::getList([
//    'select' => ['MODEL'],
//])->fetchCollection();
//
//foreach($elements as $element){
//    p('MODEL -'. $element->getModel()->getValue());
//}


//$elements = \Bitrix\Iblock\Elements\ElementCarTable::query()
//    ->addSelect("NAME")
//    ->addSelect("MODEL")
//    ->addSelect("ID")
//    ->fetchCollection();
//
//foreach($elements as $key=>$value){
//    p($value->getName()." ".$value->getModel()->getValue());
//}


$dbIblockProps = \Bitrix\Iblock\PropertyTable::getList([
    'select' => ['*'],
    'filter' => ['IBLOCK_ID' => $iblockId],
]);
while ($arIblockProps = $dbIblockProps->fetch()) {
    p($arIblockProps);
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");