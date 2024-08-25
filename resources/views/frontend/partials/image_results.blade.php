@foreach($images as $image)
    @if($image->costume->status != "terpakai")
        <div class="col-lg-4 my-3" data-costume-name="{{ $image->costume->name }}" data-manufacture-id="{{ $image->costume->manufacture->id }}">
            <div class="card">
                <img src="{{ asset($image->image) }}" class="card-img-top" alt="Car Image">
                <div class="card-body">
                    <h5 class="card-title">{{ $image->costume->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $image->costume->manufacture->name }}</h6>
                    <p class="card-text">Rp. {{ number_format($image->costume->price, 0, ',', '.') }}</p>
                    <a href="{{route('rent.index', $image->costume->id)}}"><button type="button" class="btn btn-primary">Sewa</button></a>
                </div>
            </div>
        </div>
    @endif
@endforeach