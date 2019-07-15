<?php


if(isset($_POST['submit-project'])){
    $name = trim(strip_tags($_POST['name-project']));
    $idpackage = trim(strip_tags($_POST['id-package']));
    $idcatalog = trim(strip_tags($_POST['id-catalog']));
    $idprice = trim(strip_tags($_POST['id-package']));
    $key = trim(strip_tags($_POST['id-catalog']));

    $mysqli->query ("INSERT INTO `project` ( `name-site`, `id-job-package`, `id-catalog`,`id-price`,`key-site`)
    VALUES ('$name', '$idpackage', '$idcatalog', '$idprice', '$key')");
    $mysqli->close();
    echo("Сообщение отправлено");
    header('Location:'.$_SERVER['HTTP_REFERER']);

}




//Без перезагрузки

if ( $mysqli->connect_errno ) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error());
    exit();
}
else{
    echo "Удалось подключиться";
}

if (!empty($_POST)) {
//    записываю в переменную с защитой от введенных вредоносных тэгов защиты
    $name = trim(strip_tags($_POST['name']));
    $last_start = trim(strip_tags($_POST['last_start']));
    $schedule = trim(strip_tags($_POST['schedule']));
    $status = trim(strip_tags($_POST['status']));

    $mysqli->query("INSERT INTO `task_list` ( `name`, `last_start`, `schedule`,`status`) VALUES ('$name', '$last_start','$schedule', '$status')");
    $mysqli->close();
    echo("Сообщение отправлено");


}