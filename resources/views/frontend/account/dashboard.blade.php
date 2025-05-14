@extends('layouts.user.index')


@section('content')
    <!-- user dashboard section start -->
    <section class="section-b-space">
        <div class="container">
            <div class="row">
                @include('frontend.account.sidebar')

                <livewire:frontend.account.dashboard />
            </div>
        </div>
    </section>

    <!-- user dashboard section end -->
@endsection
