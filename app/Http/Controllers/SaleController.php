<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Response;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function get_single_sale($id)
    {
        $sale = SaleDetail::where('sale_id', $id)->get();
        return Response::json($sale);
    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $sale = Sale::where('sale_id', 'LIKE', "%$keyword%")
                ->orWhere('total', 'LIKE', "%$keyword%")
                ->orWhere('supplier_name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $sale = Sale::latest()->paginate($perPage);
        }

        return view('backend.sale.index', compact('sale'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['products'] = Product::where('status', 1)->select('id', 'name', 'code')->get();
        $data['supplier'] = Customer::where('status', 1)->select('id', 'name')->get();
        return view('backend.sale.create', $data);
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


        $requestData = $request->except('_token');

        $str = Sale::orderBy('id', 'desc')->first();
        if (isset($str)) {
            $str = $str->sale_id + 1;
        } else {
            $str = date('y') . date('m') . str_pad(1, 4, "0", STR_PAD_LEFT);
        }

        $requestData['sale_id'] = $str;
        $requestData['supplier_name'] = $request->supplier_name;

        $grand_total = 0;
        $l = 0;
        foreach ($request->product_id as $item) {
            $grand_total += $request->qty[$l] * $request->unit_price[$l];
            $l++;
        }

        $requestData['total'] = $grand_total;
        $sale = Sale::create($requestData);

        $m = 0;
        foreach ($request->product_id as $item) {
            $find_product = Product::where('id', $item)->first();
            SaleDetail::create([
                'sale_id' => $sale->id,
                'product_id' => $find_product->id,
                'code' => $find_product->code,
                'product_name' => $find_product->name,
                'qty' => $request->qty[$m],
                'price' => $request->unit_price[$m],
                'total' => $request->qty[$m] * $request->unit_price[$m],
            ]);
            $m++;
        }

        return redirect('sale')->with('flash_message', 'Sale added!');
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
        $sale = Sale::with('saleDetails')->findOrFail($id);

        return view('backend.sale.show', compact('sale'));
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
        $data['sale'] = Sale::findOrFail($id);
        $data['products'] = Product::where('status', 1)->select('id', 'name', 'code')->get();
        $data['supplier'] = Customer::where('status', 1)->select('id', 'name')->get();

        return view('backend.sale.edit', $data);
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

        $requestData['supplier_name'] = $request->supplier_name;

        $grand_total = 0;
        $l = 0;
        foreach ($request->product_id as $item) {
            $grand_total += $request->qty[$l] * $request->unit_price[$l];
            $l++;
        }

        $requestData['total'] = $grand_total;

        $sale = Sale::where('id', $id)->first();
        $sale->update($requestData);

        $m = 0;
        $sale->saleDetails()->delete();
        foreach ($request->product_id as $item) {
            $find_product = Product::where('id', $item)->first();
            SaleDetail::create([
                'sale_id' => $sale->id,
                'product_id' => $find_product->id,
                'code' => $find_product->code,
                'product_name' => $find_product->name,
                'qty' => $request->qty[$m],
                'price' => $request->unit_price[$m],
                'total' => $request->qty[$m] * $request->unit_price[$m],
            ]);
            $m++;
        }

        return redirect('sale')->with('flash_message', 'Sale updated!');
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
        $sale = Sale::where('id', $id)->first();
        $sale->delete();
        $sale->saleDetails()->delete();

        return redirect('sale')->with('flash_message', 'Sale deleted!');
    }
}
