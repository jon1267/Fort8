<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Это почти копия UserController (в части работы с табл users)
 * но тут добавлены роли и много ко многим role_user (модели мигр., сидеры)
 * Те при сохранении attach($roles) или sync($roles). Вообще нужно
 * Class UserRoleController
 * @package App\Http\Controllers\Admin
 */
class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.users.users_roles_content', [
            'title' => 'Роли пользователей',
            'users' => User::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.users.users_roles_create', ['roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $user = User::create($request->except(['_token', 'roles']));

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.userr.index')
            ->with(['status' => 'Пользователь успешно добавлен']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $userr
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User  $userr)
    {
        return view('admin.users.users_roles_create', [
            'roles' => Role::all(),
            'userr' => $userr, //'userr' => User::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  User $userr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $userr)
    {
        //dd($request, $userr);
        $userr->update($request->except(['_token', '_method' ,'roles']));

        $userr->roles()->sync($request->roles);

        return redirect()->route('admin.userr.index')
            ->with(['status' => 'Данные пользователя изменены']);
    }

    /**
     * @param User $userr
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $userr)
    {
        if($userr->delete()) {
            return redirect()->route('admin.userr.index')
                ->with(['status' => 'Пользователь успешно удален']);
        }

        return redirect()->route('admin.userr.index')
            ->with(['error' => 'Ошибка удаления данных.']);
    }
}
