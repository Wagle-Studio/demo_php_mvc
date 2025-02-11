<?php

namespace Src\Repositories;

use Src\Models\User;
use Src\Repositories\AbstractRepository;

class UserRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct("user", User::class);
    }
}
