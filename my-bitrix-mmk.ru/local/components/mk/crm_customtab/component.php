<?php
file_put_contents($_SERVER["DOCUMENT_ROOT"]."/local/component_debug.log", date('c').": COMPONENT LOADED\n", FILE_APPEND);
echo '<div style="padding:30px; font-size:24px; color:green;">Модуль работает!</div>';
?>
