<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
//use Illuminate\Http\Request;
use App\Http\Requests\AdminStoreUserRequest;
use App\Http\Requests\AdminUpdateUserRequest;
//use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //if (Gate::allows('is-admin')) {
        //    // here actions allows for admin
        //}
        //dd('You need to be an admin... you none');

        $title = 'Менеджер пользователей';
        $users = User::paginate(10);

        return view('admin.users.users_content')
            ->with(['title'=>$title, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Добавить пользователя';

        return view('admin.users.users_create')->with(['title'=>$title]);
    }

    /**
     * @param AdminStoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminStoreUserRequest $request)
    {
        //dd($request);

        $data = $request->except('_token', 'password_confirmation');
        //тк в модели поставлен setPasswordAttribute($password). если там его нет, тут (ниже) раскомменировать
        //$data['password'] = bcrypt($data['password']);

        if(User::create($data)) {
            return redirect()->route('admin.user.index')
                ->with(['status' => 'Пользователь успешно добавлен']);
        }

        $request->flash();
        return redirect()->route('admin.user.index')
            ->with(['error' => 'Ошибка добавления пользователя']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(User $user)
    {
        $title = 'Редактирование пользователя';

        return view('admin.users.users_create')
            ->with(['title'=>$title, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdminUpdateUserRequest  $request
     * @param  User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminUpdateUserRequest $request, User $user)
    {
        $data = $request->except('_token', '_method' ,'password_confirmation');

        if(isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $user->password;
        }

        if($user->update($data)) {
            return redirect()->route('admin.user.index')
                ->with(['status' => 'Пользователь был успешно изменен']);
        }

        return redirect()->route('admin.user.index')
            ->with(['error' => 'Ошибка измения пользователя']);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if($user->delete()) {
            return redirect()->route('admin.user.index')
                ->with(['status' => 'Пользователь успешно удален']);
        }

        return redirect()->route('admin.user.index')
            ->with(['error' => 'Ошибка удаления данных.']);
    }
}
