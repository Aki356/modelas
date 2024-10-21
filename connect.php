<?php
$host = 'localhost';
$db = 'a1042246_kvant';
$user = 'root'; // Замените на имя вашего пользователя
$pass = 'root'; // Замените на пароль

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>