{!! Form::model($model, ['id' => 'formEdit']) !!}
    @include('pages.tipe_kamar.form')
    <div class="text-right">
        <button type="button" class="btn btn-secondary btn-sm" onclick="bootbox.hideAll()">Batal</button>
        <button type="button" class="btn btn-primary btn-sm" onclick="update({{ $model->id }})">Ubah</button>
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