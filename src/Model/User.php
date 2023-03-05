<?php

namespace User\Test\Model;

use User\Test\Component\Database;
use PDO;

class User
{
    private int $id;
    private string $name;
    private string $surname;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }


    public static function getAll(bool $isObjectFormat = true)
    {
        $db = Database::getConnection();

        $stmt = $db->query("SELECT * FROM users_test");

        if ($isObjectFormat) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, User::class); // User::class ='App\Mvc\Model\User' 

            return $stmt->fetchAll();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUserId($userId)
    {
        $db = Database::getConnection();

        $stmt = $db->query("SELECT * FROM users_test WHERE id = $userId");

        $stmt->setFetchMode(PDO::FETCH_CLASS, User::class); // User::class ='App\Mvc\Model\User' 

        return $stmt->fetchAll();
    }

    // public static function create($name, $surname) // $arr передать в параметр
    // {
    //     $db = Database::getConnection();
    //     $stmt = $db->prepare("INSERT INTO  users_test (name, surname) VALUES (?,?)");
    //     $stmt->execute([$name,  $surname]); // $arr[0], $arr[1]
    // }

    public static function create(array $data)
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("INSERT INTO users_test (name, surname) VALUES (?,?)");

        $stmt->execute([$data['name'], $data['surname']]);
    }

    public static function delete(array $data)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM users_test WHERE id = ?");
        $stmt->bindParam(1, $data['id']);
        $stmt->execute();
    }

    public static function find($id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users_test WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetchObject(User::class); // нужен комментарий (строка в объект?)
        return $user ?: null;
    }

    public static function update(array $data)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE users_test SET surname=?, name=? WHERE id=?");
        $stmt->execute([$data['surname'], $data['name'], $data['id']]);
    }
}
