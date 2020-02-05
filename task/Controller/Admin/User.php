<?php

namespace Task\Controller\Admin;

use Task\Controller\Admin;

class User extends Admin
{
    public function list()
    {
        $users = $this->database->query('SELECT * FROM `users`');
        return array('users' => $users);
    }
}
