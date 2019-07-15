<?php
include 'config.php';

$startFrom = $_POST['startfrom'];
$startFrom = (int)preg_replace("/script|http|<|>|<|>|SELECT|UNION|UPDATE|exe|exec|INSERT|tmp/i","",trim(stripslashes(strip_tags($startFrom))));

$dsn = "mysql:host=$host;dbname=$d_b;charset=$charset";
$pdo = new PDO($dsn, $user, $pass, $opt);


    $stmt = $pdo->prepare("SELECT  `massage`,`id` FROM `cgrab_site_main_level`  WHERE jobname=?  LIMIT ?, ?");
    $stmt->bindValue(1, "scroll", PDO::PARAM_INT);
    $stmt->bindValue(2, $startFrom, PDO::PARAM_INT);
    $stmt->bindValue(3, 10, PDO::PARAM_INT);
    $stmt->execute();

//    $stmt = $pdo->query("SELECT  `massage`,`id` FROM `cgrab_site_main_level`  WHERE jobname='scroll'  LIMIT $startFrom, 10");

    $i = 0;
    $array_chat = array();
    $articles = array();
    while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
        $articles[$i]["idi"] = $row['id'];
        $articles[$i]["massage"] = $row['massage'];
        $i++;

    };
     echo json_encode($articles,JSON_UNESCAPED_UNICODE);

//selectmassage($user, $pass, $opt,$host,$d_b,$charset);
