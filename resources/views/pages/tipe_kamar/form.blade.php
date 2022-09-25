<div class="form-group">
    @if(isset($model))
        {!! Form::hidden('_method', 'PUT') !!}
    @endif
    <label for="name">Nama Tipe Kamar</label>
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
</div>