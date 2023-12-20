<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseInvoice;
use App\Models\PurchaseInvoiceDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseInvoiceController extends Controller
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
            $purchaseinvoice = PurchaseInvoice::where('purchase_no', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->orWhere('payment_type', 'LIKE', "%$keyword%")
                ->orWhere('total', 'LIKE', "%$keyword%")
                ->orWhere('paid', 'LIKE', "%$keyword%")
                ->orWhere('due', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $purchaseinvoice = PurchaseInvoice::latest()->paginate($perPage);
        }

        return view('backend.purchase-invoice.index', compact('purchaseinvoice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['purchase'] = Purchase::select('id', 'purchase_id')->get();
        return view('backend.purchase-invoice.create', $data);
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

        $find_purchase = Purchase::where('id', $request->purchase_id)->first();

        $purchase_invoice = PurchaseInvoice::create([
            'purchase_id' => $find_purchase->id,
            'purchase_no' => $find_purchase->purchase_id,
            'date' => $request->date,
            'payment_type' => $request->payment_type,
            'total' => $find_purchase->total,
            'paid' => $request->paid_amount,
            'due' => $find_purchase->total - $request->paid_amount,
        ]);

        foreach ($find_purchase->purchaseDetails as $item) {
            PurchaseInvoiceDetail::create([
                'purchase_invoices_id' => $purchase_invoice->id,
                'product_id' => $item->product_id,
                'code' => $item->code,
                'product_name' => $item->product_name,
                'qty' => $item->qty,
                'price' => $item->price,
                'total' => $item->total,
            ]);
        }


        return redirect('purchase-invoice')->with('flash_message', 'PurchaseInvoice added!');
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
        $purchaseinvoice = PurchaseInvoice::findOrFail($id);

        return view('backend.purchase-invoice.show', compact('purchaseinvoice'));
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
        $purchaseinvoice = PurchaseInvoice::with('purchaseInvoiceDetails')->findOrFail($id);

        return view('backend.purchase-invoice.edit', compact('purchaseinvoice'));
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

        $purchaseinvoice = PurchaseInvoice::findOrFail($id);

        $purchaseinvoice->update([
            'paid' => $request->paid_amount,
            'due' => $purchaseinvoice->total - $request->paid_amount
        ]);

        return redirect('purchase-invoice')->with('flash_message', 'PurchaseInvoice updated!');
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
        $purchaseInvoice = PurchaseInvoice::where('id', $id)->first();
        if ($purchaseInvoice) {
            $purchaseInvoice->delete();
            $purchaseInvoice->purchaseInvoiceDetails()->delete();
        }
        return redirect('purchase-invoice')->with('flash_message', 'PurchaseInvoice deleted!');
    }
}
