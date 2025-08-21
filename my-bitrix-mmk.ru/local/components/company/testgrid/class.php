<?php

use Bitrix\Main\Context;
use Bitrix\Main\UI\Filter\Options as FilterOptions;
use Bitrix\Main\UI\PageNavigation;
use Bitrix\Main\Grid\Options as GridOptions;
use Bitrix\Iblock\ElementTable;

class CompanyTestGrid
{
    public function execute($component)
    {
        $iblockId = 16;
        $request = Context::getCurrent()->getRequest();

        // --- Excel export по кнопке
        if ($request->get("export") === "excel") {
            $this->exportExcel($iblockId, $component);
            die();
        }

        // Подготовка фильтра и навигации
        $filterOptions = new FilterOptions("MY_GRID_FILTER");
        $filterData = $filterOptions->getFilter();

        // Построничная навигация
        $gridOptions = new GridOptions("MY_GRID");
        $navParams = $gridOptions->getNavParams();
        $navigation = new PageNavigation("nav");
        $navigation->allowAllRecords(false)
            ->setPageSize($navParams['nPageSize'])
            ->initFromUri();

        // Формирование фильтра
        $filter = ['IBLOCK_ID' => $iblockId];
        if (!empty($filterData['NAME'])) {
            $filter['%NAME'] = $filterData['NAME'];
        }

        $query = ElementTable::query()
            ->setSelect(["ID", "NAME", "ACTIVE", "DATE_CREATE"])
            ->setFilter($filter)
            ->setOffset($navigation->getOffset())
            ->setLimit($navigation->getLimit());

        $result = $query->exec();
        $rows = [];
        $elementIds = [];
        while ($row = $result->fetch()) {
            $elementIds[] = $row['ID'];
            $rows[$row['ID']] = [
                'ID' => $row['ID'],
                'NAME' => $row['NAME'],
            ];
        }

        // --- Получаем свойств
        if ($elementIds) {
            $arResult['ROWS'] = [];
            $res = CIBlockElement::GetList([], ['IBLOCK_ID' => $iblockId], false, false, [
                "ID", "NAME", "PROPERTY_64", "PROPERTY_65", "PROPERTY_66", "PROPERTY_67"
            ]);
            while ($ar = $res->GetNext()) {
                $arResult['ROWS'][] = [
                    'data' => [
                        'ID' => $ar['ID'],
                        'NAME' => $ar['NAME'],
                        'PROPERTY_CITY' => $row['PROPERTY_65'],
                        'PROPERTY_STATUS' => $row['PROPERTY_66'],
                        'PROPERTY_PRICE' => $row['PROPERTY_67'],
                        'PROPERTY_DATE' => $row['PROPERTY_64'],
                    ]
                ];
            }
        }

        $finalRows = [];
        if ($elementIds) {
            $res = CIBlockElement::GetList(
                [],
                ['IBLOCK_ID' => $iblockId, 'ID' => $elementIds],
                false, false,
                ["ID", "NAME", "PROPERTY_64", "PROPERTY_65", "PROPERTY_66", "PROPERTY_67"]
            );
            while ($ar = $res->GetNext()) {
                $finalRows[] = [
                    'data' => [
                        'ID' => $ar['ID'],
                        'NAME' => $ar['NAME'],
                        'PROPERTY_CITY' => $ar['PROPERTY_65_VALUE'],
                        'PROPERTY_STATUS' => $ar['PROPERTY_66_VALUE'],
                        'PROPERTY_PRICE' => $ar['PROPERTY_67_VALUE'],
                        'PROPERTY_DATE' => $ar['PROPERTY_64_VALUE'],
                    ]
                ];
            }
        }

        $navigation->setRecordCount($result->getSelectedRowsCount());

        $component->arResult = [
            "ROWS" => $finalRows,
            "NAV_OBJECT" => $navigation,
            "TOTAL_ROWS_COUNT" => $result->getSelectedRowsCount(),
            "HEADERS" => [
                ["id" => "ID", "name" => "ID", "default" => true],
                ["id" => "NAME", "name" => "Название", "default" => true],
                ["id" => "PROPERTY_CITY", "name" => "Город", "default" => true],
                ["id" => "PROPERTY_STATUS", "name" => "Статус", "default" => true],
                ["id" => "PROPERTY_PRICE", "name" => "Цена", "default" => true],
                ["id" => "PROPERTY_DATE", "name" => "Дата", "default" => true],
            ],
        ];
        $component->includeComponentTemplate();
    }

    // CSV
    private function exportExcel($iblockId, $component)
    {
        while (ob_get_level()) {
            ob_end_clean();
        }

        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment;filename="export.csv"');

        $out = fopen('php://output', 'w');
        fputcsv($out, ['ID', 'Название', 'Город', 'Статус', 'Цена', 'Дата']);

        $dbRes = \CIBlockElement::GetList([], ['IBLOCK_ID' => $iblockId], false, false, [
            "ID", "NAME",
            "PROPERTY_65", // Город
            "PROPERTY_66", // Статус
            "PROPERTY_67", // Цена
            "PROPERTY_64", // Дата
        ]);

        while ($row = $dbRes->GetNext()) {
            fputcsv($out, [
                $row['ID'],
                $row['NAME'],
                $row['PROPERTY_65_VALUE'],
                $row['PROPERTY_66_VALUE'],
                $row['PROPERTY_67_VALUE'],
                $row['PROPERTY_64_VALUE']
            ]);
        }

        fclose($out);
        exit();
    }

}
