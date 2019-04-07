<?php
namespace Core\Users;

class Register
{
    private $userName;
    private $password;
    private $mail;

    private $repository;

    public function __construct($userName, $password, $mail)
    {
        $this->userName = $userName;
        $this->password = $password;
        $this->mail = $mail;

        $this->repository = new UsersRepository();
    }

    public function getCheckNumberForUser($userName)
    {
        $result = '';
        $chars = preg_split('//u', $userName, NULL, PREG_SPLIT_NO_EMPTY);

        foreach ($chars as $char) {
            $result .= (string)ord($char);
        }

        return $result;
    }

    public function emailSend($email, $post)
    {
        $headers  = "Content-type: text/html; charset=windows-1251 \r\n";
        $headers .= "From: От кого письмо <admnin@zpg.by>\r\n";
        $headers .= "Reply-To: reply-to@zpg.by\r\n";

        return mail($email, 'Проверка регистрации ZPG', $post, $headers);
    }

    public function register($data)
    {
        $userData = [
            'user_name' => $data['login'],
            'password' => md5($data['password']),
            'hero_id' => 0,
            'mail' => $data['email'],
            'checked' => 0,
            'check_number' => $this->getCheckNumberForUser($data['login'])
        ];

        if ($this->emailSend($userData['mail'], $userData['check_number'])) {
            return $this->repository->createUser($userData);
        }

        return false;
    }

    public function checkEmail($email, $code)
    {
        $userData = $this->repository->getUserByMail($email);
        if ($userData) {
            if ($code == $userData['check_mail']) {
                return true;
            }

            return false;
        }

        return false;
    }
}