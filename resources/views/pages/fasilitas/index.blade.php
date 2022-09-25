<x-adminLayout pageName="Fasilitas">
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-success btn-sm text-end" onclick="create()">Tambah</button>
    </div>
    <table class="table table-bordered table-condensed" id="table">
        <thead>
            <tr>
                <th>Nama Fasilitas</th>
                <th>Keterangan</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    @slot('script')
        @include('pages.fasilitas.form_script')
    @endslot
</x-adminLayout>