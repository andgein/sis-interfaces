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
        ],
        'Последняя лекция',
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

    $page = new ParallelPage([
        'parallel' => 'C.py',
        'lessons' => $lessons,
        'links' => $links,
        'teachers' => $teachers,
    ]);

    print($page->render());