
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


$('.summernote').summernote({
    height: 300,
    callbacks: {
        onImageUpload: function(files) {
            var editor = $(this);
            var url = editor.data('image-url');
            var data = new FormData();
            data.append('file', files[0]);
            axios
                .post(url, data).then(function(response) {
                editor.summernote('insertImage', response.data);
            })
                .catch(function (error) {
                    console.error(error);
                });
        }
    }
});
