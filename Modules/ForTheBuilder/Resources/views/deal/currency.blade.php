@extends('forthebuilder::layouts.forthebuilder')

@section('title') {{__("locale.show")}} @endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/owlcarousel/owl.carousel.min.css')}}">
@endsection

@section('content')

    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{__("locale.deal")}} {{__("locale.show")}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.index')}}">{{__("locale.home")}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('forthebuilder.deal.index')}}">{{__("locale.deal")}}</a></li>
                            <li class="breadcrumb-item active">{{__('locale.show')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <form action="">
            <input type="text">
        </form>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('/backend-assets/plugins/select2/js/select2.full.min.js')}}"></script>

    <script src="{{asset('/backend-assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/toastr/toastr.min.js')}}"></script>

    <script src="{{asset('/backend-assets/plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>
    <script src="{{asset('/backend-assets/plugins/owlcarousel/owl.carousel.min.js')}}"></script>
    <script>
       let page_name = 'deal';
    </script>

@endsection