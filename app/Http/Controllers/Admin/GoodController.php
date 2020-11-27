<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Goods;
//use Illuminate\Http\Request;
use App\Http\Requests\AdminHandbookRequest;

class GoodController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $title = 'Биржевые товары. Топливо.';
        $models = Goods::paginate(5);
        $createRoute = 'admin.good.create';
        $editRoute = 'admin.good.edit';
        $destroyRoute = 'admin.good.destroy';

        return view('admin.handbooks.model2_content', [
            'title' => $title,
            'models' => $models,
            'createRoute' => $createRoute,
            'editRoute' => $editRoute,
            'destroyRoute' => $destroyRoute,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // модалка c формой показывается по клику на кнопе создать, тут ничего не нужно...
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AdminHandbookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminHandbookRequest $request)
    {
        dd($request);
        if (Goods::create($request->except('_token'))) {
            return redirect()->route('admin.good.index')
                ->with(['status' => 'Данные успешно добавлены']);
        }

        $request->flash();
        return redirect()->route('admin.good.index')
            ->with(['error' => 'Ошибка добавления данных']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function edit(Goods $goods)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdminHandbookRequest  $request
     * @param  Int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminHandbookRequest $request, $id)
    {
        dd($request, $id);
    }

    /**
     * @param Int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        //dd($id, gettype($id));// Внедрение модели (Goods $goods) тут не работает
        $good = Goods::find($id);

        if($good->delete()) {
            return redirect()->route('admin.good.index')
                ->with(['status' => 'Данные успешно удалены.']);
        }

        return redirect()->back()
            ->with(['error' => 'Ошибка удаления данных.']);
    }
}
