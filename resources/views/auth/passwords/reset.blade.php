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
            <p class="login-box-msg">{{__('locale.reset_password')}}</p>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="input-group mb-1">
                            <input type="email" name="email" id="email" placeholder="{{__('locale.email')}}" class="form-control @error('email')  error-data-input is-invalid @enderror"  value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus readonly>
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
                            <input  type="password" name="password" id="password"  placeholder="{{__('locale.new_password')}}" class="form-control @error('password') error-data-input is-invalid @enderror" required autocomplete="new-password">


                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>

                        </div>
                        <div class="mb-2">
                            <span class="error-data">@error('password'){{$message}}@enderror</span>
                        </div>


                        <div class="input-group mb-1">
                            <input id="password-confirm" type="password"  placeholder="{{__('locale.password_confirmation')}}" class="form-control @error('password_confirmation') error-data-input is-invalid @enderror" name="password_confirmation" required autocomplete="current-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>

                        </div>
                        <div class="mb-2">
                            <span class="error-data">@error('password_confirmation'){{$message}}@enderror</span>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                 <button type="submit" class="btn btn-primary btn-block">{{__('locale.reset_password')}}</button>
                            </div>
                        </div>
                    </form>


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



