<?php

namespace App\Cabinet\Http\Controllers\Profile;

use App\Cabinet\Http\Requests\Profile\UpdateProfileRequest;
use App\Common\Http\Controllers\Controller;
use App\Cabinet\Entity\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class ProfileController extends Controller
{

    public function edit()
    {
        $profile = Profile::where('user_id', Auth::id())->first();
        $this->checkAccess($profile);
        return view('cabinet.profile.edit', compact('profile'));
    }

    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        $this->checkAccess($profile);
        $profile->edit(
            $request['firstname'],
            $request['lastname'],
            $request['surname'],
            $request['address'],
            $request['phone']
        );
        return redirect()->route('cabinet.home')->with('success', 'Ви успішно обновили профіль.');
    }

    private function checkAccess(Profile $profile): void
    {
        if (!Gate::allows('manage-own-profile', $profile)) {
            abort(403);
        }
    }
}
