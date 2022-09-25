{!! Form::open(['id' => 'formEdit']) !!}
    @include('pages.cart.form')
    <div class="d-flex justify-content-between mt-3">
        <button type="button" class="btn btn-secondary" onclick="bootbox.hideAll()">Batal</button>
        <button type="button" class="btn btn-primary" onclick="update({{ $model['kamar'] }})">Ubah</button>
    </div>
{!! Form::close() !!}