@extends('forthebuilder::layouts.forthebuilder')

@section('title')
    {{translate('User edit')}}
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('/backend-assets/forthebuilders/select/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/forthebuilders/select2-bootstrap4-theme/css/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/forthebuilders/bootstrap-datetimepicker.min.css')}}">
@endsection
@section('content')
    <div class="d-flex aad">
        @include('forthebuilder::layouts.content.navigation')
        <div class="mainMargin">
            @include('forthebuilder::layouts.content.header')

            <form action="{{route('forthebuilder.user.update',$model->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="first_name">{{translate('Firstname')}}</label>
                            <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') error-data-input is-invalid @enderror" value="{{ $model->first_name, old('first_name') }}" required>
                            <span class="error-data">@error('first_name'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="last_name">{{translate('Lastname')}}</label>
                            <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') error-data-input is-invalid @enderror" value="{{$model->last_name, old('last_name') }}" required>
                            <span class="error-data">@error('last_name'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="last_name">{{translate('Middlename')}}</label>
                            <input type="text" name="middle_name" id="middle_name" class="form-control @error('middle_name') error-data-input is-invalid @enderror" value="{{ $model->middle_name, old('middle_name') }}">
                            <span class="error-data">@error('middle_name'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="email">{{translate('Email')}}</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') error-data-input is-invalid @enderror" value="{{ $model->email, old('email') }}" required>
                            <span class="error-data">@error('email'){{$message}}@enderror</span>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div class="form-group">
                                <label for="birth_date">{{ translate('Birth date') }}</label> <br>
                                <input name="birth_date" id="birth_date"
                                       class="sozdatImyaSpisokInput1272 @error('birth_date') error-data-input is-invalid @enderror"
                                       value="{{$model->birth_date, old('birth_date') }}" type="date">
                            </div>
                            <div class="form-group">
                                <label for="phone_number">{{ translate('Phone number') }}</label> <br>
                                <label id="phone_number" style="margin-bottom: -35px;z-index: 99;width: 50px;margin-left: 5px;margin-right: -55px;position: sticky;margin-top: 13px;padding-left: 6px;"
                                       for="+998">+998</label>
                                <input name="phone_number" style="padding-left: 54px" maxlength="9"
                                       class="sozdatImyaSpisokInput1272 @error('phone_number') error-data-input is-invalid @enderror"
                                       value="{{$model->phone_number, old('phone_number') }}" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role_id">{{translate('Role')}}</label>
                            <select name="role_id" id="role_id"  data-placeholder="{{__('locale.role')}}" class="form-control select2 @error('role_id') is-invalid error-data-input @enderror" >
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}" {{$model->role_id == $role->id ? 'selected' : ''}}>{{$role->name}}</option>
                                @endforeach
                            </select>
                            <span class="error-data">@error('role_id'){{$message}}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="status">{{translate('status')}}</label>
                            <select name="status" id="status"  data-placeholder="{{__('locale.select')}}" class="form-control select2 @error('status') is-invalid error-data-input @enderror" >
                                <option value="2" {{$model->status == 2 ? 'selected' : ''}}>{{__('locale.active')}}</option>
                                <option value="0" {{$model->status == 0 ? 'selected' : ''}}>{{__('locale.no_active')}}</option>
                            </select>
                            <span class="error-data">@error('status'){{$message}}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="current_password">{{translate('Current password')}}</label>
                            <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') error-data-input is-invalid @enderror" value="{{ old('current_password') }}" >
                            <span class="error-data">@error('current_password'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="password">{{translate('Password')}}</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') error-data-input is-invalid @enderror" value="{{ old('password') }}" >
                            <span class="error-data">@error('password'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">{{translate('Password confirmation')}}</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') error-data-input is-invalid @enderror" value="{{ old('password_confirmation') }}" >
                            <span class="error-data">@error('password_confirmation'){{$message}}@enderror</span>
                        </div>

                        <div class="form-group ">
                            <label for="images">{{translate('Image')}}</label>
                            <style>
                                img{
                                    width: 200px;
                                    height: 200px;
                                    margin-bottom: 10px;
                                }
                            </style>
                            <div id="preView">
                                <img src="{{ asset('/uploads/user/'.$model->id.'/s_'.$model->avatar)}}" alt="" id="oldImage">
                            </div>
                            <div class="custom-file">
                                <input type="file" name="avatar" class="custom-file-input" id="uavatar">
                                <label class="custom-file-label" for="avatar">{{translate('Image')}}</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{--            <div class="col-md-4">--}}
            {{--                <div class="card card-primary">--}}
            {{--                    <div class="card-body">--}}
            {{--                        --}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-footer justify-content-end" style="">
                    <button type="submit" class="btn btn-success">{{translate('Update')}}</button>
                </div>
            </div>
        </div>

    </form>
        </div>
    </div>
    <script src="{{asset('/backend-assets/forthebuilders/select/js/select2.full.min.js')}}"></script>
    <script src="{{asset('/backend-assets/forthebuilders/moment/js/moment.min.js')}}"></script>
    <script src="{{asset('/backend-assets/forthebuilders/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('/backend-assets/forthebuilders/inputmask/jquery.inputmask.min.js')}}"></script>
    <script>
        let page_name = 'user';
        $(document).ready(function () {
            // $('#year_constructionId').datetimepicker({
            //     format: 'Y-M-D',
            // });
            $("#year_constructioninputid").inputmask("9999-99-99",{ "placeholder": "yyyy-mm-dd" });
            //
            // avatar.onchange = evt => {
            //
            //     const [file] = avatar.files
            //     $("#preViewImg").remove();
            //     $("#oldImage").remove();
            //     if (file){
            //         const preViewDiv = $('#preView');
            //         preViewDiv.append(`<img src='${URL.createObjectURL(file)}' id='preViewImg'>`)
            //     }
            //
            // }


            $('#uavatar').on('change',function (){
                // const [file] = uavatar.files
                let file = $("input[type=file]").get(0).files[0];
                $("#preViewImg").remove();
                $("#oldImage").remove();
                if (file){
                    const preViewDiv = $('#preView');
                    preViewDiv.append(`<img src='${URL.createObjectURL(file)}' id='preViewImg'>`)
                }

            });

        });


    </script>
@endsection



