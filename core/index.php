<?php
    require_once 'sis.php';

    $lessons = [
        'Введение в питон',
        ['title.html' => 'Python <span style="color: red">сердечко</span> Django'],
        [
            'title' => 'Алгоритм Дейкстры',
            'index' => 66,
            'contest_url' => ejudge_contest_url(50005),
            'results_url' => null,
            'statements_url' => 'statements/HELL.pdf',
            'additional_links' => [
                'конспект' => 'dijkstra.pdf',
                ['title.html' => 'что-то с&nbsp;<b>HTML</b>', 'link' => 'html-link/']
            ],
        ]
    ];
    
    $links = [
        'Конспект' => 'notes/',
        'Подсписок' => [
            'Первый' => 'first-link/',
            'Второй' => 'second-link/',
        ],
        ['html' => 'Угадай мелодию: <a href="">песни</a> и <a href="">результаты</a>']
    ];

    $teachers = [
        'Андрей Гейн',
        [
            'extend' => 'Андрей Станкевич',
            'info' => 'Завуч',
        ],
    ];

    $first_column = [
        new LessonsBlock([
            'lessons' => $lessons,
            'start_ejudge_contest' => 50000,
            'title' => 'Занятюшечки',
        ]),
        new LinksBlock($links),
    ];

    $second_column = [
        new TeachersBlock($teachers),
        new TeachersBlock(['title' => 'Преподаватели-няшки', 'teachers' => $teachers]),
    ];

    $page = new Page([
        'title' => 'Страничка параллели',
        'layout' => [
            [$first_column, $second_column]
        ],
        'base_url' => '/',
        'main_menu' => [
            'current' => 'study',
            'current_is_link' => true,
        ],
        'parallels_menu' => [
            'current' => 'C.py',
        ],
    ]);
    
    print($page->render());
?>