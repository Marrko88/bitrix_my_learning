<?php
Class mk_customtab extends CModule
{
    public $MODULE_ID = "mk_customtab";
    public $MODULE_NAME  = "Моя вкладка в CRM (Custom Tab)";
    public $MODULE_DESCRIPTION = "Модуль добавляет кастомную вкладку в CRM с гридом из вашей таблицы.";
    public $PARTNER_NAME = "mk";
    public $PARTNER_URI  = "https://my-bitrix-mmk.ru";

    public function __construct() {
        $arModuleVersion = [];
        include(__DIR__."/version.php");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
    }
}
