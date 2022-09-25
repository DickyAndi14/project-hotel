<x-mainLayout>
    <div style="height: 100vh!important" class="m-auto">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="m-0">Daftar Booking</h5>
            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>Nama Kamar</th>
                            <th>Tipe</th>
                            <th>Jumlah Pemesanan</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(session('cart'))
                            @foreach(session('cart') as $key => $value)
                                <tr>
                                    <td>{{ $value['nama_kamar'] }}</td>
                                    <td>{{ $value['tipe_kamar'] }}</td>
                                    <td>{{ $value['jumlah'] }} Kamar</td>
                                    <td>{{ \Carbon\Carbon::parse($value['checkin'])->toDateString() }}</td>
                                    <td>{{ \Carbon\Carbon::parse($value['checkout'])->toDateString() }}</td>
                                    <td>
                                        <button class="btn btn-success" onclick="view({{ $value['kamar'] }})">Lihat</button>
                                        <button class="btn btn-primary" onclick="edit({{ $value['kamar'] }})">Ubah</button>
                                        <button class="btn btn-danger"  onclick="destroy({{ $value['kamar'] }})">Batal</button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end m-3">
                @if(session()->has('cart') && count(session('cart')) > 0)
                    <button class="btn btn-success fw-bold" onclick="order()">Pesan</button>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">Transaksi</h5>
            </div>
            <div class="card-body">
                <table id="table-transaksi" class="table table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th>Kode Transaksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    @slot('script')
        @include('pages.cart.form_script')
    @endslot
</x-mainLayout>