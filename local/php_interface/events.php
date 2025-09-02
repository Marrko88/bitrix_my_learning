<?php

$eventsManager=\Bitrix\Main\EventManager::getInstance();


$eventsManager->addEventHandler('','MaterialsTypesOnBeforeAdd', [
    '\Otus\Hlblock\Handlers\Element',
    'onBeforeAddHandler',
]);