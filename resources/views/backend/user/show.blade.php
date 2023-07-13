@extends('layouts.backend')
@section('title')  {{__('locale.user')}}  {{__('locale.view')}} @endsection

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
                            <li class="breadcrumb-item"><a href="{{route('apartment-sale.index', app()->getLocale())}}">{{__('locale.user')}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.view')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-block table-border-style">
            <table class="table table-borderet table-hover">
                <thead >
                <tr>
                    <th>#</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{__('locale.first_name')}}</td>
                    <td>{{$model->first_name}}</td>
                </tr>
                <tr>
                    <td>{{__('locale.last_name')}}</td>
                    <td>{{$model->last_name}}</td>
                </tr>
                <tr>
                    <td>{{__('locale.middle_name')}}</td>
                    <td>{{$model->middle_name}}</td>
                </tr>
                <tr>
                    <td>{{__('locale.email')}}</td>
                    <td>{{$model->email}}</td>
                </tr>
                <tr>
                    <td>{{__('locale.role')}}</td>
                    <td>
                        @if(!empty($model->role->name))
                            {{$model->role->name}}
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
            {{--    <div class="action-content-view container" style="padding-bottom: 25px">--}}

            {{--        <a href="{{route('apartment-sale.index')}}" class="btn btn-primary" title="cancel">--}}
            {{--            cancel--}}
            {{--        </a>--}}
            {{--        <a href="{{route('apartment-sale.edit',$model->id)}}" class="btn btn-success" title="update">--}}
            {{--            update--}}
            {{--        </a>--}}
            {{--        <form style="display: inline-block;" action="{{route('apartment-sale.destroy',$model->id)}}" method="POST">--}}
            {{--            @csrf--}}
            {{--            @method('DELETE')--}}
            {{--            <button type="submit" id="delete-data-item" class="btn btn-danger" title="delete">--}}
            {{--                <i class="ti-trash"></i> delete--}}
            {{--            </button>--}}
            {{--        </form>--}}

            {{--    </div>--}}


            @endsection

            @section('scripts')
                <script>

                </script>
@endsection







