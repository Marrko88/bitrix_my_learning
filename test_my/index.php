<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

use Otus\Books\BooksTable;

new \Bitrix\Main\Type\Date;

use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;

//$rows = BooksTable::getList([
//    'select' => ['id','name','publish_date'],
//    'order'  => ['id' => 'asc'],
//])->fetchCollection();
//
//foreach ($rows as $item) {
//    echo 'Название: '.$item->getName().'<br>';
//    echo 'Дата выхода: '.($item->getPublishDate() ? $item->getPublishDate(): '-').'<hr>';
//}


//добавление
//$recoder = [
//    'name'=>'Зеленая миля',
//    'publish_date' => new \Bitrix\Main\Type\Date('1988-09-17', 'Y-m-d'),
//    'ISBN'=>'0123456789',
//];
//
//$res = BooksTable::add($recoder);
//if(!$res->isSuccess()){
//    print_r($res->getErrorMessages());
//}


//$book = BooksTable::getByPrimary(2, [
//    'select' => ['*', 'PUBLISHERS'],
//])->fetchObject();
//
//if ($book) {
//    foreach ($book->getPublishers() as $publisher) {
//        echo 'книга: ' . $book->getName() . ' | издатель: ' . $publisher->getName() . '<br>';
//    }
//} else {
//    echo 'Книга с ID=2 не найдена';
//}
//$path = $_SERVER['DOCUMENT_ROOT'].'/local/php_interface/src/Otus/Books/WikiprofileTable.php';
//var_dump(file_exists($path), $path);
//var_dump(class_exists(\Otus\Books\WikiprofileTable::class));
//die();


$record = Otus\Books\BooksTable::query()
    ->registerRuntimeField(
        new Reference(
            'WIKIPROFILE',
            \Otus\Books\WikiprofileTable::class,
            // 2) Совпадение регистра с getMap(): id, book_id
            Join::on('this.id', 'ref.book_id')
        )
    )
    ->registerRuntimeField(
    new Reference(
            'PUBLISHER',
            Otus\Publishers\PublishersTable::class,
            Join::on('this.publisher_id', 'ref.id')
        )
    )
    ->setSelect(
        array(
            'id',
            'NAME',
            'PUBLISH_DATE',
            'PUBLISHER_ID',
            'WIKI_RU' => 'WIKIPROFILE.wikiprofile_ru',

        )
    )
    ->fetchAll();

p($record);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");