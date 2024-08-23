<div class="row" id="step2Form" style="display: none;">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-body">
                <form id="checkout-form" action="" action="" method="post" enctype="multipart/form-data">
                    <div>
                        <h4>Detail Pembayaran</h4>
                    </div>
                    <div class="d-flex justify-content-between border-bottom pb-4">
                        <img src="{{ asset($image->image) }}" width="100px">
                        <div class="text-right">
                            <p class="card-title">{{ $image->costume->name }}</p>
                            <p class="card-subtitle mb-2 text-body-secondary">{{ $image->costume->manufacture->name }}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between border-bottom">
                        <p>Metode Pembayaran</p>
                        <p>QRIS</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="font-weight-bold">Total Pembayaran</p>
                        <p class="font-weight-bold">Rp. {{ number_format($image->costume->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-primary w-100">Bayar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>