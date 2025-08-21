<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle('Врачи');

$docId = 45;
$rows = Bitrix\Iblock\Elements\ElementdoctorTable::getList([
    'select' => [
        'ID',
        'NAME',
        'SPETSIALIZATSIYA_MNOZH', // ID связанной специализации


    ],
    'filter' => [
        'ID'=>$docId,
        'ACTIVE' => 'Y'
    ],
])->fetchCollection();

foreach ($rows as $row) {
    p($row->get('NAME'));
    foreach ($row->getSpetsializatsiyaMnozh()->getAll() as $mnozh) {
        p($mnozh->getId().'-'.$mnozh->getValue());
    }
}