<div class="mb-3 text-center">
    @if(isset($model))
        <img id="image" src="{{ asset('storage/'.$model->picture) }}" class="w-75 rounded" alt="">
    @else
        <img id="image" src="" class="w-75 rounded" alt="">
    @endif
</div>
<div class="form-group">
    <label for="browse_gambar">Pilih Gambar</label>
    <div class="custom-file mb-3">
        <input name="picture" type="file" class="custom-file-input" id="browse_gambar" onchange="showPreview(event)" required>
        <label class="custom-file-label" for="browse_gambar">Pilih...</label>
    </div>
</div>
<div class="form-group">
    <label for="name">Nama Fasilitas</label>
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
</div>
<div class="form-group">
    <label for="tipe">Keterangan</label>
    {!! Form::textarea('desc', null, ['class' => 'form-control', 'id' => 'desc', 'rows' => '5']) !!}
</div>