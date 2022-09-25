{!! Form::open(['id' => 'formCreate', 'enctype' => 'multipart/form-data']) !!}
    @include('pages.kamar.form')
    <div class="text-right">
        <button type="button" class="btn btn-secondary btn-sm" onclick="bootbox.hideAll()">Batal</button>
        <button type="button" class="btn btn-primary btn-sm" onclick="store()">Tambah</button>
    </div>
    <script>
        function showPreview(event){
            if(event.target.files.length > 0){
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result);
                };
                $('browse_gambar').attr('value', event.target.files);
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
{!! Form::close() !!}