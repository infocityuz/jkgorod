
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title>{{__('locale.login')}}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/css/login.css')}}">
    {{-- <title>ItKey CRM</title> --}}
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
            /* background-color: none; */
            box-shadow: none;
        }
        .error-data{
            color: #dc3545;
        }
        .color{
           color: #F9FBFF !important;
        }
    </style>
</head>

{{-- IP address for captcha --}}

{{-- {{ getIp()}} --}}
{{-- {{$clientIP = \Request::ip()}}
@dd($clientIP) --}}
<body>
    <div class="login_father">
        <div class="login_box">
            <form method="POST" class="mt-2" action="{{ route('login') }}">
                @csrf
                {{-- <input placeholder="Эл. адрес" class="login_mail" type="text"> --}}
                {{-- <input placeholder="Пароль" class="login_mail" type="text"> --}}

                <input id="email" type="email" placeholder="{{__('locale.email')}}" class="form-control login_mail @error('email')  error-data-input is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                <input id="password" type="password"  placeholder="{{__('locale.password')}}" class="form-control login_mail @error('password') error-data-input is-invalid @enderror" name="password" required autocomplete="current-password">



                <div class="form-group mathcaptcha-label-input ">
                    <button type="button"  class="reload  p-0 " id="reload">&#x21bb;</button>
                    <label for="mathgroup" class="mathcaptcha-label mx-3"> {{ app('mathcaptcha')->label() }}</label> =
                    {!! app('mathcaptcha')->input(['class' => 'form-control mathcaptcha-input ', 'id' => 'mathgroup','placeholder'=>'Ваш ответ']) !!}
                </div>
                <div class="mb-2">
                    @if ($errors->has('mathcaptcha'))
                        <span class="error-data" id="has-error-message">
                            <strong>{{translate('Verification code is invalid')}}</strong>
                        </span>
                    @endif
                </div>
                <div class="icheck-primary mt-3 text-center color  ">
                    <input class="color" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{-- {{ __('locale.remember_me') }} --}}
                        {{translate('Remember me')}}
                    </label>
                </div>
                <div class="voytiDiv ">
                    <button>{{translate('login')}}</button>
                </div>
            </form>
            <p class="text-center  mt-2">
                <a class="color" href="{{ route('password.request') }}">{{translate('Forgot password')}}</a>
            </p>
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


