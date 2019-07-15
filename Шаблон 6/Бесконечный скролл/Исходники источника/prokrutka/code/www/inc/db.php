<?php
// Хост (обычно localhost)
$db_host = "localhost";
// Имя базы данных
$db_name = "maindb2";
// Логин для подключения к базе данных
$db_user = "root";
// Пароль для подключения к базе данных
$db_pass = "";

//Подключаемся к базе
$db = mysqli_connect ($db_host, $db_user, "", $db_name) or die ("Невозможно подключиться к БД");
// Указываем кодировку, в которой будет получена информация из базы
mysqli_query ($db, 'set character_set_results = "utf8"');