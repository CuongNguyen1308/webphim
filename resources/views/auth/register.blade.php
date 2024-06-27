@extends('layouts.layout_login')

@section('content_login')
    <div id="logreg-forms">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center">Đăng ký</h1>
            <div class="social-login">
                <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign
                        in with Facebook</span> </button>
                <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign
                        in with Google+</span> </button>
            </div>
            <p style="text-align:center"> OR </p>


            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nhập tên...">

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror



            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" placeholder="Nhập email...">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror



            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password" placeholder="Nhập mật khẩu...">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror



            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password" placeholder="Nhập lại mật khẩu...">


            <div class="row mb-0">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
            <hr>
            <!-- <p>Don't have an account!</p>  -->
            <a class="" href="{{ route('login') }}">
                Đã có tài khoản đăng nhập ngay</a>
        </form>
        <br>

    </div>
@endsection
