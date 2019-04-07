<?php
require_once '../../../vendor/autoload.php';

$data = $_POST;

switch ($data['action']) {
    case 'register':
        $register = new \Core\Users\Register($data['login'], $data['password'], $data['email']);
        if ($register->register($data)) {
            header('Location: checkEmail/index.php');
            exit;
        }

        break;

    case 'check':
        $checker = new \Core\Users\Register\EmailChecker();
        if ($checker->checkEmail($_POST['email'], $_POST['code'])) {
            header('Location: ../../../index.php');
            exit;
        } else {
            header('Location: checkEmail/index.php');
            exit;
        }

        break;

    case 'auth':
        $auth = new \Core\Users\Auth();
        if ($auth->auth($data)) {
            session_start();
            header('Location: ../../../index.php');
            exit;
        } else {
            header('Location: auth/index.php');
            exit;
        }

        break;
}
