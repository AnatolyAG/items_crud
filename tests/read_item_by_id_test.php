<?php

require 'db.php';


// Тест чтения элемента по ID
function testReadItemById($db_name) {
    $pdo = connectToDatabase($db_name);
    $id = 1; // Замените на существующий ID

    $item = readItemById($pdo, $id);

    if ($item) {
        echo "Item found: " . json_encode($item) . "\n";
    } else {
        echo "Item not found\n";
    }
}
