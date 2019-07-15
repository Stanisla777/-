

$(document).ready(function ($) {

    //Футер прижимаю к низу страницы с помощью js
    function footerToBottom() {
        var browserHeight = $(window).height(),
            footerOuterHeight = $('footer').outerHeight(true),
            mainHeightMarginPaddingBorder = $('.wrap').outerHeight(true) - $('.wrap').height();
        $('.wrap').css({
            'min-height': browserHeight - footerOuterHeight - mainHeightMarginPaddingBorder
        });
    }
    footerToBottom();
    $(window).resize(function () {
        footerToBottom();
    });




    //Слайдер
    $('#slider').slider({
        min: 0,
        max: 1000,
        values: [0,1000],
        range: true,
        create: displaySliderValues,
        slide: displaySliderValues,
        stop: inputValue
    });

    function displaySliderValues() {
        $('#lower').text($('#slider').slider("values", 0));
        $('#upper').text($('#slider').slider("values", 1));
    }

    function inputValue(){
        var price_low = $("#lower").text();
        var price_top = $("#upper").text();
        $(".js-input-range-low").val(price_low);
        $(".js-input-range-top").val(price_top);
    }

    $('.name-server').click(function(){
        var price_low = $("#lower").text();
        var price_top = $("#upper").text();
        $(".js-input-range-low").val(price_low);
        $(".js-input-range-top").val(price_top);
    });


    //Резиновый input
    var $input = $('.price-range input'),
        $buffer = $('.input-buffer');

    $input.on('change', function() {
        $buffer.text($input.val());
        $input.width($buffer.width());
    });


    //!!!!!!!!!!!Потом убрать,это переходы, а пока чтобы показать редирект на другую страницу!!!!!!!!!!!!!!!!!!!!!!!!!!!
    $('.then-remove').on('click',function(){
        event.preventDefault();
        location.replace("car-added.html")
    });

    $('.then-remove-2').on('click',function(){
        event.preventDefault();
        location.replace("create-account-step2.html")
    });
    $('.then-remove-3').on('click',function(){
        event.preventDefault();
        location.replace("code-entry.html")
    });
    $('.then-remove-4').on('click',function(){
        event.preventDefault();
        location.replace("grow-screen.html")
    });

    $('.then-remove-5').on('click',function(){
        event.preventDefault();
        location.replace("information-added.html")
    });
    $('.then-remove-6').on('click',function(){
        event.preventDefault();
        location.replace("profile-klient.html")
    });
    $('.then-remove-7').on('click',function(){
        event.preventDefault();
        location.replace("mane-page.html")
    });

    $('.then-remove-9').on('click',function(){
        event.preventDefault();
        location.replace("shares.html")
    });
    $('.then-remove-10').on('click',function(){
        event.preventDefault();
        location.replace("mane-page-subscription-end.html")
    });

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    /*Снять все чекбоксы по нажатию на клафишу*/

    $(".js-pull-off-checbox").on("click",function () {
            $(this).parents(".header").siblings(".main-content-brand").find(".list-filters input").prop('checked', false);
    });


    //Переключение между табами(вкладками) на странице, например летняя - зимняя резина
    $(".tabs_menu li").click(function () {
        if (!$(this).hasClass("active")) {
            var i = $(this).index();
            $(".tabs_menu li.active").removeClass("active");
            $(".tabs .active-album").hide().removeClass("active-album");
            $(this).addClass("active");
            $($(".tabs").children(".info")[i]).fadeIn(1000).addClass("active-album");
        }
    });

    $(".tabs_menu_2 li").click(function () {
        if (!$(this).hasClass("active-type")) {
            var i = $(this).index();
            $(".tabs_menu_2 li.active-type").removeClass("active-type");
            $(".tabs_2 .active-album").hide().removeClass("active-album");
            $(this).addClass("active-type");
            $($(".tabs_2").children(".info")[i]).fadeIn(1000).addClass("active-album");
        }
    });


/*Слайдер главного экрана*/

    $('.type-job-slider').slick({
        slidesToShow: 1,
        dots: true,
        //variableWidth: true,/*именно благодаря этому кадров столько, сколько помещается на экране*/
        slidesToScroll: 1,
        infinite: true,
        cssEase: 'linear',
        speed:500,
        centerMode: true,
        centerPadding: '30px',
        focusOnSelect: true,
        arrows: false
    });

    $('.slider-photos-order').slick({
        slidesToShow: 3,
        dots: true,
        //variableWidth: true,/*именно благодаря этому кадров столько, сколько помещается на экране*/
        slidesToScroll: 1,
        infinite: true,
        cssEase: 'linear',
        speed:400,
        centerMode: true,
        centerPadding: '20px',
        focusOnSelect: true,
        arrows: false
        //respondTo: 'min'
    });


    $('.slider-service-foto').slick({
        slidesToShow: 1,
        dots: true,
        slidesToScroll: 1,
        //fade: true,
        infinite: true,
        cssEase: 'linear',
        speed:1000,
        //centerMode: true,
        //centerPadding: '30px',
        focusOnSelect: true,
        arrows: false
    });





    /*Вызов Меню*/
    $('.menu-icon').on("click",function(e){
        $('.wrap, footer').css('display','none');
        $('.media-menu').css("display","block");
        e.preventDefault();
    });
    $(".media-close").click(function(){
        $('.media-menu').css("display","none");
        $('.wrap, footer').css('display','block');
    });



    //$('.menu-icon').on("click",function(e){
    //
    //    $('.media-menu').css("display","block");
    //    e.preventDefault();
    //});
    //$(".icon-close").click(function(){
    //    $('.media-menu').css("display","none");
    //});
    //$(".main-wrap").click(function(){
    //    $('.media-menu').css("display","none");
    //});




    /*Функция для добавления картинки пользователем*/
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                //var t = $('.upload-file-container').clone(true);
                //$(t).appendTo('.wrapper-add-foto');
                $('#image').attr('src', e.target.result);

            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInput").change(function(){
        readURL(this);
    });

    /*Смена экранов в рамках одной страницы, например регистрации*/

    var steps = $("form").children(".step"); // находим все шаги формы
    $(steps[0]).show(); // показываем первый шаг
    var current_step = 0; // задаем текущий шаг

    $("a.next").click(function(){	// Событие клика на ссылку "Следующий шаг"
        if (current_step == steps.length-2) { // проверяем, будет ли следующий шаг последним
            $(this).hide(); // скрываем ссылку "Следующий шаг"
            $(".input-hide").show(); // показываем кнопку "Регистрация"
        }
        $("a.back").show(); // показываем ссылку "Назад"
        current_step++; // увеличиваем счетчик текущего слайда
        changeStep(current_step); // меняем шаг
    });

    $("a.back").click(function(){	// Событие клика на маленькое изображение
        if (current_step == 1) { // проверяем, будет ли предыдущий шаг первым
            $(this).hide(); // скрываем ссылку "Назад"
        }


        $(".input-hide").hide(); // скрываем кнопку "Регистрация"
        $("a.next").show(); // показываем ссылку "Следующий шаг"
        current_step--; // уменьшаем счетчик текущего слайда
        changeStep(current_step);// меняем шаг
    });

    function changeStep(i) { // функция смены шага
        $(steps).hide(); // скрываем все шаги
        $(steps[i]).show(); // показываем текущий

        if($(".step-11").is(":visible") != true){
            $(".footer-call-to-action").show();
        }else{
            $(".footer-call-to-action").hide();
        }

    }


    /*Стирать данные в  поле ввода по нажатию на крестик*/

    $('.js-icon-clear').on('click',function(){
        $(this).siblings('.js-input-search').val('');
    });

    /*Выбор количества звездочек для оценок*/


    $('.item-rating').on('click',  function() {
        $(this).toggleClass('item-rating-fill');
    });




    /*Яндекс карты*/
    ymaps.ready(init);

    function init () {
        var myMap = new ymaps.Map("map", {
            // Центр карты, указываем коордианты
            center:[55.752161956105276,37.61949517968746],
            // Масштаб, тут все просто
            zoom: 16,
            // Отключаем все элементы управления
            controls: []
        });

        var myGeoObjects = [];

        // Наша метка, указываем коордианты
        myGeoObjects = new ymaps.Placemark([55.800151390638646,37.61400201562497],{
            balloonContentBody: 'Текст в балуне'
        },{
            iconLayout: 'default#image',
            // Путь до нашей картинки
            iconImageHref: 'assets/img/icon-tel.png',
            // Размер по ширине и высоте
            iconImageSize: [100, 100],
            // Смещение левого верхнего угла иконки относительно
            // её «ножки» (точки привязки).
            iconImageOffset: [-35, -35]
        });

        var clusterer = new ymaps.Clusterer({
            clusterDisableClickZoom: false,
            clusterOpenBalloonOnClick: false
        });

        clusterer.add(myGeoObjects);
        myMap.geoObjects.add(clusterer);
        // Отлючаем возможность изменения масштаба
        myMap.behaviors.disable('scrollZoom');

    }
    //
    //
    ///*Формы отправки - регулярка на ввод символов*/
    //
    $('.js-number, input[name="tel"]').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9\(\)\+\-\s]/g)) {
            this.value = this.value.replace(/[^0-9\(\)\.\+\-\s]/g, '');
        }
    });

    $('.js-number-point').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9\(\)\.\+\s]/g)) {
            this.value = this.value.replace(/[^0-9\(\)\.\+\s]/g, '');
        }
    });

    $('.js-word, .js-input-search, input[name="password"], textarea[name="text"]').bind("change keyup input click", function() {
        if (this.value.match(/[^а-яА-Яa-zA-Z\s\"\'\0-9\.\,]/g)) {
            this.value = this.value.replace(/[^а-яА-Яa-zA-Z\s\"\'\0-9\.\,]/g, '');
        }
    });


    $('.js-email, input[name="e-mail"]').bind("change keyup input click", function() {
        if (this.value.match(/[^а-яА-Яa-zA-Z\s\"\'\0-9\.\,\@]/g)) {
            this.value = this.value.replace(/[^а-яА-Яa-zA-Z\s\"\'\0-9\.\,\@]/g, '');
        }
    });


    //Запуск диаграммы

    var c = $(".box input").val();
    $(function() {

        $(".dial").knob({

        });
        //$({animatedVal: 0}).animate({animatedVal: c}, {
        //    duration: 2000,
        //    easing: "swing",
        //    step: function() {
        //        $(".dial").val(Math.ceil(this.animatedVal)).trigger("change");
        //    }
        //});
    });
    //
    //if($('.radio-2').is(':checked'))
    //{
    //    alert('Приавк');
    //}

    $(".radio-2").click(function(){
        $({animatedVal: 0}).animate({animatedVal: 20}, {
                duration: 2000,
                easing: "swing",
                step: function() {
                    $(".dial").val(Math.ceil(this.animatedVal)).trigger("change");
                }
            });
    });

    $(".radio-1").click(function(){
        $({animatedVal: 0}).animate({animatedVal: c}, {
            duration: 2000,
            easing: "swing",
            step: function() {
                $(".dial").val(Math.ceil(this.animatedVal)).trigger("change");
            }
        });
    });





    /*Модальные окна*/

    var text;

    //Получаю текущий год
    Data = new Date();
    var year = Data.getFullYear();



    /*Настройка Шаблона пользователя*/

        $(".checkbox").change(function(){
            if ($(this).prop('checked')) {
                $('.wrapper-call-template').show();
                $('.input-template').hide();

            } else {
                $('.wrapper-call-template').hide();
                $('.input-template').fadeIn().show();
            }
        });



/*Бутстраповские окна*/

    /*Открытие окна с фильтром*/
    $('.js-filtr-icon').click(function(){
        $('.main-page-window, .wrap, .footer').css('display','none');
        $('.window-filtr').css('display','block');
    });

    $('.js-close').on('click',function(){
        $('.window-filtr').css('display','none');
        $('.main-page-window,.wrap, .footer').css('display','block');
    });

    /*Открытие окна с подписками*/
    $(".go-to-subscription").click(function(){
        $("#modal-subscription").modal('show');
    });

    $('.wrapper-subscription').on('click',function(){
        var price = $(this).find(".js-sub-price").text();
        $("#modal-subscription").modal('hide');
        $('.js-substitute-price').text(price);

    });

    //Вызов поп-ап Заказ опубликован наверное вызывется в AJAX

    $("#js-call-published").on("click",function(){

        //event.preventDefault(); /*Это убрать, так как окощко о том, что задание выполнено будет вызываться через ajax*/
        //$(".wrapper-order-published").css("display","block")

        event.preventDefault(); /*Это убрать, так как окощко о том, что задание выполнено будет вызываться через ajax*/
        $("#modal-order-published").modal('show');
        setTimeout('location.replace("orders.html")',2000);


    });
    //$(".pop-up-order-published").on("click",function(){
    //    $(".wrapper-order-published").css("display","none")
    //});

    //Вызов поп ап Отклик отправлен у исполнителя наверное вызывется в AJAX
    $("#js-call-response-sent").on("click",function(){
        event.preventDefault(); /*Это убрать, так как окощко о том, что задание выполнено будет вызываться через ajax*/
        $("#modal-response-sent").modal('show');
        setTimeout('location.replace("mane-page-notification.html")',2000);

    });

    //Вызов поп ап Другие шаблоны
    //$(".select-another-template").on("click",function(){
    //    event.preventDefault(); /*Это убрать, так как окощко о том, что задание выполнено будет вызываться через ajax*/
    //    $("#another-template").modal('show');
    //});

    //Вызов поп ап Вы выполнили задание?
    $(".js-question-about-task").on("click",function(){
        event.preventDefault(); /*Это убрать, так как окощко о том, что задание выполнено будет вызываться через ajax*/
        $("#modal-question-about-task").modal('show');
    });

    //Вызов поп ап Да, выполнили задание?
    $(".yes-perform").on("click",function(){
        event.preventDefault(); /*Это убрать, так как окощко о том, что задание выполнено будет вызываться через ajax*/
        $("#modal-order-published-q").modal('show');
        $("#modal-question-about-task").modal('hide');
        setTimeout('location.replace("orders.html")',2000);
    });

    /*По клику на кнопку "Добавить услугу" на странице "Создание заказа" делать клон поля вид услуги*/

    $(".tabssss").on('click','.js-perform-action',function(e){

        var elem = $(this).siblings('.wrapper-inp').find('.wrapper-input-choice').last().clone(true);
        $(elem).find('input').val("");
        $(elem).appendTo(".wrapper-inp");

    });

    //Аккордеон на странице Услуги
    ! function(i) {
        var o, n;
        i(".title_block").on("click", function() {
            o = i(this).parents(".accordion_item"), n = o.find(".info"),
                o.hasClass("active_block") ? (o.removeClass("active_block"),
                    n.slideUp()) : (o.addClass("active_block"), n.stop(!0, !0).slideDown(),
                    o.siblings(".active_block").removeClass("active_block").children(
                        ".info").stop(!0, !0).slideUp())



        })

    }(jQuery);


    //Снимаю все метки на чекбоксов
    $(".js-reset").on("click",function () {
        $("li.active_block input[type='checkbox']").prop('checked', false);
    });


    //Задаю циклом id инпутам и for лэйблам для стилизованных чекбоксов id="box1" for="box1"

    $('.checkbox-green').each(function(i) {
        $(this).attr('id', 'box'+(i+1))
    });

    $('.stylized-checkbox').each(function(i) {
        $(this).attr('for', 'box'+(i+1))
    });

//Подписка - подсчет платежа в месяц

    $('.wrapper-subscription-price').each(function(i) {
       var price = $(this).find(".subscription-price-price").text();
        var month = $(this).find(".subscription-price-time").text();
        var price_month = price/month;
        price = parseInt(price);
        month = parseInt(month);
        var price_month = price/month;
        price_month = price_month.toFixed();
        $(this).find(".price-month").text(price_month + " p")
    });

    var month;
    var price;

    $('.wrapper-subscription-price').on('click',function(){
        $(this).siblings('.wrapper-subscription-price').removeClass('border-green-2')
        $(this).addClass('border-green-2');
        month = $(this).find('.subscription-price-time').text();
        price = $(this).find('.subscription-price-price').text();
        $('.formed-price .tariff-plan').text(month+' / '+price);
    });



    //Инфа для модальных окон

    var title= {
        title_marka: "Марка",
        title_model: "Модель",
        title_engine: "Двигатель",
        title_year: "Год выпуска",
        title_transmission: "Коробка передач",
        title_type_service: "Тип сервиса",
        title_wishes_spare: "Пожелания по запчастям",
        title_weekend: "Выходные",
        title_category: "Категория",
        title_kind_service: "Вид услуги",
        title_templates: "Выберите шаблон"

    };

    var marka = [
        { name: "Ford",ic_marka:"../../assets/img/icon-BMW.png"},
        { name: "Mercedes-Benz",ic_marka:"../../assets/img/icon-BMW.png"},
        { name: "Жигули",ic_marka:"../../assets/img/icon-BMW.png"},
        { name: "Жигули",ic_marka:"../../assets/img/icon-BMW.png"},
        { name: "Жигули",ic_marka:"../../assets/img/icon-BMW.png"},
        { name: "Жигули",ic_marka:"../../assets/img/icon-BMW.png"},
        { name: "Жигули",ic_marka:"../../assets/img/icon-BMW.png"},
        { name: "Жигули",ic_marka:"../../assets/img/icon-BMW.png"},
        { name: "Жигули",ic_marka:"../../assets/img/icon-BMW.png"},
        { name: "Жигули",ic_marka:"../../assets/img/icon-BMW.png"}

    ];

    var model = [
        { name: "Focus"},
        { name: "Mercedes-Benz G"},
        { name: "Ваз-2015"},
        { name: "410H"}
    ];

    var engine = [
        { name: "Бензин"},
        { name: "Электродвигатель"},
        { name: "Дизель"}
    ];

    var type_service = [
        { name: "Замена масла"},
        { name: "Замена шин"},
        { name: "Замена магнитолы"}
    ];

    var transmission = [
        { name: "Механическая"},
        { name: "Автомат"},
        { name: "Полуавтомат"}
    ];
    var wishes_spare = [
        { name: "Только оригинальные"},
        { name: "Неоригинальные"},
        { name: "Всё равно"}
    ];
    var category = [
        { name: "Услуги"},
        { name: "Неуслуги"},
        { name: "Что-то ещё"}
    ];
    var type_of_service = [
        { name: "Диагностика кондиционера"},
        { name: "Диагностика мотора"},
        { name: "Диагностика шин"}
    ];

    var anoteher_templates = [
        { name: "Другой шаблон"},
        { name: "Другой шаблон"},
        { name: "Другой шаблон"}
    ];



    /*Вызов модального окна для селектов*/

    //Открытие модального окна и подстановка содежимого в зависимости от окна
    $(".js-modal").on("click",function(){
        $(this).parents(".main-conteiner").hide();
        $(".wrap-pop-up").show();
        $(this).find("input").addClass("active-item-m");

        if($(this).find("input").hasClass("marka")){
            $(".wrap-pop-up .header-inner-center h1").text(title.title_marka);
            $("#clientTemplate-2").tmpl(marka).appendTo(".main-content-brand .wrapper-services-modal" );
        }

        if($(this).find("input").hasClass("model")){
            $(".wrap-pop-up .header-inner-center h1").text(title.title_model);
            $("#clientTemplate").tmpl(model).appendTo(".main-content-brand .wrapper-services-modal" );
        }

        /*А это статичная инфа о годах, её не убирать*/
        if($(this).find("input").hasClass("year")){
            $(".wrap-pop-up .header-inner-center h1").text(title.title_year);
            for ( i = year; i > year-50; i--) {
                $('<li class="modal-active-item js-name-brand item-service text-center">'
                +'<span class="modal-name-service margin-auto">'+i+'</span>'+'</li>').appendTo(".main-content-brand .wrapper-services-modal")
            }
        }
        if($(this).find("input").hasClass("weekend")){
            $(".wrap-pop-up .header-inner-center h1").text(title.title_weekend);
            $(".wrap-pop-up").addClass("active-modal");
            $('<li class="modal-active-item js-name-brand item-service text-center">'
            +'<span class="modal-name-service margin-auto">Да</span>'+'</li>'+'<li class="modal-active-item js-name-brand item-service text-center">'
            +'<span class="modal-name-service margin-auto">Нет</span>'+'</li>').appendTo(".main-content-brand .wrapper-services-modal")

        }

        if($(this).find("input").hasClass("engine")){
            $(".wrap-pop-up .header-inner-center h1").text(title.title_engine);
            $(".wrap-pop-up").addClass("active-modal");
            $("#clientTemplate").tmpl(engine).appendTo(".main-content-brand .wrapper-services-modal" );
        }

        if($(this).find("input").hasClass("transmission")){
            $(".wrap-pop-up .header-inner-center h1").text(title.title_transmission);
            $(".wrap-pop-up").addClass("active-modal");
            $("#clientTemplate").tmpl(transmission).appendTo(".main-content-brand .wrapper-services-modal" );
        }

        if($(this).find("input").hasClass("type-of-service")){
            $(".wrap-pop-up .header-inner-center h1").text(title.title_kind_service);
            $("#clientTemplate").tmpl(type_service).appendTo(".main-content-brand .wrapper-services-modal" );
        }

        if($(this).find("input").hasClass("wishes-spare")){
            $(".wrap-pop-up .header-inner-center h1").text(title.title_wishes_spare);
            $(".wrap-pop-up").addClass("active-modal");
            $("#clientTemplate").tmpl(wishes_spare).appendTo(".main-content-brand .wrapper-services-modal" );
        }

        if($(this).find("input").hasClass("category")){
            $(".wrap-pop-up .header-inner-center h1").text(title.title_category);
            $("#clientTemplate").tmpl(category).appendTo(".main-content-brand .wrapper-services-modal" );
        }

        if($(this).hasClass("select-another-template")){
            $(".wrap-pop-up .header-inner-center h1").text(title.title_templates);
            $(".wrap-pop-up").addClass("active-modal");
            $("#clientTemplate").tmpl(anoteher_templates).appendTo(".main-content-brand .wrapper-services-modal" );
        }

        ret()

    });
    //Закрытие модального окна при нажатии на крестик
    $(".close-icom").on("click",function(){
        $(this).parents(".wrap-pop-up").hide();
        $(this).parents(".wrap-pop-up").siblings(".main-conteiner").show();
        $(this).parents(".wrap-pop-up").find(".wrapper-services-modal").html("");
        $(".js-modal").find("input").removeClass("active-item-m");
        $(".wrap-pop-up").removeClass("active-modal");
    });

    //Функция при клике на пункт окна, записываем в переменную, подставляем в поле и закрываем окно
    function ret(){

        $(".modal-active-item").on("click",function(){
            $(this).removeClass("active-item-modal");
            $(this).find(".modal-name-service").addClass("active-item-modal");
            var tex = $(this).find(".modal-name-service").text();
            $(this).parents(".wrap-pop-up").hide();
            $(this).parents(".wrap-pop-up").siblings(".main-conteiner").show();
            $(this).parents(".wrap-pop-up").find(".wrapper-services-modal").html("");

            $(".active-item-m").val(tex);
            $(".js-modal").find("input").removeClass("active-item-m");
            tex = "";


            $(".wrap-pop-up").removeClass("active-modal");
        })
    }


    //Закрываю банер
    $(".banner-card-close").on("click",function(){
        $(this).parents(".banner-card").hide()
    });


    //Убираю класс у футера

    //$(window).scroll(function(){
    //    $("footer").removeClass("footer-abs")
    //});



    //Резиновый textarea
    var textarea= $('#textarea');

    textarea.height(textarea.get(0).scrollHeight);

    textarea.on('keyup input', function(){
        var $this = $(this);
        $this.height(1);
        $this.height(this.scrollHeight);
    });


});


