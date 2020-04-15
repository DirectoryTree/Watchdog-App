<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    /**
     * Display a list of all users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('users.index', ['users' => User::get()]);
    }

    /**
     * Display the form for creating the user.
     *
     * @param User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(User $user)
    {
        return view('users.create', ['user' => $user]);
    }

    /**
     * Create the user.
     *
     * @param UserRequest $request
     * @param User        $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $user)
    {
        $request->persist($user);

        return redirect()->route('users.index');
    }

    /**
     * Display the form for editing the user.
     *
     * @param User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the user.
     *
     * @param UserRequest $request
     * @param User        $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $request->persist($user);

        return redirect()->route('users.index');
    }

    /**
     * Delete the user.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        // Don't allow the user to delete themselves.
        if ($user->is(auth()->user())) {
            return redirect()->route('users.edit', $user);
        }

        // Don't allow deletion when they are the only user.
        if (User::count() == 1) {
            return redirect()->route('users.edit', $user);
        }

        $user->delete();

        return redirect()->route('users.index');
    }
}
