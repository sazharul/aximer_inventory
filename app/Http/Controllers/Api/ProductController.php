<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $category_id = $request->get('category_id');
        $company_id = json_decode($request->get('company_id'));
        $price = $request->get('price');
        $discount_price = $request->get('discount_price');
        $discount_percentage = $request->get('discount_percentage');
        $is_flash_sale = $request->get('is_flash_sale');

        if ($request->get('pagination')) {
            $perPage = $request->get('pagination');
        } else {
            $perPage = 15;
        }

        $products = Product::where('status', 1)
            ->where(function ($query) use($keyword, $category_id, $company_id, $price, $discount_price, $discount_percentage, $is_flash_sale) {
                if (isset($keyword)){
                    $query->where('name', 'LIKE', "%$keyword%");
                }
                if (isset($category_id)){
                    $query->where('category_id', $category_id);
                }
                if (isset($company_id)){
                    $query->whereIn('company_id', $company_id);
                }
                if (isset($price)){
                    $query->where('price', 'LIKE', "%$price%");
                }
                if (isset($discount_price)){
                    $query->where('discount_price', 'LIKE', "%$discount_price%");
                }
                if (isset($discount_percentage)){
                    $query->where('discount_percentage', 'LIKE', "%$discount_percentage%");
                }
                if (isset($is_flash_sale)){
                    $query->where('is_flash_sale', $is_flash_sale);
                }
            })->with('company')
            ->orderBy('name', 'asc')->paginate($perPage);


        //$products->get();

        return $this->sendResponse($products, 'Products retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $product = Product::create($input);

        return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $product->name = $input['name'];
        $product->detail = $input['detail'];
        $product->save();

        return $this->sendResponse(new ProductResource($product), 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return $this->sendResponse([], 'Product deleted successfully.');
    }
}
