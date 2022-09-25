<x-mainLayout>
    <x-carrousel>
        <div class="carousel-inner">
            @if($model)
                <div class="carousel-item active">
                    <img src="{{ asset('img/Hotel.jpg') }}" class="d-block w-100 img-fit">
                </div>
            @endif
        </div>
    </x-carrousel>
    <div class="mx-5">
        <div class="row my-5">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row mb-3"> 
                            <span class="fw-bold">Pesan Kamar</span>
                        </div>
                        <div class="container">
                            @if(session()->has('error_jumlah'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error_jumlah') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            {!! Form::open(['route' => 'cart.store', 'method' => 'post']) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="check-in" class="fw-bold mb-2">Check In </label>
                                            {!! Form::text('checkin', old('checkin') ?? null, ['class' => 'form-control', 'id' => 'check-in', 'autocomplete' => 'off']) !!}
                                            @error('checkin')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="check-out" class="fw-bold mb-2">Check Out </label>
                                            {!! Form::text('checkout', old('checkout') ?? null, ['class' => 'form-control', 'id' => 'check-out', 'autocomplete' => 'off']) !!}
                                            @error('checkout')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jumlah" class="fw-bold mb-2">Jumlah</label>
                                            {!! Form::number('jumlah', old('jumlah') ?? null, ['class' => 'form-control', 'id' => 'jumlah', 'min' => '0']) !!}
                                            @error('jumlah')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kamar" class="fw-bold mb-2">Kamar </label>
                                            {!! Form::select('kamar_id',['' => 'Pilih']+App\Models\Kamar::pluck('name', 'id')->toArray() ,old('kamar_id') ?? null, ['class' => 'form-control', 'id' => 'kamar']) !!}
                                            @error('kamar_id')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pemesan" class="fw-bold mb-2">Nama Pemesan</label>
                                            {!! Form::hidden('user_id',auth()->user()->id ?? null, ['class' => 'form-control', 'id' => 'user_id', 'readonly']) !!}
                                            {!! Form::text('pemesan',auth()->user()->name ?? null, ['class' => 'form-control', 'id' => 'pemesan', 'readonly']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="fw-bold mb-2">Email</label>
                                            {!! Form::text('email', auth()->user()->email ?? null, ['class' => 'form-control', 'id' => 'email', 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="guest" class="fw-bold mb-2">Nama Tamu</label>
                                            {!! Form::text('nama_tamu', old('nama_tamu') ?? null, ['class' => 'form-control', 'id' => 'guest']) !!}
                                            @error('nama_tamu')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_hp" class="fw-bold mb-2">No Hp</label>
                                            {!! Form::number('no_hp', old('no_hp') ?? null, ['class' => 'form-control', 'id' => 'no_hp']) !!}
                                            @error('no_hp')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4 text-end">
                                    <div class="form-group">
                                        @if(!auth()->user())
                                            <a href="{{ route('login') }}" id="cta-order" class="btn btn-primary fw-bold">Pesan</a>
                                        @else
                                            <button id="cta-order" class="btn btn-primary fw-bold">Pesan</button>
                                        @endif
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 mb-4 text-center">
                <div class="">
                    <div class="row text-center text-black">
                        <h2>Tentang Kami</h2>
                    </div>
                    <div class="mt-2 text-black text-center">
                        Beristirahatlah dengan tenang dan nyaman di GRATHAEL(The Great Hotel), dengan berbagai fasilitas yang menarik dan harga yang terjangkau.
                    </div>
                </div>
            </div>
        </div>
    </div>
    @slot('script')
        <script>
            $('#check-in').datepicker();
            $('#check-out').datepicker();
        </script>
    @endslot
</x-mainLayout>