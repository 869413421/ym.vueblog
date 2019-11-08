<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function retrieved(User $user)
    {
        $user->updateLastActiveDate();
    }
}
