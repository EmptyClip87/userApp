<?php

namespace app\Databases;


use app\Models\User;

interface IDatabaseHandler
{
    public function connect();

    public function register(User $newUser);
}