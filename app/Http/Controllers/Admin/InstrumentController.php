<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instruments;
//use Illuminate\Http\Request;
use App\Http\Requests\AdminHandbookRequest;

class InstrumentController extends Controller
{

    private $pageTitle = 'Инструменты: топливо, базис и лот поставки';
    private $createRoute = 'admin.instrument.create';
    private $editRoute = 'admin.instrument.edit';
    private $destroyRoute = 'admin.instrument.destroy';
    private $indexRoute = 'admin.instrument.index';
    private $storeRoute = 'admin.instrument.store';
    private $updateRoute = 'admin.instrument.update';

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        return view('admin.handbooks.model2_content', [
            'title' => $this->pageTitle,
            'models' => Instruments::paginate(5),
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
        if (Instruments::create($request->except('_token'))) {
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
            $good = Instruments::find($request->id);
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
        //dd($id, gettype($id));// Внедрение модели (Goods $goods) тут не работает
        $good = Instruments::find($id);

        if($good->delete()) {
            return redirect()->route($this->indexRoute)
                ->with(['status' => 'Данные успешно удалены.']);
        }

        return redirect()->back()
            ->with(['error' => 'Ошибка удаления данных.']);
    }
}
