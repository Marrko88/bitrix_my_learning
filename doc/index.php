<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");


global $APPLICATION;

use Bitrix\Iblock\Elements\ElementdoctorTable;
use Bitrix\Iblock\ElementTable as IblockElementTable;
use Bitrix\Main\Loader;
use Bitrix\Main\Entity\ReferenceField;
use Bitrix\Main\Application;

$APPLICATION->SetTitle('Врачи!');
Loader::includeModule('iblock');

$IBLOCK_ID = 21;                // doctor
$PROP_CODE_NAME = 'IMYA';
$PROP_CODE_MID  = 'OTCHESTVO';
$PROP_CODE_SPEC = 'SPETSIALIZATSIYA_MNOZH'; // множественный, привязка к элементам
$PROP_CODE_PROC = 'PROTSEDURY_MNOZH';       // множественный, привязка к элементам



function getLinked(int $idblock)
{
    $out =[];
    $rs = CIBlockElement::GetList(['NAME' => 'ASC'], ['IBLOCK_ID'=>$idblock, 'ACTIVE'=>'Y'],false,false,['ID','NAME']);
    while ($row = $rs->GetNext()) {
        $out[$row['ID']] = $row['NAME'];
    }
    return $out;
}

//$propSpec = CIBlockProperty::GetByID($PROP_CODE_SPEC, $IBLOCK_ID)->Fetch();
//$propProc = CIBlockProperty::GetByID($PROP_CODE_PROC, $IBLOCK_ID)->Fetch();
//
//$specOptions = $propSpec && (int)$propSpec['LINK_IBLOCK_ID'] > 0 ? getLinked((int)$propSpec['LINK_IBLOCK_ID']) : [];
//$procOptions = $propProc && (int)$propProc['LINK_IBLOCK_ID'] > 0 ? getLinked((int)$propProc['LINK_IBLOCK_ID']) : [];



// ==== обработка отправки формы
$request = Application::getInstance()->getContext()->getRequest();
$errors = [];
$createdId = 0;


if ($request->isPost()&& $request->getPost('doctor_add_form') === 'Y') {

    $name      = trim((string)$request->getPost('NAME'));          // Фамилия или основное имя элемента
    $imya      = trim((string)$request->getPost('IMYA'));
    $otchestvo = trim((string)$request->getPost('OTCHESTVO'));
    $specIds   = (array)$request->getPost('SPETS');                 // множественные ID
    $procIds   = (array)$request->getPost('PROCS');

    $PROP = [
            $PROP_CODE_NAME => $imya,
            $PROP_CODE_MID  => $otchestvo,
            ];
    $oldSpecs = (array)$request->getPost('SPETS');
    $oldProcs = (array)$request->getPost('PROCS');

    $el = new CIBlockElement();

    $fields = [
            'IBLOCK_ID' => $IBLOCK_ID,
        'NAME' => $name,
        'ACTIVE' => 'Y',
        'PROPERTY_VALUES' => $PROP,
    ];

    if ($ID = $el->Add($fields)) {
        $createdId = (int)$ID;
        // редирект на вашу же страницу с детальным просмотром
        LocalRedirect($APPLICATION->GetCurPageParam('id='.$createdId, ['id']));
        die();
    } else {
        $errors[] = 'Ошибка сохранения: '.$el->LAST_ERROR;
    }
}

?>
    <style>
        .form-card{max-width:900px;margin:24px auto;padding:20px;border:1px solid #e5e7eb;border-radius:14px}
        .form-card h3{margin:0 0 12px}
        .form-row{display:flex;gap:12px;margin-bottom:12px}
        .form-row>div{flex:1}
        .form-label{display:block;font-size:14px;margin-bottom:6px}
        input[type="text"],select{width:100%;padding:8px 10px;border:1px solid #cbd5e1;border-radius:10px}
        .btn{display:inline-block;padding:10px 14px;border-radius:10px;border:1px solid #2563eb;background:#2563eb;color:#fff;cursor:pointer}
        .error{background:#fef2f2;color:#991b1b;border:1px solid #fecaca;padding:10px;border-radius:10px;margin-bottom:12px}
    </style>


    <div class="form-card">
        <h3>Добавить врача</h3>

        <?php if ($errors): ?>
            <div class="error"><?= implode('<br>', array_map('htmlspecialcharsbx', $errors)) ?></div>
        <?php endif; ?>

        <form method="post">
            <?= bitrix_sessid_post() ?>
            <input type="hidden" name="doctor_add_form" value="Y">

            <div class="form-row">
                <div>
                    <label class="form-label">ФИО/Название элемента *</label>
                    <input type="text" name="NAME" value="<?= htmlspecialcharsbx($request->getPost('NAME')) ?>">
                </div>
                <div>
                    <label class="form-label">Имя *</label>
                    <input type="text" name="IMYA" value="<?= htmlspecialcharsbx($request->getPost('IMYA')) ?>">
                </div>
                <div>
                    <label class="form-label">Отчество</label>
                    <input type="text" name="OTCHESTVO" value="<?= htmlspecialcharsbx($request->getPost('OTCHESTVO')) ?>">
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label class="form-label">Специализации (множественные строки)</label>
                    <div id="spec-wrap">
                        <?php foreach ($oldSpecs as $v): ?>
                            <input type="text" name="SPETS[]" value="<?= htmlspecialcharsbx($v) ?>" style="margin-bottom:8px">
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="btn" onclick="addField('spec-wrap','SPETS[]')">+ ещё</button>
                </div>

                <div>
                    <label class="form-label">Процедуры (множественные строки)</label>
                    <div id="proc-wrap">
                        <?php foreach ($oldProcs as $v): ?>
                            <input type="text" name="PROCS[]" value="<?= htmlspecialcharsbx($v) ?>" style="margin-bottom:8px">
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="btn" onclick="addField('proc-wrap','PROCS[]')">+ ещё</button>
                </div>
            </div>

            <script>
                function addField(wrapperId, name){
                    var w = document.getElementById(wrapperId);
                    var i = document.createElement('input');
                    i.type='text'; i.name=name; i.style.marginBottom='8px';
                    w.appendChild(i);
                }
            </script>

            <button class="btn" type="submit">Сохранить</button>
        </form>
    </div>
<?php



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
        if (!empty($r['SPEC_NAME'])) {
            $specs[] = $r['SPEC_NAME'];
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