<x-mainLayout>
    <x-carrousel>
        <div class="carousel-inner">
            @if($model)
                @foreach($model as $key => $value)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/'.$value['picture']) }}" class="d-block w-100 img-fit">
                    </div>
                @endforeach
            @endif
        </div>
    </x-carrousel>
    <div class="container">
        <div class="row flex-wrap mt-5">
            @if($model)
                @foreach($model as $key => $value)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('storage/'.$value['picture']) }}" height="200" class="card-img-top img-fit-cover" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $value['name'] }}</h5>
                                <p class="card-text">{{ $value['desc'] }}.</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</x-mainLayout>