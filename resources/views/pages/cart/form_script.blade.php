<script>
    var table;
    var tableTransaksi;
    $(() => {
        table = $('#table').DataTable();
        tableTransaksi = $('#table-transaksi').DataTable({
            serverSide: true,
            processing: true,
            ajax:'{{ route('transaksi.index') }}',
            responsive: true,
            columns: [
                {data: 'kode_booking', name: 'transaksis.kode_booking'},
                {data: '_', searchable: false}
            ]
        });
    })
    
    function view(id){
        let url = '{{ route('cart.show',':id') }}';
        url = url.replace(':id', id);
        $.ajax({
            url,
            success: (response) => {
                bootbox.dialog({
                    title: 'Detail Booking',
                    message: response
                });
            }
        });
    }

    function edit(id){
        let url = '{{ route('cart.edit',':id') }}';
        url = url.replace(':id', id);
        $.ajax({
            url,
            success: (response) => {
                bootbox.dialog({
                    title: 'Ubah Booking',
                    message: response
                });
                $('#check-in').datepicker();
                $('#check-out').datepicker();
            }
        });
    }

    function update(id){
        $('#formEdit .alert').remove();

        let url = '{{ route('cart.update',':id') }}';
        url = url.replace(':id', id);

        $.ajax({
            url,
            dataType: 'json',
            method: 'post',
            data: $('#formEdit').serialize(),
            success: (response) => {
                if(response.success){
                    Swal.fire({
                        title: 'success',
                        icon: 'success',
                        text: response.message
                    });
                    $('#count').html(response.count);
                }else{
                    Swal.fire({
                        title: 'error',
                        icon: 'error',
                        text: response.message
                    });
                    $('#count').html(response.count);
                }
                bootbox.hideAll();
                location.reload();

            },
            error: (err) => {
                let response = JSON.parse(err.responseText);
                $('#formCreate').prepend(validation(response));
            }
        });
    }

    function destroy(id){

        let url = '{{ route('cart.destroy',':id') }}';
        url = url.replace(':id', id);

        Swal.fire({
            title: 'Yakin hapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
        }).then(res => {
            if(res.isConfirmed){
                $.ajax({
                    url,
                    dataType: 'json',
                    method: 'post',
                    data: {'_method': 'DELETE', '_token' : '{{ csrf_token() }}'},
                    success: (response) => {
                        Swal.fire({
                            title: 'success',
                            icon: 'success',
                            text: response.message
                        });
                        $('#count').html(response.count);
                        bootbox.hideAll();
                        location.reload();

                    },
                    error: (err) => {
                        let response = JSON.parse(err.responseText);
                        $('#formCreate').prepend(validation(response));
                    }
                });
            }
        })
    }

    function order(){
        Swal.fire({
            title: 'Yakin memproses transaksi?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjutkan',
        }).then(res => {
            if(res.isConfirmed){
                $.ajax({
                    url: '{{ route('transaksi.store') }}',
                    method: 'post',
                    data: {'_token': "{{ csrf_token() }}"},
                    success: (response) => {
                        if(response){
                            Swal.fire({
                                title: 'success',
                                text: response.message,
                                icon: 'success'
                            });
                        }else {
                            Swal.fire({
                                title: 'error',
                                icon: 'error',
                                text: response.message,
                            });
                        }
                    },
                    error: (err) => {
                        console.log(err);
                    }
                });
            }
        });
    }

    function print_invoice(id){
        let url = "{{ route('transaksi.invoice', ':id') }}";
        url = url.replace(':id', id);
        
        $.ajax({
            url,
            xhrFields: {
                responseType: 'blob'
            },
            success:(res) => {
                var blob = new Blob([res]);
                var link=document.createElement('a');
                link.href=window.URL.createObjectURL(blob);
                link.download=`invoice_{{ auth()->user()->name }}.pdf`;
                link.click();
            }
        });
    }

    function show(id){
        let url = "{{ route('transaksi.invoice.show', ':id') }}";
        url = url.replace(':id', id);
        
        $.ajax({
            url,
            success:(res) => {
                bootbox.dialog({
                    title: 'Invoice',
                    size: 'large',
                    message: res
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