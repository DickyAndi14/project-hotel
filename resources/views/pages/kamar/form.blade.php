<div class="mb-3 text-center">
    @if(isset($model))
        <img id="image" src="{{ asset('storage/'.$model->banner) }}" class="w-75 rounded" alt="">
    @else
        <img id="image" src="" class="w-75 rounded" alt="">
    @endif
</div>
<div class="form-group">
    <label for="tipe">Pilih Gambar</label>
    <div class="custom-file mb-3">
        <input name="banner" type="file" class="custom-file-input" id="browse_gambar" onchange="showPreview(event)" required>
        <label class="custom-file-label" for="browse_gambar">Pilih...</label>
    </div>
</div>
<div class="form-group">
    <label for="name">Nama</label>
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
</div>
<div class="form-group">
    <label for="tipe">Tipe Kamar</label>
    {!! Form::select('tipe_kamar_id', ['' => 'Pilih']+App\Models\TipeKamar::pluck('name', 'id')->toArray(),null, ['class' => 'form-control', 'id' => 'tipe_kamar']) !!}
</div>
<div class="form-group">
    <label for="tipe">Jumlah</label>
    {!! Form::number('jumlah', null, ['class' => 'form-control', 'id' => 'jumlah']) !!}
</div>