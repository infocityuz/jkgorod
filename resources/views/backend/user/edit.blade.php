@extends('layouts.backend')
@section('title')
    {{__('locale.user')}} {{__('locale.edit')}}
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/bootstrap-datetimepicker.min.css')}}">
@endsection
@section('content')
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{__('locale.user')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('backend.index', app()->getLocale())}}">{{__('locale.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('user.index', app()->getLocale())}}">{{__('locale.user')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.edit')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{route('user.update',['language'=>app()->getLocale(),$model->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="first_name">{{__('locale.first_name')}}</label>
                            <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') error-data-input is-invalid @enderror" value="{{ $model->first_name, old('first_name') }}" required>
                            <span class="error-data">@error('first_name'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="last_name">{{__('locale.last_name')}}</label>
                            <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') error-data-input is-invalid @enderror" value="{{$model->last_name, old('last_name') }}" required>
                            <span class="error-data">@error('last_name'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="last_name">{{__('locale.middle_name')}}</label>
                            <input type="text" name="middle_name" id="middle_name"
                                   class="form-control @error('middle_name') error-data-input is-invalid @enderror"
                                   value="{{ $model->middle_name, old('middle_name') }}">
                            <span class="error-data">@error('middle_name'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('locale.email')}}</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') error-data-input is-invalid @enderror" value="{{ $model->email, old('email') }}" required>
                            <span class="error-data">@error('email'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="role_id">{{__('locale.role')}}</label>
                            <select name="role_id" id="role_id"  data-placeholder="{{__('locale.role')}}" class="form-control select2 @error('role_id') is-invalid error-data-input @enderror" >
                                @if(!empty($roles))
                                    <option value="">---------------------</option>
                                    @foreach($roles as $role)
                                        @if($model->role_id == $role->id)
                                            <option value="{{$role->id}}" selected>{{$role->name}}</option>
                                        @endif
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="error-data">@error('role_id'){{$message}}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="status">{{__('locale.status')}}</label>
                            <select name="status" id="status"  data-placeholder="{{__('locale.select')}}" class="form-control select2 @error('status') is-invalid error-data-input @enderror" >
                                <option value="1" {{$model->status == 1 ? 'selected' : ''}}>{{__('locale.active')}}</option>
                                <option value="0" {{$model->status == 0 ? 'selected' : ''}}>{{__('locale.no_active')}}</option>
                            </select>
                            <span class="error-data">@error('status'){{$message}}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="current_password">{{__('locale.current_password')}}</label>
                            <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') error-data-input is-invalid @enderror" value="{{ old('current_password') }}" >
                            <span class="error-data">@error('current_password'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="password">{{__('locale.password')}}</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') error-data-input is-invalid @enderror" value="{{ old('password') }}" >
                            <span class="error-data">@error('password'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">{{__('locale.password_confirmation')}}</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') error-data-input is-invalid @enderror" value="{{ old('password_confirmation') }}" >
                            <span class="error-data">@error('password_confirmation'){{$message}}@enderror</span>
                        </div>

                        <div class="form-group ">
                            <label for="images">{{__('locale.image')}}</label>
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
                                <label class="custom-file-label" for="avatar">{{__('locale.image')}}</label>
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
                    <button type="submit" class="btn btn-success">{{__('locale.update')}}</button>
                </div>
            </div>
        </div>

    </form>


@endsection


@section('scripts')
    <script src="{{asset('/backend-assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <script>
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
