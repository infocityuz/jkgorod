<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Atribut :atribut qabul qilinadi.',
    'accepted_if' => ':atribut :other :value bo\'lganda qabul qilinishi kerak.',
    'active_url' => ':atribut haqiqiy URL emas.',
    'after' => ':atribut :date dan keyingi sana bo\'lishi kerak.',
    'after_or_equal' => ':atribut :date sanasidan keyingi yoki unga teng bo\'lishi kerak.',
    'alpha' => ':atribut faqat harflardan iborat bo\'lishi kerak.',
    'alpha_dash' => ':atribut faqat harflar, raqamlar, tire va pastki chiziqdan iborat bo\'lishi kerak.',
    'alpha_num' => ':atribut faqat harflar va raqamlardan iborat bo\'lishi kerak.',
    'array' => ':atribut massiv bo\'lishi kerak.',
    'before' => ':atribut :date dan oldingi sana bo\'lishi kerak.',
    'before_or_equal' => ':atribut :datedan oldingi yoki unga teng bo\'lishi kerak.',
    'between' => [
        'numeric' => ':atribut :min va :max orasida bo\'lishi kerak.',
        'file' => ':atribut :min va :maks kilobaytlar orasida bo\'lishi kerak.',
        'string' => ':atribut :min va :max orasida bo\'lishi kerak.',
        'array' => ':atribut :min va :max elementlar orasida bo\'lishi kerak.',
    ],
    'boolean' => ':atribut maydoni rost yoki noto\'g\'ri bo\'lishi kerak.',
    'confirmed' => ':atributni tasdiqlash mos emas.',
    'current_password' => 'Parol noto\'g\'ri.',
    'date' => ':atribut haqiqiy sana emas.',
    'date_equals' => ':atribut :date ga teng sana bo\'lishi kerak.',
    'date_format' => ' :atribut :formatga mos kelmaydi.',
    'declined' => ':atribut rad etilishi kerak.',
    'declined_if' => ':atribut :other :value bo\'lganda rad etilishi kerak.:atribut :other :value bo\'lganda rad etilishi kerak.',
    'different' => ':attribute va :other boshqacha bo\'lishi kerak.',
    'digits' => ':atribut :digits digits bo\'lishi kerak.',
    'digits_between' => ':atribut :min va :max orasida bo\'lishi kerak',
    'dimensions' => ':atributda rasm o\'lchamlari noto\'g\'ri.',
    'distinct' => ':atribut maydoni ikki nusxadagi qiymatga ega.',
    'email' => ':atribut Elektron pochta manzili pochta haqiqiy bo\'lishi kerak.',
    'ends_with' => ':atribut quyidagi belgilardan biri bilan tugashi kerak: :values.',
    'enum' => 'Tanlangan :atribut noto\'g\'ri.',
    'exists' => 'Tanlangan :atribut noto\'g\'ri.',
    'file' => ':atribut fayl bo\'lishi kerak.',
    'filled' => ':atribut maydoni qiymatga ega bo\'lishi kerak.',
    'gt' => [
        'numeric' => ':atribut :value dan katta bo\'lishi kerak.',
        'file' => ':atribut :value kilobaytdan katta bo\'lishi kerak.',
        'string' => ' :atribut :value dan katta bo\'lishi kerak.',
        'array' => ' :atribut :value elementlardan katta bo\'lishi kerak.',
    ],
    'gte' => [
        'numeric' => ' :atribut :value dan katta yoki teng bo\'lishi kerak.',
        'file' => ' :atribut :value kilobaytdan katta yoki teng bo\'lishi kerak.',
        'string' => ' :atribut :value belgilaridan katta yoki teng bo\'lishi kerak.',
        'array' => ' :atributda :value elementlar yoki undan ko\'p bo\'lishi kerak.',
    ],
    'image' => ' :atribut rasm bo\'lishi kerak.',
    'in' => 'Tanlangan :atribut noto\'g\'ri.',
    'in_array' => ' :atribut maydoni :other ichida mavjud emas.',
    'integer' => ' :atribut butun son bo\'lishi kerak.',
    'ip' => ' :atribut haqiqiy IP manzil bo\'lishi kerak.',
    'ipv4' => ' :atribut yaroqli IPv4 manzili bo\'lishi kerak.',
    'ipv6' => ' :atribut yaroqli IPv6 manzili bo\'lishi kerak.',
    'json' => ' :atribut haqiqiy JSON qatori bo\'lishi kerak.',
    'lt' => [
        'numeric' => ' :atribut :value dan kichik bo\'lishi kerak..',
        'file' => ' :atribut :value kilobaytdan kichik bo\'lishi kerak.',
        'string' => ' :atribut :value belgilardan kichik bo\'lishi kerak.',
        'array' => ' :atribut :value elements dan kichik bo\'lishi kerak.',
    ],
    'lte' => [
        'numeric' => ' :atribut :value dan kichik yoki teng bo\'lishi kerak.',
        'file' => ' :atribut :value kilobaytdan kichik yoki teng bo\'lishi kerak.',
        'string' => ' :atribut :value belgilardan kichik yoki teng bo\'lishi kerak.',
        'array' => ' :atributda :value elementlardan ko\'p bo\'lmasligi kerak.',
    ],
    'mac_address' => ' :atribut haqiqiy MAC manzili bo\'lishi kerak.',
    'max' => [
        'numeric' => ' :atribut :max dan katta bo\'lmasligi kerak.',
        'file' => ' :atribut :maks kilobaytdan oshmasligi kerak.',
        'string' => ' :atribut :max belgilardan oshmasligi kerak.',
        'array' => ' :atribut :max elementlardan oshmasligi kerak',
    ],
    'mimes' => ' :atribut quyidagi kabi fayl bo\'lishi kerak: :values.',
    'mimetypes' => ' :atribut quyidagi turdagi fayl bo\'lishi kerak: :values.',
    'min' => [
        'numeric' => ' :atribut kamida :min bo\'lishi kerak',
        'file' => ' :atribut kamida :min kilobayt bo\'lishi kerak.',
        'string' => ' :atribut kamida :min belgidan iborat bo\'lishi kerak.',
        'array' => ' :atribut kamida :min element bo\'lishi kerak.',
    ],

    'multiple_of' => ' :atribut :valuening karrali bo\'lishi kerak.',
    'not_in' => ' Tanlangan :atribut noto\'g\'ri.',
    'not_regex' => ' :atribut formati yaroqsiz.',
    'numeric' => ' :atribut raqam bo\'lishi kerak.',
    'password' => ' Parol noto\'g\'ri.',
    'present' => ' :atribut maydoni mavjud bo\'lishi kerak.',
    'prohibited' => ' atribut maydoni taqiqlangan.',
    'prohibited_if' => ' :atribut maydoni :other :value bo\'lganda taqiqlanadi.',
    'prohibited_unless' => ' :atribut maydoni taqiqlanadi, agar :other :values ​​ichida bo\'lmasa.',
    'prohibits' => ' :atribut maydoni :other mavjudligini taqiqlaydi.',
    'regex' => ' :atribut formati noto\'g\'ri.',
    'required' => ' :atribut Majburiy maydon.',
    'required_array_keys' => ' :attribute maydonida :values uchun yozuvlar bo\'lishi kerak.',
    'required_if' => ' :attribute maydoni kerak, agar :other :value bo\'lsa.',
    'required_unless' => ' :attribute maydoni :values ichida :other bo\'lmasa kerak.',
    'required_with' => ' :attribute maydoni :values. mavjud bo\'lganda talab qilinadi',
    'required_with_all' => ' :attribute maydoni :qiymatlar mavjud bo\'lganda talab qilinadi.',
    'required_without' => ' :attribute Agar :values etishmayotgan bo\'lsa, maydon kerak.',
    'required_without_all' => ' :attribute Agar :qiymatlardan hech biri mavjud bo\'lmasa, maydon talab qilinadi.',
    'same' => ' :attribute va :other mos kelishi kerak.',

    'size' => [
        'numeric' => ' :atribut :size bo\'lishi kerak.',
        'file' => ' :atribut :size kilobayt bo\'lishi kerak.',
        'string' => ' :atribut :size belgilar bo\'lishi kerak.',
        'array' => ' :atributda :size elementlari bo\'lishi kerak.',
    ],
    'starts_with' => ' :atribut quyidagilardan biri bilan boshlanishi kerak: :value.',
    'string' => ' :atribut qator bo\'lishi kerak.',
    'timezone' => ' :atribut yaroqli vaqt mintaqasi bo\'lishi kerak.',
    'unique' => ' :atribut allaqachon olingan.',
    'uploaded' => ' :atributni yuklab bo\'lmadi.',
    'url' => ' :atribut haqiqiy URL bo\'lishi kerak.',
    'uuid' => ' :atribut haqiqiy UUID bo\'lishi kerak.',
    'failed' => 'Ushbu hisob ma\'lumotlari bizning qaydlarimizga mos kelmaydi.',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'maxsus-xabar',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [

        'title' => 'Sarlavha',
        'description' => 'Ta\'rif',
        'address' => 'Manzil',
        'price' => 'Narx',
        'apartment_sale' => 'Kvartira sotuvi',
        'deleted' => 'Muvaffaqiyatli o\'chirildi',
        'currency' => 'Valyuta',
        'usd' => 'AQSh dollari',
        'uzs' => 'Sum',
        'house_type' => 'Uy turi',
        'number_of_rooms' => 'Xonalar soni',
        'total_area' => 'Umumiy maydon',
        'is_exchange' => 'Almashtirish',
        'living_space' => 'Yashash maydoni',
        'kitchen_area' => 'Oshxona ',
        'floor' => 'Qavat',
        'floors_of_house' => 'Uy qavatlari',
        'layout' => 'Layout',
        'year_construction' => 'Qurilish yili',
        'bathroom' => 'hammom',
        'is_furnished' => 'Mebel bilan jihozlangan',
        'ceiling_height' => 'Shift balandligi',
        'repair' => 'Ta\'mirlash',
        'is_commission' => 'Komissiya',
        'deleted_at' => 'O\'chirilgan sana',
        'created_at' => 'Yaratilgan sana',
        'updated_at' => 'Yangilangan sana',
        'object_category_id' => 'Kategoriya',
        'parent_element_id' => 'Ota element',
        'build_type' => 'Turar-joy kvartiralarini ko\'rsatadigan toifalar',
        'service_fee' => 'Komissiya',
        'site' => 'Saytga nashr qilish',
        'comment' => 'Xizmat sharhi',
        'region_id' => 'Region',
        'city_id' => 'Shahar Shahar',
        'district_id' => 'Shahar tumani',
        'street_id' => 'Ko\'cha',
        'house_number' => 'Uy raqami',
        'village_name' => 'Qishloq nomi',
        'village_lastname' => 'Ikkinchi qishloq nomi',
        'build_year' => 'Qurilish yili',
        'build_area' => 'Qishloq maydoni (Ha)',
        'yard_count' => 'Uy xo\'jaliklari soni',
        'house_count' => 'Uylar soni',
        'house_area_min' => 'Kottejlar maydoni',
        'house_area_max' => 'Kottejlar maydoni gacha',
        'yard_area_min' => 'Uy uchastkalari maydoni',
        'yard_area_max' => 'Ushbu uchastkalar maydoni',
        'external_infrastructure' => 'Tashqi infratuzilma',
        'internal_infrastructure' => 'Ichki infratuzilma',
        'object_security_id' => 'Obyekt xavfsizligi',
        'building_name' => 'Turar joy nomi',
        'building_section' => 'Uy-joy kvartira korpusi',
        'building_state' => 'Qurilish holati',
        'ready_quarter' => 'Etkazib berish choragi',
        'floor_count' => 'Uy-joy majmuasining etajlari soni',
        'material_id' => 'Devor materiali',
        'building_class_id' => 'Bino sinfi',
        'legal_address' => 'Yuridik manzil',
        'access_id' => 'Kirish',
        'parking' => 'To\'xtash joyi',
        'parking_price' => 'To\'xtash joyi narxi, RUB',
        'internet' => 'Internet',
        'internet_type' => 'Boshqa ISP',
        'work_plan' => 'Ish jadvali',
        'lift' => 'Yuk ko\'taruvchisi',
        'lift_person_count' => 'Yuk liftlari soni, dona',
        'work_type',
        'cost_of_legal_address' => 'Yuridik manzil narxi, RUB',
        'apartment_has' => 'Kvartira bor',
        'there_is_nearby' => 'Yaqin-atrofda bor',
        'additional_phone_number' => 'Qo\'shimcha telefon raqami',

        'ads' => 'Reklama',
        'body' => 'Turar joy tavsifi',

        'start_date' => 'Shartnomaning boshlanish sanasi',
        'finish_date' => 'Shartnomaning tugash sanasi',
        'contract_admin_id' => 'Mas\'uliyatli',
        'contract_number' => 'Ro\'yxatga olish raqami',
        'contract_fee' => 'Mukofot',

        'user_type' => 'Tur',
        'user_info' => 'Familiya, ism, otasining ismi',
        'more_info' => 'Batafsil ma\'lumot',
        'admin_id' => 'Mas\'uliyatli',
        'images' => 'Rasmlar',
        'files' => 'Hujjatlar',

        'first_name' => 'Ism',
        'last_name' => 'Familiya',
        'surname' => 'Otasining ismi',
        'requestid' => 'so\'rov identifikatori',
        'auth.failed' => 'auth bajarilmadi',

        'validation.mathcaptcha' => 'Noto\'g\'ri javob',
        'mathcaptcha' => 'Noto\'g\'ri javob',
    ],

];
