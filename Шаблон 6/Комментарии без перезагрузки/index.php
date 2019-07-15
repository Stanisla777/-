<html>
<head>
<title>Комментарии без перезагрузки</title>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src='js/comment.js'></script>
<script type="text/javascript" src='js/JsHttpRequest.js'></script>
</head>
<body>

<?php
/*
вывод комментариев из базы
На этой странице при выводе статьи должна присутствовать переменная $id для извлечения и добавления данных в базу

$result = mysql_query("SELECT * FROM comment WHERE post='$id' ORDER BY id",$db);
if(mysql_num_rows($result) > 0)
{
$comment = mysql_fetch_array($result);
do
{
$text = $comment["text"];
$author = $comment["author"];
$date = $comment["date"];

printf("<div><strong>%s</strong><br>Добавлено: %s<br>%s</div>",$author,$date,$text);
}
while ($comment = mysql_fetch_array($result));
}
*/
?>	

<div id='cerror'></div>
<br><br>
<form action="#" method="POST" enctype="multipart/form-data" name="addcom" id="addcom" onSubmit="return false">
Ваше имя:<br>
<input name="author" type="text" size="30" class="pole" id="author"><br><br>
Текст комментария:<br>
<textarea name="text" rows="5" cols="50" class="text"></textarea><br>           
<br>
<input name="id" type="hidden" value="<?php echo $id; ?>">
<input class="adscom" name="button" type="button" value='Добавить комментарий' onclick="doLoad(document.getElementById('addcom'))">	
</form>



</body>
</html>