<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $stock = Stock::where('product_id', 'LIKE', "%$keyword%")
                ->orWhere('purchase_id', 'LIKE', "%$keyword%")
                ->orWhere('purchase_no', 'LIKE', "%$keyword%")
                ->orWhere('qty', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $stock = Stock::latest()->paginate($perPage);
        }

        return view('backend.stock.index', compact('stock'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.stock.create');
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

        $requestData = $request->except('date');


        if (isset($request->date)) {
            $requestData['date'] = $request->date;
        } else {
            $requestData['date'] = Carbon::now()->toDateString();
        }

        $find_product = Product::where('id', $request->product_id)->first();
        $find_product->update([
            'stock' => $find_product->stock + $request->qty
        ]);

        $find_purchase = Purchase::where('id', $request->purchase_id)->first();
        if (isset($find_purchase)) {
            $requestData['purchase_no'] = $find_purchase->purchase_id;
        }


        Stock::create($requestData);


        return redirect('stock')->with('flash_message', 'Stock added!');
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
        $stock = Stock::findOrFail($id);

        return view('backend.stock.show', compact('stock'));
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
        $stock = Stock::findOrFail($id);
        return view('backend.stock.edit', compact('stock'));
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

        $find_purchase = Purchase::where('id', $request->purchase_id)->first();

        if (isset($find_purchase)) {
            $requestData['purchase_no'] = $find_purchase->purchase_id;
        }

        $stock = Stock::findOrFail($id);
        $find_product = Product::where('id', $request->product_id)->first();

        // check if same product
        if ($stock->product_id == $request->product_id) {

            if ($stock->qty < $request->qty) {
                $stock_qty = $find_product->stock + ($request->qty - $stock->qty);
            } else {
                $stock_qty = $find_product->stock - ($stock->qty - $request->qty);
            }

        } else {
            $stock_qty = $find_product->stock + $request->qty;
            $find_old_product = Product::where('id', $stock->product_id)->first();

            if (isset($find_old_product)) {
                $find_old_product->update([
                    'stock' => $find_old_product->stock - $stock->qty
                ]);
            }
        }


        $find_product->update([
            'stock' => $stock_qty
        ]);


        $stock->update($requestData);

        return redirect('stock')->with('flash_message', 'Stock updated!');
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

        $stock = Stock::where('id', $id)->first();
        $find_product = Product::where('id', $stock->product_id)->first();
        if (isset($find_product)) {
            $find_product->update([
                'stock' => $find_product->stock - $stock->qty
            ]);
        }

        $stock->delete();

        return redirect('stock')->with('flash_message', 'Stock deleted!');
    }
}
