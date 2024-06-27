@extends('layouts.layout_login')

@section('content_login')
<div id="logreg-forms">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal" style="text-align: center">Đăng nhập</h1>
        <div class="social-login">
            <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign
                    in with Facebook</span> </button>
            <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign
                    in with Google+</span> </button>
        </div>
        <p style="text-align:center"> OR </p>

        <input id="email" id="inputEmail" type="email"
            class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
            required autocomplete="email" autofocus>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <input id="password" id="inputPassword" type="password"
            class="form-control @error('password') is-invalid @enderror" name="password" required
            autocomplete="current-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div>
        <div class="row mb-0">
            <div class="col-md-12">
                <button type="submit" class="btn btn-success btn-block">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </div>
        <hr>
        <!-- <p>Don't have an account!</p>  -->
        <a class="" href="{{ route('register') }}"><i class="fas fa-user-plus"></i>
            Tạo tài khoản mới</a>
    </form>
    <br>

</div>
@endsection
