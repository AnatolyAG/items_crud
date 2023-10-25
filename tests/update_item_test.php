<?php

require 'db.php';


// Тест обновления элемента
function testUpdateItem($db_name) {
    $pdo = connectToDatabase($db_name);
    $data = [
        'id' => 1, //  должен существовать ID
        'name' => 'Updated Test Item',
        'phone' => '987-654-3210',
        'key' => 'updated-test-key'
    ];

    $result = updateItem($pdo, $data);

    if ($result) {
        echo "Item updated\n";
    } else {
        echo "Error updating item\n";
    }
}
