<?php

namespace App\Http\Controllers;

use App\Models\InventoryBrand;
use App\Models\InventoryItems;
use App\Models\InventoryCategories;
use App\Models\InventorySuppliers;
use App\Models\InventoryItemSuppliers;
use App\Http\Requests\ItemsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class inventoryItemsController extends Controller
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
        $brands = InventoryBrand::all();
        $categories = InventoryCategories::all();
        $suppliers = InventorySuppliers::all();
        $item = InventoryItems::all();
        return view('pages.items.index')->with([
            'items' => $item,
            'brands' => $brands,
            'categories' => $categories,
            'suppliers' => $suppliers
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
    public function store(ItemsRequest $request)
    {
        

        $data = $request->all();
        InventoryItems::create($data);
        if($data)
        return redirect()->route('items.index')->with(['success' => 'Data Berhasil Disimpan!']);
        else
        return redirect()->route('items.index')->with(['error' => 'Data Gagal Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands = InventoryBrand::all();
        $categories = InventoryCategories::all();
        $items = InventoryItems::findOrFail($id);
        return view('pages.items.edit')->with([
            'item' => $items,
            'brands' => $brands,
            'categories' => $categories
        ]);
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
        $validator = Validator::make($request->all(), [
            'brand_id' => 'required|integer|exists:inventory_brands,id',
            'category_id' => 'required|integer|exists:inventory_categories,id',
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'kode' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $data = $request->all();
        $item = InventoryItems::findOrFail($id);
        $item->update($data);
        if($data)
        return redirect()->route('items.index')->with(['success' => 'Data Berhasil Diupdate!']);
        else
        return redirect()->route('items.index')->with(['error' => 'Data Gagal Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = InventoryItems::findOrFail($id);
        $item->delete();
        if($item)
        return redirect()->route('items.index')->with(['success' => 'Data Berhasil Didelete!']);
        else
        return redirect()->route('items.index')->with(['error' => 'Data Gagal Didelete!']);
    }

    public function addquantity(Request $request)
    {
       
        $item = InventoryItems::findOrFail($request->item_id);
        $item->quantity = $item->quantity+$request->quantity_order;
        $item->save();

        $data = $request->all();
        $data['date_delivery'] = $request->date_delivery = date('Y-m-d H:i:s');
        InventoryItemSuppliers::create($data);
        if($data)
        return redirect()->route('items.index')->with(['success' => 'Data Berhasil Disimpan!']);
        else
        return redirect()->route('items.index')->with(['error' => 'Data Gagal Disimpan!']);
    }
    
}
