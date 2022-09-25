<div class="row">
    @if($model['kamar'])
        {!! Form::hidden('_method', 'PUT'); !!}
    @endif
    <div class="col-md-6">
        <div class="form-group">
            <label for="check-in" class="fw-bold mb-2">Check In </label>
            {!! Form::text('checkin', $model['checkin'] ?? null, ['class' => 'form-control', 'id' => 'check-in']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="check-out" class="fw-bold mb-2">Check Out </label>
            {!! Form::text('checkout', $model['checkout'] ?? null, ['class' => 'form-control', 'id' => 'check-out']) !!}
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-4">
        <div class="form-group">
            <label for="jumlah" class="fw-bold mb-2">Jumlah</label>
            {!! Form::number('jumlah', $model['nama_tamu'] ? $model['jumlah'] : null, ['class' => 'form-control', 'id' => 'jumlah', 'min' => '0']) !!}
        </div>
    </div>
    @if(!$model['kamar'])
        <div class="col-md-8">
            <div class="form-group">
                <label for="kamar" class="fw-bold mb-2">Kamar </label>
                {!! Form::hidden('kamar_id', $model->id ?? null) !!}
                {!! Form::text('kamar', $model->name ?? null, ['class' => 'form-control', 'id' => 'kamar', 'disabled']) !!}
            </div>
        </div>
    @else
    <div class="col-md-8">
        <div class="form-group">
            <label for="kamar" class="fw-bold mb-2">Kamar </label>
            {!! Form::hidden('kamar_id', $model['kamar']) !!}
            {!! Form::text('kamar', $model['nama_kamar'], ['class' => 'form-control', 'id' => 'kamar', 'disabled']) !!}
        </div>
    </div>
    @endif
</div>
<div class="row mt-4">
    <div class="col-md-4">
        <div class="form-group">
            <label for="pemesan" class="fw-bold mb-2">Nama Pemesan</label>
            {!! Form::hidden('user_id',auth()->user()->id ?? null, ['class' => 'form-control', 'id' => 'user_id', 'readonly']) !!}
            {!! Form::text('pemesan',auth()->user()->name ?? null, ['class' => 'form-control', 'id' => 'pemesan', 'readonly']) !!}
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label for="email" class="fw-bold mb-2">Email</label>
            {!! Form::text('email', auth()->user()->email ?? null, ['class' => 'form-control', 'id' => 'email', 'readonly']) !!}
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-4">
        <div class="form-group">
            <label for="guest" class="fw-bold mb-2">Nama Tamu</label>
            {!! Form::text('nama_tamu', $model['nama_tamu'] ?? null, ['class' => 'form-control', 'id' => 'guest']) !!}
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label for="no_hp" class="fw-bold mb-2">No Hp</label>
            {!! Form::number('no_hp', $model['no_hp'] ?? null, ['class' => 'form-control', 'id' => 'no_hp']) !!}
        </div>
    </div>
</div>