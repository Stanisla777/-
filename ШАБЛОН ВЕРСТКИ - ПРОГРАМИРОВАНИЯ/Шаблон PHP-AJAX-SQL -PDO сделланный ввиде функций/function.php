<?php
//include("phpQuery.php");



$db_param = array (
    'host'     => 'localhost',
    'dbname'   => 'mydb',
    'username' => 'stas',
    'passwd'   => 'stas'
);
$table_name = 'chat';



    function setmassage($db_param,$name,$message){
        $mysqli = new mysqli($db_param['host'], $db_param['username'], $db_param['passwd'], $db_param['dbname']);
        $mysqli->set_charset("utf8");

        if($name==""||$message==""){
            return;
        }
        $name = htmlspecialchars(trim(stripslashes(strip_tags($name))));
        $message = htmlspecialchars(trim(stripslashes(strip_tags($message))));
        $mysqli->query ("INSERT INTO `chat` ( `name`, `message`) VALUES ('$name', '$message')");
    }



       if(!empty($_POST)) {
           setmassage($db_param,$_POST['name'],$_POST['message']);
           header("Location:index.php");
}

function get_massage($db_param){
    $mysqli = new mysqli($db_param['host'], $db_param['username'], $db_param['passwd'], $db_param['dbname']);
    $mysqli->set_charset("utf8");
    $result = $mysqli->query("SELECT * FROM `chat` ",   MYSQLI_USE_RESULT);
    $rows=array();
    while ($row = mysqli_fetch_assoc($result)) {

        $rows[]= $row['name']." - ";
        $rows[]= $row['message']." - ";
        $rows[]=$row['date']."<br>";

    };
    return $rows;
}
$array = get_massage($db_param);//в array мы записываем результат возвращения функции


//!!!!!!!!!!!!!!!!!!ШАБЛОН с PDO и Ajax запроса!!!!!!!!!!!!!!!!!!!!!!!

function setmassages($user, $pass, $opt,$host,$d_b,$charset,$name,$tel){
    $dsn = "mysql:host=$host;dbname=$d_b;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass, $opt);

    if($name==""){
        return;
    }
    $name = preg_replace("/script|http|<|>|<|>|SELECT|UNION|UPDATE|exe|exec|INSERT|tmp/i","",
        trim(stripslashes(strip_tags($name))));
    $tel = preg_replace("/script|http|<|>|<|>|SELECT|UNION|UPDATE|exe|exec|INSERT|tmp/i","",
        trim(stripslashes(strip_tags($tel))));


    $data = array("$name","$tel");
    $stmt = $pdo->prepare ("INSERT INTO `chat` ( `name`,`tel`) VALUES (?,?)");
    $stmt->execute($data);


}

if(!empty($_POST)) {
    setmassages($user, $pass, $opt,$host,$d_b,$charset,$_POST['name'],$_POST['tel']);
    header("Location:index.php");
}

?>

    <form id="callback" action="#" method="post">
        <input name="name" type="text" placeholder="Введите имя"/>
        <input name="tel" type="text" placeholder="Введите телефон"/>
        <button class="" type="submit">Отправить</button>
    </form>


    <script>
    $(document).ready(function() {
        $("#callback").submit(function(){
            $.ajax({
                type:"POST",
                url:"function-db.php",
                data:$("#callback").serialize(),
//                data: { name: $('.name').val(), last_start:$('.last-start').val()}//можно и так, если хотим напримен не все поля отправлять снрверу
                success:function(data){//функция в качестве параметра принимащая ответ от сервера, которая вызывается,
                    // если не произошло никакой ошибки. Этот параметр можно и не указывать, если он нам не нужен
                    $("#content").append("<br>Success<br>"+data)
            };
            return false;
        });
    });




    //Тут вместо success done. Чем отличается не понял,но хер знает

    $(document).ready(function() {
        $("#callback").submit(function(){
            $.ajax({
                type:"POST",
                url:"function-db.php",
                data:$("#callback").serialize()
//                data: { name: $('.name').val(), last_start:$('.last-start').val()}//можно и так, если хотим напримен не все поля отправлять снрверу
            }).done(function(){
                $("#callback input").val("");//это чтобы поля очищались
            });
            return false;
        });
    });
</script>


