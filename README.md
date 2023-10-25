# items_crud

Для запуска используем 
1. php -S localhost:3000 item_crud.php
2. После этого можно запускать тесты, в папке tests
3. Можно запускать из броузера команды или использовать приложения для отладки запросов (POST, GET, др.)
4. И да проект не отлаживался и не запускался, так что могут быть ошибки.
5. Использовано только то что идет в поставке с php.

ООП не использовался.
в базу для истории надо добавлять таблицу истории
например такую:

CREATE TABLE entity_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tableName  VARCHAR NOT NULL,
    entity_id INT NOT NULL,
    action VARCHAR(10) NOT NULL,
    data TEXT NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
);












