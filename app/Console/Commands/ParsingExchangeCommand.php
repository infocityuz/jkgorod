<?php

namespace App\Console\Commands;

use App\Models\ApartmentHas;
use App\Models\ApartmentSale;
use App\Models\ApartmentSaleContacts;
use App\Models\ThereIsNearby;
use Illuminate\Console\Command;

class ParsingExchangeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parsing:exchange';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.olx.uz/d/nedvizhimost/kvartiry/obmen/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        $html = curl_exec($ch);
        $dom = new \DOMDocument();
        @ $dom->loadHTML($html);
        $xpath = new \DOMXPath($dom);
        $flats_url = $xpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-88vtd4']//div[@class='css-1d90tha']//div[@class='css-1sw7q4x']//a[@class='css-rc5s2u']");
        $found_flats = $xpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-88vtd4']//div[@class='css-x1jscs']//div[@class='css-n9feq4']//h3//div");
        $data=[];
        foreach ($found_flats as $found_flat){
            $this->found_f = $found_flat->textContent;
        }
        if((int)explode(' ', $this->found_f)){
            foreach($flats_url as $furl) {
                $apartment_sale = new ApartmentSale();
                $apartment_sale_contacts = new ApartmentSaleContacts();
                $oneFlat = curl_init();
                $apartment_model = ApartmentSale::where('olx_url', str_replace(' ', '', "https://www.olx.uz".$furl->getAttribute('href')))->first();
                if(!isset($apartment_model->id)){
                    curl_setopt($oneFlat, CURLOPT_URL, "https://www.olx.uz".$furl->getAttribute('href'));
                    curl_setopt($oneFlat, CURLOPT_RETURNTRANSFER, true);
                    $onehtml = curl_exec($oneFlat);
                    $onedom = new \DOMDocument();
                    if($onehtml) {
                        @ $onedom->loadHTML($onehtml);
                        $onexpath = new \DOMXPath($onedom);
                        $flat_title = $onexpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-1qw98an']//div[@class='css-1d90tha']//div[@class='css-n9feq4']//div[@class='css-1wws9er']//h1");
                        $flat_price = $onexpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-1qw98an']//div[@class='css-1d90tha']//div[@class='css-n9feq4']//div[@class='css-dcwlyx']//h3");
                        $flat_adress = $onexpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-1qw98an']//div[@class='css-1d90tha']//a[@class='css-tyi2d1']");
                        $flat_infos = $onexpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-1qw98an']//ul[@class='css-sfcl1s']//p");
                        $oneimages = $onexpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-1qw98an']//div[@class='css-1d90tha']//img");
                        $descriptions = $onexpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-1qw98an']//div[@class='css-1m8mzwg']//div");
                        $seller_id = $onexpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-1qw98an']//div[@class='css-cgp8kk']//span");
                        $user_name = $onexpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-1qw98an']//div[@class='css-2f03k6']//div[@class='css-1fp4ipz']//h4");
                        $adress_count = count($flat_adress);
                        $adress_array = [];
                        foreach($user_name as $uname){
                            $apartment_sale_contacts->first_name = $uname->textContent;
                        }
                        foreach ($flat_adress as $fadress) {
                            $adress_array[] = $fadress->textContent;
                        }
                        $adress_region = explode(' - ', $adress_array[$adress_count - 3]);
                        $adress_region = explode('-', $adress_array[$adress_count - 2]);
                        $adress_city = explode('-', $adress_array[$adress_count - 1]);
                        $flatAddress = $adress_region[1] . ' ' . $adress_city[1];

                        foreach ($descriptions as $description) {
                            $string_withouth_spaces = str_replace(' ', '', $description->textContent);
                            $string_withouth_space = str_replace('-', '', $string_withouth_spaces);
                            $number_string = preg_replace("/[^0-9]/", ' ', $string_withouth_space);
                            $number_array = explode(' ', $number_string);
                            foreach ($number_array as $number_key => $number_element) {
                                if ($number_element == "") {
                                    unset($number_array[$number_key]);
                                }
                            }
                            $last_number_array = substr(end($number_array), -4);

                            if ($last_number_array != '0000'&& (int)end($number_array)>999999) {
                                $apartment_sale_contacts->additional_phone_number = end($number_array);
                            }
                            $apartment_sale->description = $description->textContent;
                        }
                        $flat_images = [];
                        foreach ($oneimages as $key_image => $oneimage) {
                            if ($oneimage->getAttribute('src')) {
                                $flat_images[] = $oneimage->getAttribute('src');
                            } else {
                                $flat_images[] = $oneimage->getAttribute('data-src');
                            }
                        }
                        unset($flat_images[$key_image]);
                        $apartment_sale->images = json_encode($flat_images);
                        $apartment_sale->olx_url = "https://www.olx.uz" . str_replace(' ', '', $furl->getAttribute('href'));
                        $data[] = json_encode([
                            $apartment_sale->olx_url
                        ]);
                        foreach ($flat_price as $fprice) {
                            $flat_price_array = explode(' ', $fprice->textContent);
                        }
                        if (str_replace(' ', '', end($flat_price_array)) == 'у.е.') {
                            $apartment_sale->currency = 1;
                        } else {
                            $apartment_sale->currency = 2;
                        }
                        $customer_id_string = [];
                        foreach ($seller_id as $seller) {
                            $customer_id_string[] = $seller->textContent;
                        }
                        $customer_id_array = explode(':', $customer_id_string[0]);
                        $apartment_sale->seller_id = str_replace(' ', '', $customer_id_array[1]);
                        $IsSave = 0;
                        foreach ($flat_title as $ftitle) {
                            $apartment_sale->title = $ftitle->textContent;
                        }
                        foreach ($flat_infos as $flat_info) {
                            $apartment_sale->type = $flat_type;
                            $flat_info_array = explode(':', $flat_info->textContent);
                            switch (str_replace(' ', '', $flat_info_array[0])) {
                                case 'Типжилья':
                                    $apartment_sale->flat_type = $flat_info_array[1];
                                    break;
                                case 'Количествокомнат':
                                    $apartment_sale->number_of_rooms = (int)$flat_info_array[1];
                                    break;
                                case 'Общаяплощадь':
                                    foreach ($flat_price as $fprice) {
                                        $f_string_price = str_replace(' ', '', $fprice->textContent);
                                        //                                    $apartment_sale->price = number_format(((int)$f_string_price / (float)$flat_info_array[1]), 2, '.', '');
                                        $apartment_sale->price = (int)$f_string_price;
                                    }
                                    $IsSave = 1;
                                    $apartment_sale->total_area = (float)$flat_info_array[1];
                                    break;
                                case 'Жилаяплощадь':
                                    $apartment_sale->living_space = (float)$flat_info_array[1];
                                    break;
                                case 'Площадькухни':
                                    $apartment_sale->kitchen_area = (float)$flat_info_array[1];
                                    break;
                                case 'Этаж':
                                    $apartment_sale->floor = (int)$flat_info_array[1];
                                    break;
                                case 'Этажностьдома':
                                    $apartment_sale->floors_of_house = (int)$flat_info_array[1];
                                    break;
                                case 'Типстроения':
                                    $apartment_sale->building_type = $flat_info_array[1];
                                    break;
                                case 'Планировка':
                                    $apartment_sale->housing_type = $flat_info_array[1];
                                    break;
                                case 'Годпостройки/сдачи':
                                    $apartment_sale->year_construction = $flat_info_array[1];
                                    break;
                                case 'Санузел':
                                    $apartment_sale->bathroom = $flat_info_array[1];
                                    break;
                                case 'Меблирована':
                                    if (str_replace(' ', '', $flat_info_array[1]) == 'Нет') {
                                        $apartment_sale->is_furnished = 0;
                                    } else {
                                        $apartment_sale->is_furnished = 1;
                                    }
                                    break;
                                case 'Высотапотолков':
                                    $apartment_sale->ceiling_height = (float)$flat_info_array[1];
                                    break;
                                case 'Ремонт':
                                    $apartment_sale->repair = $flat_info_array[1];
                                    break;
                                case 'Комиссионные':
                                    if (str_replace(' ', '', $flat_info_array[1]) == 'Нет') {
                                        $apartment_sale->is_commission = 0;
                                    } else {
                                        $apartment_sale->is_commission = 1;
                                    }
                                    break;
                                case 'Связатьсяспродавцом':

                                    break;
                                default:
                            }
                            $apartment_sale->address = $flatAddress;
                            if ($IsSave == 1) {
                                $apartment_sale->save();
                            }
                            if (isset($apartment_sale_contacts->first_name) && isset($apartment_sale_contacts->additional_phone_number)) {
                                if($IsSave == 1){
                                    $apartment_sale_contacts->apartment_sale_id = $apartment_sale->id;
                                    $apartment_sale->contacts()->save($apartment_sale_contacts);
                                }
                            }
                            switch (str_replace(' ', '', $flat_info_array[0])) {
                                case 'Вквартиреесть':
                                    $flat_has_string = str_replace(' ', '', $flat_info_array[1]);
                                    $flat_has_array = explode(',', $flat_has_string);
                                    foreach ($flat_has_array as $key => $flat_h) {
                                        if ($flat_h == "КабельноеТВ") {
                                            $flat_has_array[$key] = "Кабельное ТВ";
                                        } elseif ($flat_h == "Стиральнаямашина") {
                                            $flat_has_array[$key] = "Стиральная машина";
                                        }
                                    }
                                    $apartment_has = ApartmentHas::select('id')->whereIn('name', $flat_has_array)->get();
                                    $a_has_array = [];
                                    foreach ($apartment_has as $a_has) {
                                        $a_has_array[] = $a_has->id;
                                    }
                                    if ($IsSave == 1) {
                                        $apartment_sale->apartment_has()->attach($a_has_array);
                                    }
                                    break;
                                case 'Рядоместь':
                                    $flat_nearby_string = str_replace(' ', '', $flat_info_array[1]);
                                    $flat_nearby_array = explode(',', $flat_nearby_string);
                                    foreach ($flat_nearby_array as $n_key => $flat_n) {
                                        if ($flat_n == "ДетскаяПлощадка") {
                                            $flat_nearby_array[$n_key] = "Детская Площадка";
                                        } elseif ($flat_n == "ДетскийСад") {
                                            $flat_nearby_array[$n_key] = "Детский Сад";
                                        } elseif ($flat_n == "РазвитаяИнфраструктура") {
                                            $flat_nearby_array[$n_key] = "Развитая Инфраструктура";
                                        } elseif ($flat_n == "ТЦ(РазвлекательныеЦентр)") {
                                            $flat_nearby_array[$n_key] = "ТЦ(Развлекательные Центр)";
                                        } elseif ($flat_n == "Парк/Зеленаязона") {
                                            $flat_nearby_array[$n_key] = "Парк/Зеленая зона";
                                        }
                                    }
                                    $apartment_nearby = ThereIsNearby::select('id')->whereIn('name', $flat_nearby_array)->get();
                                    $a_nearby_array = [];
                                    foreach ($apartment_nearby as $a_nearby) {
                                        $a_nearby_array[] = $a_nearby->id;
                                    }
                                    if ($IsSave == 1) {
                                        $apartment_sale->there_is_nearby()->attach($a_nearby_array);
                                    }
                                    break;
                            }
                        }
                    }
                }
                curl_close($oneFlat);
                sleep(3);
            }
        }

    }
}
