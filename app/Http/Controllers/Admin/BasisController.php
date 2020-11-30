<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Http\Requests\AdminBasisStoreRequest;
use App\Http\Requests\AdminBasisUpdateRequest;
use App\Models\Basis;


class BasisController extends Controller
{

    private $pageTitle = 'Коды базиса поставки.';
    private $createRoute = 'admin.basis.create';
    private $editRoute = 'admin.basis.edit';
    private $destroyRoute = 'admin.basis.destroy';
    private $indexRoute = 'admin.basis.index';
    private $storeRoute = 'admin.basis.store';
    private $updateRoute = 'admin.basis.update';

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.handbooks.model3_content', [
            'title' => $this->pageTitle,
            'models' => Basis::get(),
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
        // модалки пускаются по onclick="showModal()" тут ничего ненадо
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AdminBasisStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminBasisStoreRequest $request)
    {
        // dd($request);
        $basis = $request->validated();

        Basis::create($basis);

        return response()->json($basis);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // модалки пускаются по onclick="showModal()" тут ничего ненадо
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdminBasisUpdateRequest  $request
     * @param  Int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminBasisUpdateRequest $request, $id)
    {
        $basis = Basis::find($id);
        $basis->update($request->validated());

        return response()->json($basis);
    }

    /**
     * @param Int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $basis = Basis::find($id);
        $basis->delete();

        return redirect()->route($this->indexRoute)
            ->with(['status' => 'Данные успешно удалены.']);
    }
}
