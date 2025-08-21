<?php

if(file_exists(__DIR__ . "/src/autoloader.php")){
    require_once __DIR__ . "/src/autoloader.php";
}

//include_once __DIR__ . "/classes/Dadata.php";


function p($var,$type = false)
{
    echo '<pre style="font-size: 12px; border: 1px solid #000; background-color: #FFF; text-align: left; color: #000;">';
    if($type){
        var_dump($var);
    }else{
        print_r($var);
        echo '</pre>';
    }
}
//namespace Local\Crm;
//
//use Bitrix\Main\Loader;
//use Bitrix\Main\Type\DateTime;
//use Bitrix\Main\Diag\Debug;
//use Bitrix\Main\Data\Cache;
//use Bitrix\Crm\DealTable;




//class OverdueDealsAgent
//{
//    public static function run(): string
//    {
//        $log = $_SERVER['DOCUMENT_ROOT'].'/local/logs/overdue.log';
//
//        Debug::writeToFile(date('c'), 'AGENT_CALLED', $log);
//
//        // блокировка ~55 сек
//        $c = Cache::createInstance();
//        if ($c->initCache(55, 'overdue_lock', '/agents')) return "\\Local\\Crm\\OverdueDealsAgent::run();";
//        if ($c->startDataCache(55, 'overdue_lock', '/agents')) $c->endDataCache(['t'=>time()]);
//
//        Debug::writeToFile(date('c'), 'AGENT_START', $log);
//
//        if (!Loader::includeModule('crm')) {
//            Debug::writeToFile('CRM not loaded', 'WARN', $log);
//            return "\\Local\\Crm\\OverdueDealsAgent::run();";
//        }
//
//        $now = new DateTime();
//        $rs = DealTable::getList([
//            'select' => ['ID'],
//            'filter' => [
//                '<CLOSEDATE' => $now,
//                '!STAGE_ID'  => 'UC_YUZSEV',
//            ],
//            'limit' => 200,
//        ]);
//
//        $upd = new \CCrmDeal(false);
//        $moved = 0;
//        while ($d = $rs->fetch()) {
//            $upd->Update((int)$d['ID'], ['STAGE_ID' => 'UC_YUZSEV']);
//            $moved++;
//        }
//
//        Debug::writeToFile("moved={$moved}", 'AGENT_END', $log);
//        return "\\Local\\Crm\\OverdueDealsAgent::run();";
//    }
//}
//
//
//
//class PingAgent {
//    public static function run(): string {
//        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/local/logs/ping.log', date('c')." PING\n", FILE_APPEND);
//        return "\\PingAgent::run();";
//    }
//}


