<?php

define('QQ6x5t5JJhU7MTx4Xfmx', true);

require 'db.php';


validateToken(); // Проверка токена



$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    handleGetRequest();
} elseif ($method === 'POST') {
    handlePostRequest();
} elseif ($method === 'PUT') {
    handlePutRequest();
} elseif ($method === 'DELETE') {
    handleDeleteRequest();
} else {
    http_response_code(405); // Метод не поддерживается
}


// Функция для проверки токена
function validateToken() {

    // Выковыряем переданный токен из запроса
    $requestToken = $_GET['token'] ?? '';
    $expectedToken = 'EEWfgrt5567ghhnhn'; // Тут должен быть вызов функции извлечения из хранилища допустимых токенов

    if ($requestToken !== $expectedToken) {
        http_response_code(401); // Ответ с кодом 401 Unauthorized
        die('Error: Invalid token');
    }
}



function handleGetRequest() {
    $params = $_GET;
    
    if (isset($params['id'])) {
        $id = $params['id'];
        $item = readItemById(connectToDatabase(), $id);
        echo json_encode($item);
    } else {
        $items = readAllItems(connectToDatabase());
        echo json_encode($items);
    }
}

function handlePostRequest() {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = createItem(connectToDatabase(), $data);
    echo json_encode(['id' => $id]);
}

function handlePutRequest() {
    $data = json_decode(file_get_contents('php://input'), true);
    updateItem(connectToDatabase(), $data);
    echo json_encode(['message' => 'Item updated']);
}

function handleDeleteRequest() {
    $data = json_decode(file_get_contents('php://input'), true);
    deleteItem(connectToDatabase(), $data['id']);
    echo json_encode(['message' => 'Item deleted']);
}
