<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return User::all();
    }

    /**
     * @param Request $request
     * @param User $user
     * @return User
     */
    public function store(Request $request, User $user)
    {
        $user->create($request->all());
        return $user->refresh();
    }

    /**
     * @param User $user
     * @return User
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * @param Request $request
     * @param User $user
     * @return User
     */
    public function update(Request $request, User $user)
    {
        $user->update($request);
        return $user->refresh();
    }

    /**
     * @param User $user
     * @return bool
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
    }
}
