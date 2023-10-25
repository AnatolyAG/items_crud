<?php

// Проверка наличия cURL
if (!function_exists('curl_version')) {
    die('cURL is not available. Please install or enable cURL in your PHP configuration.');
}

// Функция для отправки GET-запроса и вывода ответа
function sendGETRequest($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

// Функция для отправки POST-запроса и вывода ответа
function sendPOSTRequest($url, $data) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

// Функция для отправки PUT-запроса и вывода ответа
function sendPUTRequest($url, $data) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

// Функция для отправки DELETE-запроса и вывода ответа
function sendDELETERequest($url, $data) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

// Тест GET-запроса для чтения элемента по ID
function testGETReadItemById($url) {
    $id = 1; // Используем существующий ID - вызывать после создания
    $url = $url . '?id=' . $id; // Модифицируем урл
    $response = sendGETRequest($url);
    echo "GET Request (Read Item by ID):\n";
    echo $response . "\n";
}

// Тест GET-запроса для чтения всех элементов
function testGETReadAllItems($url) {
    $response = sendGETRequest($url);
    echo "GET Request (Read All Items):\n";
    echo $response . "\n";
}

// Тест POST-запроса для создания элемента
function testPOSTCreateItem($url) {
    $data = json_encode([
        'name' => 'Test Item',
        'phone' => '123-456-7890',
        'key' => 'test-key',
    ]);
    $response = sendPOSTRequest($url, $data);
    echo "POST Request (Create Item):\n";
    echo $response . "\n";
}

// Тест PUT-запроса для обновления элемента
function testPUTUpdateItem($url) {
    $data = json_encode([
        'id' => 1, // Используем существующий ID - вызывать после создания
        'name' => 'Updated Test Item',
        'phone' => '987-654-3210',
        'key' => 'updated-test-key',
    ]);
    $response = sendPUTRequest($url, $data);
    echo "PUT Request (Update Item):\n";
    echo $response . "\n";
}

// Тест DELETE-запроса для удаления элемента
function testDELETEItem($url) {
    $data = json_encode(['id' => 1]); // Используем существующий ID - вызывать после создания
    $response = sendDELETERequest($url, $data);
    echo "DELETE Request (Delete Item):\n";
    echo $response . "\n";
}
