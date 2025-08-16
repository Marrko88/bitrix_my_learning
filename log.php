<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
// твой код
var_dump(['mama' => "+79991111111"]). '<br>';
echo '--------------------------------------------------'. '<br>';


\Bitrix\Main\Diag\Debug::writeToFile([
    'mama' => "+799922222235"
],'dictionary', 'test.log');


require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");