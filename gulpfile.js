var gulp = require('gulp');
var $ = require('gulp-load-plugins')(),
  browserSync = require('browser-sync'),
  autoprefixer = require('autoprefixer');
var minimist = require('minimist'); // 用來讀取指令轉成變數
var gulpSequence = require('gulp-sequence').use(gulp);

// production || development
// # gulp --env production
var envOptions = {
  string: 'env',
  default: { env: 'development' }
};
var options = minimist(process.argv.slice(2), envOptions);

gulp.task('clean', function() {
  return gulp.src(['./2017', './.tmp'], { read: false }) // 選項讀取：false阻止gulp讀取文件的內容，使此任務更快。
    .pipe($.clean());
  cb(err)
});

// gulp.task('jade', function(){
//   return gulp.src(['./source_17/**/*.jade'])
//     .pipe($.plumber())
//     // .pipe($.data(function(file) {
//     //   var json = require('./source_17/data/data.json');
//     //   var data = Object.assign({}, json);
//     //   return data;
//     // }))
//     .pipe($.jade({ pretty: true }))
//     .pipe(gulp.dest('./2017'))
//     .pipe(browserSync.reload({
//       stream: true
//     }));
// });

gulp.task('babel', function() {
  return gulp.src(['./source_17/javascripts/**/*.js'])
    .pipe($.plumber())
    .pipe($.sourcemaps.init())
    .pipe($.concat('all.js'))
    .pipe($.babel({
      presets: ['es2015']
    }))
    .pipe(
      $.if(options.env === 'production', $.uglify({
        compress: {
          drop_console: true
        }
      }))
    )
    .pipe($.sourcemaps.write('.'))
    .pipe(gulp.dest('./2017/javascripts'))
    .pipe(browserSync.reload({
      stream: true
    }));;
});

gulp.task('vendorJs', function () {
  return gulp.src(['node_modules/jquery/dist/jquery.js', 'node_modules/bootstrap/dist/js/bootstrap.js', 'node_modules/owl.carousel/dist/owl.carousel.min.js'])
    .pipe($.concat('vendor.js'))
    .pipe($.if(options.env === 'production', $.uglify()))
    .pipe(gulp.dest('./2017/javascripts'))
})

gulp.task('sass', function() {
  // PostCSS AutoPrefixer
  var processors = [
    autoprefixer({
      browsers: ['last 5 version'],
    })
  ];

  return gulp.src(['./source_17/stylesheets/**/*.sass', './source_17/stylesheets/**/*.scss'])
    .pipe($.plumber())
    .pipe($.sourcemaps.init())
    .pipe($.sass({
      outputStyle: 'nested',
      includePaths: ['./node_modules/bootstrap/dist/scss']
    }).on('error', $.sass.logError))
    .pipe($.postcss(processors))
    .pipe($.if(options.env === 'production', $.minifyCss())) // 假設開發環境則壓縮 CSS
    .pipe($.sourcemaps.write('.'))
    .pipe(gulp.dest('./2017/stylesheets'))
});

gulp.task('plugin', function() {
  gulp.src('./node_modules/owl.carousel/dist/assets/*.min.css')
    .pipe(gulp.dest('./2017/plugin/'));

});

gulp.task('fonts', function() {
  gulp.src('./source_17/fonts/**/*')
    .pipe(gulp.dest('./2017/fonts/'));

});

gulp.task('imageMin', function() {
  gulp.src('./source_17/images/*')
    .pipe($.if(options.env === 'production', $.imagemin()))
    .pipe(gulp.dest('./2017/images'));
});

gulp.task('watch', function() {
  gulp.watch(['./source_17/stylesheets/**/*.sass', './source_17/stylesheets/**/*.scss'], ['sass']);
  // gulp.watch(['./source_17/**/*.jade'], ['jade']);
  gulp.watch(['./source_17/javascripts/**/*.js'], ['babel']);
});

gulp.task('sequence', gulpSequence('clean', 'sass', 'babel', 'vendorJs', 'plugin', 'fonts', 'imageMin'));

gulp.task('default', ['sass', 'babel', 'vendorJs', 'plugin', 'fonts', 'imageMin', 'watch']);
gulp.task('build', ['sequence'])
