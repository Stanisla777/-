<?php
include 'inc/db.php';

// Получаем первые 10 статей, которые будут видны изначально
$res = mysqli_query($db, "SELECT * FROM `articles` ORDER BY `article_id` DESC LIMIT 10");

// Формируем массив из 10 статей
$articles = array();
while($row = mysqli_fetch_assoc($res))
{
    $articles[] = $row;
}
?>

<!DOCTYPE HTML>
<html>

<head>
	<meta charset = "utf-8" />
	<title>Все статьи</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
    
</head>

<body>

<div style="width: 200px;" id="articles">

    <?php foreach ($articles as $article): ?>
        <p><b><?php echo $article['title']; ?></b><br />
        <?php echo $article['text']; ?></p>
    <?php endforeach; ?>
    
</div>
<button id="more">Дальше</button>

</body>
</html>