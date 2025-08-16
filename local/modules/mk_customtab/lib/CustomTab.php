<?php
namespace Mk;

use Bitrix\Main\Event;

class CustomTab
{
    public static function onEntityDetailsTabsInitialized(\Bitrix\Main\Event $event)
    {
        $params = $event->getParameter('params');
        file_put_contents(
            $_SERVER["DOCUMENT_ROOT"]."/local/tabs_debug.log",
            date('c').": " . print_r($params, true) . "\n",
            FILE_APPEND
        );

        $entityId = $params['entityId'] ?? null;

        $tabs = [
            [
                'id' => 'custom_tab_mk',
                'name' => 'Моя вкладка',
                'enabled' => true,
                'order' => 1000,
                'loader' => [
                    'componentData' => [
                        'componentName' => 'bitrix:system.auth.form',
                        'componentTemplate' => '',
                        'componentParams' => [
                            'ENTITY_ID' => $entityId
                        ]
                    ]
                ],
                'className' => 'custom-tab-mk'
            ]
        ];
        file_put_contents(
            $_SERVER["DOCUMENT_ROOT"]."/local/tabs_dump.log",
            print_r($tabs, true)."\n\n",
            FILE_APPEND
        );
        return new \Bitrix\Main\EventResult(
            \Bitrix\Main\EventResult::SUCCESS,
            ['tabs' => $tabs]
        );
    }

}