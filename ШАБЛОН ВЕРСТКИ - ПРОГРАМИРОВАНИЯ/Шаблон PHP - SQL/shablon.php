<?php

//Подключение к базе данных
$mysqli = new mysqli("localhost","stas","stas","new_data");
/* проверка соединения */
$mysqli->set_charset("utf8");
if ( $mysqli->connect_errno ) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error());
    exit();
}
else {
    $mysqli->query ("INSERT INTO `tasklist` ( `name`, `laststart`, `schedule`,`status`) VALUES ('name-4', '2015-02-02', 'no-today', 'work')");
    $mysqli_2->query ("DELETE FROM `tasklist` WHERE id=1");
    $mysqli->query ("UPDATE `task_list` SET name=40,name=30 WHERE id='1'");


    //выбираем из таблицы значение всех строк
    //mysqli_fetch_assoc - Орабатывает ряд результата запроса и возвращает неассоциативный массив.
    //mysql_fetch_assoc --  Обрабатывает ряд результата запроса и возвращает ассоциативный массив.
    //mysql_num_rows -- Возвращает количество рядов результата запроса

    if ($result = $mysqli->query("SELECT * FROM `task_list` ",   MYSQLI_USE_RESULT)) {
        $rows = array();
        $servers["servers"] = array();
        $i = 0;
        //более сложное
        while ($row = mysqli_fetch_assoc($result)) {
            $servers["servers"][$i]["server_id"] = $row['id'];
            $servers["servers"][$i]["name_task"] = $row['name'];
            $servers["servers"][$i]["last_start"] = $row['last_start'];
            $servers["servers"][$i]["status_task"] = $row['schedule'];
            $servers["servers"][$i]["task"] = $row['status'];
            $i++;

        }
        //менее сложное
        while ($row = mysqli_fetch_row($result)) {
            $r=$row;
            echo $r[0];
        };
        while ($row = mysqli_fetch_assoc($result)) {
            $r=$row;
            echo $r['name'];
        };

        $rows = $servers;
        $result->close();
    }

    $json=json_encode($rows);//возвращаем ассоциативный массив в JSON
}
?>
<script>
    var perem = '<?php echo $json; ?>'; //запись в переменную javasript записи из PHP
    var Item = JSON.parse(perem); //распарсили переменную и с ней уже работаем
</script>


<!--Добавляем в базу SQL данные из формы-->
<body>
    <form class="wrapper" action="dbfile.php" method="post">
        <input class="name" type="text" placeholder="name" name="name"/>
        <input class="last-start" type="text" placeholder="last-start" name="last-start"/>
        <button id="add">Отправить</button>
        <br> <br>
    </form>
</body>
<?php

$name = htmlspecialchars(trim(stripslashes(strip_tags($_POST['name']))), ENT_QUOTES);
$last_start = htmlspecialchars(trim(stripslashes(strip_tags($_POST['last-start']))), ENT_QUOTES);




$mysqli->query("INSERT INTO `task_list` ( `name`, `last_start`) VALUES ('".$name."', '".$last_start."')");
?>
<!--Добавляем в базу SQL данные из формы с помощью ajax-->
<div class="wrapper">
    <input class="name" type="text" placeholder="name" name="name"/>
    <input class="last-start" type="text" placeholder="last-start" name="last-start"/>
    <button id="add">Отправить</button>

</div>

<script>
    $("#add").on("click",function(){
        $.ajax({
            url:"dbfile.php", //файл обработчик данных из формы
            type:"POST",//тип передачи
            data: { name: $('.name').val(), last_start:$('.last-start').val()},//записываем в перменные для отправки их в обработчик значения value полей


            success: //в случае удачной обработки переменных в обработчике перегружаем страничку. Это нужно
                     //например когда у нас данные не только попадают в базу, но и формируют элементы из этой базы
                function(data){
                    setTimeout('window.location.reload()', 500);
                }
        })
    });
</script>
<?php
if (!empty($_POST)){
    $name = trim(strip_tags($_POST['name']));
    $last_start = trim(strip_tags($_POST['last_start']));



    $mysqli->query("INSERT INTO `task_list` ( `name`, `last_start`) VALUES ('".$name."', '".$last_start."')");
}
?>