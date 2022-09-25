<x-mainLayout>
    <x-carrousel>
        <div class="carousel-inner">
            @if($model)
                @foreach($model as $key => $value)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/'.$value['banner']) }}" class="d-block w-100 img-fit ">
                    </div>
                @endforeach
            @endif
        </div>
    </x-carrousel>
    <div class="container">
        <div class="row flex-wrap mt-5">
            @if($model)
                @foreach($model as $key => $value)
                    <div class="col-md-4 m-5">
                        <div class="card h-100">
                            <img src="{{ asset('storage/'.$value['banner']) }}" height="200" class="card-img-top img-fit-cover" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $value['name'] }}</h5>
                                <p class="card-text"><span class="fw-bold">Jumlah tersedia: </span> {{ $value['jumlah'] }} kamar</p>
                                <p class="card-text"><span class="fw-bold">Tipe Kamar: </span> {{ $value['tipeKamar']->name }}</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                @if(!auth()->user())
                                <a href="{{ route('login') }}" id="cta-order" class="btn btn-success fw-bold">Pesan</a>
                                @else
                                <button class="btn btn-success fw-bold text-right" onclick="create({{ $value['id'] }})">Pesan</button>
                                @endif
                                <button class="btn btn-outline-warning fw-bold" onclick="show({{ $value['id'] }})">Detail</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    @slot('script')
        <script>
            function show(id){
                let url = "{{ route('kamar.hotel.show', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    url,
                    success: (response => {
                        bootbox.dialog({
                            title: 'Detail Kamar',
                            message: response,
                            size: 'large',
                            closeButton: true
                        });
                    })
                });
            }

            function create(id){
                $.ajax({
                    url: '{{ route('cart.create') }}?kamar_id='+id,
                    success:(response) => {
                        bootbox.dialog({
                            title: 'Pemesanan Kamar',
                            size: 'large',
                            message: response
                        });
                        $('#check-in').datepicker();
                        $('#check-out').datepicker();
                    }
                });
            }

            function store(){
                $('#formCreate .alert').remove();
                $.ajax({
                    url: '{{ route('cart.store') }}',
                    dataType: 'json',
                    method: 'post',
                    data: $('#formCreate').serialize(),
                    success: (response) => {
                        if(response.success){
                            Swal.fire({
                                title: 'success',
                                icon: 'success',
                                text: response.message
                            });
                        }else{
                            Swal.fire({
                                title: 'error',
                                icon: 'error',
                                text: response.message
                            });
                        }
                        $('#count').html(response.count)
                        bootbox.hideAll();
                    },
                    error: (err) => {
                        let response = JSON.parse(err.responseText);
                        $('#formCreate').prepend(validation(response));
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
    @endslot
</x-mainLayout>