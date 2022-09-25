{!! Form::model($model, ['id' => 'formShow']) !!}
    <div class="mb-5 text-center">
        <img id="image" src="{{ asset('storage/'.$model->banner) }}" class="w-75 rounded" alt="">
    </div>
    <div class="row">
        <div class="col-md-3">
            <h6>Nama Kamar :</h6>
        </div>
        <div class="col-md-9">
            <p>{{ $model->name }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <h6>Tipe Kamar :</h6>
        </div>
        <div class="col-md-9">
            <p>{{ $model->tipeKamar->name }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <h6>Jumlah :</h6>
        </div>
        <div class="col-md-9">
            <p>{{ $model->jumlah }}</p>
        </div>
    </div>
    <div class="text-right">
        <button type="button" class="btn btn-secondary btn-sm" onclick="bootbox.hideAll()">Batal</button>
    </div>
{!! Form::close() !!}