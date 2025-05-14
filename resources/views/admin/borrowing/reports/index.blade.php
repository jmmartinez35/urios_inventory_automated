@extends('layouts.admin.index')
@section('content')
    <style>
        /* Scoped styles for borrow tabs */
        .borrow-tabs .nav-tabs {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .borrow-tabs .nav-tabs .nav-item {
            flex: 1 1 auto;
            text-align: center;
        }

        .borrow-tabs .nav-tabs .nav-linkx {
            display: block;
            padding: 10px;
            text-align: center;
            width: 100%;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .borrow-tabs .nav-tabs {
                flex-wrap: wrap;
            }

            .borrow-tabs .nav-tabs .nav-item {
                flex: 1 1 50%;
                /* Two items per row */
            }

            .borrow-tabs .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
    <div class="row">
    </div>
    <div class="row">
        <livewire:admin.borrowing.report />
    </div>
    <style>
        .dropdown-toggle::after {
            display: none !important;
        }

        .dropdown-toggle i {
            font-weight: bold !important;
        }
    </style>
@endsection
