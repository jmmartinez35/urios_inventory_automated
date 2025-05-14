@php
    use Illuminate\Support\Facades\Auth;
@endphp

<div class="text-white mt-0 mx-0 d-flex justify-content-end align-items-center">

    @if (Auth::check() && Auth::user()->role_as == 1)
        {{-- Admin View --}}
        @if ($name_str != '')
            <a href="{{ url('admin/dashboard') }}" class="text-white">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="text-center">Hi, <strong>{{ Str::ucfirst($name_str ?? 'Admin') }}</strong></h3>
                    </div>
                    <div class="col-sm-12">
                        <p class="text-center">(Admin)</p>
                    </div>
                </div>
            </a>
        @else
            <a href="{{ url('admin/dashboard') }}" class="text-white pl-5">Admin Session </a>
        @endif
    @else
        {{-- Regular User View --}}
        @if ($name_str != '')
            <a href="{{ route('myaccount.dashboard') }}" class="text-white">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="text-center">Hi, <strong>{{ Str::ucfirst($name_str ?? 'User') }}</strong></h3>
                    </div>
                    <div class="col-sm-12">
                        <p class="text-center">({{ Str::ucfirst($pos_str ?? 'No Position') }})</p>
                    </div>
                </div>
            </a>
        @else
            <a href="{{ route('myaccount.profile') }}">Incomplete details.</a>
        @endif
    @endif

</div>
