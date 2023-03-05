<?php

namespace User\Test\Model;

use mysqli;
use User\Test\Component\Database;
use PDO;

class Order
{
    private int $id;
    private int $users_id;
    private string $order;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setUsersId(int $users_id)
    {
        $this->users_id = $users_id;
    }

    public function getUsersId(): int
    {
        return $this->users_id;
    }

    public function setOrder(string $order)
    {
        $this->order = $order;
    }

    public function getOrder(): string
    {
        return $this->order;
    }

    public static function getAll(bool $isObjectFormat = true)
    {
        $db = Database::getConnection();

        $stmt = $db->query("SELECT * FROM orders_test");

        if ($isObjectFormat) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, Order::class); // Order::class ='App\Mvc\Model\Order' 

            return $stmt->fetchAll();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function union(array $data)
    {
        $db = Database::getConnection();
        $stmt_u = $db->prepare("SELECT * FROM orders_test JOIN users_test ON orders_test.users_id = users_test.id WHERE users_test.id =?");
        $stmt_u->bindParam(1, $data['user_id'], PDO::PARAM_INT);
        $stmt_u->execute();
        return $stmt_u->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $data)
    {
        $db = Database::getConnection();
        $stmt_u = Order::union($data);
        $stmt = $db->prepare("INSERT INTO orders_test (order, users_id) VALUES (?,?)");
        $stmt->execute([$data['order'], $stmt_u['users_id']]);
    }
}
