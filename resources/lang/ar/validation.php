<?php

return [
    'required' => 'حقل :attribute مطلوب.',
    'numeric' => 'يجب أن يكون :attribute رقمًا.',
    'url' => 'يجب أن يكون :attribute رابطًا صالحًا.',
    'date' => 'يجب أن يكون :attribute تاريخًا صالحًا.',
    'in' => 'القيمة المحددة لـ :attribute غير صالحة.',
    'max' => [
        'numeric' => 'لا يمكن أن يكون :attribute أكبر من :max.',
        'file' => 'لا يمكن أن يكون :attribute أكبر من :max كيلوبايت.',
        'string' => 'لا يمكن أن يكون :attribute أكبر من :max حرفًا.',
        'array' => 'لا يمكن أن يحتوي :attribute على أكثر من :max عناصر.',
    ],
    'min' => [
        'numeric' => 'يجب أن يكون :attribute على الأقل :min.',
        'file' => 'يجب أن يكون :attribute على الأقل :min كيلوبايت.',
        'string' => 'يجب أن يكون :attribute على الأقل :min حرفًا.',
        'array' => 'يجب أن يحتوي :attribute على الأقل :min عناصر.',
    ],

    // Custom attribute names
    'attributes' => [
        'social_media' => 'وسائل التواصل الاجتماعي',
        'goal' => 'الهدف',
        'campaigName' => 'اسم الحملة',
        'title' => 'العنوان',
        'description' => 'الوصف',
        'call_to_action' => 'دعوة إلى العمل',
        'website_url' => 'رابط الموقع',
        'media' => 'الوسائط',
        'media_type' => 'نوع الوسائط',
        'dates' => 'التواريخ',
        'budget' => 'الميزانية',
        'language' => 'اللغة',
        'gender' => 'الجنس',
        'age_group' => 'الفئة العمرية',
        'location' => 'الموقع',
    ],

    // Custom messages
    'custom' => [
        'social_media' => [
            'required' => 'يجب اختيار وسيلة التواصل الاجتماعي.',
        ],
        'goal' => [
            'required' => 'يجب اختيار هدف الحملة.',
        ],
        'title' => [
            'required' => 'يجب إدخال عنوان للحملة.',
            'max' => 'يجب ألا يتجاوز العنوان 255 حرفًا.',
        ],
        'description' => [
            'required' => 'يجب إدخال وصف للحملة.',
        ],
        'website_url' => [
            'required' => 'يجب إدخال رابط الموقع.',
            'url' => 'يجب إدخال رابط موقع صالح.',
        ],
        'media' => [
            'required' => 'يجب تحميل وسائط للحملة.',
        ],
        'dates' => [
            'required' => 'يجب تحديد فترة زمنية للحملة.',
        ],
        'budget' => [
            'required' => 'يجب تحديد ميزانية للحملة.',
            'numeric' => 'يجب أن تكون الميزانية رقماً.',
            'min' => 'يجب ألا تقل الميزانية عن 150 ريال سعودي.',
        ],
        'language' => [
            'required' => 'يجب اختيار لغة واحدة على الأقل.',
        ],
        'location' => [
            'required' => 'يجب اختيار موقع.',
        ],
    ],
];