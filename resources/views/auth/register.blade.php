@extends('layouts.user.index')

@section('content')
    <style>
        .register-bg-wrapper {
            background: linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.7)),
                url('{{ asset('images/hero.webp') }}') no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
        }
    </style>
    <div class="register-bg-wrapper">
        <div class="container">
            <div class="row justify-content-center ">

                <div class="d-flex justify-content-center mt-5">
                    <img class="register-logo-avatar" src="{{ asset('assets/images/smcc-logo.png') }}" alt="">
                </div>

                <div class="col-md-auto register-wrapper shadow">
                    <div class="d-flex justify-content-center login-title">
                        <h5>{{ __('REGISTER') }}</h5>
                    </div>
                    <div class="register-container mt-3 m-4">
                        <livewire:auth.custom-registration />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
