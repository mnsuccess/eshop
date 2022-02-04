<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditTrail;
use App\Models\Product;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    /**
    * Listing of the resource
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->select('name', 'id', 'description', 'price', 'discount', 'image')->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    /**
     * view form for the new ressource
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * store the new ressource
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $validated = $request->validated();
        $product = Product::create($validated);
        AuditTrail::addToAudit('Product', $validated, 'Loaded Product '.$product->id);
        return  redirect(route('product.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.create', compact('product'));
    }

    /**
     * update the resource
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $validated  = $request->validated();
        $product->update($validated);
        AuditTrail::addToAudit('Product', $validated, 'Updated Product '.$product->id);
        return  redirect(route('product.index'));
    }

    /**
     * Remove the related resource
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return  redirect(route('product.index'));
    }
}
