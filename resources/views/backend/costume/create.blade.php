@extends('backend.layouts')
@section('title','Tambah Data')
@section('content')
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            <form action="{{route('costume.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                          <label>Gambar</label>
                          <input type="file" name="image[]" id="fileinput" class="form-control border-dark-50" required="" multiple>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                          <label>Nama</label>
                          <input type="text" name="name" id="" class="form-control border-dark-50" required="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                          <label>Kategori</label>
                            <select name="category_id" class="form-control select2">
                                @foreach (App\Category::orderBy('name','asc')->get() as $row)
                                <option value="{{$row->id}}">{{title_case($row->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col">
                        <div class="form-group">
                          <label>Nomer Polisi</label>
                          <input type="text" name="license_number" id="" class="form-control border-dark-50" required="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                          <label>Tahun</label>
                          <input type="text" name="year" id="" class="form-control border-dark-50" required="">
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                          <label>Sewa Perhari</label>
                          <input type="text" name="price" id="price" class="form-control border-dark-50" required="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                          <label>Denda Perhari</label>
                          <input type="text" name="penalty" id="penalty" class="form-control border-dark-50" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col">
                        <div class="form-group">
                          <label>Warna</label>
                          <input type="text" name="color" id="" class="form-control border-dark-50" required="">
                        </div>
                    </div>-->
                    <div class="col">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control border-dark-50" required="">
                                <option value="tersedia">Tersedia</option>
                                <option value="terpakai">Terpakai</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-gorup">
                            <button type="submit" class="btn btn-primary  shadow-sm">Simpan</button>
                            <a class="btn btn-light shadow-sm" href="{{route('costume.index')}}">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    $('.select2').select2({
            dropdownParent: $('body'),
            theme: 'bootstrap'
    });

    $('#fileinput').fileinput({
        uploadUrl:'#',
          browseClass: "btn btn-primary btn-block",
          fileActionSettings:{
            showZoom:false,
            showUpload:false,
            removeClass: "btn btn-danger",
            removeIcon: "<i class='fa fa-trash'></i>"
          },
          showCaption: false,
          showRemove: false,
          showUpload: false,
          showCancel: false,
          dropZoneEnabled: false,
          allowedFileExtensions: ['jpg', 'png','jpeg'],
    });

    function cleanNumericFields() {
        // Get AutoNumeric instances
        var price = new AutoNumeric('#price');
        var penalty = new AutoNumeric('#penalty');

        // Remove the digit group separator (.) and update the fields
        $('#price').val(price.getNumber().toString().replace(/\./g, ''));
        $('#penalty').val(penalty.getNumber().toString().replace(/\./g, ''));
    }

    // Initialize AutoNumeric fields
    new AutoNumeric('#price', {
        digitGroupSeparator: ',',
        decimalCharacter: '.',
        decimalPlaces: 0,
        minimumValue: 0
    });

    new AutoNumeric('#penalty', {
        digitGroupSeparator: ',',
        decimalCharacter: '.',
        decimalPlaces: 0,
        minimumValue: 0
    });

    // Clean the numeric fields before form submission
    $('form').on('submit', function() {
        cleanNumericFields();
    });
</script>

@endpush
