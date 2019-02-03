var lazypipe = require('lazypipe');
var sass = require('gulp-sass');
var gulpIf = require('gulp-if');

function isSCSSFile(file) {
    return (function (str, suffix) {
        return str.indexOf(suffix, str.length - suffix.length) !== -1;
    })(file.relative, 'scss');
}

var CSSTransform = lazypipe().pipe(function () {
    return gulpIf(isSCSSFile, sass());
});

module.exports = {
    bundle: {
        app: {
            scripts: [
               './background/assets/js/app/common/custom.js',
                
            ],
            styles: [
                './background/assets/css/app/main.scss',
            ],
            options: {
                transforms: {
                    styles: CSSTransform
                },
                rev: false,
                maps: false,
                uglify: true
            }
        },
        vendor: {
            scripts: [
                './node_modules/jquery/dist/jquery.min.js',
                './node_modules/popper.js/dist/umd/popper.min.js',
                './node_modules/bootstrap/dist/js/bootstrap.min.js',
                './node_modules/wowjs/dist/wow.min.js', 

            ],
            styles: [
                './node_modules/bootstrap/dist/css/bootstrap.min.css',
                './node_modules/font-awesome/css/font-awesome.min.css',
            ],
            options: {
                transforms: {
                    styles: CSSTransform // pipe(s) of style transforms
                },
                rev: false,
                maps: false,
                uglify: false
            }
        }  
    }
};
