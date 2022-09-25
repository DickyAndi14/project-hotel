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
            ajax: '',
            responsive: true,
            columns: [
                {data: 'name', name: 'fasilias.name'},
                {data: 'desc', name: 'fasilitas.desc'},
                {data: 'picture', name: 'fasilitas.picture', class:"text-center", orderable: false},
                {data: '_', searchable: false}
            ]
        });
    });

    function create(){
        $.ajax({
            url: '{{ route('fasilitas.create') }}',
            success: (response) => {
                bootbox.dialog({
                    title: 'Tambah Fasilitas',
                    message: response,
                    closeButton: true
                });
            }
        })
    }

    function store(){
        let fd = new FormData();
        fd.append('picture', $('#browse_gambar').prop('files')[0]);
        fd.append('name', $('#name').val());
        fd.append('_token', '{{ csrf_token() }}');
        fd.append('desc', $('#desc').val());
        $('#formCreate .alert').remove();
        
        $.ajax({
            url: '{{ route('fasilitas.store') }}',
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
        let url = "{{ route('fasilitas.edit', ":id") }}"
        url = url.replace(':id', id);
        $.ajax({
            url,
            success: (response) => {
                bootbox.dialog({
                    title: 'Ubah Fasilitas',
                    message: response,
                    closeButton: true
                });
            }
        });
    }

    function update(id){
        let fd = new FormData();
        fd.append('picture', $('#browse_gambar').prop('files')[0]);
        fd.append('name', $('#name').val());
        fd.append('_token', '{{ csrf_token() }}');
        fd.append('_method', 'PUT');
        fd.append('desc', $('#desc').val());
        $('#formEdit .alert').remove();

        let url = "{{ route('fasilitas.update', ":id") }}";
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
        let url = "{{ route('fasilitas.show', ":id") }}";
        url = url.replace(":id", id);

        $.ajax({
            url,
            success: (response) => {
                bootbox.dialog({
                    title: 'Detail Fasilitas',
                    message: response,
                    closeButton: true
                });
            }
        });
    }

    function destroy(id){
        let data = {'_token': "{{ csrf_token() }}", '_method': 'DELETE'};
        
        let url  = "{{ route('fasilitas.destroy', ":id") }}";
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