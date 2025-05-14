<div class="col-lg-3">

    <ul class="nav nav-tabs custome-nav-tabs flex-column category-option" id="myTab">
        <li class="nav-item mb-2">
            <a class="nav-link font-light {{ Request::is('myaccount/dashboard') ? 'active' : '' }}" href="{{ route('myaccount.dashboard') }}"><i
                    class="fas fa-angle-right"></i>Dashboard</a>
        </li>

       
        <li class="nav-item mb-2">
            <a class="nav-link font-light {{ Request::is('myaccount/profile') ? 'active' : '' }}" href="{{ route('myaccount.profile') }}"><i
                    class="fas fa-angle-right"></i>Profile</a>
        </li>

        <li class="nav-item">
            <a class="nav-link font-light {{ Request::is('myaccount/borrowed') ? 'active' : '' }}" href="{{ route('myaccount.borrowed') }}"><i
                    class="fas fa-angle-right"></i>Borrowed</a>
        </li>
    </ul>
</div>
