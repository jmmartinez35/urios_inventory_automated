@extends('layouts.admin.index')
@section('content')
    <div class="row">
        
        <livewire:admin.items />
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
