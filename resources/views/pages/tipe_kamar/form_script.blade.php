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
                {data: 'name', name: 'tipe_kamars.name'},
                {data: '_', searchable: false}
            ]
        });
    });

    function create(){
        $.ajax({
            url: '{{ route('tipe-kamar.create') }}',
            success: (response) => {
                bootbox.dialog({
                    title: 'Tambah Tipe Kamar',
                    message: response,
                    closeButton: true
                });
            }
        })
    }

    function store(){
        $('#formCreate .alert').remove();
        
        $.ajax({
            url: '{{ route('tipe-kamar.store') }}',
            type: 'post',
            dataType: 'json',
            data: $('#formCreate').serialize(),
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
        let url = "{{ route('tipe-kamar.edit', ":id") }}"
        url = url.replace(':id', id);
        $.ajax({
            url,
            success: (response) => {
                bootbox.dialog({
                    title: 'Ubah Tipe Kamar',
                    message: response,
                    closeButton: true
                });
            }
        });
    }

    function update(id){
        $('#formEdit .alert').remove();

        let url = "{{ route('tipe-kamar.update', ":id") }}";
        url = url.replace(':id', id);
        $.ajax({
            url,
            type: 'post',
            dataType: 'json',
            data: $('#formEdit').serialize(),
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
        let url = "{{ route('tipe-kamar.show', ":id") }}";
        url = url.replace(":id", id);

        $.ajax({
            url,
            success: (response) => {
                bootbox.dialog({
                    title: 'Detail Tipe Kamar',
                    message: response,
                    closeButton: true
                });
            }
        });
    }

    function destroy(id){
        let data = {'_token': "{{ csrf_token() }}", '_method': 'DELETE'};
        
        let url  = "{{ route('tipe-kamar.destroy', ":id") }}";
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