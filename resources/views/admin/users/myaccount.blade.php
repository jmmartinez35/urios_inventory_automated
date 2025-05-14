@extends('layouts.admin.index')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <h4 class="card-title">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0 font-weight-bold text-muted">ADMINISTRATOR ACCOUNT MANAGEMENT</h5>

                        </div>
                    </h4>
                    @livewire('admin.user.myaccount')
                </div>
            </div>
        </div>
    </div>
@endsection
