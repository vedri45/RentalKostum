<!-- Modal -->
<div class="modal fade" id="show" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-header rounded-0 bg-gradient-primary">
                <h5 class="modal-title text-white">Detail Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body rounded-0">
                <div class="row">
                    <div class="col">
                        <div id="carouselId" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="gambar"></div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" name="nik" class="form-control" readonly="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" readonly="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>No telp</label>
                            <input type="text" name="phone_number" class="form-control" readonly="">
                        </div>
                    </div>
                    <div class="col">
                        {{-- <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" readonly="">
                        </div> --}}
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <input type="text" name="sex" class="form-control" readonly="">
                          </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                          <label>Alamat</label>
                          <input type="text" name="address" class="form-control" readonly="">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
