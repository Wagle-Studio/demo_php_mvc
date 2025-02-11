<?php

namespace Src\Controllers;

use Src\Repositories\UserRepository;

class UserController extends AbstractController
{
    public function collection()
    {
        $userRepository = new UserRepository();
        $users = $userRepository->findAll();

        $this->render("users_list", [
            "users" => $users
        ]);
    }

    public function read($userId)
    {
        $userRepository = new UserRepository();
        $user = $userRepository->find($userId);

        var_dump($user);
    }
}
