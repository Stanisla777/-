/**
 * Created by King on 19.08.2018.
 */

const gulp = require('gulp');
const autoprefixer = require('gulp-autoprefixer');
const browserSync = require('browser-sync'); // Подключаем Browser Sync
const rigger = require('gulp-rigger');//подключение содержимого файлов в другие файлы
const sourcemaps = require('gulp-sourcemaps');
const gcmq = require('gulp-group-css-media-queries');//собирает медиа-запросы в один.Работает только в паре с preproc
const cleanCSS = require('gulp-clean-css');//сжимает css
const preproc = require('gulp-less');//преобразует less в css



const config = {
    src: './src',
    app:'/app',
    css: {
        css:'/app/css',
        watch:'/app/css/*.less',
        src: '/app/css/style.less',
        img: '/app/img',
        dist: '/dist/css'
    },
    html: {
        src: '/app/*.html',
        src_dist: '/dist'


    }
};


//любые изменение в файле отображаются в браузере, при этом запускается задача build со всем её содержимым

//перемещение из одной папки в другую css файлов
gulp.task('build-css', function () {
    gulp.src(config.src+config.css.src)//выборка файлов по конкретному пути

        .pipe(gulp.dest(config.src+config.css.dist))//вывод результирующего файла в папку назначения (dest — пункт назначения)

        .pipe(browserSync.reload({//пайпим перезагрузку
            stream:true
        }));
});

//перемещение из одной папки в другую html файлов
gulp.task('build-html', function () {
    gulp.src(config.src+config.html.src)//выборка файлов по конкретному пути

    //.pipe(gulp.dest(config.src+config.html.src_dist)) //вывод результирующего файла в папку назначения (dest — пункт назначения)

        .pipe(browserSync.reload({//пайпим перезагрузку
            stream:true
        }));
});




//приводит в порядок медиа-запросы
// собирает одинаковые в один, помещает все в конец css, расставляет по порядку
gulp.task('gcmq', function () {
    gulp.src(config.src+config.css.src)//выборка файлов по конкретному пути
        .pipe(preproc())
        .pipe(gcmq())
        .pipe(gulp.dest(config.src+config.css.dist));//вывод результирующего файла в папку назначения (dest — пункт назначения)
});

//преобразование less в css
gulp.task('preprop', function () {
    gulp.src(config.src+config.css.src)//выборка файлов по конкретному пути
        .pipe(preproc())
        .pipe(gulp.dest(config.src+config.css.css))//вывод результирующего файла в папку назначения (dest — пункт назначения)
        .pipe(browserSync.reload({//пайпим перезагрузку
            stream:true
        }));
});



////////////////////////////////////////////////////////////////////////////////////////////////////

//копирование содержания рабочей папки в конечную
gulp.task('build-all', function () {
    gulp.src('./src/app/**/*')//выборка файлов по конкретному пути

    //.pipe(gulp.dest('./src/dist')); //вывод результирующего файла в папку назначения (dest — пункт назначения)
        .pipe(gulp.dest(config.src+config.html.src_dist)); //вывод результирующего файла в папку назначения (dest — пункт назначения)

});


////////////////////////////////////////////////////////



//Автопрефиксы
gulp.task('autoprefixer', function () {
    gulp.src('./src/app/css/**/style.css')//выборка файлов по конкретному пути

    //даем префиксы стилям
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))

        .pipe(gulp.dest('./src/dist/css')); //вывод результирующего файла в папку назначения (dest — пункт назначения)

});



//Наблюдение за изменениями в файлах по отдельности и вызов задачи build
gulp.task('watch',function(){
    gulp.watch(config.src+config.css.src,['preprop']);
    //gulp.watch(config.src+config.html.src,['build-html']);
});

//Наблюдение за изменениями во всём проекте и вызов задачи build
gulp.task('watch-all',function(){
    gulp.watch(config.src+config.app+'/**/*',['build','build-html']);
});



////////////////////////////////////////-----АВТОМАТИЧЕСКОЕ ОБНОВЛЕНИЕ СТРАНИЦ ПРИ ИЗМЕНЕНИИ-----//////////////////////////////////////////////



//создание сервера для подключения
//обновление файла в конечной дериктории, не в которой работаем
gulp.task('browserSync', function() {
    browserSync.init({
        server: {
            baseDir: config.src+config.app //корень поднимаего сервера, тоесть корневая папка, где лежит файл index.html
        }
    });
});



//////////////////////////////////////////////////////////////////////////////////////////////////


//перезагрузка и перемещение  при изменении файлов по отдельности. ЗАПУСКАТЬ этот ТАСК этот наверное предпочтительней

gulp.task('watch-reload',['browserSync'],function(){
    gulp.watch(config.src+config.css.watch,['preprop']);
    gulp.watch(config.src+config.html.src,['build-html']);
});


//перезагрузка при изменении любого файла из проекта ЗАПУСКАТЬ этот ТАСК
gulp.task('watch-reload-all',['browserSync'],function(){
    //gulp.watch('./src/app/**/*',['reload-all']);
    gulp.watch(config.src+config.app+'/**/*',['preprop','build-html']);
});






//перезагрузка  отдельных файлов в которых идет верста без перемещения в конечную дерективу

gulp.task('reload', function () {
    gulp.src('./src/app/css/*.css')//выборка файлов по конкретному пути
        .pipe(browserSync.reload({//пайпим перезагрузку
            stream:true
        }));
    gulp.src('./src/app/*.html')//выборка файлов по конкретному пути
        .pipe(browserSync.reload({//пайпим перезагрузку
            stream:true
        }));
});

//перезагрузка всех файлов в которых идет верста без перемещения в конечную дерективу

gulp.task('reload-all', function () {
    gulp.src(config.src+config.app+'/**/*')//выборка файлов по конкретному пути
        .pipe(browserSync.reload({//пайпим перезагрузку
            stream:true
        }));

});




//подключение содержимого файлов в другие файлы
gulp.task('rigger-task', function () {
    gulp.src('./src/app/*.html') //Выберем файлы по нужному пути
        .pipe(rigger()) //Прогоним через rigger
        .pipe(gulp.dest('./src/dist')); //Выплюнем их в папку build

});


