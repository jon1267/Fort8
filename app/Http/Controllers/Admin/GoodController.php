<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Goods;
//use Illuminate\Http\Request;
use App\Http\Requests\AdminHandbookRequest;

/**
 * Class GoodController (заготовка под CRUD controller) Пока: копипастим:) этот контроллер, под др. именем.
 * вставляем в use нужную модель, нужные для create & update форм реквесты, прописываем (в private св-вах)
 * 6 штук имен [name(!)] роутов, как они получаются в Route::resource(...)
 * Вьюхи (model2_content, create_modal, update_modal)  работают в расчете что в мускуле имена полей
 * 'title' и 'description' ... (пока нет реакции на ошибки валидации - модалка, скрывается данные не пишутся)
 *
 * @package App\Http\Controllers\Admin
 */
class GoodController extends Controller
{

    private $pageTitle = 'Биржевые товары. Топливо.';
    private $createRoute = 'admin.good.create';
    private $editRoute = 'admin.good.edit';
    private $destroyRoute = 'admin.good.destroy';
    private $indexRoute = 'admin.good.index';
    private $storeRoute = 'admin.good.store';
    private $updateRoute = 'admin.good.update';

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        return view('admin.handbooks.model2_content', [
            'title' => $this->pageTitle,
            'models' => Goods::paginate(5),
            'createRoute' => $this->createRoute,
            'editRoute' => $this->editRoute,
            'destroyRoute' => $this->destroyRoute,
            'storeRoute' => $this->storeRoute,
            'updateRoute' => $this->updateRoute,
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
        //dd($request);
        if (Goods::create($request->except('_token'))) {
            return redirect()->route($this->indexRoute)
                ->with(['status' => 'Данные успешно добавлены']);
        }

        $request->flash();
        return redirect()->route($this->indexRoute)
            ->with(['error' => 'Ошибка добавления данных']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);
        //$model = Goods::find($id);
        //return view('admin.handbooks.update_modal', ['model' => $model])->render();
        //оно (выше) не запускает модальное окно с формой :( а значит нет смысла...
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
        //dd($request, $id);
        if ($request->has('id')) {
            $good = Goods::find($request->id);
            $good->update($request->except('_token', '_method', 'id'));

            return redirect()->route($this->indexRoute)
                ->with(['status' => 'Данные успешно изменены']);
        }

        $request->flash();
        return redirect()->route($this->indexRoute)
            ->with(['error' => 'Ошибка обновления данных']);

    }

    /**
     * @param Int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        //dd($id, gettype($id));// Внедрен модели (Goods $goods) тут не работает, тупо возвр null(!)
        $good = Goods::find($id);

        if($good->delete()) {
            return redirect()->route($this->indexRoute)
                ->with(['status' => 'Данные успешно удалены.']);
        }

        return redirect()->route($this->indexRoute)
            ->with(['error' => 'Ошибка удаления данных.']);
    }
}
