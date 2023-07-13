@extends('forthebuilder::layouts.forthebuilder')

@section('title') {{__("locale.show")}} @endsection

@section('content')

<div class="page-header card">
</div>
<div class="card">
<div class="content-header">
  <div class="container-fluid card-block">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">{{__("locale.leads")}}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('forthebuilder.index')}}">{{__("locale.home")}}</a></li>
          <li class="breadcrumb-item"><a href="{{route('forthebuilder.lead-status.index')}}">{{__("locale.lead-status")}}</a></li>
          <li class="breadcrumb-item active">{{__("locale.show")}}</li>
        </ol>
      </div>
    </div>
  </div>
</div>

</div>

<div class="card">
    <div class="card-body">
    <div class="card-block table-border-style">
          <table class="table table-bordered table-hover">
              <thead >
                  <tr>
                      <th>Атрибут</th>
                      <th>Данные</th>
                  </tr>
              </thead>
              <tbody>

                  <tr>
                      <td><b>{{__("locale.name")}}</b></td>
                      <td>{{$model->name}}</td>
                  </tr>
                  <tr>
                      <td><b>{{__("locale.order")}}</b></td>
                      <td>{{$model->order}}</td>
                  </tr>

              </tbody>
          </table>

        </div>
    </div>
</div>
<script>
    let page_name = 'lead-status';
</script>
@endsection
@section('scripts')
  <script>

  </script>
@endsection







