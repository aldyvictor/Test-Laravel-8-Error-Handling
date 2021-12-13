<?php

namespace App\Services;

use App\Exceptions\UserNotFoundException;
use App\Models\User;

class UserService {
    public function findByUsername($username)
    {
        $user = User::where('username', $username)->first();
        if (!$user) {
            throw new UserNotFoundException('User is not found by username' . ' ' . $username);
        }

        return $user;
    }
}

?>
