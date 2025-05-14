@extends('layouts.user.index')

@section('content')

@include('frontend.cart.banner')

<livewire:frontend.borrower.index  />
     
@endsection