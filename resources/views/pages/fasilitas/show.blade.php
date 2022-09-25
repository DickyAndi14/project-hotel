{!! Form::model($model, ['id' => 'formShow']) !!}
    <div class="mb-3 text-center">
        <img id="image" src="{{ asset('storage/'.$model->picture) }}" class="w-75 rounded" alt="">
    </div>
    <div class="container">
        <div class="row">
            <h6>Nama Fasilitas</h6>
        </div>
        <div class="row">
            <p>{{ $model->name }}</p>
        </div>
        <div class="row">
            <h6>Deskripsi</h6>
        </div>
        <div class="row">
            <p>{{ $model->desc }}</p>
        </div>
    </div>
    <div class="text-right">
        <button type="button" class="btn btn-secondary btn-sm" onclick="bootbox.hideAll()">Batal</button>
    </div>
{!! Form::close() !!}