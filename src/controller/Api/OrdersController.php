<?php

namespace User\Test\Controller\Api;

use User\Test\Model\Order;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class OrdersController
{
    public function actionCreate()
    {
        $data = [
            'order' => $_POST['order'],
            'users_id' => $_POST['users_id']
        ];

        if (empty($data['order']) || empty($data['users_id'])) {
            $errorResponse = new JsonResponse(['message' => 'Ты ввел недостаточно данных!']);
            $errorResponse->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);

            $errorResponse->send();

            return;
        }

        Order::create($data);

        $response = new JsonResponse($data);
        $response->setStatusCode(JsonResponse::HTTP_CREATED);

        $response->send();
    }
}
