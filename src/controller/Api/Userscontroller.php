<?php

namespace User\Test\Controller\Api;

use User\Test\Model\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class UsersController
{
    public function actionIndex()
    {
        $users = User::getAll(false);
        $response = new JsonResponse($users);
        $response->send();
    }

    public function actionCreate()
    {
        $request = Request::createFromGlobals();
        $data = $request->toArray();

        if (empty($data['name']) || empty($data['surname'])) {
            $errorResponse = new JsonResponse(['message' => 'Ты ввел недостаточно данных!']);
            $errorResponse->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);

            $errorResponse->send();

            return;
        }

        User::create($data);

        $response = new JsonResponse($data);
        $response->setStatusCode(JsonResponse::HTTP_CREATED);

        $response->send();
    }





    public function actionView($userId)
    {
        $getUser = User::getUserId($userId)[0];

        if (empty($userId)) {
            return new JsonResponse(
                [
                    'error' => 'Такой пользователь не найден'
                ],
                JsonResponse::HTTP_NOT_FOUND
            );
        }
        $response =  new JsonResponse([
            'id' => $getUser->getId(),
            'name' => $getUser->getName(),
            'surname' => $getUser->getSurname(),
        ]);
        return $response->send();
    }


    public function actionDelete($id) // можно прокидывать массив и
    {
        $user = User::find($id);
        if ($user) {
            $data = [
                'id' =>  $user->getId(),
            ];
            User::delete($data);
            $response =  new JsonResponse([
                'message' => 'Пользователь успешно удален',
            ]);
        } else {
            $response =  new JsonResponse([
                'error' => 'Пользователь не найден',
            ]);
        }
        return $response->send();
    }


    public function actionUpdate($id)
    {
        $request = Request::createFromGlobals();
        $requestData = $request->toArray();
        if (isset($requestData['name']) && isset($requestData['surname'])) {
            $user = User::find($id);
            if ($user) {
                $data = [
                    'id' =>  $user->getId(),
                    'name' => $requestData['name'],
                    'surname' => $requestData['surname'],
                ];
                if (User::update($data)) { // условие: если обновление прошло успешно, как установить? сейчас при обновлении выдает в любом случае 'Ошибка при обновлении пользователя'
                    $response = new JsonResponse([
                        'message' => 'Пользователь успешно обновлен',
                    ]);
                } else {
                    $response = new JsonResponse([
                        'error' => 'Ошибка при обновлении пользователя',
                    ]);
                }
            } else {
                $response = new JsonResponse([
                    'error' => 'Пользователь не найден',
                ]);
            }
        } else {
            $response = new JsonResponse([
                'error' => 'Не указаны обязательные параметры "name" и/или "surname"',
            ]);
        }
        return $response->send();
    }
}
