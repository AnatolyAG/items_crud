<?php

require 'db.php';


// Тест чтения всех элементов
function testReadAllItems($db_name) {
    $pdo = connectToDatabase($db_name);

    $items = readAllItems($pdo);

    if ($items) {
        echo "All items: " . json_encode($items) . "\n";
    } else {
        echo "No items found\n";
    }
}
