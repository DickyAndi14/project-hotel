{!! Form::model($model, ['id' => 'formShow']) !!}
    <hr>
        <h5 class="mb-3">Kamar</h5>
    <hr>
    <div class="mb-3 text-center">
        <img id="image-kamar" src="{{ asset('storage/'.$model->kamar->banner) }}" class="w-75 rounded" alt="">
    </div>
    <div class="row">
        <div class="col-md-3">
            <h6>Tipe Kamar :</h6>
        </div>
        <div class="col-md-9">
            <p>{{ $model->kamar->tipe }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <h6>Jumlah :</h6>
        </div>
        <div class="col-md-9">
            <p>{{ $model->kamar->jumlah }}</p>
        </div>
    </div>
    <hr>
        <h5 class="mb-3">Fasilitas</h5>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <h6>Nama Fasilitas :</h6>
        </div>
        <div class="col-md-8">
            <p>{{ $model->fasilitas->name }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h6>Deskripsi :</h6>
        </div>
        <div class="col-md-8">
            <p>{{ $model->fasilitas->desc }}</p>
        </div>
    </div>
    <div class="mb-3 text-center">
        <img id="image-fasilitas" src="{{ asset('storage/'.$model->fasilitas->picture) }}" class="w-75 rounded" alt="">
    </div>
    <div class="text-right">
        <button type="button" class="btn btn-secondary btn-sm" onclick="bootbox.hideAll()">Batal</button>
    </div>
{!! Form::close() !!}