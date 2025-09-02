<?php
namespace Otus\Hlblock\Handlers;

use \Bitrix\Main\Entity\Event;
use \Bitrix\Main\Entity\EventResult;


class Element{
    public static function onBeforeAddHandler(Event $event): EventResult
    {
        $entity = $event->getEntity();
        $fields = $event->getParametr('fields');
        if(!str_contains($fields['UF_NAME'], 'Материал') && $entity->getName() === 'MatrialsTypes'){
            $fields['UF_NAME'] = 'Материал ' . $fields['UF_NAME'];
        }

        $result = new EventResult();

        $result->modifyFields($fields);
        return $result;
    }
}