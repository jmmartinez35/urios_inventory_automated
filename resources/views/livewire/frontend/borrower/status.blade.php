<div>
    <!-- Order Success Section Start -->
    <section class="pt-0">
        <div class="container-fluid">
            @if ($details->status == 0)
                <div class="row">
                    <div class="col-12 p-0">
                        <div class="success-icon">
                            <div class="main-container">
                                <div class="check-container">
                                    <div class="check-background" style="background:orange !important;">

                                        <i class="fa-solid fa-hourglass-half fa-3x text-white"></i>

                                    </div>
                                    <div class="check-shadow"></div>
                                </div>
                            </div>

                            <div class="success-contain">
                                <h4 class="text-warning">Pending</h4>
                                <h5 class="font-light">Your borrowing request has been successfully submitted. Please
                                    proceed to the facility and present your barcode for approval.</h5>
                                <h6 class="font-light ">Note: If the requested date has passed and the item has not been
                                    approved, your request will be automatically canceled.</strong></h6>
                            </div>
                        </div>

                    </div>
                </div>
            @elseif ($details->status == 2)
                <div class="row">
                    <div class="col-12 p-0">
                        <div class="success-icon">
                            <div class="main-container">
                                <div class="check-container">
                                    <div class="check-background" style="background:#DC3545 !important;">
                                        <i class="fa-solid fa-road-barrier fa-3x text-white"></i>


                                    </div>
                                    <div class="check-shadow"></div>
                                </div>
                            </div>

                            <div class="success-contain">
                                <h4 class="text-danger">Cancelled</h4>
                                <h5 class="font-light">The borrowed has been cancelled. </h5>

                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($details->status == 3)
                <div class="row">
                    <div class="col-12 p-0">
                        <div class="success-icon">
                            <div class="main-container">
                                <div class="check-container">
                                    <div class="check-background">
                                        <i class="fa-solid fa-circle-check fa-3x text-white"></i>

                                    </div>
                                    <div class="check-shadow"></div>
                                </div>
                            </div>

                            <div class="success-contain">
                                <h4 class="text-success">Completed</h4>
                                <h5 class="font-light">The borrowed has been completed. </h5>

                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12 p-0">
                        <div class="success-icon">


                            <div class="success-contain">
                                <h4 class="p-3">Congratulation🎊</h4>
                                <h5 class="font-light">The borrowed has been successfully approved. Thank You!</h5>

                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>
    @if ($remarks != null && $remarks->remarks_msg != 'blank')
        <section class="section-b-space cart-section order-details-table">
            <div class="alert alert-warning alert-dismissible fade show m-3 text-center text-wrap" role="alert">

                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>

                <strong>Remarks: {{ Str::ucfirst(Str::lower($remarks->remarks_msg)) }}</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        </section>
    @endif
    @if ($borreturn != null && $borreturn->barcode_return != '' && $details->status == 1)
        <section class="section-b-space cart-section order-details-table">
            <div class="container">
                @livewire('frontend.borrower.bdownload', ['imageBarcode' => $borreturn->barcode_return, 'expire' => $details->end_date])

                <div class="main-container">
                    <div class="card mb-3 barcode-card">
                        <div class="card-body text-center">
                            <p class="text-muted mb-2">
                                Please present this barcode to the in-charge to process the return of your borrowed
                                item.
                            </p>
                            <img class="border p-2 barcode-image" id="barcodeImage"
                                src="data:image/png;base64,{{ DNS1D::getBarcodePNG($borreturn->barcode_return, 'C39') }}"
                                alt="barcode" />
                            <p class="mt-1">CODE: {{ $borreturn->barcode_return }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Order Success Section End -->
    @if ($details->status == 0)
        <section class="section-b-space cart-section order-details-table">
            <div class="container">
                @livewire('frontend.borrower.bdownload', ['imageBarcode' => $barcode, 'expire' => $details->end_date])


                <div class="main-container">
                    <div class="card mb-3 barcode-card">
                        <div class="card-body text-center">
                            <p class="text-muted mb-2">
                                Please present this barcode to the in-charge for approval of your borrowing request.
                            </p>
                            <img class="border p-2 barcode-image" id="barcodeImage"
                                src="data:image/png;base64,{{ DNS1D::getBarcodePNG($barcode, 'C39') }}"
                                alt="barcode" />
                            <p class="mt-1">CODE: {{ $barcode }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif
    <!-- Oder Details Section Start -->
    <section class="section-b-space cart-section order-details-table">
        <div class="container">
            <div class="title title1 title-effect mb-1 title-left">
                <h2 class="mb-3">Borrowed Details</h2>
            </div>
            <div class="row g-4">
                @livewire('frontend.borrower.thank1', ['borID' => $borID])


                <div class="col-md-6">
                    <div class="order-success">
                        <div class="row g-4">
                            <div class="col-sm-6">
                                <h4>Summary </h4>
                                <ul class="order-details">
                                    {{-- <li class="d-none">Reference: <strong>{{ $details->reference_num }}</strong></li> --}}
                                    <li>Date: {{ \Carbon\Carbon::parse($details->start_date)->format('F j, Y') }}
                                        -<br>
                                        {{ \Carbon\Carbon::parse($details->end_date)->format('F j, Y') }}</li>

                                </ul>
                            </div>

                            <div class="col-sm-6">
                                <h4>borrowed details</h4>
                                <ul class="order-details">

                                    <li>Name: <strong>{{ Str::ucfirst($users->firstname ?? '?') }}
                                            {{ Str::ucfirst($users->middlename ?? '') }}
                                            {{ Str::ucfirst($users->lastname ?? '') }}</strong></li>
                                    <li>Contact: {{ Str::ucfirst($users->contact) }}</li>
                                    <li>Address: {{ Str::ucfirst($users->address) }}</li>
                                </ul>
                            </div>

                            <div class="col-md-12" style="color:#333">

                                <p>Remarks:
                                    <strong>{{ $details->reason ? Str::ucfirst($details->reason) : '?' }}</strong>
                                </p>

                            </div>

                            <div class="col-md-12">
                                <div class="delivery-sec">
                                    <h3>expected return date of Borrowed: <span>
                                            {{ \Carbon\Carbon::parse($details->end_date)->format('F j, Y') }}</span>
                                    </h3>
                                    @livewire('frontend.borrower.thank', ['details' => $details])


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
