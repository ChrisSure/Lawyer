<?php

namespace App\Site\UseCases\State;

use App\Site\Entity\State;
use Illuminate\Support\Facades\Auth;


class StateService
{

    public function save(string $filename, int $sum): State
    {
        $user_id = (Auth::check()) ? Auth::id() : null;
        return State::new($filename, $sum, $user_id);
    }


}