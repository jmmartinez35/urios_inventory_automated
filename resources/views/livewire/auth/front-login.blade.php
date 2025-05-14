<div class="login-wrapper shadow" style="width:100%">
    <div class="d-flex justify-content-center login-title">
        <h5>{{ __('LOGIN ') }}</h5>
    </div>
    <div class="login-container m-4">
        <form method="POST" wire:submit.prevent="loginCustom">
            @csrf
            <div class="mb-3">
                <label for="login" class="col-md-12 col-form-label ">{{ __('Username or Email Address') }}</label>
                <input id="login" type="text" class="form-control @error('login') is-invalid @enderror"
                    wire:model="login" value="{{ old('login') }}" required autocomplete="login" autofocus>

                @error('login')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="col-md-4 col-form-label ">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    wire:model="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3 d-flex justify-content-center align-items-center rmb">
                <div class="form-check w-100">

                    <a class="btn btn-link" href="{{ route('register.custom') }}">
                        <small> {{ __('Register') }}</small>
                    </a>
                </div>
                <div class="form-check">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            <small> {{ __('Forgot Your Password?') }}</small>
                        </a>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-login-c mb-3">
                {{ __('Sign In') }}
            </button>
        </form>

    </div>
</div>
