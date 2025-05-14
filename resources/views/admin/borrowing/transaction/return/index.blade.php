@extends('layouts.borrowing.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.borrowing.transaction.return-trans')
    </div>
@endsection
