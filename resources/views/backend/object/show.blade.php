@extends('layouts.backend')
@section('title')
    {{ __('locale.object') }} {{ __('locale.view') }}
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('/backend-assets/plugins/owlcarousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
          integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('locale.object') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                        href="{{ route('backend.index', app()->getLocale()) }}">{{ __('locale.home') }}</a></li>
                            <li class="breadcrumb-item"><a
                                        href="{{ route('object.index', app()->getLocale()) }}">{{ __('locale.object') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('locale.view') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="row">
            <div class="col-12">

                <div class="card-header">
                    <h4 class="card-title">{{ __('locale.image') }}</h4>
                    <div class="float-right">
                        <a href="{{ route('object.edit', [app()->getLocale(), $model->id]) }}" class="btn btn-primary"
                           title="update">{{ __('locale.update') }}</a>
                        <form style="display: inline-block;"
                              action="{{ route('object.destroy', [app()->getLocale(), $model->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-data-item btn btn-danger"
                                    title="delete">{{ __('locale.delete') }}</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <h3>{{ __('locale.images') }}</h3>
                        <div class="house__slider owl-carousel owl-theme">
                            @if (!empty($model->images))
                                @foreach ($model->images as $img)
                                    <div class="item">
                                        <a href="{{ asset('/uploads/object/images/' . $img->object_id . '/l_' . $img->guid) }}"
                                           data-title="{{ $img->name }}" class="mp-images">
                                            <img src="{{ asset('/uploads/object/images/' . $img->object_id . '/m_' . $img->guid) }}"
                                                 class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <h3>{{ __('locale.file') }}</h3>
                <div class="house__slider owl-carousel owl-theme">
                    @if (!empty($model->files))
                        @foreach ($model->files as $img)
                            @php
                                $arr = explode('.', $img->guid);
                                $extension = end($arr);
                            @endphp
                            <div class="item">
                                <a href="{{ asset('/uploads/object/files/' . $img->object_id . '/' . $img->guid) }}"
                                   data-title="{{ $img->name }}" class="mp-files">
                                    @if (in_array($extension, ['jpg', 'jpeg', 'png']))
                                        <img src="{{ asset('/uploads/object/files/' . $img->object_id . '/' . $img->guid) }}"
                                             class="img-fluid mb-2" alt="white sample" />
                                    @else
                                        <img style="height: 150px; width: 150px"
                                             src="{{ asset('/uploads/object/default_file.webp') }}"
                                             class="img-fluid mb-2" alt="white sample" />
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-6">
                <div class="card-body">
                    <h1>{{ __('locale.object') }}</h1>
                    <table class="table table-bordered table-hover">
                        <tbody>
                        <tr>
                            <td>{{__('locale.Object number')}}</td>
                            <td>{{ $model->id }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('locale.title') }}</td>
                            <td>{{ $model->title }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('locale.description') }}</td>
                            <td>{{ $model->description }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('locale.address') }}</td>
                            <td>{{ $model->address }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('locale.price') }} </td>
                            <td>{{ $model->price }} {{ $model->currency == 1 ? ' Сум' : ' Доллар' }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('locale.object_category') }}</td>
                            <td>
                                @if (!empty($model->category_id))
                                    {{ $model->category->name }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('locale.Region') }}</td>
                            <td>{{ $model->region->name ?? __('locale.Not specified') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('locale.Town') }}</td>
                            <td>{{ $model->town->name ?? __('locale.Not specified') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('locale.area') }}</td>
                            <td>{{ $model->town_id != 0 ? $model->area->name : $model->notArea->name }}</td>
                        </tr>

                        <tr>
                            <td>{{ __('locale.house_number') }}</td>
                            <td>
                                @if (!empty($model->house_number))
                                    {{ $model->house_number }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('locale.service_fee') }}</td>
                            <td>
                                @if (!empty($model->service_fee))
                                    {{ $model->service_fee }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('locale.site') }}</td>
                            <td>
                                {{ !empty($model->site) || $model->site != 0 ? $model->site : __('locale.Not specified') }}
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('locale.user') }}</td>
                            <td>
                                @if (!empty($model->user_id))
                                    {{ $model->user->last_name . ' ' . $model->user->first_name }}
                                @endif
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card-body">
                    <h1>Параметры категории</h1>
                    <table class="table table-bordered table-hover">
                        <tbody>
                        @if ($model->village_name)
                            <tr>
                                <td>{{ __('locale.village_name') }}</td>
                                <td>
                                    {{ $model->village_name ?? __('locale.Not specified') }}
                                </td>
                            </tr>
                        @endif

                        @if ($model->village_lastname)
                            <tr>
                                <td>{{ __('locale.village_lastname') }}</td>
                                <td>
                                    {{ $model->village_lastname ?? __('locale.Not specified') }}
                                </td>
                            </tr>
                        @endif

                        @if ($model->repair)
                            <tr>
                                <td>{{ __('locale.repair') }}</td>
                                <td>
                                    {{ $model->repair->name ?? __('locale.Not specified') }}
                                </td>
                            </tr>
                        @endif

                        @if ($model->build_year)
                            <tr>
                                <td>{{ __('locale.build_year') }}</td>
                                <td>
                                    {{ $model->build_year ?? __('locale.Not specified') }}
                                </td>
                            </tr>
                        @endif

                        @if ($model->build_area)
                            <tr>
                                <td>{{ __('locale.build_area') }}</td>
                                <td>
                                    {{ $model->build_area ?? __('locale.Not specified') }}
                                </td>
                            </tr>
                        @endif

                        @if ($model->yard_count)
                            <tr>
                                <td>{{ __('locale.yard_count') }}</td>
                                <td>
                                    {{ $model->yard_count ?? __('locale.Not specified') }}
                                </td>
                            </tr>
                        @endif

                        @if ($model->house_count)
                            <tr>
                                <td>{{ __('locale.house_count') }}</td>
                                <td>
                                    {{ $model->house_count ?? __('locale.Not specified') }}
                                </td>
                            </tr>
                        @endif

                        @if ($model->house_area_min)
                            <tr>
                                <td>{{ __('locale.house_area_min') }}</td>
                                <td>
                                    {{ $model->house_area_min ?? __('locale.Not specified') }}
                                </td>
                            </tr>
                        @endif

                        @if ($model->house_area_max)
                            <tr>
                                <td>{{ __('locale.house_area_max') }}</td>
                                <td>
                                    {{ $model->house_area_max ?? __('locale.Not specified') }}
                                </td>
                            </tr>
                        @endif

                        @if ($model->yard_area_min)
                            <tr>
                                <td>{{ __('locale.yard_area_min') }}</td>
                                <td>
                                    {{ $model->yard_area_min ?? __('locale.Not specified') }}
                                </td>
                            </tr>
                        @endif

                        @if ($model->yard_area_max)
                            <tr>
                                <td>{{ __('locale.yard_area_max') }}</td>
                                <td>
                                    {{ $model->yard_area_max ?? __('locale.Not specified') }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->external_infrastructure))
                            <tr>
                                <td>{{ __('locale.external_infrastructure') }}</td>
                                <td>
                                    {{ $model->external_infrastructure }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->internal_infrastructure))
                            <tr>
                                <td>{{ __('locale.internal_infrastructure') }}</td>
                                <td>
                                    {{ $model->internal_infrastructure }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->object_security))
                            <tr>
                                <td>{{ __('locale.object_security') }}</td>
                                <td>
                                    {{ $model->object_security }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->building_name))
                            <tr>
                                <td>{{ __('locale.building_name') }}</td>
                                <td>
                                    {{ $model->building_name }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->building_section))
                            <tr>
                                <td>{{ __('locale.building_section') }}</td>
                                <td>
                                    {{ $model->building_section }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->building_state))
                            <tr>
                                <td>{{ __('locale.building_state') }}</td>
                                <td>
                                    {{ $model->building_state }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->ready_quarter))
                            <tr>
                                <td>{{ __('locale.ready_quarter') }}</td>
                                <td>
                                    {{ $model->ready_quarter }}
                                </td>
                            </tr>
                        @endif

                        @if ($model->floor)
                            <tr>
                                <td>{{ __('locale.floor') }}</td>
                                <td>
                                    {{ $model->floor ?? __('locale.Not specified') }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->floor))
                            <tr>
                                <td>{{ __('locale.floor_count') }}</td>
                                <td>
                                    {{ $model->floor_count }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->material))
                            <tr>
                                <td>{{ __('locale.material') }}</td>
                                <td>
                                    {{ $model->material }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->building_class))
                            <tr>
                                <td>{{ __('locale.building_class') }}</td>
                                <td>
                                    {{ $model->building_class }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->legal_address))
                            <tr>
                                <td>{{ __('locale.legal_address') }}</td>
                                <td>
                                    {{ $model->legal_address }}
                                </td>
                            </tr>
                        @endif


                        @if (!empty($model->access))
                            <tr>
                                <td>{{ __('locale.access') }}</td>
                                <td>
                                    {{ $model->access }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->parking))
                            <tr>
                                <td>{{ __('locale.parking') }}</td>
                                <td>
                                    {{ $model->parking }}
                                </td>
                            </tr>
                        @endif


                        @if (!empty($model->parking_price))
                            <tr>
                                <td>{{ __('locale.parking_price') }}</td>
                                <td>
                                    {{ $model->parking_price }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->internet))
                            <tr>
                                <td>{{ __('locale.internet') }}</td>
                                <td>
                                    {{ $model->internet }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->internet_type))
                            <tr>
                                <td>{{ __('locale.internet_type') }}</td>
                                <td>
                                    {{ $model->internet_type }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->work_plan))
                            <tr>
                                <td>{{ __('locale.work_plan') }}</td>
                                <td>
                                    {{ $model->work_plan }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->lift))
                            <tr>
                                <td>{{ __('locale.lift') }}</td>
                                <td>
                                    {{ $model->lift }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->lift_person_count))
                            <tr>
                                <td>{{ __('locale.lift_person_count') }}</td>
                                <td>
                                    {{ $model->lift_person_count }}
                                </td>
                            </tr>
                        @endif

                        @if ($model->ceiling_height)
                            <tr>
                                <td>{{ __('locale.ceiling_height') }}</td>
                                <td>
                                    {{ $model->ceiling_height ?? __('locale.Not specified') }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->ceiling_height))
                            <tr>
                                <td>{{ __('locale.work_type') }}</td>
                                <td>
                                    {{ $model->work_type }}
                                </td>
                            </tr>
                        @endif

                        @if ($model->cost_of_legal_address)
                            <tr>
                                <td>{{ __('locale.cost_of_legal_address') }}</td>
                                <td>
                                    {{ $model->cost_of_legal_address ?? __('locale.Not specified') }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->lift_person_count))
                            <tr>
                                <td>{{ __('locale.lift_person_count') }}</td>
                                <td>
                                    {{ $model->lift_person_count }}
                                </td>
                            </tr>
                        @endif


                        @if (!empty($model->lift_person_count))
                            <tr>
                                <td>{{ __('locale.lift_person_count') }}</td>
                                <td>
                                    {{ $model->lift_person_count }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->ads))
                            <tr>
                                <td>{{ __('locale.ads') }}</td>
                                <td>
                                    {{ $model->ads }}
                                </td>
                            </tr>
                        @endif

                        @if (!empty($model->body))
                            <tr>
                                <td>{{ __('locale.body') }}</td>
                                <td>
                                    {{ $model->body }}
                                </td>
                            </tr>
                        @endif

                        </tbody>
                    </table>

                </div>
            </div>

        </div>


        {{--    <div class="action-content-view container" style="padding-bottom: 25px"> --}}

        {{--        <a href="{{route('user-sale.index')}}" class="btn btn-primary" title="cancel"> --}}
        {{--            cancel --}}
        {{--        </a> --}}
        {{--        <a href="{{route('user-sale.edit',$model->id)}}" class="btn btn-success" title="update"> --}}
        {{--            update --}}
        {{--        </a> --}}
        {{--        <form style="display: inline-block;" action="{{route('user-sale.destroy',$model->id)}}" method="POST"> --}}
        {{--            @csrf --}}
        {{--            @method('DELETE') --}}
        {{--            <button type="submit" id="delete-data-item" class="btn btn-danger" title="delete"> --}}
        {{--                <i class="ti-trash"></i> delete --}}
        {{--            </button> --}}
        {{--        </form> --}}

        {{--    </div> --}}


        @endsection

        @section('scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"
                    integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w=="
                    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="{{ asset('/backend-assets/plugins/owlcarousel/owl.carousel.min.js') }}"></script>

            <script>
                $(document).ready(function() {
                    $('.mp-images').magnificPopup({
                        type: 'image',
                        gallery: {
                            enabled: true
                        },
                    });

                    $('.house__slider').owlCarousel({
                        loop: false,
                        margin: 10,
                        nav: true,
                        responsive: {
                            0: {
                                items: 1
                            },
                            600: {
                                items: 4
                            },
                            1000: {
                                items: 5
                            }
                        }
                    })
                });
            </script>
@endsection
