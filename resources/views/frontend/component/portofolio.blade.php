<!-- PORTOFOLIO -->
<section class="mosh-portfolio-area section_padding_100_0 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Portfolio</h2>
                        <p class="pt-3 text-red">kepercayaan adalah sebuah hal yang tak ternilai</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mosh-projects-menu">
            {{-- <div class="text-center portfolio-menu">
                <p class="active" data-filter="*">All</p>
                @foreach (App\Category::get() as $row)
                <p data-filter=".{{$row->slug}}">{{title_case($row->name)}}</p>
                @endforeach
            </div> --}}
        </div>

        <div class="mosh-portfolio">
            {{-- @foreach (App\Portofolio::orderBy('created_at','desc')->get() as $row)
            <!-- Single gallery Item Start -->
            <div class="single_gallery_item {{$row->category->slug}}">
                @php
                    $image = App\PortofolioImage::where('portofolio_id',$row->id)->get()->first()->image;
                @endphp
                <img src="{{$image}}" alt="">
                <div class="gallery-hover-overlay d-flex align-items-center justify-content-center">
                    <div class="port-hover-text text-center">
                        <a href="{{route('index.menu',[$row->menu->slug,$row->slug])}}">
                            <h4>{{$row->name}}</h4>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach --}}

        </div>
    </section>
    <!-- PORTOFOLIO END -->
