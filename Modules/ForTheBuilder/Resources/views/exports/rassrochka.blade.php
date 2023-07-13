@php
    $month = [
        1 => 'й', 2 => 'ой', 3 => 'ий', 4 => 'ый', 5 => 'ый', 6 => 'ой', 7 => 'ой', 8 => 'ой', 9 => 'ый',10 => 'ый',11 => 'ый',12 => 'ый',13 => 'ый',14 => 'ый',15 => 'ый',16 => 'ый',17 => 'ый',18 => 'ый'];
@endphp
<table>
    <tr>
        <td width="30">{{__("locale.Your Personal Manager") }}</td>
        <td width="30">{{ $model->deal->user->first_name ?? ''  }} {{ $model->deal->user->last_name ?? ''  }}</td>
        <td width="30"><b>{{__("locale.Application №2") }}</b></td>
    </tr>
    <tr>
        <td>{{__("locale.contacts") }}</td>
        <td>+998 97 3359999</td>
        <td><b>{{__("locale.share agreement") }}</b></td>
    </tr>
    <tr>
        <td>{{__("locale.Price listing date") }}</td>
        <td>{{ date('d.m.Y') }}</td>
        <td><b>{{__("locale.in residential building construction") }}</b></td>
    </tr>
    <tr>
        <td>{{__("locale.Price valid until") }}</td>
        <td></td>
        <td><b>{{__("locale.No 00 of January 2023") }}</b></td>
    </tr>
