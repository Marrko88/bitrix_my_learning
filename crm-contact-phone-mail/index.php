<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

use Bitrix\Main\Loader;
use Bitrix\Crm\Service\Container;

Loader::includeModule('crm');

$mail = 'kozlov@mail.ru';
$phone = '+79999999999';
$contactFields = [
    'NAME' => 'Mark4',
    'LAST_NAME' => 'kozlov',
];
$contactsModel = new \CCrmContact;
$newContactId = $contactsModel->Add($contactFields);

$multi = new CCrmFieldMulti();

$multi->Add([
    'ENTITY_ID'   => 'CONTACT',
    'ELEMENT_ID'  => $newContactId,
    'TYPE_ID'     => 'EMAIL',
    'VALUE_TYPE'  => 'WORK',
    'VALUE'       => $mail,
]);

$multi->Add([
    'ENTITY_ID'   => 'CONTACT',
    'ELEMENT_ID'  => $newContactId,
    'TYPE_ID'     => 'PHONE',
    'VALUE_TYPE'  => 'WORK',
    'VALUE'       => $phone,
]);

echo 'Создан контакт ID: ' . (int)$newContactId;


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");