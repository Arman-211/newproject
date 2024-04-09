<?php
echo 24342343243;
require_once 'api/NotebookController.php';

$db_host = '3306';
$db_user = 'user';
$db_password = 'Mypassword123!@#';
$db_name = 'notebook';

$db = new mysqli($db_host, $db_user, $db_password, $db_name);
if ($db->connect_errno) {
    echo "Ошибка соединения с базой данных: " . $db->connect_error;
    exit();
}

$controller = new NotebookController($db);
$controller->handleRequest();
?>
