<div class="form-group">
    <label for="kamar_id">Tipe Kamar</label>
    @if(isset($model))
        {!! Form::hidden('_method', 'PUT') !!}
    @endif
    {!! Form::select('kamar_id', ['' => 'Pilih']+App\Models\Kamar::pluck('name', 'id')->toArray(), null, ['class' => 'form-control', 'id' => 'kamar_id']) !!}
</div>
<div class="form-group">
    <label for="tipe">Fasilitas</label>
    {!! Form::select('fasilitas_id', ['' => 'Pilih']+App\Models\Fasilitas::pluck('name', 'id')->toArray(), null, ['class' => 'form-control', 'id' => 'fasilitas_id']) !!}
</div>