{!! Form::model($model, ['id' => 'formEdit']) !!}
    @include('pages.fasilitas_kamar.form')
    <div class="text-right">
        <button type="button" class="btn btn-secondary btn-sm" onclick="bootbox.hideAll()">Batal</button>
        <button type="button" class="btn btn-primary btn-sm" onclick="update({{ $model->id }})">Ubah</button>
    </div>
{!! Form::close() !!}