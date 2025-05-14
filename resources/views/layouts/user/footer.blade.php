<footer class="footer-sm-space ">
    <div class="main-footer">
        <div class="container">
            <div class="row gy-4">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="footer-contact">
                        <div class="brand-logo">
                            <a href="{{ url('/') }}" class="footer-logo float-start">
                                <img src="{{ asset('images/logo-clear.png') }}" class="f-logo img-fluid blur-up lazyload"
                                    alt="logo">
                            </a>
                        </div>
                        <ul class="contact-lists" style="clear:both;">

                            <li>
                                <span><b>Address:</b><span class="font-light">P-5 Brgy. Buhang, Magallanes, Agusan Del
                                        Norte , Magallanes, Philippines</span></span>
                            </li>

                        </ul>
                    </div>
                </div>
                {{-- hide section --}}
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 ">

                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="footer-links">
                        <div class="footer-title">
                            <h3>About us</h3>
                        </div>
                        <div class="footer-content">
                            <ul>
                                <li>
                                    <a href="{{ route('home') }}" class="font-dark">Home</a>
                                </li>
                                @guest
                                    <li>
                                        <a href="{{ route('register.custom') }}" class="font-dark">Register</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('login.custom') }}" class="font-dark">Login</a>
                                    </li>
                                @endguest
                                @auth
                                <li>
                                    <a href="{{ route('myaccount.dashboard') }}" class="font-dark">My Account</a>
                                </li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">

                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6 d-none d-sm-block">

                </div>
            </div>
        </div>
    </div>
    <div class="sub-footer">
        <div class="container">
            <div class="row gy-3">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">
                    <p class="mb-0 font-dark">&copy;{{ date('Y') }} {{ config('app.name', '') }}</p>
                </div>
            </div>
        </div>
    </div>
</footer>
