<?php
return [
    'admin' => [
        'type' => 1,
        'description' => 'Администратор',
        'children' => [
            'user/users/create',
            'user/users/update',
            'user/users/view',
            'user/users/delete',
            'user/users/index',
            'main/events/create',
            'main/events/index',
            'main/reports/index',
            'main/limits/index',
            'user/profile/index',
            'user/profile/update',
            'user/profile/password-change',
            'user/default/logout',
        ],
    ],
    'employeer' => [
        'type' => 1,
        'description' => 'Сотрудник',
        'children' => [
            'main/events/create',
            'main/events/index',
            'main/reports/index',
            'user/profile/index',
            'user/profile/update',
            'user/profile/password-change',
            'user/default/logout',
        ],
    ],
    'user/users/create' => [
        'type' => 2,
        'description' => 'Пользователи / Создание',
    ],
    'user/users/update' => [
        'type' => 2,
        'description' => 'Пользователи / Редактирование',
    ],
    'user/users/view' => [
        'type' => 2,
        'description' => 'Пользователи / Просмотр',
    ],
    'user/users/delete' => [
        'type' => 2,
        'description' => 'Пользователи / Удаление',
    ],
    'user/users/index' => [
        'type' => 2,
        'description' => 'Пользователи / Список',
    ],
    'main/events/create' => [
        'type' => 2,
        'description' => 'События / Создание',
    ],
    'main/events/index' => [
        'type' => 2,
        'description' => 'События / Список',
    ],
    'main/reports/index' => [
        'type' => 2,
        'description' => 'Отчет / Просмотр',
    ],
    'main/limits/index' => [
        'type' => 2,
        'description' => 'Лимиты / Редактирование',
    ],
    'user/profile/index' => [
        'type' => 2,
        'description' => 'Профиль / Просмотр',
    ],
    'user/profile/update' => [
        'type' => 2,
        'description' => 'Профиль / Редактирование',
    ],
    'user/profile/password-change' => [
        'type' => 2,
        'description' => 'Профиль / Смена пароля',
    ],
    'user/default/logout' => [
        'type' => 2,
        'description' => 'Выйти',
    ],
];
