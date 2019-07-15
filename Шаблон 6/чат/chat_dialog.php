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
header("Content-Type: text/html; charset=windows-1251");
include("chat_config.php");

function get_body_msg($id_msg, $date_msg, $name_msg, $text_msg) {
    ?>
    <table class="chat_msg" id="<?= $id_msg ?>">
        <tr>
            <td>
                <font class="chat_date"><?= date("d-m-y H:i", $date_msg) ?></font> - <font class="chat_name"><?= $name_msg ?></font>
            </td>
        </tr>
        <tr>
            <td class="chat_text"><?= $text_msg ?></td>
        </tr>
    </table>
    <?php
}
function clear_chat_msg($string) {
    $string = strip_tags($string);
    $string = htmlspecialchars($string, ENT_QUOTES);
    $string = iconv("UTF-8", "cp1251", $string);
    $string = trim($string);
    return $string;
}
//подключаемся к серверу MySQL
mysql_connect($chat_host, $chat_user, $chat_pass) or die ("Невозможно установить соединение с сервером MySQL:<br />".mysql_error());
//создаем базу данных если её нет
mysql_query("CREATE DATABASE IF NOT EXISTS `$chat_db`") or die("Ошибка создания базы данных:<br />".mysql_error());
// выбираем базу данных
mysql_select_db($chat_db);
//создаем в базе таблицу если её нет
mysql_query("
    CREATE TABLE IF NOT EXISTS `$chat_table` (
    `id` int(11) NOT NULL auto_increment,
    `date` int(11) default NULL,
    `name` text NOT NULL,
    `text` text NOT NULL,
    UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251") or die("Ошибка создания таблицы в базе данных:<br />".mysql_error());

//если только пришли на страницу выведем несколько последних сообщений
if(isset($_POST['chat_last_msg'])) {
    $msg_array = mysql_query("
        SELECT *
        FROM (
            SELECT *
            FROM `$chat_table`
            ORDER BY `id` DESC
            LIMIT $chat_msg_quantity
        ) AS `chat_last_msg`
        ORDER BY `id` ASC
    ") or die("Ошибка получения записей из базы:<br />".mysql_error());

    if(mysql_num_rows($msg_array) > 0) {
        while($msg_list = mysql_fetch_assoc($msg_array)) {
            get_body_msg($msg_list['id'], $msg_list['date'], $msg_list['name'], $msg_list['text']);
        }
    }
}
//добавление нового сообщения
if(isset($_POST['chat_id'])) {
    $chat_date = time();
    $chat_id = abs(intval($_POST['chat_id']));
                                                                     //echo "<pre>"; print_r($_POST); echo "</pre>";
    if(isset($_POST['chat_name'])) $chat_name = clear_chat_msg($_POST['chat_name']);
    if(isset($_POST['chat_text'])) $chat_text = clear_chat_msg($_POST['chat_text']);

    if((isset($chat_name) & $chat_name != "") & (isset($chat_text) & $chat_text != "")) {
        //добавляем сообщение в базу
        mysql_query("
            INSERT INTO `$chat_table`
            SET
            `date` = '$chat_date',
            `name` = '$chat_name',
            `text` = '$chat_text'
        ") or die("Ошибка добавления записи в базу данных:<br />".mysql_error());
    }
    //получаем из базы это сообщение и возможно новые
    $msg_array = mysql_query("
        SELECT *
        FROM `$chat_table`
        WHERE `id` > '$chat_id'
        ORDER BY `id`
    ") or die("Ошибка получения из базы добавленного и новых сообщений:<br />".mysql_error());
    if(mysql_num_rows($msg_array) > 0) {
        while($msg_list = mysql_fetch_assoc($msg_array)) {
            get_body_msg($msg_list['id'], $msg_list['date'], $msg_list['name'], $msg_list['text']);
        }
    }
}
?>