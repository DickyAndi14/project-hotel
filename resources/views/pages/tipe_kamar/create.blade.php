{!! Form::open(['id' => 'formCreate']) !!}
    @include('pages.tipe_kamar.form')
    <div class="text-right">
        <button type="button" class="btn btn-secondary btn-sm" onclick="bootbox.hideAll()">Batal</button>
        <button type="button" class="btn btn-primary btn-sm" onclick="store()">Tambah</button>
    </div>
{!! Form::close() !!}