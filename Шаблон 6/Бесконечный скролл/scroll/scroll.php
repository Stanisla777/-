<?php
//    include 'db_scroll.php';
    include 'config.php';

$dsn = "mysql:host=$host;dbname=$d_b;charset=$charset";
$pdo = new PDO($dsn, $user, $pass, $opt);


$stmt = $pdo->prepare("SELECT  `massage`,`name`,`id` FROM `cgrab_site_main_level`  WHERE jobname=?  LIMIT ?");
$stmt->bindValue(1, "scroll", PDO::PARAM_INT);
$stmt->bindValue(2, 10, PDO::PARAM_INT);
$stmt->execute();

$i = 0;
$articles = array();
while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
    $articles[$i]["id"] = $row['id'];
    $articles[$i]["massage"] = $row['massage'];
    $i++;

};

?>


<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
    <style>
        #articles{
            width: 960px;
            background-color: #edfdff;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div id="articles">
    <?php foreach($articles as $element): ?>
        <p><?php echo $element['massage'] ?><br><?php echo $element['id'] ?></p>
    <?php endforeach ?>

</div>


<script src="script.js"></script>
</body>
</html>