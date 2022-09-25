<x-authLayout>
    <p class="text-bold tracking-wider text-xl text-blacker">REGISTER</p>
    {!! Form::open(['route' => 'signup', 'method' => 'post']) !!}
    <div class="form-group mb-3">
        <label for="email" class="mb-2">Email</label>
        {!! Form::text('email', '', ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'jhondoe@gmail.com']) !!}
        @error('email')
            <small class="text-danger">*{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label for="name" class="mb-2">Username</label>
        {!! Form::text('name', '', ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'doe']) !!}
        @error('name')
            <small class="text-danger">*{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label for="password" class="mb-2">Password</label>
        {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
        @error('password')
            <small class="text-danger">*{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-primary w-75">
                    <i class="fa fa-plane"></i>
                    Register
                </button>
            </div>
            <div class="col-md-6 align-self-center text-end">
                <a href="{{ route('login') }}">Sudah punya akun?</a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</x-authLayout>