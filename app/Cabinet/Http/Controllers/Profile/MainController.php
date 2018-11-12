<?php

namespace App\Cabinet\Http\Controllers\Profile;

use App\Cabinet\Http\Requests\Profile\UpdateMainRequest;
use App\Common\Http\Controllers\Controller;
use App\Common\Entity\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class MainController extends Controller
{

    public function edit()
    {
        $user = User::findOrFail(Auth::id());
        $this->checkAccess($user);
        return view('cabinet.main.edit', compact('user'));
    }

    public function update(UpdateMainRequest $request, User $user)
    {
        $this->checkAccess($user);
        $user->editMain(
            $request['name'],
            $request['email']
        );
        return redirect()->route('cabinet.home')->with('success', 'Ви успішно обновили основні дані.');
    }

    private function checkAccess(User $user): void
    {
        if (!Gate::allows('manage-own-main', $user)) {
            abort(403);
        }
    }
}
