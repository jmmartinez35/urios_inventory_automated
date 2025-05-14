@extends('layouts.admin.index')
@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-6 mb-xl-0 mt-3 mb-5 row">
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <a href="{{ route('borrowing.history') }}#pending">
                    <div class="card ">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Borrow Pending</p>
                                        <h3 class="font-weight-bolder mb-0 {{ $borrow_pending != 0 ? 'text-danger' : '' }}">
                                            {{ $borrow_pending }}
                                        </h3>
                                        
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <a href="{{ route('borrowing.history') }}#approved">
                    <div class="card ">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Borrow Approved</p>
                                        <h3 class="font-weight-bolder mb-0 ">
                                            {{ $borrow_approved }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <a href="{{ route('borrowing.history') }}#cancelled">
                    <div class="card ">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Borrow Cancelled</p>
                                        <h3 class="font-weight-bolder mb-0 ">
                                            {{ $borrow_cancel }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>


        <div class="col-xl-12 col-sm-6 mb-xl-0 mt-3 mb-5 row">
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <a href="{{ route('items') }}">
                    <div class="card ">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Items Total</p>
                                        <h3 class="font-weight-bolder mb-0 ">
                                            {{ $items }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <a href="{{ route('users.pending') }}">
                    <div class="card ">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Users Pending</p>
                                        <h3 class="font-weight-bolder mb-0 ">
                                            {{ $userPending }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <a href="{{ route('users.management') }}">
                    <div class="card ">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Users Total</p>
                                        <h3 class="font-weight-bolder mb-0 ">
                                            {{ $user }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


        </div>

        <div class="col-xl-12 col-sm-6 mb-xl-0 mt-3 mb-5 row">
            
            <livewire:admin.dashboard.dashboard-graph />
    

        </div>

   
    @endsection
