//Калькулятор

var calc1 = ['#kvz', '#koz', '#ppz', '#dso', '#pdd', '#pdm'];
$(calc1[0]).val('300');  //здесь мы вписываем значения, которые будут при открытии странички
$(calc1[1]).val('100');
$(calc1[2]).val('27');
$(calc1[3]).val('5000');
$(calc1[4]).val('12500');
var calc = {};
getCalc();

$(calc1.join(', ')).keydown(function(e) {   //Это часть для чего-то нужна, а для чего не понятно, её удаление ни к чему не привело
    // backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
            // home, end, left, right, down, up
        (e.keyCode >= 35 && e.keyCode <= 40)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});

$(calc1.join(', ')).keyup(function(e) {
    getCalc();
});

function getCalc() {   //Здесь мы буквы превращаем в цифры

    if ($(calc1[0]).val()) {
        calc.kvz = parseInt($(calc1[0]).val());
    }
    else {
        calc.kvz = 1;
        $(calc1[0]).val('');
    }

    if ($(calc1[1]).val()) {
        calc.koz = parseInt($(calc1[1]).val());
    }
    else {
        calc.koz = 0;
        $(calc1[1]).val('');
    }

    if ($(calc1[2]).val()) {
        calc.ppz = parseInt($(calc1[2]).val());
    }
    else {
        calc.ppz = 0;
        $(calc1[2]).val('');
    }

    if ($(calc1[3]).val()) {
        calc.dso = parseInt($(calc1[3]).val());
    }
    else {
        calc.dso = 0;
        $(calc1[3]).val('');
    }
                //Здесь мы формируем переменные матеиатическими действиями
    calc.konv = (calc.koz / calc.kvz).toFixed(3); //toFixed это округление
    calc.kpz = (calc.kvz / (100 - calc.ppz) * calc.ppz).toFixed(3);
    calc.kpk = (calc.kpz * calc.konv).toFixed(2);
    calc.pdd = (calc.dso * calc.kpk).toFixed(0);
    calc.pdm = (calc.pdd * 12).toFixed(0); //Итоговая переменная
    $(calc1[4]).val((calc.pdd).toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 '));//Служит для представления результата в виде строки.Если не будет этой записи не будет автоматического вычисления вычисления
    $(calc1[5]).val((calc.pdm).toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 '));
}
//Самое простое вычмсление - сложение 2 первых столбцов и деление на третий
calc.konv = ((calc.koz + calc.kvz)/calc.ppz); //в переменную мы записали мат.действие
calc.pdm = (calc.konv).toFixed(0);//а сюда куда мы помещаем результат действия

$(calc1[5]).val((calc.pdm).toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 '));