@extends('forthebuilder::layouts.forthebuilder')

@section('title')
    {{__('locale.create')}}
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/bootstrap-datetimepicker.min.css')}}">

    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/kartik-v-bootstrap-fileinput/css/fileinput.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous">

@endsection
@section('content')
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{__('locale.task')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.index')}}">{{__('locale.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.task.index')}}">{{__('locale.task')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.create')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form  id="" action="{{route('forthebuilder.task.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="title">{{__('locale.title')}}</label>
                            <input type="text" name="title" id="title"
                                   class="form-control @error('title') error-data-input is-invalid @enderror"
                                   value="{{ old('title') }}">
                            <span class="error-data">@error('title'){{$message}}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="performer_id">{{__('locale.task_user_id')}}</label>
                            <select name="performer_id" id="performer_id"
                                    data-placeholder="{{__('locale.select')}}"
                                    class="form-control select2 @error('performer_id') is-invalid error-data-input @enderror" >
                                <option value="">------------</option>
                                @empty(!$users)
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ (Auth::user()->id == $user->id) ? 'selected' : '' }}>{{ $user->first_name }}</option>
                                    @endforeach
                                @endempty
                            </select>
                            <span class="error-data">@error('performer_id'){{$message}}@enderror</span>
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label for="performer_id">{{__('locale.performer_id')}}</label>--}}
{{--                            <select name="performer_id" id="performer_id"--}}
{{--                                    data-placeholder="{{__('locale.select')}}"--}}
{{--                                    class="form-control select2 @error('performer_id') is-invalid error-data-input @enderror" >--}}
{{--                                <option value="">------------</option>--}}
{{--                                @empty(!$users)--}}
{{--                                    @foreach($users as $user)--}}
{{--                                        <option value="{{ $user->id }}" >{{ $user->first_name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                @endempty--}}
{{--                            </select>--}}
{{--                            <span class="error-data">@error('performer_id'){{$message}}@enderror</span>--}}
{{--                        </div>--}}

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="type">{{__('locale.type')}}</label>
                            <select name="type" id="type"
                                    data-placeholder="{{__('locale.select')}}"
                                    class="form-control select2 @error('type') is-invalid error-data-input @enderror" >
                                <option value="Связаться">Связаться</option>
                                <option value="Встреча">Встреча</option>
                                <option value="Внедрение">Внедрение</option>
                            </select>
                            <span class="error-data">@error('type'){{$message}}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="task_date">{{__('locale.task_date')}}</label>
                            <input type="text" name="task_date" id="task_date"
                                   class="form-control @error('task_date') error-data-input is-invalid @enderror"
                                   value="{{ old('task_date') }}" required>
                            <span class="error-data">@error('task_date'){{$message}}@enderror</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card-footer justify-content-end" style="">
                    <button type="submit" class="btn btn-success">{{__('locale.create')}}</button>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('scripts')
    <script src="{{asset('/backend-assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/bootstrap-datetimepicker.js')}}"></script>
    <script>
        let page_name = 'tasks';
        $('#task_date').datetimepicker({
            format: 'Y-M-D',
        });
    </script>
@endsection




