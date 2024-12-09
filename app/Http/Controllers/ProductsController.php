<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Sections;
use Illuminate\Http\Request;
use App\Http\Requests\ProductsRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();
        $sections = Sections::all();
        return view('products.products', compact('products', 'sections'));
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
    public function store(ProductsRequest $request)
    {
        $validated = $request->validated();

        Products::create([
            'product_name' => $request->product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        session()->flash('add', 'تم اضافه المنتج بنجاح');
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }


    public function edit(Request $request) {}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $products = Products::findOrFail($request->id);
        $validated = $request->validate(
            [
                'product_name' => ['required', 'max:255', 'unique:products,product_name,' . $id . ',id'],
                'description' => ['required'],
            ],
            [
                'product_name.required' => '  برجاء ادخال اسم المنتج ',
                'product_name.unique' => 'هذا المنتج موجود بالفعل',
                'product_name.max' => 'لقد تجاوزت الحد الاقصي ',
                'description.required' => ' برجاء ادخال  الوصف',
            ]
        );
        $products->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'section_id' => $request->section_id,
            'updated_at' => now(),
        ]);
        session()->flash('edit', 'تم التعديل بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $products = Products::findOrFail($request->id);
        $products->delete($request->id);
        session()->flash("delete", "لقد تم حذف القسم بنجاح");
        return redirect()->back();
    }
}
