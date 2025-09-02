<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

use Bitrix\Main\Loader;
use Bitrix\Crm\Service\Container;

Loader::includeModule('crm');

$deal = new \CCrmDeal();
$cont = [
    'ROLE_ID' => 0,
    'IS_PRIMARY' => 'Y',
    'CONTACT_BINDINGS' =>
        [
            [
                'CONTACT_ID' => 1,
                'SORT' => 10,
            ],
            [
                'CONTACT_ID' => 2,
                'SORT' => 20,
            ],
        ],
];
$newDealId = $deal->Add();


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");