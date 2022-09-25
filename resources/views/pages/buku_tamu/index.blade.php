<x-adminLayout pageName="Buku Tamu">
    {!! Form::open(['id' => 'filter']) !!}
    <div class="d-flex mb-3 ml-1">
        {!! Form::text('from', null, ['class' => 'form-control w-25', 'id' => 'from', 'placeholder' => 'from', 'autocomplete' => 'off']) !!}
        {!! Form::text('to', null, ['class' => 'form-control w-25 ml-4 mr-4', 'id' => 'to', 'placeholder' => 'to', 'autocomplete' => 'off']) !!}
        <button type="button" class="btn btn-primary fw-bold m-0" onclick="filter()">Filter</button>
        <button type="button" class="btn btn-secondary fw-bold ml-3" onclick="reset_filter()">Reset</button>
    </div>
    {!! Form::close() !!}
    <table class="table table-condensed table-bordered mt-5" id="table">
        <thead>
            <tr>
                <th>Nama Tamu</th>
                <th>Tanggal Cek In</th>
                <th>Tanggal Cek Out</th>
                <th>Status</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    @slot('script')
        @include('pages.buku_tamu.form_script')
    @endslot
</x-adminLayout>