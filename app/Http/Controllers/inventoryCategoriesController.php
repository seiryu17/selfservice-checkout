<?php

namespace App\Http\Controllers;

use App\Models\InventoryCategories;
use Illuminate\Http\Request;

class inventoryCategoriesController extends Controller
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
        $item = InventoryCategories::all();
        return view('pages.categories.index')->with([
            'items' => $item
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
    public function store(Request $request)
    {
        $data = $request->all();

        InventoryCategories::create($data);
        if($data)
        return redirect()->route('categories.index')->with(['success' => 'Data Berhasil Disimpan!']);
        else
        return redirect()->route('categories.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = InventoryCategories::findOrFail($id);
        $item->delete();

        if($item)
        return redirect()->route('categories.index')->with(['success' => 'Data Berhasil Dihapus!']);
        else
        return redirect()->route('categories.index')->with(['error' => 'Data Gagal Disimpan!']);
    }
}
