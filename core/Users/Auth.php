<?php

namespace Core\Users;

class Auth
{
    private $repository;

    public function __construct()
    {
        $this->repository = new UsersRepository();
    }

    public function auth($data)
    {
        $userData = $this->repository->getUserByName($data['login']);

        if (isset($userData[0]['id'])) {
            if (!$userData[0]['checked']) {

                return false;
            }

            if ($userData[0]['password'] != md5($data['password'])) {

                return false;
            }

            return true;
        } else {

            return false;
        }

    }
}