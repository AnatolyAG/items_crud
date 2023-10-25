<?php

require './create_item_test.php';
require './read_item_by_id_test.php';
require './update_item_test.php';
require './read_all_item_test.php';
require './delete_item_test.php';



// Запуск всех тестов - функции обработки запросов
$url_test = 'http://localhost:3000';
testPOSTCreateItem($url_test);
testGETReadItemById($url_test);
testGETReadAllItems($url_test);
testPUTUpdateItem($url_test);
testDELETEItem($url_test);




// Запуск всех тестов - функции взаимодействия с базой
testCreateItem('test');
testReadItemById('test');
testUpdateItem('test');
testReadAllItems('test');
testDeleteItem('test');
