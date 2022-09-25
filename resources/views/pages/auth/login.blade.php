<x-authLayout>
    @if(Session::has('alert-errors'))
        <x-alert type="danger">
            {{ Session::get('alert-errors') }}
        </x-alert>
    @endif
    {!! Form::open(['route' => 'signin', 'method' => 'post']) !!}
    <div class="form-group mb-3">
        <label for="email" class="mb-2">Email</label>
        {!! Form::text('email', '', ['class' => 'form-control', 'id' => 'email']) !!}
        @error('email')
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
                    Login
                </button>
            </div>
            <div class="col-md-6 align-self-center text-end">
                <a href="{{ route('register') }}">Belum punya akun?</a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</x-authLayout>