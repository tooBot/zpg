<?php
namespace Core\Users;

use core\Connection;

class UsersRepository
{
    const TBL_MAIN = 'users';

    private $db;
    private $connection;

    public function __construct()
    {
        $this->db = new Connection();
        $this->connection = $this->db->getConnection();
    }

    public function getUserByName($userName)
    {
        return $this->connection
            ->table(self::TBL_MAIN)
            ->where('user_name', $userName)
            ->get();
    }

    public function getUserByMail($mail)
    {
        return $this->connection
            ->table(self::TBL_MAIN)
            ->where('mail', $mail)
            ->get();
    }

    public function createUser($data)
    {
        if (!$this->getUserByName($data['user_name']) && !$this->getUserByMail($data['mail'])) {
            $this->connection
                ->table(self::TBL_MAIN)
                ->insert($data);

            return true;
        }

        return false;
    }

    public function setUserCheck($userId)
    {
        $this->connection
            ->table(self::TBL_MAIN)
            ->where('id', $userId)
            ->update([
                'hero_id' => $userId,
                'checked' => 1
            ]);
    }



}