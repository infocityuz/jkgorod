@extends('forthebuilder::layouts.forthebuilder')

@section('title') {{ __("locale.show") }} @endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/owlcarousel/owl.carousel.min.css') }}">
@endsection

@section('content')

<div class="page-header card">
</div>
<div class="card">
    <div class="content-header">
        <div class="container-fluid card-block">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __("locale.deal") }} {{ __("locale.show") }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('forthebuilder.index') }}">{{ __("locale.home") }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('forthebuilder.deal.index') }}">{{ __("locale.deal") }}</a></li>
                        <li class="breadcrumb-item active">{{ __('locale.show') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="card-block table-border-style">
            {{-- <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('locale.image') }}</h4>
                    </div>
                    <div class="house__slider owl-carousel owl-theme">
                        @if(!empty($model->main_image))
                            @foreach($model->files as $img)
                                <div class="col-lg-6 item">
                                    <img src="{{ asset('/uploads/deal/'.$img->deal_id.'/l_'.$img->guid) }}" class="img-fluid mb-2" alt="white sample"/>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Атрибут</th>
                                <th>Данные</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b>{{ __("locale.Manager") }}</b></td>
                                <td>{{ $model->user->first_name ?? '' }} {{ $model->user->last_name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>{{ __("locale.name") }} {{ __("locale.customer") }}</b></td>
                                <td>{{ $model->personal_informations->full_name ?? '' }} </td>
                            </tr>
                            <tr>
                                <td><b>{{ __("locale.flat") }}</b></td>
                                <td>
                                    @if(!empty($model->house_flat->id))
                                        <a href="{{ route('forthebuilder.house-flat.show',$model->house_flat->id) }}">{{ $model->house_flat->house->house_number ?? '' }} дом, {{ $model->house_flat->number_of_flat ?? '' }} квартира</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>{{ __("locale.contract_number") }}</b></td>
                                <td>
                                    {{ !empty($model->house_flat->contract_number) ? $model->house_flat->contract_number : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td><b>{{ __("locale.house_flat_number") }}</b></td>
                                <td>{{ $model->house_flat_number }}</td>
                            </tr>
                            <tr>
                                <td><b>{{ __("locale.agreement_number") }}</b></td>
                                <td>{{ $model->agreement_number }}</td>
                            </tr>
                            <tr>
                                <td><b>{{ __("locale.Gender") }}</b></td>
                                <td>{{ $model->gender==1?__('locale.Woman'):__('locale.Man') }}</td>
                            </tr>
                            <tr>
                                <td><b>{{ __('locale.Transaction price') }}</b></td>
                                <td>{{ number_format($model->price_bought, 2) }} $</td>
                            </tr>
                            <tr>
                                <td><b>{{ __("locale.additional_phone_number") }}</b></td>
                                <td>{{ $model->additional_phone }}</td>
                            </tr>
                            <tr>
                                <td><b>{{ __("locale.phone") }}</b></td>
                                <td>{{ $model->phone }}</td>
                            </tr>
                            <tr>
                                <td><b>{{ __("locale.email") }}</b></td>
                                <td>{{ $model->email }}</td>
                            </tr>
                            <tr>
                                <td><b>{{ __("locale.date") }}</b></td>
                                <td>{{ $model->dateDl }}</td>
                            </tr>
                            <tr>
                                <td><b>{{ __("locale.description") }}</b></td>
                                <td>{{ $model->description }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
        <div class="action-content-view " style="display: flex;justify-content:space-between">
            <div>
                <a href="#" onclick="goBack();" class="btn btn-primary" title="cancel" style="margin-right: 15px;">
                    {{ __('locale.cancel') }}
                </a>
                <a href="{{ route('forthebuilder.deal.edit',$model->id) }}" class="btn btn-success" title="update" style="margin-right: 15px;">
                    {{ __('locale.update') }}
                </a>
                <form style="display: inline-block; margin-right: 15px;" class="delete" action="{{ route('forthebuilder.deal.destroy', $model->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="delete-data-item" class="delete-data-item btn btn-danger" title="delete">
                        {{ __('locale.delete') }}
                    </button>
                </form>
            </div>
            <div>
                <a href="{{ route('forthebuilder.exports.generateContract',$model->id) }}" class="btn btn-primary" title="show"><i class="fas fa-file-word"></i></a>
                {{-- <a href="{{ route('forthebuilder.deal.generateContract',$model->id) }}" class="btn btn-primary" title="show"><i class="fas fa-file-word"></i></a> --}}
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
    <script src="{{ asset('/backend-assets/plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('/backend-assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/toastr/toastr.min.js') }}"></script>

    <script src="{{ asset('/backend-assets/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <script src="{{ asset('/backend-assets/plugins/owlcarousel/owl.carousel.min.js') }}"></script>

    <script>
        let page_name = 'deal';
        $(function () {
            // $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            //     event.preventDefault();
            //     $(this).ekkoLightbox({
            //         alwaysShowClose: true
            //     });
            // });

            $('.house__slider').owlCarousel({
                loop:true,
                margin:10,
                nav:true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    1000:{
                        items:1
                    }
                }
            })
        })
    </script>
@endsection