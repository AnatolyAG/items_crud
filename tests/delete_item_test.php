<?php

require 'db.php';

// Тест удаления элемента
function testDeleteItem($db_name) {
    $pdo = connectToDatabase($db_name);
    $id = 1; // Замените на существующий ID

    $result = deleteItem($pdo, $id);

    if ($result) {
        echo "Item deleted\n";
    } else {
        echo "Error deleting item\n";
    }
}

