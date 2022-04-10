<?php

/*return [
    'settings' => [
        'title' => 'Настройки сайта',
        'icon'  => '<i class="fa fa-cogs" aria-hidden="true"></i>',
    ]
];*/


use App\Models\NewsBase;
use App\Modules\Admin\News\Models\News;

return [
    /** Modules **/

    'types' => [
        'Admin' => [
            'Main' => [],
            'Catalog' => [
                'title' => 'Сборы',
                'icon'  => '<i class="fas fa-coins"></i>',
                'items' => [
                    'singleItem' => 'Сбор',
                    'manyItems' => 'Сборов',
                    'manyItemsList' => 'Сборы',
                ],
                'seoFields' => [
                    'currency' => [
                        'title' => 'Символ валюты'
                    ]
                ]
            ],
            'Settings' => [
                'title' => 'Настройки сайта',
                'icon'  => '<i class="fa fa-cog"></i>',
            ],
            'News' => [
                'title' => 'Новости',
                'icon'  => '<i class="fa fa-newspaper"></i>',
            ],
            'Employees' => [
                'title' => 'Команда',
                'icon'  => '<i class="fas fa-user"></i>',
                'seoFields' => [
                    'description' => [
                        'title' => 'Описание под командой',
                        'textarea' => true,
                    ]
                ]
            ],
            'Services' => [
                'title' => 'Программы',
                'icon'  => '<i class="fas fa-images"></i>',
            ],
            'Filemanager' => [
                'title' => 'Файловый менеджер',
                'icon'  => '<i class="fas fa-folder-open"></i>',
            ],
            'Ymlgenerator' => [
                'title' => 'Yml генератор',
                'icon'  => '<i class="fab fa-yandex-international"></i>',
            ],
            'Pages' => [
                'title' => 'Статические страницы',
                'icon'  => '<i class="fas fa-columns"></i>',
            ],
            'Informations' => [
                'title'     => 'Отчеты/Документы',
                'icon'      => '<i class="fas fa-poll"></i>',
            ],
            'Partners' => [
                'title' => 'Партнеры',
                'icon'  => '<i class="fas fa-handshake"></i>',
            ],
            'Documents' => [
                'title'     => 'Документы',
                'icon'      => '<i class="fas fa-file-alt"></i>',
            ],
            'Attributes' => [
                'title' => 'Дополнит. атрибуты',
                'icon'  => false,
            ],
            'Navigations' => [
                'title' => 'Управление навигацией',
                'icon'  => false,
            ],
            'Faq' => [
                'title' => 'Вопрос/ответ',
                'icon'  => false,
            ],
            'Feedbacks' => [
                'title' => 'Обратная связь',
                'icon'  => '<i class="fas fa-comments"></i>',
            ],
        ],
        'Site' => [
            'Main'          => [],
            'Reviews'       => [],
            'Catalog'       => [],
            'Pages'         => [
                'links' => [
                    'contacts'  => 'Контакты',
                    'aboutUs'   => 'О фонде',
                    'donation'  => 'Выплата закята',
                ],
            ],
            'Feedbacks'     => [],
            'Services'      => [],
            'News'          => [],
            'Faq'           => [],
            'Partners'      => [],
            'Informations'  => [
                'links' => [
                    'documents' => 'Документы - о фонде',
                    'reports'   => 'Отчеты',
                ]
            ],
        ],
        'Profile' => [
            'Main'          => [],
            'Donations'          => [],
            'Auth'          => []
        ]
    ]
];
