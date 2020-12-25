<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventorySuppliers;
use App\Http\Requests\SuppliersRequest;

class inventorySuppliersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = InventorySuppliers::all();
        return view('pages.suppliers.index')->with([
            'items' => $item,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuppliersRequest $request)
    {
        $data = $request->all();
        InventorySuppliers::create($data);
        if($data)
        return redirect()->route('suppliers.index')->with(['success' => 'Data Berhasil Disimpan!']);
        else
        return redirect()->route('suppliers.index')->with(['error' => 'Data Gagal Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = InventorySuppliers::findOrFail($id);
        return view('pages.suppliers.edit')->with([
            'item' => $items,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SuppliersRequest $request, $id)
    {
        $data = $request->all();
        $item = InventorySuppliers::findOrFail($id);
        $item->update($data);
        if($data)
        return redirect()->route('suppliers.index')->with(['success' => 'Data Berhasil Diupdate!']);
        else
        return redirect()->route('suppliers.index')->with(['error' => 'Data Gagal Diupdate!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = InventorySuppliers::findOrFail($id);
        $item->delete();
        if($item)
        return redirect()->route('suppliers.index')->with(['success' => 'Data Berhasil Didelete!']);
        else
        return redirect()->route('suppliers.index')->with(['error' => 'Data Gagal Didelete!']);
    }
}
