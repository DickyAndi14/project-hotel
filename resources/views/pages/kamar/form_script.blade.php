<script>
    var table;
    $(() => {
        table = $('#table').DataTable({
            searching: false,
            lengthChange: false,
            info: false,
            paging: false,
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '',
            columns: [
                {data: 'name', name: 'kamars.name'},
                {data: 'tipe_kamar.name', name: 'tipe_kamar.name'},
                {data: 'jumlah', name: 'kamars.jumlah'},
                {data: '_', searchable: false}
            ]
        });
    });

    function create(){
        $.ajax({
            url: '{{ route('kamar.create') }}',
            success: (response) => {
                bootbox.dialog({
                    title: 'Tambah Kamar',
                    message: response,
                    closeButton: true
                });
            }
        })
    }

    function store(){
        let fd = new FormData();
        fd.append('_token', '{{ csrf_token() }}');
        fd.append('banner', $('#browse_gambar').prop('files')[0]);
        fd.append('tipe_kamar_id', $('#tipe_kamar').val());
        fd.append('name', $('#name').val());
        fd.append('jumlah', $('#jumlah').val());
        $('#formCreate .alert').remove();
        
        $.ajax({
            url: '{{ route('kamar.store') }}',
            type: 'post',
            cache: false,
            contentType: false,
            processData: false,
            data: fd,
            success: (response) => {
                if(response.status){
                    Swal.fire({
                        title: 'success',
                        text: response.message,
                        icon: 'success'
                    });
                    table.ajax.reload();
                }else {
                    Swal.fire({
                        title: 'gagal',
                        text: response.message,
                        icon: 'error'
                    });
                }
                bootbox.hideAll();
            },
            error: (err) => {
                var response = JSON.parse(err.responseText);
                $('#formCreate').prepend(validation(response));
            }
        });
    }

    function edit(id){
        let url = "{{ route('kamar.edit', ":id") }}"
        url = url.replace(':id', id);
        $.ajax({
            url,
            success: (response) => {
                bootbox.dialog({
                    title: 'Ubah Kamar',
                    message: response,
                    closeButton: true
                });
            }
        });
    }

    function update(id){
        let fd = new FormData();
        fd.append('_token', '{{ csrf_token() }}');
        fd.append('_method', 'PUT');
        fd.append('tipe_kamar_id', $('#tipe_kamar').val());
        fd.append('name', $('#name').val());
        fd.append('banner', $('#browse_gambar').prop('files')[0]);
        fd.append('jumlah', $('#jumlah').val());
        $('#formEdit .alert').remove();

        let url = "{{ route('kamar.update', ":id") }}";
        url = url.replace(':id', id);
        $.ajax({
            url,
            type: 'post',
            cache: false,
            contentType: false,
            processData: false,
            data: fd,
            success: (response) => {
                if(response.status){
                    Swal.fire({
                        title: 'success',
                        text: response.message,
                        icon: 'success'
                    });
                    table.ajax.reload();
                }else {
                    Swal.fire({
                        title: 'gagal',
                        text: response.message,
                        icon: 'error'
                    });
                }
                bootbox.hideAll();
            },
            error: (err) => {
                let response = JSON.parse(err.responseText);
                $('#formEdit').prepend(validation(response));
            }
        });
    }

    function view(id){
        let url = "{{ route('kamar.show', ":id") }}";
        url = url.replace(":id", id);

        $.ajax({
            url,
            success: (response) => {
                bootbox.dialog({
                    title: 'Detail Kamar',
                    message: response,
                    closeButton: true
                });
            }
        });
    }

    function destroy(id){
        let data = {'_token': "{{ csrf_token() }}", '_method': 'DELETE'};
        
        let url  = "{{ route('kamar.destroy', ":id") }}";
        url = url.replace(':id', id);

        Swal.fire({
            title: 'Yakin hapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
        }).then((result) => {
            if(result.isConfirmed){
                $.ajax({
                    url,
                    method: 'post',
                    data,
                    success: (response) => {
                        if(response.status){
                            Swal.fire({
                                title: 'success',
                                text: response.message,
                                icon: 'success'
                            });
                            table.ajax.reload();
                        }else {
                            Swal.fire({
                                title: 'gagal',
                                text: response.message,
                                icon: 'error'
                            });
                        }
                    }
                });
            }
        });
    }

    function validation(errors){
        var validations = '<div class="alert alert-danger">';
        $.each(errors.errors, function(i, error){
            validations += error[0]+'<br>';
        });
        validations += '</div>';
        return validations;
    }
</script>