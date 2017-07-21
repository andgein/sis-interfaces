<?php

$TEACHERS = [
    'Андрей Гейн' => [
        'info' => ['Преподаватель', '<a href="#">Ссылка во второй строке</a>'],
        'social' => ['vk' => 'andgein', 'telegram' => 'andgein'],
    ],
    'Андрей Станкевич' => [
        'name' => 'Андрей Сергеевич Станкевич',
        'image' => 'andrew.jpg',
        'info' => 'Переопределяемое значение',
    ]
];


foreach ($TEACHERS as $key => &$teacher)
    if (! array_key_exists('name', $teacher))
        $teacher['name'] = $key;