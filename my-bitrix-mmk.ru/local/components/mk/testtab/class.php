<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\UI\PageNavigation;

class CrmCustomTabComponent extends CBitrixComponent implements Controllerable
{
    public function configureActions() { return []; }

    public function onPrepareComponentParams($arParams) {
        $arParams["ENTITY_ID"] = (int)$arParams["ENTITY_ID"];
        return $arParams;
    }

    public function executeComponent() {
        Loader::includeModule('main');
        global $DB;
        $entityId = $this->arParams["ENTITY_ID"];
        $data = [];
        $res = $DB->Query("SELECT * FROM b24_custom_entity WHERE CRM_ENTITY_ID = " . $entityId);
        while($row = $res->Fetch()) {
            $data[] = $row;
        }
        $this->arResult["ROWS"] = $data;
        $this->includeComponentTemplate();
    }
}