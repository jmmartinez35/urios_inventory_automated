<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none " id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="text-white    " href="javascript:;"><strong>FUAMI BORROWING
                            TRANSACTION</strong></a></li>


            </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            </div>
            <ul class="navbar-nav  justify-content-end">

                <li class="nav-item dropdown mx-3 pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body  font-weight-bold p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user me-sm-1 text-white"></i>
                        <span class="d-sm-inline text-white d-none">
                            Welcome {{ ucfirst(Auth::user()->username) }}
                        </span>
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                        aria-labelledby="dropdownMenuButton">
                        <li class="mb-0">
                            {{-- profile --}}
                            <a href="{{ route('dashboard') }}" class="btn  mb-0 btn-sm w-100 mb-2">Inventory</a>

                        </li>
                        <li class="mb-0">
                            <a class="btn btn-outline-danger mb-0 btn-sm w-100" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                                <i class="mdi mdi-logout text-primary"></i>

                                {{ __('Logout') }}

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                            </a>

                        </li>

                    </ul>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 d-flex d-none align-items-center ">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<livewire:admin.borrowing.util.index  />
     
