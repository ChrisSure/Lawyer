<?php

namespace App\Cabinet\Http\Controllers;

use App\Cabinet\Entity\Profile;
use App\Common\Entity\User;
use App\Common\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{

    public function index()
    {
        $profile_mes = $this->getMesProfile();
        $main_mes = $this->getMesMain();
        return view('cabinet.home', compact('profile_mes', 'main_mes'));
    }


    private function getMesProfile()
    {
        $profile = Profile::where('user_id', Auth::id())->first();
        return collect($profile)->every(function ($value, $key) {
            return $value != "" && $value != null;
        });
    }

    private function getMesMain()
    {
        $user = User::findOrFail(Auth::id())->toArray();
        foreach($user as $key => $value) {
            if ($key == 'name' || $key == 'email') {
                if ($value == "" && $value == null) {
                    return false;
                }
            }
        }
        return true;
    }

}
