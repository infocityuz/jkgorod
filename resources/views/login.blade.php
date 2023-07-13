<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>{{__('locale.login')}}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/css/adminlte.min.css')}}">
    <style>
        .error-data{
            color: #dc3545;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{__('locale.login')}}</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-1">
                    <input id="email" type="email" placeholder="{{__('locale.email')}}" class="form-control @error('email')  error-data-input is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>

                </div>
                <div class="mb-2">
                    <span class="error-data">@error('email'){{$message}}@enderror</span>
                </div>
                <div class="input-group mb-1">
                    <input id="password" type="password"  placeholder="{{__('locale.password')}}" class="form-control @error('password') error-data-input is-invalid @enderror" name="password" required autocomplete="current-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>

                </div>
                <div class="mb-2">
                    <span class="error-data">@error('password'){{$message}}@enderror</span>
                </div>

                <style>
                    .mathcaptcha-label-input{
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                    }
                    .mathcaptcha-label{
                        font-size: 18px;
                        margin: 0;
                    }
                    .mathcaptcha-input{
                        width: 60%;

                    }
                    .reload{
                        background: transparent;
                        border: 0;
                    }
                </style>

                    {{-- Пожалуйста, решите следующую математическую функцию: --}}
                    <div class="form-group mathcaptcha-label-input">
                        <button type="button"  class="reload" id="reload">&#x21bb;</button>
                        <label for="mathgroup" class="mathcaptcha-label"> {{ app('mathcaptcha')->label() }}</label> =
                        {!! app('mathcaptcha')->input(['class' => 'form-control mathcaptcha-input', 'id' => 'mathgroup','placeholder'=>'Ваш ответ']) !!}
                    </div>
                    <div class="mb-2">
                        @if ($errors->has('mathcaptcha'))
                            <span class="error-data" id="has-error-message">
                                <strong>Код подтверждения недействителен.</strong>
                            </span>
                        @endif
                    </div>

                <div class="icheck-primary">
                    <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('locale.remember_me') }}
                    </label>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                         <button type="submit" class="btn btn-primary btn-block">{{__('locale.login')}}</button>
                    </div>
                </div>
            </form>

{{--            <div class="social-auth-links text-center mb-3">--}}
{{--                <p>- OR -</p>--}}
{{--                <a href="#" class="btn btn-block btn-danger">--}}
{{--                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+--}}
{{--                </a>--}}
{{--            </div>--}}

            <p class="mb-1">
                <a href="{{ route('password.request') }}">{{__('locale.i_forgot_my_password')}}</a>
            </p>
            <p class="mb-0">
                <a href="{{ route('register') }}" class="text-center">{{__('locale.registration')}}</a>
            </p>
        </div>
    </div>
</div>

<script src="{{asset('/backend-assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/backend-assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/backend-assets/js/adminlte.js')}}"></script>
<script>
    $('#reload').click(function () {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'GET',
            url: '/reload-captcha',
            dataType: "json",
            success: function (data) {
                // console.log(data);
                // $(".captcha span").html(data.captcha);
                $('.mathcaptcha-label').text(data);
            },
            error: function (error) {
                // console.log(error);
            }
        });
    });
</script>

</body>
</html>
