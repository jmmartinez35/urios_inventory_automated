@extends('layouts.admin.index')
@section('content')
<style>
    .dropdown-toggle::after {
      display: none !important;
    }
  
    .dropdown-toggle i {
      font-weight: bold !important;
    }
  </style>
    <div class="row">
        <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <h4 class="card-title">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0 font-weight-bold text-muted">USERS PENDING</h5>
                            <a href="" class="btn bg-gradient-primary d-none"><i class="fa fa-plus-square"></i>&nbsp;ADD
                                NEW RESOURCE</a>
                        </div>
                    </h4>
                    @livewire('admin.user.pending')
                </div>
            </div>
        </div>
    </div>
@endsection
