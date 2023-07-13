@extends('layouts.backend')
@section('title')  {{__('locale.action_logs')}}  {{__('locale.view')}} @endsection

@section('content')

    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{__('locale.action_logs')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('backend.index', app()->getLocale())}}">{{__('locale.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('action-logs.index', app()->getLocale())}}">{{__('locale.action_logs')}}</a></li>
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
            <td>@if($model->user->first_name){{$model->user->first_name}}@endif</td>
          </tr>
          <tr>
              <td>{{__('locale.last_name')}}</td>
              <td>@if($model->user->last_name){{$model->user->last_name}}@endif</td>
          </tr>
          <tr>
              <td>{{__('locale.middle_name')}}</td>
              <td>{{$model->user->middle_name}}</td>
          </tr>
          <tr>
              <td>{{__('locale.message')}}</td>
              <td>{{$model->message}}</td>
          </tr>
          <tr>
              <td>{{__('locale.user_agent')}}</td>
              <td>{{$model->user_agent}}</td>
          </tr>
          <tr>
              <td>{{__('locale.created_at')}}</td>
              <td>{{$model->record_datetime}}</td>
          </tr>

      </tbody>
  </table>
@endsection

@section('scripts')
  <script>

  </script>
@endsection







