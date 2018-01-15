module.exports = {
    paths: {
        src: {
    		html: 'app/resources/assets/html/**/*',
    		font: 'app/resources/assets/fonts/**/*',
    		sass: 'app/resources/assets/scss/**/*.scss',
    		js: 'app/resources/assets/js/**/*.js',
    		image: 'app/resources/assets/images/**/*'
    	},
    	dest: {
    		html: 'app/resources/views/',
    		font: 'public/fonts/',
    		sass: 'public/css/',
    		js: 'public/js/',
    		image: 'public/images/',
    		beauty: {
    		  sass: 'public/css/beauty/'
    		}
    	}
    }
};