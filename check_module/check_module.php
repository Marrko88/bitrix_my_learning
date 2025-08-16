<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$path = $_SERVER["DOCUMENT_ROOT"] . "/local/modules/mk_customtab/mk_customtab.php";
echo "Путь к паспорту: $path<br>";
if (file_exists($path)) {
    echo "Файл mk_customtab.php существует!<br>";
    include_once($path);
    if (class_exists('mk_customtab')) {
        echo "Класс mk_customtab загружен!<br>";
        $m = new mk_customtab();
        echo "MODULE_ID: ".$m->MODULE_ID."<br>";
        echo "NAME: ".$m->MODULE_NAME."<br>";
        echo "DESC: ".$m->MODULE_DESCRIPTION."<br>";
        echo "VERSION: ".$m->MODULE_VERSION."<br>";
    } else {
        echo "Класс mk_customtab НЕ найден.<br>";
    }
} else {
    echo "mk_customtab.php НЕ найден!<br>";
}
?>
