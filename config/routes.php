<?php


// $path = preg_replace('#^/users/(\d+)$#', '$1', $_SERVER['REQUEST_URI']); // Case 1:

// $pathCaseTwo = preg_replace('#^/users/(\d+)/orders/(\d+)$#', '$2', $_SERVER['REQUEST_URI']);
// $pathCaseTwo = preg_replace('#^/users/\d+/orders/(\d+)$#', '$1', $_SERVER['REQUEST_URI']);

return [
    'GET' => [
        //API
        'api\/users\/(\d+)' => 'api/users/view/$1', // показывает одного пользователя
        'api\/users' => 'api/users/index', // 'api\ стандарт оформления и только 

        //WEB
        // "users\/(\d+)\/order\/(\d+)" => "users/order/$1/$2",
        "users\/(\d+)" => "web/users/view/$1", // Case 2: какой верный "users/order"?- не работат
        'users' => 'web/users/index',
        '' => 'web/main/index', // конроллер main с методом index еще не описан поэтому выводит пустоту?
    ],
    'POST' => [
        // API
        'api\/users\/(\d+)\/orders' => 'api/users/$1/orders', // заказы конкретного пользователя
        'api\/users' => 'api/users/create', // создает пользователя
        //WEB
        'users\/create' => 'web/users/create', // создает пользователя
        'users\/delete' => 'web/users/delete', // если строки 23-25/34 активны то только чистит пользователя без удаления
        'users\/update' => 'web/users/update/', // обновление пользователя

    ],
    'PUT' => [
        'api/users\/(\d+)' => 'api/users/update/$1', // обновление данных о пользователе
    ],
    'DELETE' => [
        'api\/users\/delete/(\d+)' => 'api/users/delete/$1',
    ],



    // 'users/create' => 'users/create'
    // "users/$path" => "users/index/$path", // Case 1:
    // "users/1/2" => "users/order", // аналогично строке 16
    // 'users/1' => 'users/view' //     "/1"  в правую часть почему не прокидываем?
];
















// "users/index/$path/$pathCaseTwo"
