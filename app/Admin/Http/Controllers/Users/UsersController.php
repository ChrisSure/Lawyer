<?php

namespace App\Admin\Http\Controllers\Users;

use App\Common\Entity\User;
use App\Admin\Http\Requests\Users\CreateRequest;
use App\Admin\Http\Requests\Users\UpdateRequest;
use App\Common\Http\Controllers\Controller;
use App\Common\UseCases\Auth\RegisterService;
use Illuminate\Http\Request;


class UsersController extends Controller
{
    private $register;

    public function __construct(RegisterService $register)
    {
        $this->register = $register;
        $this->middleware('can:admin.users');
    }

    public function index(Request $request)
    {
        $query = User::orderByDesc('id');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }

        if (!empty($value = $request->get('name'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('email'))) {
            $query->where('email', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('status'))) {
            $query->where('status', $value);
        }

        if (!empty($value = $request->get('role'))) {
            $query->where('role', $value);
        }

        $users = $query->paginate(20);

        $statuses = User::statusList();

        $roles = User::rolesList();

        return view('admin.users.index', compact('users', 'statuses', 'roles'));
    }

    public function create()
    {
        $roles = User::rolesList();
        return view('admin.users.create', compact('roles'));
    }

    public function store(CreateRequest $request)
    {
        $user = User::new(
            $request['name'],
            $request['email']
        );
        $user->changeRole($request['role']);
        return redirect()->route('admin.users.show', $user)->with('success', 'Ви успішно додали користувача.');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $statuses = User::statusList();
        $roles = User::rolesList();
        return view('admin.users.edit', compact('user', 'statuses', 'roles'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->only(['name', 'email', 'role']));
        if ($request['role'] !== $user->role) {
            $user->changeRole($request['role']);
        }
        return redirect()->route('admin.users.show', $user)->with('success', 'Ви успішно змінили дані користувача.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }

    public function verify(User $user)
    {
        $this->register->verify($user->id);
        return redirect()->route('admin.users.show', $user)->with('success', 'Ви успішно верифікували користувача.');
    }
}