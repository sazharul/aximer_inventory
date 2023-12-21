<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Response;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function get_single_purchase($id)
    {
        $purchase = PurchaseDetails::where('purchase_id', $id)->get();
        return Response::json($purchase);
    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $purchase = Purchase::where('purchase_id', 'LIKE', "%$keyword%")
                ->orWhere('total', 'LIKE', "%$keyword%")
                ->orWhere('supplier_name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $purchase = Purchase::latest()->paginate($perPage);
        }

        return view('backend.purchase.index', compact('purchase'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['products'] = Product::where('status', 1)->select('id', 'name', 'code')->get();
        $data['supplier'] = Supplier::where('status', 1)->select('id', 'name')->get();
        return view('backend.purchase.create', $data);
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

        $str = Purchase::orderBy('id', 'desc')->first();
        if (isset($str)) {
            $str = $str->purchase_id + 1;
        } else {
            $str = date('y') . date('m') . str_pad(1, 4, "0", STR_PAD_LEFT);
        }

        $requestData['purchase_id'] = $str;
        $requestData['supplier_id'] = $request->supplier_id;

        $grand_total = 0;
        $l = 0;
        foreach ($request->product_id as $item) {
            $grand_total += $request->qty[$l] * $request->unit_price[$l];
            $l++;
        }

        $requestData['total'] = $grand_total;
        $purchase = Purchase::create($requestData);

        $m = 0;
        foreach ($request->product_id as $item) {
            $find_product = Product::where('id', $item)->first();
            PurchaseDetails::create([
                'purchase_id' => $purchase->id,
                'product_id' => $find_product->id,
                'code' => $find_product->code,
                'product_name' => $find_product->name,
                'qty' => $request->qty[$m],
                'price' => $request->unit_price[$m],
                'total' => $request->qty[$m] * $request->unit_price[$m],
            ]);
            $m++;
        }

        return redirect('purchase')->with('flash_message', 'Purchase added!');
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
        $purchase = Purchase::with('purchaseDetails')->findOrFail($id);

        return view('backend.purchase.show', compact('purchase'));
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
        $data['purchase'] = Purchase::findOrFail($id);
        $data['products'] = Product::where('status', 1)->select('id', 'name', 'code')->get();
        $data['supplier'] = Supplier::where('status', 1)->select('id', 'name')->get();

        return view('backend.purchase.edit', $data);
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

        $purchase = Purchase::where('id', $id)->first();
        $purchase->update($requestData);

        $m = 0;
        $purchase->purchaseDetails()->delete();
        foreach ($request->product_id as $item) {
            $find_product = Product::where('id', $item)->first();
            PurchaseDetails::create([
                'purchase_id' => $purchase->id,
                'product_id' => $find_product->id,
                'code' => $find_product->code,
                'product_name' => $find_product->name,
                'qty' => $request->qty[$m],
                'price' => $request->unit_price[$m],
                'total' => $request->qty[$m] * $request->unit_price[$m],
            ]);
            $m++;
        }

        return redirect('purchase')->with('flash_message', 'Purchase updated!');
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
        $purchase = Purchase::where('id', $id)->first();
        $purchase->delete();
        $purchase->purchaseDetails()->delete();

        return redirect('purchase')->with('flash_message', 'Purchase deleted!');
    }
}
