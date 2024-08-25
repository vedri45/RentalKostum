<div class="row" id="step1Form">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-body">
                <form id="data-form" action="{{ route('rent.store', ['id' => $data->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col text-center">
                            <img id="imagePreview" src="#" alt="Image Preview"
                                style="display:none; max-width: 100%; height: auto; margin-bottom: 20px;">
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Foto KTP</label>
                                <input type="file" name="image[]" id="fileinput" class="form-control border-dark-50"
                                    required="" multiple>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" name="nik" class="form-control border-dark-50" required="">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control border-dark-50" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" name="address" class="form-control border-dark-50" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="sex" class="form-control">
                                    <option value="laki-laki">Laki-Laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>No Telp</label>
                                <input type="text" name="phone_number" class="form-control border-dark-50"
                                    required="">
                            </div>
                        </div>
                    </div> --}}

                    <div class="row">
                        <div class="col">
                            <div class="form-group text-center">
                                <button type="button" id="nextStep"
                                    class="btn btn-primary shadow-sm w-100">Next</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>