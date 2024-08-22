<!-- SERVICE -->
<section class="mosh--services-area section_padding_100">
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2>{{ $title }}</h2>
                    <p class="pt-3 text-red">Kami berikan layanan terbaik kepada anda</p>
                </div>
            </div>

            {{-- @foreach (App\Service::get() as $row)
            <!-- Single Feature Area -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="single-feature-area d-flex mb-100">
                    <div class="feature-icon mr-30">
                        <i class="fas fa-5x text-red"></i>
                        <i class="{{$row->icon}} fa-5x text-red"></i>
                    </div>
                    <div class="feature-content">
                        <h4>{{title_case($row->name)}}</h4>
                        <p>{{str_limit($row->description,70)}}</p>
                    </div>
                </div>
            </div>
            @endforeach --}}
        </div>
        <div class="row">
            @foreach($images as $image)
                @if($image->car->status != "tidak_tersedia")
                    <div class="col-lg-4 my-3">
                        <div class="card">
                            <img src="{{ asset($image->image) }}" class="card-img-top" alt="Car Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $image->car->name }}</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">{{ $image->car->manufacture->name }}</h6>
                                <p class="card-text">Rp. {{ number_format($image->car->price, 0, ',', '.') }}</p>
                                <button type="button" class="btn btn-primary">Sewa</button>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
<!-- SERVICE END -->
