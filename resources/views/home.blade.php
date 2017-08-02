@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ action('PostsController@create') }}" role="form">
        {!! csrf_field() !!}
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="form-group">
                    <label for="email-address">Title</label>
                    <input class="form-control" id="title" name="title" placeholder="Enter title">
                </div>
                <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=faf4cupi28jhg6piozwmpbjbk97n1dq1jroc6v3w2d2ekkky"></script>
                <script>
                    tinymce.init({
                        selector: '#editor',
                        plugins: 'image code emoticons spellchecker',
                        toolbar: 'undo redo | link image | code | emoticons | spellchecker',
                        // enable title field in the Image dialog
                        image_title: true,
                        // enable automatic uploads of images represented by blob or data URIs
                        automatic_uploads: true,
                        // URL of our upload handler (for more details check: https://www.tinymce.com/docs/configure/file-image-upload/#images_upload_url)
                        images_upload_url: 'postAcceptor.php',
                        // here we add custom filepicker only to Image dialog
                        file_picker_types: 'image',
                        // and here's our custom image picker
                        file_picker_callback: function(cb, value, meta) {
                            var input = document.createElement('input');
                            input.setAttribute('type', 'file');
                            input.setAttribute('accept', 'image/*');

                            // Note: In modern browsers input[type="file"] is functional without
                            // even adding it to the DOM, but that might not be the case in some older
                            // or quirky browsers like IE, so you might want to add it to the DOM
                            // just in case, and visually hide it. And do not forget do remove it
                            // once you do not need it anymore.

                            input.onchange = function() {
                                var file = this.files[0];

                                var reader = new FileReader();
                                reader.readAsDataURL(file);
                                reader.onload = function () {
                                    // Note: Now we need to register the blob in TinyMCEs image blob
                                    // registry. In the next release this part hopefully won't be
                                    // necessary, as we are looking to handle it internally.
                                    var id = 'blobid' + (new Date()).getTime();
                                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                                    var base64 = reader.result.split(',')[1];
                                    var blobInfo = blobCache.create(id, file, base64);
                                    blobCache.add(blobInfo);

                                    // call the callback and populate the Title field with the file name
                                    cb(blobInfo.blobUri(), { title: file.name });
                                };
                            };

                            input.click();
                        }
                    });
                </script>
                <textarea class="form-control" id="editor" name="body"></textarea>

                <div style="float: right; margin-top: 20px;">
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
