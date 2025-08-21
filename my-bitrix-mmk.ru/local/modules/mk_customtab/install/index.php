<?php
use \Bitrix\Main\ModuleManager;
use \Bitrix\Main\EventManager;

class mk_customtab extends CModule
{

    public function DoInstall()
    {
        \Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);

        global $DB;
        $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/local/modules/mk_customtab/install/db/install.sql");

        \Bitrix\Main\EventManager::getInstance()->registerEventHandler(
            'crm',
            'onEntityDetailsTabsInitialized',
            $this->MODULE_ID,
            'Mk\\CustomTab',
            'onEntityDetailsTabsInitialized'
        );
    }

    public function DoUninstall()
    {
        global $DB;
        $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/local/modules/mk_customtab/install/db/uninstall.sql");

        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler(
            'crm',
            'onEntityDetailsTabsInitialized',
            $this->MODULE_ID,
            'Mk\\CustomTab',
            'onEntityDetailsTabsInitialized'
        );
        \Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);
    }
}