function CountdownTimer(elm,tl,mes){
    this.initialize.apply(this,arguments);
}
CountdownTimer.prototype={
    initialize:function(elm,tl,mes) {
        this.elem = document.getElementById(elm);
        this.tl = tl;
        this.mes = mes;
    },countDown:function(){
        var timer='';
        var today=new Date();
        var day=Math.floor((this.tl-today)/(24*60*60*1000));
        var hour=Math.floor(((this.tl-today)%(24*60*60*1000))/(60*60*1000));
        var min=Math.floor(((this.tl-today)%(24*60*60*1000))/(60*1000))%60;
        var sec=Math.floor(((this.tl-today)%(24*60*60*1000))/1000)%60%60;
        var me=this;

        if( ( this.tl - today ) > 0 ){
//                timer += '<span class="number-wrapper"><div class="line"></div><span class="number day">'+day+'</span><div class="caption">DAYS</div></span>';
//                timer += '<span class="number-wrapper"><div class="line"></div><span class="number hour">'+hour+'</span><div class="caption">HOURS</div></span>';
//                timer += '<span class="number-wrapper"><div class="line"></div><div class="caption">MINS</div><span class="number min">'+this.addZero(min)+'</span></span><span class="number-wrapper"><div class="line"></div><div class="caption">SECS</div><span class="number sec">'+this.addZero(sec)+'</span></span>';


            //Когда у нас все цифры и разделители находятся на равном удалении друг от друга.
            // Здесь <div class="line"> это у нас невложенный элемент в контейнер .number-wrapper. Вид разделителя прописывается тут

//                timer += '<span class="number-wrapper">' +
//                '<span class="number day">'+day+'</span></span><div class="line">:</div>';
//                timer += '<span class="number-wrapper"><span class="number hour">'+hour+'</span></span><div class="line">:</div>';
//                timer += '<span class="number-wrapper"><span class="number min">'+this.addZero(min)+'</span></span><div class="line">:</div><span class="number-wrapper"><span class="number sec">'+this.addZero(sec)+'</span></span>';

            //Если у нас разделитель находится возле цифры, поменял расположение <div class="line"> и теперь он находится внутри .number-wrapper

//                timer += '<span class="number-wrapper">' +
//                '<span class="number day">'+day+'</span><div class="line">д.</div></span>';
//                timer += '<span class="number-wrapper"><span class="number hour">'+hour+'</span></span><div class="line">:</div>';
//                timer += '<span class="number-wrapper"><span class="number min">'+this.addZero(min)+'</span></span><div class="line">:</div><span class="number-wrapper"><span class="number sec">'+this.addZero(sec)+'</span></span>';



            //Разделиитель задается в объекте, настройки, которого ниже
            //timer += '<span class="number-wrapper">' +
            //'<span class="number day">'+day+'</span></span><div class="line">'+obj.delimiter+'</div>';
            //timer += '<span class="number-wrapper"><span class="number hour">'+hour+'</span></span><div class="line">'+obj.delimiter+'</div>';
            //timer += '<span class="number-wrapper"><span class="number min">'+this.addZero(min)+'</span></span><div class="line">'+obj.delimiter+'</div><span class="number-wrapper"><span class="number sec">'+this.addZero(sec)+'</span></span>';


                timer += '<span class="number-wrapper">' +
                '<span class="number day">'+day+'</span></span><div class="line">'+obj.delimiter+'</div>';
                timer += '<span class="number-wrapper"><span class="number hour">'+hour+'</span></span><div class="line">'+obj.delimiter+'</div>';
                timer += '<span class="number-wrapper"><span class="number min">'+this.addZero(min)+'</span></span><div class="line">'+obj.delimiter+'</div><span class="number-wrapper"><span class="number sec">'+this.addZero(sec)+'</span></span>';


            this.elem.innerHTML = timer;
            tid = setTimeout( function(){me.countDown();},10 );
        }else{
            this.elem.innerHTML = this.mes;
            return;
        }
    },addZero:function(num){ return ('0'+num).slice(-2); }
};



function CDT(year,month,day,hour,minutes,seconds,container){

    var e = +year+'/'+month+'/'+day +' '+ hour+':'+ minutes+':'+seconds;
    var tl = new Date(e);

    var timer = new CountdownTimer(container,tl,'<span class="number-wrapper"><div class="line"></div><span class="number end">Time is up!</span></span>');

    timer.countDown();
}

//Объявляю переменную с новым таймером. В container указываетcя id таймера

var obj = {
    year: '2018',
    month: '08',
    day:'21',
    hour:'18',
    minutes:'00',
    seconds:'00',
    delimiter:':',
    container:'CDT',
    method:CDT
};

obj.method(obj.year,obj.month,obj.day,obj.hour,obj.minutes,obj.seconds,obj.container);//передаю в функцию CDT параметры

var obj_2 = {
    year: '2018',
    month: '05',
    day:'21',
    hour:'18',
    minutes:'00',
    seconds:'00',
    delimiter:'+',
    container:'PDT',
    method:CDT
};

obj_2.method(obj_2.year,obj_2.month,obj_2.day,obj_2.hour,obj_2.minutes,obj_2.seconds,obj_2.container);


if('hour' in obj ==false){
    obj.hour = '00';
}
if('minutes' in obj ==false){
    obj.minutes = '00';
}
if('seconds' in obj ==false){
    obj.seconds = '00';
}

