<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

use Bitrix\Iblock\Elements\ElementdoctorTable;
use Bitrix\Iblock\ElementTable as IblockElementTable;
use Bitrix\Main\Entity\ReferenceField;

$APPLICATION->SetTitle('Врачи');

$docId = 45;
$rows = ElementdoctorTable::getList([
    'select' => [
        'ID',
        'NAME',
        'SPEC_ID' => 'SPETSIALIZATSIYA_MNOZH.VALUE', // ID связанной специализации
        'SPEC_NAME' => 'SPEC.NAME',

    ],
    'filter' => [
        'ID' => $docId,
        'ACTIVE' => 'Y'
    ],
    'runtime' => [
        new ReferenceField(
            'SPEC',
            IblockElementTable::class,
            ['=this.SPETSIALIZATSIYA_MNOZH.VALUE' => 'ref.ID'],
            ['join_type' => 'left']
        )
    ]
])->fetchAll();

foreach ($rows as $row) {
    p($row['NAME']);
    p($row['SPEC_ID'] . ' - ' . $row['SPEC_NAME']);
}