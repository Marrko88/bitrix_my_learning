<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)die();

\Bitrix\Main\Loader::registerAutoLoadClasses(null, [
    \Otus\Books\BooksTable::class       => '/local/php_interface/src/Otus/Books/BooksTable.php',
    \Otus\Publishers\PublishersTable::class => '/local/php_interface/src/Otus/Books/PublishersTable.php',
    \Otus\Books\WikiprofileTable::class => '/local/php_interface/src/Otus/Books/WikiprofileTable.php',
]);

//spl_autoload_register(function (string $class): void {
//   if(!str_contains($class, 'Otus')){
//       return;
//   }
//   $class= str_replace('\\', '/', $class);
//
//   $path = __DIR__.'/'.$class.'.php';
//
//   if(is_file($path)){
//       require_once $path;
//   }
//});