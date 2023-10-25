<?php

require '../db.php';

// Тест создания нового элемента
function testCreateItem($db_name) {
    $data = [
        'name' => 'Some test Item',
        'phone' => '123-456-7890',
        'key' => 'test-key'
    ];

    $pdo = connectToDatabase($db_name);
    $id = createItem($pdo, $data);

    if ($id) {
        echo "Item created with ID: $id\n";
    } else {
        echo "Error creating item\n";
    }
}