</table>
<br>
<br>
<table border=3 style="border: 5px solid #000;">
    <tr style="border: 5px solid #000;">
        <td style="border: 5px solid #000;"><b>{{__("locale.house_flat_number") }}</b></td>
        <td style="border: 5px solid #000;">{{ $model->deal->house_flat->number_of_flat ?? '' }}</td>
    </tr>
    <tr style="border: 5px solid #000;">
        <td style="border: 5px solid #000;"><b>{{__("locale.Apartment area") }}</b></td>
        <td style="border: 5px solid #000;">
            {{ $model->deal->house_flat->total_area ?? '' }}
        </td>
    </tr>
    <tr style="border: 5px solid #000;">
        <td style="border: 5px solid #000;"><b>{{__("locale.House") }}</b></td>
        <td style="border: 5px solid #000;">
            {{ ($model->deal->house_flat->house->house_number . ' . ' . $model->deal->house_flat->house->house_info) ?? '' }}
        </td>
    </tr>
    <tr style="border: 5px solid #000;">
        <td style="border: 5px solid #000;"><b>{{__("locale.floor") }}</b></td>
        <td style="border: 5px solid #000;">
            {{ $model->deal->house_flat->floor ?? '' }}
        </td>
    </tr>
    <tr style="border: 5px solid #000;">
        <td style="border: 5px solid #000;"><b>{{__("locale.Current exchange rate") }}</b></td>
        <td style="border: 5px solid #000;">
            {{ (isset($currency) ? number_format(($currency->SUM / $currency->USD), 2) : 0) }}
        </td>
    </tr>
    <tr style="border: 5px solid #000;">
        <td style="border: 5px solid #000;"></td>
        <td style="border: 5px solid #000;"></td>
    </tr>
    <tr style="border: 5px solid #000;">
        <td style="border: 5px solid #000;"><b>{{__("locale.prepayment") }}</b></td>
        <td style="border: 5px solid #000;"> 100 % </td>
    </tr>
    <tr style="border: 5px solid #000;">
        <td style="border: 5px solid #000;"><b>{{__("locale.Price for 1 sq.m") }}</b></td>
        <td style="border: 5px solid #000;"> 
            @php
                $priceAll = $model->deal->house_flat->price;
                $price = $priceAll - ($priceAll / 100 * $model->percent);
                // echo number_format($price * $currency->SUM);
            @endphp
            {{ number_format($price * $currency->SUM) . ' UZS'; }}
        </td>
    </tr>
    <tr style="border: 5px solid #000;">
        <td style="border: 5px solid #000;"><b>{{__("locale.total cost") }}</b></td>
        <td style="border: 5px solid #000;"> 
            @php
                $priceFlats = $model->deal->house_flat->price * $model->deal->house_flat->total_area;
                $priceBasement = ($model->deal->house_flat->basement_area ?? 0) * ($model->deal->house_flat->basement ?? 0);
                $priceMansard = ($model->deal->house_flat->mansard_area ?? 0) * ($model->deal->house_flat->mansard ?? 0);
            @endphp
            {{ (number_format(($priceFlats + $priceBasement + $priceMansard) * $currency->SUM) ?? '') . ' UZS' }} 
        </td>
    </tr>
    <tr style="border: 5px solid #000;">
        <td style="border: 5px solid #000;"></td>
        <td style="border: 5px solid #000;"></td>
    </tr>
    <tr style="border: 5px solid #000;">
        <td style="border: 5px solid #000;"><b>{{__("locale.an_initial_fee") }}</b></td>
        <td style="border: 5px solid #000;">
            {{ ($model->percent ?? '') . ' %' }}
            {{-- {{ (number_format($model->an_initial_fee * $currency->SUM) ?? '') . ' UZS' }} --}}
        </td>
    </tr>
    <tr style="border: 5px solid #000;">
        <td style="border: 5px solid #000;"><b>{{__("locale.Payment to the cadastre") }}</b></td>
        <td style="border: 5px solid #000;"> {{ number_format(($model->all_sum - $model->an_initial_fee) * $currency->SUM) . ' UZS' }} </td>
    </tr>
    <tr style="border: 5px solid #000;">
        <td style="border: 5px solid #000;"><b>{{__("locale.installment period") }}</b></td>
        <td style="border: 5px solid #000;">{{ $model->period ?? '' }}</td>
    </tr>
    <tr style="border: 5px solid #000;">
        <td style="border: 5px solid #000;"><b>{{__("locale.Price for 1 sq.m") }}</b></td>
        <td style="border: 5px solid #000;">{{ number_format(($model->all_sum / ($model->deal->house_flat->total_area + $model->deal->house_flat->basement_area + $model->deal->house_flat->mansard_area) ?? 1) * $currency->SUM) . ' UZS' }}</td>
    </tr>
    <tr style="border: 5px solid #000;">
        <td style="border: 5px solid #000;"><b>{{__("locale.total cost") }}</b></td>
        <td style="border: 5px solid #000;">{{ (number_format($model->all_sum * $currency->SUM) ?? '') . ' UZS' }}</td>
    </tr>
    <tr style="border: 5px solid #000;">
        <td colspan="2" style="height: 50px; background: yellow; border: 5px solid #000; text-align: center;">
            <b>{{ __("locale.Calculation of monthly payments of your apartment")  }}</b>
        </td>
    </tr>
    <tr style="border: 5px solid #000;">
        <td style="border: 5px solid #000; text-align: center;"><b>{{__("locale.an_initial_fee") }}</b></td>
        <td style="border: 5px solid #000; text-align: center;">{{ (number_format($model->an_initial_fee * $currency->SUM) ?? 0) . ' UZS' }}</td>
    </tr>
    <tr style="border: 5px solid #000;">
        <td style="border: 5px solid #000; text-align: center;"><b>{{__("locale.Apartment price") }}</b></td>
        <td style="border: 5px solid #000; text-align: center;">{{ number_format($model->all_sum * $currency->SUM) . ' UZS' ?? '' }}</td>
    </tr>
    <tr style="border: 5px solid #000;">
        <td style="border: 5px solid #000; text-align: center;"><b>{{__("locale.Month") }}</b></td>
        <td style="border: 5px solid #000; text-align: center;"><b>{{__("locale.Payments") }}</b></td>
    </tr>
    @php
        if (isset($model)) {
            switch ($model->period) {
                case '12 месяц':
                    $pay_month = round(($model->all_sum - $model->an_initial_fee)/12, 2, PHP_ROUND_HALF_UP);
                break;
                case '18 месяц':
                    $pay_month = round(($model->all_sum - $model->an_initial_fee)/18, 2, PHP_ROUND_HALF_UP);
                break;
            }
        }
    @endphp
    @empty(!$statuses)
        @php $i = 0; @endphp
        @foreach($statuses as $status)
            @php $i++; $back_color = ''; $text_color =''; $paid_sum = $status->sum??0 @endphp
            <tr class="status-tr" data-id="2">
                <td class="status-date" style="border: 5px solid #000; text-align: center;">
                    <b>{{ $i . '-' . $month[$i] . ' ' . __("locale.Month") }}</b>
                </td>
                <td class="status-price" style="border: 5px solid #000; text-align: center;">
                    {{ number_format(($pay_month - $paid_sum) * $currency->SUM) . ' UZS' }}
                    {{-- {{ number_format(round(($pay_month - $paid_sum), 2, PHP_ROUND_HALF_UP), 2) }} $ --}}
                </td>
            </tr>
        @endforeach
    @endempty
</table>
<?php // die('12312321'); ?>