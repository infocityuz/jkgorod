@extends('forthebuilder::layouts.forthebuilder')

@section('title') {{__('locale.Status Colors')}} @endsection
@section('styles')
  	<link rel="stylesheet" href="{{asset('/backend-assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
@endsection
@section('content')


<div class="page-header card">
</div>
<div class="card">
    <div class="content-header">
        <div class="container-fluid card-block">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{__('locale.Status Colors')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('forthebuilder.index')}}">{{__('locale.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('locale.Status Colors')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
        <table id="dashboard_datatable" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>{{__('locale.Status')}}</th>
                <th>{{__('locale.Colors')}}</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($models))
                @foreach($models as $key => $model)
                    <tr>
                        <td scope="row">{{ $models->firstItem()+$key }}</td>
                        <!-- <td>{{ $model->status; }}</td> -->
                        <td> @if($model->status == 0) {{ __("locale.Free") }} @elseif($model->status == 1) {{ __("locale.Busy") }} @else {{ __("locale.Sales") }} @endif </td>
                        <td>
                        	<div style="width: 50px; height: 50px; background-color: {{ $model->color; }};"></div>
                        </td>
                        <td>
                            <div style="text-align: center;">
                                <a href="{{route('forthebuilder.status-colors.edit', $model->id)}}" class="btn btn-primary" title="update"><i class="fas fa-pencil-alt"></i></a>
                            </div>
                        </td>
                    </tr>

                    
                @endforeach
            @endif
            </tbody>
        </table>
          <div class="mt-2">
              {{ $models->links() }}
          </div>
        </div>
    </div>

</div>


@endsection

@section('scripts')
<script src="{{asset('/backend-assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script>
    let page_name = 'status-colors';
	$(document).ready(function() {
		$('.my-colorpicker1').colorpicker()
	})
</script>
@endsection