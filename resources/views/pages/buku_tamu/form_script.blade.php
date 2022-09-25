<script>
    var table;
    $(() => {
        table = $('#table').DataTable({
            ajax:'',
            serverSide: true,
            processing: true,
            responsive: true,
            columns: [
                { data: 'tamu', name: 'transaksi_details.tamu' },
                { data: 'checkin', name: 'transaksi_details.checkin' },
                { data: 'checkout', name: 'transaksi_details.checkout' },
                { data: '_', searchable: false, sorting: false},
            ]
        });
        $('#from').datepicker();
        $('#to').datepicker();
    });

    function update(id){
        let url = "{{ route('buku.tamu.update', ':id') }}";
        url = url.replace(':id', id);
        
        $.ajax({
            url,
            method: 'post',
            data: {'_method': 'put', '_token': '{{ csrf_token() }}'},
            success: (response) => {
                if(response.status){
                    Swal.fire({
                        icon: 'success',
                        title: response.message
                    });
                    table.ajax.reload()
                }else {
                    Swal.fire({
                        icon: 'error',
                        title: response.message
                    });
                }
            }
        });
    }

    function reset_filter(){
        $('#from').val('');
        $('#to').val('');
        let filter = $('#filter').serialize();
        table.ajax.url(`{{ route('buku.tamu.index') }}?${filter}`).load();
    }

    function filter(){
        let filter = $('#filter').serialize();
        table.ajax.url(`{{ route('buku.tamu.index') }}?${filter}`).load();
    }
</script>