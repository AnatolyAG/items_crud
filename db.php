<?php

if (!defined('QQ6x5t5JJhU7MTx4Xfmx')) {
    exit("Error.");
}


// Подключение к базе данных (для примера берем мускул)
function connectToDatabase($dbName = 'prod') {
    // Используем PDO, если что легко меняем на любую базу
    // Проверяем, используется ли тестовая база данных
    // Пароли брать из env
    if ($dbName === 'test') {
        $dsn = "mysql:host=localhost;dbname=test_database";
        $username = "test_username";
        $password = "test_password";
    } else {
        $dsn = "mysql:host=localhost;dbname=production_database";
        $username = "prod_username";
        $password = "prod_password";
    }

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Ошибка подключения к базе данных: " . $e->getMessage());
    }

}

// Функция для валидации данных
function validateData($data) {
    if (empty($data['name'])) {
        die('Error: Name field is required.');
    }
    if (empty($data['phone']) || !preg_match('/^\d{3}-\d{3}-\d{4}$/', $data['phone'])) {
        die('Error: Phone field is required and must be in the format 123-456-7890.');
    }
    if (empty($data['key'])) {
        die('Error: Key field is required.');
    }
}


// Функция для валидации идентификатора записи (ID)
function validateId($id) {
    if (!is_numeric($id) || $id <= 0 || floor($id) != $id) {
        die('Error: Invalid ID. ID must be a positive integer.');
    }
}



// Функция для сохранения записи истории
function saveEntityHistory($pdo, $tableName, $entityId, $action, $data) {
    $query = "INSERT INTO entity_history (tableName, entity_id, action, data) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$entityId, $action, $data]);
}


// Используем подстановку для защиты от иньекций

// Чтение одного элемента по ID
function readItemById($pdo, $id) {

    validateId($id); // проверим наличие и допуск ключа

    try {
        $stmt = $pdo->prepare("SELECT * FROM items WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Ошибка при чтении элемента: " . $e->getMessage());
    }
}


// Чтение всех элементов
function readAllItems($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM items");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Ошибка при чтении всех элементов: " . $e->getMessage());
    }
}

// Создание нового элемента
function createItem($pdo, $data) {
    try {
        $name = $data['name'];
        $phone = $data['phone'];
        $key = $data['key'];

        validateData($data); // Проверим или все ок с данными

        // Для постгреса добавить RETURN id, кажеться стандартный подход для возврата ключа не работает
        $stmt = $pdo->prepare("INSERT INTO items (name, phone, key) VALUES (?, ?, ?)");
        $stmt->execute([$name, $phone, $key]);

        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        die("Ошибка при создании элемента: " . $e->getMessage());
    }
}

// Обновление элемента
function updateItem($pdo, $data) {
    try {
        $id = $data['id'];
        $name = $data['name'];
        $phone = $data['phone'];
        $key = $data['key'];

        validateData($data); // Проверим или все ок с данными

        validateId($id); // проверим наличие и допуск ключа

        $data = json_encode($data); // Сериализация данных
        saveEntityHistory($pdo, 'items' ,$id, 'update', $data);

        $stmt = $pdo->prepare("UPDATE items SET name = ?, phone = ?, key = ? WHERE id = ?");
        $stmt->execute([$name, $phone, $key, $id]);
        return true;
    } catch (PDOException $e) {
        die("Ошибка при обновлении элемента: " . $e->getMessage());
    }
}

// Удаление элемента
function deleteItem($pdo, $id) {
    
    validateId($id); // проверим наличие и допуск ключа

    // Сделать предварительный запрос из базы по данному идентифиактору
    // 
    // $data = json_encode($data); // Сериализация данных
    // saveEntityHistory($pdo, 'items' ,$id, 'update', $data);

    try {
        $stmt = $pdo->prepare("DELETE FROM items WHERE id = ?");
        $stmt->execute([$id]);
        return true;
    } catch (PDOException $e) {
        die("Ошибка при удалении элемента: " . $e->getMessage());
    }
}