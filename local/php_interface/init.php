<?php

if(file_exists(__DIR__ . "/src/autoloader.php")){
    require_once __DIR__ . "/src/autoloader.php";
}

if(file_exists(__DIR__ . "/events.php")){
    require_once __DIR__ . "/events.php";
}





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
