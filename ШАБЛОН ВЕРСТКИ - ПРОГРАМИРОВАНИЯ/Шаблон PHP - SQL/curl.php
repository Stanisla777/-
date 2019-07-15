<?php

include 'phpQuery-onefile.php';
$db_param = array (
    'host'     => 'localhost',
    'dbname'   => 'testdb',
    'username' => 'u1',
    'passwd'   => 'u1'
);
//
$db_param_art = array (
    'host'     => 'localhost',
    'dbname'   => 'grab123',
    'username' => 'root',
    'passwd'   => ''
);


$port = 9050;
$round = 3;
$jobname = "bonprix";
$site_name = "http://www.bonprix.ru/";
$country = "Великая Россия";
$brand = "bonprix";
//$url_page = "http://www.delikateska.ru";

$url = "http://www.delikateska.ru";//адрес страницы с которой начнем парсит - точка отсчета
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//С помощью этой функции узнаю количество страниц для парсинга она будет вызываться в функции по сбору инфы о товаре
//function count_page($url){
//    $array_count_page = array();
//    $ch = curl_init($url);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
//    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//    curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
//    curl_setopt($ch, CURLOPT_TIMEOUT, 5); //9
//    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); //6
//    $page = curl_exec($ch);
//
//    $document = phpQuery::newDocument($page);
//    $hentry = $document;
//
//    foreach ($hentry as $el) {
//        $elem_pq = pq($el);
//        foreach($elem_pq->find('nav#items-pager a') as $element) { //выборка всех ссылок с номкрами страниц
//            $array_count_page[] = trim(pq($element)->text());
//        };
//    }
////    print_r($array_count_page);
////    $new_arr = array_diff($array_count_page, array(''," ", NULL, false));
//    $last_page = array_pop($array_count_page);
//    return $last_page;
//}
//$count_page = count_page($url);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Функция для сбора и помещения в таблицу категорий товара - уровень 1
function category_level_1($db_param,$url){
    $mysqli = new mysqli($db_param['host'], $db_param['username'], $db_param['passwd'], $db_param['dbname']);
    $mysqli->set_charset("utf8");


    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5); //9
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); //6
    $page = curl_exec($ch);
    $ci=curl_getinfo($ch);
    $header_status = ($ci["http_code"]);

    $document = phpQuery::newDocument($page);
    $hentry = $document;

    foreach ($hentry as $el) {
        $elem_pq = pq($el);
        foreach($elem_pq->find('nav.catalogMenu ul li.root a') as $element) { //выборка всех ссылок с номерами страниц
            $link_main_category = $url.pq($element)->attr('href');
            echo $name_category= trim(pq($element)->text());
            echo "\n";

            //print_r($name_category);
//            $mysqli->query ("INSERT INTO `cgrab_site_main_level`(port, round, link, typeofstruct,struct,jobname,sitename,brand,pagecode)
//            VALUES (9050, 1, '".$link_main_category."',1,'".$name_category."','delikateska','ДЕЛИКАТЕСКА.РУ','delikateska','$header_status')");

        };
    };

};
category_level_1($db_param,$url);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
////Считываем с таблицы полученные адреса категорий уровня 1(typestruct = 1)("Овощи и фрукты")
//$array_link_level_1 = array();
//function select_src_typestruct_1($db_param){
//    $mysqli = new mysqli($db_param['host'], $db_param['username'], $db_param['passwd'], $db_param['dbname']);
//    $mysqli->set_charset("utf8");
//    $result = $mysqli->query("SELECT  `link` FROM `cgrab_site_main_level` WHERE round=1 AND jobname='delikateska' AND typeofstruct=1" ,  MYSQLI_USE_RESULT);
//    $rows=array();
//
//
//    while ($row = mysqli_fetch_assoc($result)) {
//
//        $rows[] = $row['link'];
//
//    };
//    return $rows;
//}
//$array_link_level_1 = select_src_typestruct_1($db_param);//записали в переменную массив с адресами каталогов
//print_r($array_link_level_1);
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Функция для сбора и помещения в таблицу категорий товара - уровень 2 ( Овощи и Фрукты -> Свежие овощи)

