<div class="col-xl-12 col-md-12 col-sm-6 mb-xl-0 mb-4">
    @include('shared.offline')
    <div class="card">
        <div class="card-body p-3">
            <h4 class="card-title">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold text-muted">BARCODE MANAGEMENT</h5>
                    <button onclick="window.open('{{ route('barcodes.print') }}', '_blank')"
                        class="btn bg-gradient-primary">
                        <i class="fa-solid fa-print"></i>&nbsp;PRINT
                    </button>
                </div>

            </h4>
            <hr>

            <div class="row gap-3 mx-2">
                @foreach ($items as $item)
                    <div class="col-md-3 text-center mb-4 border">
                        <div class="card">
                            <small class="text-muted m  -1 text-center">{{ Str::ucfirst($item->name) }}</small>
                            <img class="border p-2" id="barcodeImage"
                                src="data:image/png;base64,{{ DNS1D::getBarcodePNG($item->barcode, 'C39') }}"
                                alt="barcode" />
                            <small class="m-1 text-muted">CODE: {{ $item->barcode }}</small>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
