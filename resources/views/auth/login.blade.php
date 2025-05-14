@extends('layouts.user.index')

@section('content')
    <style>
        .login-bg-wrapper {
            background: linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.7)),
                        url('{{ asset('images/hero.webp') }}') no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
        }
    </style>
    <div class="login-bg-wrapper">
        <div class="container ">

            <div class="row justify-content-center ">

                <div class="d-flex justify-content-center " style="margin-top:50px">
                    <img class="login-logo-avatar" src="{{ asset('images/logo-clear.png') }}" alt="">
                </div>

                <div class="col-md-auto login-wrapper shadow " >
                    <div class="d-flex justify-content-center login-title">
                        <h5>{{ __('LOGIN') }}</h5>
                    </div>
                    <div class="login-container mt-5 m-4" >
                        <livewire:auth.custom-login />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