//function category_level_2($db_param,$url,$url_page){
////
//    $mysqli = new mysqli($db_param['host'], $db_param['username'], $db_param['passwd'], $db_param['dbname']);
//    $mysqli->set_charset("utf8");
//
//    //узнаю количество переходов с товарами определенной категории
////        $count_page = count_page($url);
////        echo $count_page."------------------------------------77777777----------------------";
////        //узнанное количество переходов подставляю в цикл
////        for ($q = 1; $q <= $count_page; $q++) {
//
//            $ch = curl_init($url/*."/r/page/.$q"*/);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
//            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
//            curl_setopt($ch, CURLOPT_TIMEOUT, 5); //9
//            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); //6
//            $page = curl_exec($ch);
//            $ci = curl_getinfo($ch);
//            $header_status = ($ci["http_code"]);
//
//            $document = phpQuery::newDocument($page);
//            $hentry = $document;
//
//
//            foreach ($hentry as $el) {
//                $elem_pq = pq($el);
//
//                foreach ($elem_pq->find('div.catalogHeaderCategories__inner__checker a:gt(0):lt(-3)') as $element) { //выборка всех ссылок с номерами страниц
//                    $link_category_2 = $url_page.pq($element)->attr('href');
//                    echo $link_category_2;
//
//                $mysqli->query ("INSERT INTO `cgrab_site_main_level`(port, round, link, typeofstruct,jobname,sitename,brand,pagecode)
//                VALUES (9050, 1, '".$link_category_2."',2,'delikateska','ДЕЛИКАТЕСКА.РУ','delikateska','$header_status')");
//                };
//            };
//
////        }
//};
////foreach($array_link_level_1 as $item_2){
////    category_level_2($db_param,$item_2,$url_page);
////}
////Цикл, чтобы ограничить количество товара
//for ($q=0;$q</*count($array_link_level_1)*/2;$q++){
//    category_level_2($db_param,$array_link_level_1[$q],$url_page);
//}

////Считываем с таблицы полученные адреса категорий уровня 2(typestruct = 2)

//$array_link_level_2 = array();
//function select_src_typestruct_2($db_param){
//    $mysqli = new mysqli($db_param['host'], $db_param['username'], $db_param['passwd'], $db_param['dbname']);
//    $mysqli->set_charset("utf8");
//    $result = $mysqli->query("SELECT  `link` FROM `cgrab_site_main_level` WHERE round=1 AND jobname='delikateska' AND typeofstruct=2" ,  MYSQLI_USE_RESULT);
//    $rows=array();
//
//
//    while ($row = mysqli_fetch_assoc($result)) {
//
//        $rows[] = $row['link'];
//
//    };
//    return $rows;
//}
//$array_link_level_2 = select_src_typestruct_2($db_param);//записали в переменную массив с адресами каталогов
//print_r($array_link_level_2);

////Функция для сбора и помещения в таблицу категорий уровень 3 вход(адреса typestruct = 3) в моём случае получаю адрес карточки товара

//function category_level_3($db_param,$url,$url_page){
//
//    $mysqli = new mysqli($db_param['host'], $db_param['username'], $db_param['passwd'], $db_param['dbname']);
//    $mysqli->set_charset("utf8");
//
//    //узнаю количество переходов с товарами определенной категории
////        $count_page = count_page($url);
////        echo $count_page."------------------------------------77777777----------------------";
////        //узнанное количество переходов подставляю в цикл
////        for ($q = 1; $q <= $count_page; $q++) {
//
//            $ch = curl_init($url/*."/r/page/.$q"*/);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
//            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
//            curl_setopt($ch, CURLOPT_TIMEOUT, 5); //9
//            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); //6
//            $page = curl_exec($ch);
//            $ci = curl_getinfo($ch);
//            $header_status = ($ci["http_code"]);
//
//            $document = phpQuery::newDocument($page);
//            $hentry = $document;
//
//
//            foreach ($hentry as $el) {
//                $elem_pq = pq($el);
//
//                $array_struct=array();
//                foreach (pq($elem_pq)->find('nav.path a:gt(1)')as $elem){
//                    $array_struct[] = pq($elem)->text();
//                }
//                $json_struct=json_encode($array_struct,JSON_UNESCAPED_UNICODE);
//                print_r($json_struct);
//
//                foreach ($elem_pq->find('div.productsCatalogCtn article.product') as $element) { //выборка всех ссылок с номерами страниц
//                    $link_category_2 = $url_page . pq($element)->find('a[href^="/product"]')->attr('href');
//                    echo $link_category_2;
//
//                $mysqli->query ("INSERT INTO `cgrab_site_main_level`(port, round, link, typeofstruct,struct,jobname,sitename,brand,pagecode,itsmodel)
//                VALUES (9050, 1, '".$link_category_2."',3,'".$json_struct."','delikateska','ДЕЛИКАТЕСКА.РУ','delikateska','$header_status',1)");
//                };
//            };
//
////        }
//};
////foreach($array_link_level_2 as $item_3){
////    category_level_3($db_param,$item_3,$url_page);
////}
////Цикл, чтобы ограничить количество товара
//for ($q=0;$q</*count($array_link_level_2)*/2;$q++){
//    category_level_3($db_param,$array_link_level_2[$q],$url_page);
//}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//////Функция для грабинга карточки товара - ПОСЛЕДНИЙ ШАГ

