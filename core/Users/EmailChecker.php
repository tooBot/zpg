<?php
namespace Core\Users\Register;

use Core\Users\UsersRepository;

class EmailChecker
{
    private $repository;

    public function __construct()
    {
        $this->repository = new UsersRepository();
    }

    public function checkEmail($email, $code)
    {
        $userData = $this->repository->getUserByMail($email);
        if (isset($userData[0]['id'])) {
            if ($code == $userData[0]['check_number']) {
                $this->repository->setUserCheck($userData[0]['id']);
                return true;
            }

            return false;
        }

        return false;
    }
}