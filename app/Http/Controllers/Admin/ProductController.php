<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Facades\App\Http\Repositories\ProductRepository;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\Backend\ProductResource;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductRepository::paginate(20);
        return Inertia::render('Views/product/index', [
            'title' => 'Products',
            'products' => ProductResource::collection($products),
            'trash' => request('trash') ? true : false,
            'breadcumb' => [
                [
                    'text' => 'Dashboard',
                    'url' => route('dashboard'),
                ],
                [
                    'text' => 'Product',
                    'url' => route('product.index')
                ],
            ],
        ]);
    }

    /**
    * create view
    */
    public function create()
    {
        $product = new Product;
        return Inertia::render('Views/product/form', [
            'product' => ProductResource::make($product),
            'method' => 'store',
            'title' => 'Create ' . 'Product' ,
            'breadcumb' => [
                [
                    'text' => 'Dashboard',
                    'url' => route('dashboard'),
                ],
                [
                    'text' => 'Product',
                    'url' => route('product.index')
                ],
            ],
        ]);
    }

    /**
    * store data
    */
    public function store(ProductRequest $request, Product $product)
    {
        $product = Product::create($request->all());

        createLogAdmin('Product', 'Create', $product->title ?? null, $product->getChanges());

        Cache::tags(['products'])->flush();
        return redirect()->route('product.index')->with('message', toTitle($product->title) . ' has been created');
    }

    /**
    * Edit view
    */
    public function edit(Product $product)
    {
        return Inertia::render('Views/product/form', [
            'product' => $product,
            'type' => type(),
            'method' => 'update',
            'title' => 'Edit ' . 'Product',
            'locale' => app()->getLocale(),
            'breadcumb' => [
                [
                    'text' => 'Dashboard',
                    'url' => route('dashboard'),
                ],
                [
                    'text' => 'Product',
                    'url' => route('product.index')
                ],
            ],
        ]);
    }

    /**
    * Update Data
    */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());
        createLogAdmin('Product', 'Update', $product->title ?? null, $product->getChanges());
        Cache::tags(['products'])->flush();
        return redirect()->back()->with('message', toTitle($product->title) . ' has been updated');
    }

    /**
    * Remove the specified resource from storage temporary.
    */
    public function delete($product)
    {
        $product = Product::find($product);
        if(!$product){
            return abort(404);
        }
        createLogAdmin('Product', 'Delete', $product->title ?? null, $product->getChanges());
        $product->delete();

        Cache::tags(['products'])->flush();
        return redirect()->back()->with('message', toTitle($product->title . ' hase been deleted'));
    }

    /**
     * Remove data permanently
     */
    public function destroy($product)
    {
        $product = Product::withTrashed()->find($product);
        if(!$product){
            return abort(404);
        }
        createLogAdmin('Product', 'Destroy', $product->title ?? null, $product->getChanges());
        $product->forceDelete();

        Cache::tags(['products'])->flush();
        return redirect()->back()->with('message', toTitle($product->title . ' hase been destroyed'));
    }

    public function destroyAll()
    {
       $ids = explode(',',request('selected'));
       $products = Product::whereIn('_id',$ids)->withTrashed()->get();
       foreach ($products as $product) {
          $product->forceDelete();
       }
       Cache::tags(['products'])->flush();
       return redirect()->back()->with('message', toTitle($product->title) . ' has been destroyed');
    }

    /**
     * Restore Data from trash
     */
    public function restore($product)
    {
       $product = Product::withTrashed()->find($product);
       if(!$product){
           return abort(404);
       }
       createLogAdmin('Product', 'Restore', $product->title ?? null, $product->getChanges());
       $product->restore();
       Cache::tags(['products'])->flush();
       return redirect()->back()->with('message', toTitle($product->title) . ' has been restored');
    }
}