//Считываем с таблицы полученные адреса категорий уровня 3(typestruct = 3) в моём случае адреса товаров
//$array_link_level_3 = array();
//function select_src_typestruct_3($db_param){
//    $mysqli = new mysqli($db_param['host'], $db_param['username'], $db_param['passwd'], $db_param['dbname']);
//    $mysqli->set_charset("utf8");
//    $result = $mysqli->query("SELECT `link`,`struct` FROM `cgrab_site_main_level` WHERE round=1 AND jobname='delikateska' AND typeofstruct=3" ,  MYSQLI_USE_RESULT);
//    $rows=array();
//    $hg = array();
//
//    $array_category_4=array();
//    $i=0;
//    while ($row = mysqli_fetch_assoc($result)) {
//        $array_category_4[$i]["category"] =$row['struct'];//2 вариант
//        $array_category_4[$i]["value"] =$row['link'];
//        $i++;
//    };
//    return $array_category_4;
//}
//$array_link_level_3 = select_src_typestruct_3($db_param);//записали в переменную массив с адресами каталогов
//print_r($array_link_level_3);


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
////////Функция для грабинга карточки товара - ПОСЛЕДНИЙ ШАГ
//function grab_product ($db_param_art,$url,$struct)
//{
//    $port = 9050;
//    $round = 5;
//    $jobname = "delikateska";
//    $site_name = "http://www.delikateska.ru";
//    $country = "Великая Россия";
//    $brand = "delikateska";
//
//
//    $mysqli = new mysqli($db_param_art['host'], $db_param_art['username'], $db_param_art['passwd'], $db_param_art['dbname']);
//    $mysqli->set_charset("utf8");
//
//    $ch = curl_init($url);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
//    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//    curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
//    curl_setopt($ch, CURLOPT_TIMEOUT, 5); //9
//    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); //6
//    $page = curl_exec($ch);
//
//    $ci=curl_getinfo($ch);
//    $header_status = ($ci["http_code"]);
//
//    $document = phpQuery::newDocument($page);
//    $hentry = $document;
//
//    $array_img_product = array();
//    foreach ($hentry as $el) {
//
//        $elem_pq = pq($el);
//        $container_product=$elem_pq;
//
//        //А вот и иформация о товаре, здесь же и структуа
//
//        $adress_page = $url;
////        echo "$adress_page/br----";
//
//        $name_product = pq($container_product)->find('h1.productTitle')->text();
//        echo $name_product;
//
////      JSON СТРУКТУРА
//        $json_struct = $struct;
////        print_r($json_struct);
//
//
////        $array_img_product[] = pq($container_product)->find('div.productPhotoWrap img.product-photowrapper__img')->attr('src');
//
////        $array_img_product = array();
//        foreach(pq($container_product)->find('div#productGallery')->find('div.thumbs')->find('a img') as $eleme){
//            $img = pq($eleme)->attr('src');
//            $pattern = "/[w]\d+[h]\d+/";
//            $replacement = "w400h300";
//            $img_2 = preg_replace($pattern, $replacement, $img);
//
////            $img_2 = str_replace('w63h100','w400h300',$img);
//            $array_img_product[] = $img_2;
//        }
//        if(empty($array_img_product)){
//            $array_img_product[] = pq($container_product)->find('div#productGallery')->find('div.image img')->attr('src');
//        }
////        print_r($array_img_product);
//
//        $json_img_product = json_encode($array_img_product);
////        print_r($json_img_product);
//
//        $price_product = pq($container_product)->find('div.buyProduct span.priceBlock span.priceWrap')->text();
//
//        $curency = pq($container_product)->find('span.rubSmall')->text();
////            echo $curency;
//
//        $size_for_price = pq($container_product)->find('div.buyProduct span.priceBlock small')->text();
////            echo $size_for_price;
//
//        $presence_on_store = pq($container_product)->find('div.buyProduct p.bought--rest')->text();
////        echo $presence_on_store;
//
//        if($presence_on_store==false){
//            $presence_on_store = pq($container_product)->find('div.buyProduct span.priceWrap')->text();
//        }
////        echo $presence_on_store;
//
//        $line_number_product = pq($container_product)->find('.subtitle')->text();
//        $number_product = substr($line_number_product, strpos($line_number_product, "артикул") + 7);
////            echo $number_product;
//
//        $line_description = trim(pq($container_product)->find('p.subtitle')->text());
//        $description = trim(substr($line_description,0,strpos($line_description, "артикул"))," ,");
////            echo $description;
//
//
//        $line_already_buy = pq($container_product)->find('p.bought:not(p.bought--rest)')->text();
//        $line_2_already_buy = substr($line_already_buy,11);
//        $count_already_buy = trim(substr($line_2_already_buy,0,strpos($line_2_already_buy, "раз")));
////            echo $alreay_buy;
//
//        //JSON - Свойства товара(длина, размер, цвет и т.д.) - тобеш все свойства
//        $key_property_product=array();
//        $property_product=array();
//        foreach(pq($container_product)->find('table.productChars tr')as $element){
//            $key_property_product[] = pq($element)->find('td span.classifyName')->text();
//            $property_product[] = pq($element)->find('td.classifyTitle')->next('td')->text();
//
//        };
//
//        $array_property = array_combine ($key_property_product,$property_product);
//        $json_property = json_encode($array_property,JSON_UNESCAPED_UNICODE);
//        $json_property_base_64=base64_encode($json_property);
//
////        print_r(base64_decode($json_property_base_64));
//
//
////
////        $mysqli->query ("INSERT INTO `grab`(port,round,jobname,sitename,link,name,typeofstruct,struct,img,price,currency,amount,presence,articul,buycount,discription,json,country,brand,pagecode)
////                VALUES (".$port.",".$round.",'".$jobname."','".$site_name."','".$adress_page."',
////                '".$name_product."',0,'".$json_struct."','".$json_img_product."','".$price_product."','".$curency."','".$size_for_price."','".$presence_on_store."',
////                '".$number_product."','".$count_already_buy."','".$description."','".$json_property_base_64."','".$country."','".$brand."',$header_status)");
//
////
//    }
//}
////Цикл, чтобы ограничить количество товара
//foreach($array_link_level_3 as $elemen) {
//    $elemen["category"];
//    $elemen["value"];
//    grab_product($db_param_art,$elemen["value"],$elemen["category"]);
//
//};
//    for ($e=0;$e<count($elemen);$e++){
//        grab_product($db_param_art,array_values($elemen)[$e],array_keys($elemen)[$e]);
//    }

//grab_product($db_param_art,"http://www.delikateska.ru/product/8483");




//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Функция для удаления сток из таблицы SQL
//function delete($db_param)
//{
//    $mysqli = new mysqli($db_param['host'], $db_param['username'], $db_param['passwd'], $db_param['dbname']);
//    $mysqli->set_charset("utf8");
//    $mysqli->query ("DELETE FROM `cgrab_site_main_level` WHERE jobname='delikateska'");
//}
//delete($db_param);

//Удаление из Артемовской таблицы
//function delete($db_param_art)
//{
//    $mysqli = new mysqli($db_param_art['host'], $db_param_art['username'], $db_param_art['passwd'], $db_param_art['dbname']);
//    $mysqli->set_charset("utf8");
//    $mysqli->query ("DELETE FROM `grab` WHERE jobname='delikateska' AND round=5 AND typeofstruct=0");
//}
//delete($db_param_art);
?>
