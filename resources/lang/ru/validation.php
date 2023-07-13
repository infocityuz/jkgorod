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

    'accepted' => 'Атрибут :attribute быть принят.',
    'accepted_if' => ':attribute должен быть принят, когда :other равно :value.',
    'active_url' => ':attribute не является допустимым URL.',
    'after' => ':attribute должен быть датой после :date.',
    'after_or_equal' => ':attribute должен быть датой после :date или равным ей.',
    'alpha' => ':attribute должен содержать только буквы.',
    'alpha_dash' => ':attribute должен содержать только буквы, цифры, дефисы и символы подчеркивания.',
    'alpha_num' => ':attribute должен содержать только буквы и цифры.',
    'array' => ':attribute должен быть массивом.',
    'before' => ':attribute должна быть дата до :date.',
    'before_or_equal' => ':attribute должна быть датой до или равной :date.',
    'between' => [
        'numeric' => ':attribute должно быть между :min и :max.',
        'file' => ':attribute должен быть между :min и :max килобайтами.',
        'string' => ':attribute должно быть между символами :min и :max.',
        'array' => ':attribute должно быть между :min и :max элементами.',
    ],
    'boolean' => ':attribute поле должно быть истинным или ложным.',
    'confirmed' => ':attribute подтверждение не совпадает.',
    'current_password' => 'Пароль неверен.',
    'date' => ':attribute не является действительной датой.',
    'date_equals' => ':attribute должна быть дата, равная :date.',
    'date_format' => ' :attribute не соответствует формату :format.',
    'declined' => ':attribute должны быть отклонены.',
    'declined_if' => ':attribute должно быть отклонено, когда :other равно :value.',
    'different' => ':attribute и :other должны быть разными.',
    'digits' => ':attribute должно быть :digits цифры.',
    'digits_between' => ':attribute должно быть между цифрами :min и :max.',
    'dimensions' => ':attribute имеет недопустимые размеры изображения.',
    'distinct' => ':attribute поле имеет повторяющееся значение.',
    'email' => ':attribute Адрес эл. почты должен быть действительным.',
    'ends_with' => ':attribute должен заканчиваться одним из следующих символов: :values.',
    'enum' => 'Выбранный :attribute недействителен.',
    'exists' => 'Выбранный :attribute недействителен.',
    'file' => ':attribute должен быть файлом.',
    'filled' => ':attribute поле должно иметь значение.',
    'gt' => [
        'numeric' => ':attribute должно быть больше, чем :value.',
        'file' => ':attribute должно быть больше :value килобайт.',
        'string' => ' :attribute должно быть больше символов :value.',
        'array' => ' :attribute должно быть больше, чем :value элементов.',
    ],
    'gte' => [
        'numeric' => ' :attribute должно быть больше или равно :value.',
        'file' => ' :attribute должен быть больше или равен :value килобайт.',
        'string' => ' :attribute должно быть больше или равно :value символов.',
        'array' => ' :attribute должны иметь элементы :value или более.',
    ],
    'image' => ' :attribute должен быть образ.',
    'in' => 'Выбранный :attribute недействителен.',
    'in_array' => ' :attribute поле не существует в :other.',
    'integer' => ' :attribute должно быть целым числом.',
    'ip' => ' :attribute должен быть действительным IP-адресом.',
    'ipv4' => ' :attribute должен быть действительным адресом IPv4.',
    'ipv6' => ' :attribute должен быть действительным адресом IPv6.',
    'json' => ' :attribute должна быть допустимой строкой JSON.',
    'lt' => [
        'numeric' => ' :attribute должно быть меньше :value.',
        'file' => ' :attribute должен быть меньше :value килобайт.',
        'string' => ' :attribute должно быть меньше символов :value.',
        'array' => ' :attribute должно быть меньше, чем :value элементов.',
    ],
    'lte' => [
        'numeric' => ' :attribute должно быть меньше или равно :value.',
        'file' => ' :attribute должен быть меньше или равен :value килобайт.',
        'string' => ' :attribute должно быть меньше или равно :value символов.',
        'array' => ' :attribute не должен иметь более :value элементов.',
    ],
    'mac_address' => ' :attribute должен быть действительным MAC-адресом.',
    'max' => [
        'numeric' => ' :attribute не должно быть больше :max.',
        'file' => ' :attribute не должен превышать :max килобайт.',
        'string' => ' :attribute не должен превышать :max символов.',
        'array' => ' :attribute не должно быть более :max элементов.',
    ],
    'mimes' => ' :attribute должен быть файлом типа: :values.',
    'mimetypes' => ' :attribute должен быть файлом типа: :values.',
    'min' => [
        'numeric' => ' :attribute должно быть не менее :мин.',
        'file' => ' :attribute должен быть не менее :min килобайт.',
        'string' => ' :attribute должно быть не менее :min символов.',
        'array' => ' :attribute должно быть не менее :min элементов.',
    ],

    'multiple_of' => ' :attribute должно быть кратно :value.',
    'not_in' => ' выбранный :атрибут недействителен.',
    'not_regex' => ' :attribute формат недействителен.',
    'numeric' => ' :attribute должно быть числом.',
    'password' => ' Неверный пароль.',
    'present' => ' :attribute поле должно присутствовать.',
    'prohibited' => ' :attribute поле запрещено.',
    'prohibited_if' => ' :attribute поле запрещено, когда :other равно :value.',
    'prohibited_unless' => ' :attribute поле запрещено, если только :other не находится в :values.',
    'prohibits' => ' :attribute поле запрещает присутствие :other.',
    'regex' => ' :attribute формат недействителен.',
    'required' => ' :attribute Поле, обязательное для заполнения.',
    'required_array_keys' => ' :attribute поле должно содержать записи для: :values.',
    'required_if' => ' :attribute Поле обязательно, если :other равно :value.',
    'required_unless' => ' :attribute поле является обязательным, если только :other не находится в :values.',
    'required_with' => ' :attribute Поле обязательно, когда присутствует :values.',
    'required_with_all' => ' :attribute Поле обязательно, когда присутствуют :values.',
    'required_without' => ' :attribute Поле обязательно, если :values отсутствует.',
    'required_without_all' => ' :attribute Поле является обязательным, если ни одно из значений :value отсутствует.',
    'same' => ' :attribute и :other должны совпадать.',

    'size' => [
        'numeric' => ' :attribute должно быть :size.',
        'file' => ' :attribute должно быть :size килобайт.',
        'string' => ' :attribute должно быть :size символов.',
        'array' => ' :attribute должен содержать элементы :size.',
    ],
    'starts_with' => ' :attribute должен начинаться с одного из следующих: :values.',
    'string' => ' :attribute должна быть строка.',
    'timezone' => ' :attribute должен быть допустимым часовым поясом.',
    'unique' => ' :attribute уже занят.',
    'uploaded' => ' :attribute не удалось загрузить.',
    'url' => ' :attribute должен быть действительным URL.',
    'uuid' => ' :attribute должен быть действительным UUID.',
    'failed' => 'These credentials do not match our records.',
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
            'rule-name' => 'custom-message',
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

        'title' => 'Заголовок',
        'description' => 'Описание',
        'address' => 'Адрес',
        'price' => 'Цена',
        'apartment_sale' => 'Квартира Продажа',
        'deleted' => 'Успешно удален',
        'currency' => 'Валюта',
        'usd' => 'Доллар США',
        'uzs' => 'Сўм',
        'house_type' => 'Тип Жилья',
        'number_of_rooms' => 'Количество комнат',
        'total_area' => 'Общая Площадь',
        'is_exchange' => 'Обмен',
        'living_space' => 'Жилая Площадь',
        'kitchen_area' => 'Площадь Кухни',
        'floor' => 'Этаж',
        'floors_of_house' => 'Этажность Дома',
        'layout' => 'Планировка',
        'year_construction' => 'Год постройки',
        'bathroom' => 'Санузел',
        'is_furnished' => 'Меблирована',
        'ceiling_height' => 'Высота Потолков',
        'repair' => 'Ремонт',
        'is_commission' => 'Комиссионные',
        'deleted_at' => 'Удаленная дата',
        'created_at' => 'Дата создания',
        'updated_at' => 'Дата обновления',
        'object_category_id' => 'Категория',
        'parent_element_id' => 'Родительский элемент',
        'build_type' => 'Категории, в которых показываем Жк',
        'service_fee' => 'Комиссия',
        'site' => 'Опубликовать на сайте',
        'comment' => 'Служебный комментарий',
        'region_id' => 'Район',
        'city_id' => 'Населенный пункт *',
        'district_id' => 'Район города',
        'street_id' => 'Улица',
        'house_number' => 'Номер дома',
        'village_name' => 'Основное название поселка',
        'village_lastname' => 'Второе название поселка',
        'build_year' => 'Год постройки',
        'build_area' => 'Площадь поселка (Га)',
        'yard_count' => 'Кол-во домовладений',
        'house_count' => 'Кол-во участков',
        'house_area_min' => 'Площадь коттеджей от',
        'house_area_max' => 'Площадь коттеджей до',
        'yard_area_min' => 'Площадь участков от',
        'yard_area_max' => 'Площадь участков до',
        'external_infrastructure' => 'Внешняя инфраструктура',
        'internal_infrastructure' => 'Внутренняя инфраструктура',
        'object_security_id' => 'Охрана объекта',
        'building_name' => 'Название ЖК',
        'building_section' => 'Корпус ЖК',
        'building_state' => 'Стадия строительства',
        'ready_quarter' => 'Квартал сдачи',
        'floor_count' => 'Общая площадь ЖК',
        'material_id' => 'Материал стен',
        'building_class_id' => 'Класс здания',
        'legal_address' => 'Юридический адрес',
        'access_id' => 'Доступ',
        'parking' => 'Парковка',
        'parking_price' => 'Стоимость парковки, руб.',
        'internet' => 'Интернет',
        'internet_type' => 'Другой провайдер Интернета',
        'work_plan' => 'Режим работы',
        'lift' => 'Лифт грузовой',
        'lift_person_count' => 'Количество грузовых лифтов, шт',
        'work_type',
        'cost_of_legal_address' => 'Стоимость юридического адреса, руб',
        'apartment_has' => 'В квартире есть',
        'there_is_nearby' => 'Рядом Есть',
        'additional_phone_number' => 'Дополнительный номер телефона',

        'ads' => 'Реклама',
        'body' => 'Описание ЖК',

        'start_date' => 'Дата начала договора',
        'finish_date' => 'Дата окончания договора',
        'contract_admin_id' => 'Ответственный',
        'contract_number' => 'Реестровый номер',
        'contract_fee' => 'Вознаграждение',

        'user_type' => 'Тип',
        'user_info' => 'Фамилия, Имя, Отчество',
        'more_info' => 'Дополнительная информация',
        'admin_id' => 'Ответственный',
        'images' => 'Фото',
        'files' => 'Документы',

        'first_name' => 'Имя',
        'last_name' => 'Фамилия',
        'surname' => 'Отчество',
        'requestid' => 'запрос ид',
        'auth.failed' => 'авт не удалось',

        'validation.mathcaptcha' => 'Неправильный ответ',
        'mathcaptcha' => 'Неправильный ответ',
    ],

];
