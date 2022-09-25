<x-adminLayout pageName="Fasilitas Kamar">
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-success btn-sm text-end" onclick="create()">Tambah</button>
    </div>
    <table class="table table-bordered table-condensed" id="table">
        <thead>
            <tr>
                <th>Tipe Kamar</th>
                <th>Fasilitas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    @slot('script')
        @include('pages.fasilitas_kamar.form_script')
    @endslot
</x-adminLayout>