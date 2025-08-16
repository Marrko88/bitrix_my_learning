<?php
class testmod extends CModule
{
    public $MODULE_ID = "testmod";
    public $MODULE_NAME = "Тестовый модуль";
    public $MODULE_DESCRIPTION = "Минимальный модуль для проверки видимости.";
    public $PARTNER_NAME = "mk";
    public $PARTNER_URI = "https://my-bitrix-mmk.ru";

    public function __construct() {
        $arModuleVersion = [];
        include(__DIR__."/version.php");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
    }
}
