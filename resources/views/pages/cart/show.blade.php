<div class="row">
    <div class="col-md-4">
        <p class="fw-bold m-0">Check In</p>
        {{ \Carbon\Carbon::parse($model['checkin'])->toFormattedDateString() }}
    </div>
    <div class="col-md-8">
        <p class="fw-bold m-0">Check Out</p>
        {{ \Carbon\Carbon::parse($model['checkout'])->toFormattedDateString() }}
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-4 fw-bold">
        Nama Kamar
    </div>
    <div class="col-md-8">
        {{ $model['nama_kamar'] }}
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-4 fw-bold ">
        Tipe Kamar
    </div>
    <div class="col-md-8">
        {{ $model['tipe_kamar'] }}
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-4 fw-bold">
        Jumlah Pemesanan
    </div>
    <div class="col-md-8">
        {{ $model['jumlah'] }} Kamar
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-4 fw-bold">
        Nama Pemesan
    </div>
    <div class="col-md-8">
        {{ auth()->user()->name }}
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-4 fw-bold">
        Tamu
    </div>
    <div class="col-md-8">
        {{ $model['nama_tamu'] }}
    </div>
</div>