<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function get_single_product($id)
    {
        $product = Product::where('id', $id)->first();
        return Response::json($product);
    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $data['product'] = DB::table("products")
            ->leftJoin('categories', function ($join) {
                $join->on('products.category_id', '=', 'categories.id');
            })
            ->leftJoin('suppliers', function ($join) {
                $join->on('products.supplier_id', '=', 'suppliers.id');
            })
            ->select(
                'products.id',
                'products.image',
                'products.name',
                'products.category_id',
                'products.supplier_id',
                'products.price',
                'products.code',
                'products.product_color',
                'products.product_size',
                'categories.name as category_name',
                'suppliers.name as supplier_name',
                'products.status'
            )
            ->where(function ($query) use ($keyword) {
                if (isset($keyword)) {
                    $query->where('products.name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('categories.name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('suppliers.supplier_name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('products.price', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('products.code', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('products.product_color', 'LIKE', '%' . $keyword . '%');
                }
            })->orderBy('products.created_at', 'desc')
            ->paginate(15);

        return view('backend.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads');
            $file->move($destinationPath, $fileName);
            $requestData['image'] = 'uploads/' . $fileName;
        }

        Product::create($requestData);

        return redirect('product')->with('flash_message', 'Product added!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('backend.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('backend.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads');
            $file->move($destinationPath, $fileName);
            $requestData['image'] = 'uploads/' . $fileName;
        }

        $product = Product::findOrFail($id);
        $product->update($requestData);

        return redirect('product')->with('flash_message', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect('product')->with('flash_message', 'Product deleted!');
    }
}
