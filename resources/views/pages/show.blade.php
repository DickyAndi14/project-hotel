<h3 class="mb-3 mt-3">{{ $model->name }}</h3>

<div class="mb-3 text-center">
    <img id="image-kamar" src="{{ asset('storage/'.$model->banner) }}" class="w-75 rounded" alt="">
</div>
<div class="row mt-5">
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
<h5 class="mb-3 mt-3">Fasilitas</h5>
<div class="row flex-wrap mb-5">
    @if($model->fasilitases)
        @foreach($model->fasilitases as $key => $value)
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                <img src="{{ asset('storage/'.$value->fasilitas->picture) }}" height="200" class="card-img-top img-stretch-cover" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $value->fasilitas->name }}</h5>
                        <p class="card-text">{{ $value->fasilitas->desc }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

<div class="text-right">
    <button type="button" class="btn btn-secondary" onclick="bootbox.hideAll()">Batal</button>
</div>