<?php
/*******************************************************************************
Aprel jChat
http://aprel-chat.googlecode.com/
aprelvovanya@mail.ru
Рыжов Владимир Владимирович
Ryzhov Vladimir Vladimirovich
*******************************************************************************/
?>
<?php
//время через которое проверяется наличие новых сообщений (1сек = 1000)
$chat_waiting_time = 5000;
//длительность автопрокрутки (1сек = 1000)
$chat_scroll_speed = 2000;
//максимальная длинна имени в символах
$chat_maxlength_name = 12;
//количество строк для ввода сообщения
$chat_text_rows = 3;
//сообщений в чате при первом входе
$chat_msg_quantity = 10;

//параметры для подключения к серверу mysql
$chat_host = "localhost";
$chat_user = "root";
$chat_pass = "";
$chat_db = "chat";
$chat_table = "chat";
?>