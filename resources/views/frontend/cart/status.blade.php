@extends('layouts.user.index')

@section('content')
<livewire:frontend.borrower.status :users="$users" :details="$details" :borID="$borID" :barcode="$barcode" :borreturn="$borreturn" :remarks="$remarks"  />
     
@endsection
