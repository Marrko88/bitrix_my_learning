<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");


global $APPLICATION;

use Bitrix\Iblock\Elements\ElementdoctorTable;
use Bitrix\Iblock\ElementTable as IblockElementTable;
use Bitrix\Main\Loader;
use Bitrix\Main\Entity\ReferenceField;


$APPLICATION->SetTitle('Врачи!');
Loader::includeModule('iblock');


$docId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($docId > 0) {
    $rows = ElementdoctorTable::getList([
            'select' => [
                    'ID',
                    'NAME',
                    'IMYA',
                    'OTCHESTVO',
                    'SPEC_ID' => 'SPETSIALIZATSIYA_MNOZH.VALUE',
                    'SPEC_NAME' => 'SPEC.NAME',
            ],
            'filter' => [
                    '=ID' => $docId,
                    '=ACTIVE' => 'Y',
            ],
            'runtime' => [
                    new ReferenceField(
                            'SPEC',
                            IblockElementTable::class,
                            ['=this.SPETSIALIZATSIYA_MNOZH.VALUE' => 'ref.ID'],
                            ['join_type' => 'left']
                    ),
            ],
            'order' => ['SPEC_NAME' => 'ASC'],
    ])->fetchAll();

    $docName = $rows[0]["NAME"].' '.$rows[0]["IBLOCK_ELEMENTS_ELEMENT_DOCTOR_IMYA_VALUE"].' '.$rows[0]["IBLOCK_ELEMENTS_ELEMENT_DOCTOR_OTCHESTVO_VALUE"];

    $specs = [];
    foreach ($rows as $r) {
        if ((int)$r['ID'] > 0) {
            $specs[] = $r['SPEC_ID'];
        }
    }
    
    ?>
    <style>
        .doc-container {
            max-width: 1000px;
            margin: 32px auto;
            padding: 0 16px
        }

        .doc-back {
            display: inline-block;
            margin-bottom: 16px;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 10px;
            border: 1px solid #e5e7eb
        }

        .doc-title {
            font-size: 28px;
            font-weight: 700;
            margin: 12px 0 20px
        }

        .doc-sub {
            font-size: 18px;
            margin: 16px 0 8px
        }

        .doc-list {
            margin: 0 0 24px 20px
        }
    </style>

    <div class="doc-container">
        <a class="doc-back" href="<?= $APPLICATION->GetCurPageParam('', ['id']) ?>">← Все врачи</a>
        <div class="doc-title"><?= $docName ?></div>

        <div class="doc-sub">Процедуры:</div>
        <?php if ($specs): ?>
            <ul class="doc-list">
                <?php foreach ($specs as $name): ?>
                    <li><?= htmlspecialcharsbx($name) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>


    </div>
    <?php

    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
    return;
}

$doctors = ElementdoctorTable::getList([
        'select' => ['ID', 'NAME', 'IMYA', 'OTCHESTVO'],
        'filter' => ['=ACTIVE' => 'Y'],
        'order' => ['NAME' => 'ASC'],
])->fetchAll();

?>

    <style>
        .cards-wrap {
            max-width: 1200px;
            margin: 32px auto;
            padding: 0 16px
        }

        .cards-title {
            font-size: 32px;
            font-weight: 700;
            text-align: center;
            margin: 12px 0 24px
        }

        .cards-grid {
            display: grid;
            grid-template-columns:repeat(auto-fill, minmax(240px, 1fr));
            gap: 18px
        }

        .card {
            display: block;
            text-decoration: none;
            color: #0f172a;
            background: #fff;
            border-radius: 16px;
            padding: 18px 20px;
            box-shadow: 0 8px 18px rgba(37, 99, 235, .18);
            border: 1px solid #eef2ff;
            transition: transform .12s ease, box-shadow .12s ease
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 22px rgba(37, 99, 235, .22)
        }

        .card-name {
            font-size: 16px;
            line-height: 1.4
        }
    </style>

    <div class="cards-wrap">
        <div class="cards-title">Врачи</div>
        <div class="cards-grid">
            <?php foreach ($doctors as $d): ?>
                <a class="card" href="<?= $APPLICATION->GetCurPageParam('id=' . $d['ID'], ['id']) ?>">
                    <div class="card-name"><?= htmlspecialcharsbx($d['NAME']." ".$d['IBLOCK_ELEMENTS_ELEMENT_DOCTOR_IMYA_VALUE']." ".$d['IBLOCK_ELEMENTS_ELEMENT_DOCTOR_OTCHESTVO_VALUE']) ?></div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>