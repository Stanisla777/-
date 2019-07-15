<?
include_once("bd.php");
// Запрет на кэширование
header("Expires: Mon, 23 May 1995 02:00:00 GTM");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GTM");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
//****

$log =="";
$error="no"; //флаг наличия ошибки

require_once 'JsHttpRequest.php';
$JsHttpRequest =& new JsHttpRequest("utf-8");

//Короткие имена переменных и обрезка пробелов img_title
$text = trim($_POST['text']);
$author = trim($_POST['author']);
$id = trim($_POST['id']);

//Проверка email адреса

if($author == ''){
	$log .= "Пожалуйста, введите Ваше имя<br>";
	$error = "yes";
}

//Проверка наличия введенного текста комментария
if (empty($text)){
	$log .= "Необходимо указать текст сообщения!<br>";
	$error = "yes";
}
else{
	//Должнен быть хоть один символ на русском языке
	$spam=1;  

	for($i=0;$i<strlen($text);$i++){
		if((ord($text[$i])>=192) && (ord($text[$i])<=255)){$spam=0;break;}
	}

	if ($spam == 1)	{
		$log .= "Ваше сообщение не содержит ни одной русской буквы.<br>";
		$error = "yes";    
	} 

}

//Проверка длины текста комментария
if(strlen($text)>1000){
	$log .= "Слишком длинный текст, в вашем распоряжении 1000 символов!<br>";
	$error = "yes";
}
	 
//Проверка на наличие длинных слов
$mas = preg_split("/[\s]+/",$text);
foreach($mas as $index => $val){
	if (strlen($val)>40)  {
		$log .= "Слишком длинные слова (более 40 символов) в тексте записи!<br>";
		$error = "yes";
		break;
	}
}
	
//Экранирование и преобразование опасных символов
if (!get_magic_quotes_gpc()){
	$text = addslashes($text);
	$author = addslashes($author);
	$cod = addslashes($cod);
}

$text = htmlspecialchars($text);
$author = htmlspecialchars($author);
$cod = htmlspecialchars($cod);

//Если нет ошибок добавляем в базу  
if($error=="no"){
	$date = date("d-m-Y в H:i");
	$result2 = mysql_query("INSERT INTO comment (post,author,text,date) VALUES ('$id','$author','$text','$date')",$db);
	//****
	$ok="<div><strong>".$author."</strong><br>Добавлено: ".$date."<br>".$text."</div>";

	//Помещаем результат в массив
	$GLOBALS['_RESULT'] = array(
	'error' => 'no',
	'ok' => $ok
	);

}
else {//если ошибки есть
 	$log = "<div><strong><font color='red'> Ошибка! </font></strong><br>".$log."</div>";
	//Отправляем результат в массив
	$GLOBALS['_RESULT'] = array(
	'error' => 'yes',      
	'er_mess' => $log);
}  
?>