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

    'accepted' => 'صفت :attribute باید تایید شده باشد.',
    'active_url' => ':attribute لینک نامعتبر است.',
    'after' => ':attribute باید تاریخ بعد از :date باشد.',
    'after_or_equal' => ':attribute باید تاریخ بعد یا برابر با :date باشد.',
    'alpha' => ':attribute فقط شامل حروف میباشد.',
    'alpha_dash' => ':attribute فقط شامل حروف، اعداد، و علامت های - و ـ میباشد.',
    'alpha_num' => ':attribute فقط شامل حروف و اعداد میباشد.',
    'array' => ':attribute باید یک لیست باشد.',
    'before' => ':attribute باید تاریخ قبل از :date باشد.',
    'before_or_equal' => ':attribute باید تاریخ قبل یا برابر با :date باشد.',
    'between' => [
        'numeric' => ':attribute باید بین :min و :max باشد.',
        'file' => ':attribute باید بین :min و :max کیلوبایت باشد.',
        'string' => ':attribute باید بین :min و :max کاراکتر باشد.',
        'array' => ':attribute باید بین :min و :max آیتم باشد.',
    ],
    'boolean' => ':attribute باید مقادیر درست یا نادرست داشته باشد.',
    'confirmed' => ':attribute باید مطابقت داشته باشد.',
    'date' => ':attribute یک تاریخ معتبر نیست.',
    'date_equals' => ':attribute باید برابر با :date. باشد',
    'date_format' => ':attribute با ساختار :format مطابقت ندارد.',
    'different' => ':attribute و :other باید متفاوت باشند.',
    'digits' => ':attribute باید :digits رقم باشد.',
    'digits_between' => ':attribute باید بین :min و :max رقم باشد.',
    'dimensions' => ':attribute ابعاد تصویر نامعتبر است.',
    'distinct' => ':attribute مقادیر تکراری دارد.',
    'email' => ':attribute باید ایمیل معتبری باشد.',
    'ends_with' => ':attribute باید با یکی از موارد زیر پایان یابد: :values.',
    'exists' => ':attribute انتخاب شده، نامعتبر است.',
    'file' => ':attribute باید یک فایل باشد.',
    'filled' => ':attribute باید پر شود.',
    'gt' => [
        'numeric' => ':attribute باید بیشتر از :value باشد.',
        'file' => ':attribute باید بیشتر از :value کیلوبایت باشد.',
        'string' => ':attribute باید بیشتر از :value کاراکتر باشد.',
        'array' => ':attribute باید بیشتر از :value آیتم باشد.',
    ],
    'gte' => [
        'numeric' => ':attribute باید بیشتر یا برابر با :value باشد.',
        'file' => ':attribute باید بیشتر یا برابر از :value کیلوبایت باشد.',
        'string' => ':attribute باید بیشتر یا برابر از :value کاراکتر باشد.',
        'array' => ':attribute باید بیشتر یا برابر از :value آیتم باشد.',
    ],
    'image' => ':attribute باید عکس باشد.',
    'in' => ':attribute انتخاب شده، نامعتبر است.',
    'in_array' => ':attribute در :other وجود ندارد.',
    'integer' => ':attribute باید یک عدد صحیح باشد.',
    'ip' => ':attribute باید یک آی‌پی معتبر باشد.',
    'ipv4' => ':attribute باید یک آی‌پی ورژن ۴ معتبر باشد.',
    'ipv6' => ':attribute باید یک آی‌پی ورژن ۶ معتبر باشد.',
    'json' => ':attribute باید یک رشته JSON معتبری باشد.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

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

    'jdate' => 'The :attribute is not valid Jalali date',
    'jdate_equal' => 'The :attribute is not equal Jalali date  :date',
    'jdate_not_equal' => 'The :attribute is\'nt not equal Jalali date  :date',
    'jdatetime' => 'The :attribute is not valid Jalali datetime',
    'jdatetime_equal' => 'The :attribute is not equal Jalali datetime :date',
    'jdatetime_not_equal' => 'The :attribute is\'nt not equal Jalali datetime :date',
    'jdate_after' => 'The :attribute must be a Jalali date after :date.',
    'jdate_after_equal' => 'The :attribute must be a Jalali date after or equal :date.',
    'jdatetime_after' => 'The :attribute must be a Jalali datetime after :date.',
    'jdatetime_after_equal' => 'The :attribute must be a Jalali datetime after or equal :date.',
    'jdate_before' => 'The :attribute must be a Jalali date before :date.',
    'jdate_before_equal' => 'The :attribute must be a Jalali date before or equal :date.',
    'jdatetime_before' => 'The :attribute must be a Jalali datetime before :date.',
    'jdatetime_before_equal' => 'The :attribute must be a Jalali datetime before or equal :date.',

    'attributes' => [
        'start_date' => 'start date',
        'expire_datetime' => 'expire datetime',
    ],

];
