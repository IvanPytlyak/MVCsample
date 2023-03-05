<?php

namespace User\Test\Controller\Web;

use User\Test\Model\User;
use User\Test\Component\View;

class UsersController
{
    public function actionIndex()
    {
        echo 'Привет, это страница отобразит список пользователей';
        $users = User::getAll();
        View::build(
            'main', // template
            'users', // page
            [
                'users' => $users,
            ]
        );
    }
    public function actionOrder()
    {
        echo 'Привет, это страница отобразит список заказов';
    }


    public function actionView($userId)
    {
        echo 'Привет, это страница вользователя: ' . $userId . '</br>';
        $getUser = User::getUserId($userId)[0];
        $message = sprintf(
            'id: %s, name: %s, surnsme: %s',
            $getUser->getId(),
            $getUser->getName(),
            $getUser->getSurname()
        );
        echo ($message);
    }


    public function actionCreate() // можно прокидывать массив и
    {
        $array = [
            'name' => $_POST['name'],
            'surname' => $_POST['surname']
        ];
        User::create($array); // получим данные по arr[0] arr[1]
        header('Location: http://mvc.loc/users');
    } // получить данные из POST и передать в model (User.php)

    public function actionDelete() // можно прокидывать массив и
    {
        $data = [
            'id' => $_POST['id'],
        ];
        User::delete($data); // получим данные по arr[0] arr[1]
        header('Location: http://mvc.loc/users');
    }

    public function actionUpdate()
    {
        $data = [
            'id' => $_POST['id'],
            'name' => $_POST['name'],
            'surname' => $_POST['surname'],
        ];
        User::update($data);
        header('Location: http://mvc.loc/users');
    }
}
