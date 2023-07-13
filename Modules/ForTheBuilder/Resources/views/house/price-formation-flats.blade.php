<style>
    .btnFilterFlat:hover {
        border: 5px solid lightgrey;
    }
</style>
<div>
    <div class="col-md-11">
        <span style="background-color: #44BE26; width: 10px; height: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
        {{ translate('The green ones are not given a price') }}
    </div>

    <div class="col-md-11">
        <span style="background-color: #FB3030; width: 10px; height: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
        {{ translate('The red ones are given a price even if it`s a piece') }}
    </div>
</div>
<div class="d-flex">
    <div class="dalePodyedzEtaj" style="margin: 50px 20px 0 0;">
        @empty(!$arr['entrance_count'])
            @foreach ($arr['entrance_count'] as $val_entrance_count)
                <h2 class="etajNameNomerDale">{{ $val_entrance_count }}</h2>
            @endforeach
        @endempty
    </div>

    <div class="d-flex" style="overflow: scroll">
        @empty(!$arr['list'])
            @php
                $n = 0;
            @endphp
            @foreach ($arr['list'] as $key => $val)
                @php
                    $n++;
                    if ($status == 'client') {
                        $house_details_url = e(url('forthebuilder/clients/client-show-details')) . '/' . $model->id . '/' . ($val['entrance'] ?? 0) . '/' . 0 . '/' . $client_id;
                    } else {
                        $house_details_url = e(url('forthebuilder/house/show-details')) . '/' . $model->id . '/' . ($val['entrance'] ?? 0) . '/' . 0;
                    }
                @endphp
                <div>
                    <div class="dalePodyedzBig2">
                        <h2 class="podyedzNameDale">
                            {{ translate('Entrance') . ' ' . ($val['entrance'] ?? '') }}
                        </h2>
                        @empty(!$arr['list'])
                            @foreach ($val['list'] as $key2 => $val2)
                                <div class="d-flex">
                                    @foreach ($val2 as $val3)
                                        <div style="min-width: 60px; height: 60px;">
                                            @php
                                                $partStr = translate('No data');
                                                if ($val3['areas_price']) {
                                                    $partStr = '';
                                                    $prices = json_decode($val3['areas_price']);
                                                    foreach ($prices as $key => $value) {
                                                        switch ($key) {
                                                            case 'fifty':
                                                                $keyPercent = 50;
                                                                break;
                                                            case 'thirty':
                                                                $keyPercent = 30;
                                                                break;
                                                            case 'hundred':
                                                                $keyPercent = 100;
                                                                break;
                                                        }
                                                        $partStr .= $keyPercent . ' - ( ';
                                                        foreach ($value as $key2 => $val) {
                                                            $partStr .= translate($key2) . ' = ' . $val . ', ';
                                                        }
                                                        $partStr .= ' ) ';
                                                    }
                                                    // dd($partStr);
                                                }
                                            @endphp
                                            {{-- <span class="" style="position: relative">Lorem, ipsum dolor sit amet consectetur
                                        adipisicing elit. Ipsa
                                        optio,
                                        eveniet enim
                                        magni sapiente fugit voluptatem velit deserunt at nam molestiae similique
                                        perferendis. Officia soluta dolore dolorum voluptas, commodi ducimus!</span> --}}
                                            @php
                                                $color = '#44BE26';
                                                if ($val3['areas_price']) {
                                                    $color = '#FB3030';
                                                }
                                            @endphp
                                            <div class="podyedzNameDaleNol padyedzNameJkSeeaGreen btnFilterFlat btn bc"
                                                style="background-color: {{ $color }}; z-index: 99999;"
                                                data-category="{{ $val3['color_status'] }}"
                                                datd-color="{{ $colors[$val3['color_status']] }}" data-default="0"
                                                data-id={{ $val3['id'] }} title="{{ $partStr }}">
                                                {{ $val3['room_count'] ?? 0 }}
                                            </div>
                                            {{-- {{ $colors[$val3['color_status']] }}; --}}
                                            {{-- #44BE26 --}}
                                            {{-- #FB3030 --}}
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        @endempty
                    </div>
                </div>
            @endforeach
        @endempty
    </div>
</div>
