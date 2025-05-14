<div class="col-lg-9">
    <div class="filter-button dash-filter dashboard">
        <button class="btn btn-solid-default btn-sm fw-bold filter-btn">Show Menu</button>
    </div>

    <div class="dashboard-right">
        <div class="dashboard">
            <div class="page-title title title1 title-effect">
                <h2>My Dashboard</h2>
            </div>
            <div class="welcome-msg">
                <h6 class="font-light">Hello, <span>{{ Str::ucfirst(Auth::user()->username) }}</span></h6>
                <p class="font-light">From your My Account Dashboard you have the ability to
                    view a snapshot of your recent account activity and update your account
                    information. Select a link below to view or edit information.</p>
            </div>

            <div class="order-box-contain my-4">
                <div class="row g-4">
                    <div class="col-lg-4 col-sm-6">
                        <a href="{{ route('myaccount.borrowed') }}#pending">
                            <div class="order-box">
                                <div class="order-box-image">
                                    <img src="{{ asset('assets_users/images/svg/box.png') }}"
                                        class="img-fluid blur-up lazyload" alt="">

                                </div>
                                <div class="order-box-contain">
                                    <img src="{{ asset('assets_users/images/svg/box1.png') }}"
                                        class="img-fluid blur-up lazyload" alt="">

                                    <div>
                                        <h5 class="font-light">pending</h5>
                                        <h3 class="text-dark">{{ $borrow_pending }}</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="{{ route('myaccount.borrowed') }}#cancelled">

                            <div class="order-box">
                                <div class="order-box-image">
                                    <img src="{{ asset('assets_users/images/svg/box.png') }}"
                                        class="img-fluid blur-up lazyload" alt="">

                                </div>
                                <div class="order-box-contain">
                                    <img src="{{ asset('assets_users/images/svg/box1.png') }}"
                                        class="img-fluid blur-up lazyload" alt="">

                                    <div>
                                        <h5 class="font-light">cancelled</h5>
                                        <h3 class="text-dark">{{ $borrow_cancel }}</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="{{ route('myaccount.borrowed') }}#completed">

                            <div class="order-box">
                                <div class="order-box-image">
                                    <img src="{{ asset('assets_users/images/svg/sent.png') }} "
                                        class="img-fluid blur-up lazyload" alt="">
                                </div>
                                <div class="order-box-contain">
                                    <img src="{{ asset('assets_users/images/svg/sent1.png') }}"
                                        class="img-fluid blur-up lazyload" alt="">
                                    <div>
                                        <h5 class="font-light">total borrowing</h5>
                                        <h3 class="text-dark">{{ $borrow_total }}</h3>
                                    </div>
                                </div>
                            </div>

                        </a>
                    </div>




                </div>
            </div>


        </div>
    </div>

</div>
