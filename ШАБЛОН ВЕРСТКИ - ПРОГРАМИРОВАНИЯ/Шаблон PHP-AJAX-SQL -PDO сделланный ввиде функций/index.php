<?php
include("function.php");
?>
<!DOCTYPE html>

<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
<form action="function.php" method="post">
    <input name="name" type="text" placeholder="Имя"/>
    <input name="message" type="text" placeholder="Сообщение"/>
    <button type="submit">Отправить</button>
</form>
<?php
foreach ($array as $mas){
    echo $mas;
}
?>

</body>
</html>