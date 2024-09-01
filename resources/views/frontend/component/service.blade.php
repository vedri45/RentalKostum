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

            <!-- Search and Filter Form -->
            <div class="col-lg-12 mb-4">
                <div class="d-flex justify-content-center" style="gap: 10px;">
                    <input type="text" id="search-box" class="form-control" placeholder="Search by costume name" style="width: 250px;">
                    <select id="category-select" class="form-control" style="width: 200px;">
                        <option value="">Select Category</option>
                        @foreach ($category as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row" id="results">
            @foreach($images as $image)
                @if($image->costume->status != "terpakai")
                    <div class="col-lg-4 my-3" data-costume-name="{{ $image->costume->name }}" data-category-id="{{ $image->costume->category->id }}">
                        <div class="card">
                            <img src="{{ asset($image->image) }}" class="card-img-top" alt="Car Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $image->costume->name }}</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">{{ $image->costume->category->name }}</h6>
                                <p class="card-text">Rp. {{ number_format($image->costume->price, 0, ',', '.') }}</p>
                                <a href="{{route('rent.index', $image->costume->id)}}"><button type="button" class="btn btn-primary">Sewa</button></a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function filterResults() {
            var searchQuery = document.getElementById('search-box').value;
            var categoryId = document.getElementById('category-select').value;
            
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '{{ route('index.filter') }}' + '?search=' + encodeURIComponent(searchQuery) + '&category_id=' + encodeURIComponent(categoryId), true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    document.getElementById('results').innerHTML = xhr.responseText;
                } else {
                    console.error('Request failed with status: ' + xhr.status);
                }
            };
            xhr.onerror = function() {
                console.error('Request error');
            };
            xhr.send();
        }
        
        document.getElementById('search-box').addEventListener('keyup', filterResults);
        document.getElementById('category-select').addEventListener('change', filterResults);
    });
</script>
<!-- SERVICE END -->