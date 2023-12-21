<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleInvoice;
use App\Models\SaleInvoiceDetail;
use Illuminate\Http\Request;

class SaleInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function pay_sale_due(Request $request, $id)
    {
        $pay = $request->payment_amount;
        $find_sale_invoice = SaleInvoice::where('id', $id)->first();

        if (isset($find_sale_invoice)) {
            $find_sale_invoice->update([
                'paid' => $find_sale_invoice->paid + $pay,
                'due' => $find_sale_invoice->due - $pay
            ]);
        }

        return redirect('sale-invoice')->with('flash_message', 'Paid Successfully');
    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $saleinvoice = SaleInvoice::with('customerDetails')
                ->where('sale_no', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->orWhere('payment_type', 'LIKE', "%$keyword%")
                ->orWhere('total', 'LIKE', "%$keyword%")
                ->orWhere('discount', 'LIKE', "%$keyword%")
                ->orWhere('paid', 'LIKE', "%$keyword%")
                ->orWhere('due', 'LIKE', "%$keyword%")
                ->orWhereHas('customerDetails', function ($query) use ($keyword) {
                    if (isset($keyword)) {
                        $query->where('name', 'LIKE', "%$keyword%");
                    }
                })
                ->latest()->paginate($perPage);
        } else {
            $saleinvoice = SaleInvoice::latest()->paginate($perPage);
        }

        return view('backend.sale-invoice.index', compact('saleinvoice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['sale'] = Sale::select('id', 'sale_id')->get();
        return view('backend.sale-invoice.create', $data);
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

        $find_sale = Sale::where('id', $request->sale_id)->first();

        $sale_invoice = SaleInvoice::create([
            'sale_id' => $find_sale->id,
            'sale_no' => $find_sale->sale_id,
            'date' => $request->date,
            'payment_type' => $request->payment_type,
            'total' => $find_sale->total,
            'paid' => $request->paid_amount,
            'discount' => $request->discount_amount,
            'due' => $find_sale->total - $request->discount_amount - $request->paid_amount,
        ]);

        foreach ($find_sale->saleDetails as $item) {
            SaleInvoiceDetail::create([
                'sale_invoices_id' => $sale_invoice->id,
                'product_id' => $item->product_id,
                'code' => $item->code,
                'product_name' => $item->product_name,
                'qty' => $item->qty,
                'price' => $item->price,
                'total' => $item->total,
            ]);
        }


        return redirect('sale-invoice')->with('flash_message', 'SaleInvoice added!');
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
        $saleinvoice = SaleInvoice::findOrFail($id);

        return view('backend.sale-invoice.show', compact('saleinvoice'));
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
        $saleinvoice = SaleInvoice::with('saleInvoiceDetails')->findOrFail($id);

        return view('backend.sale-invoice.edit', compact('saleinvoice'));
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

        $saleinvoice = SaleInvoice::findOrFail($id);

        $saleinvoice->update([
            'paid' => $request->paid_amount,
            'discount' => $request->discount_amount,
            'due' => $saleinvoice->total - $request->discount_amount - $request->paid_amount,
        ]);

        return redirect('sale-invoice')->with('flash_message', 'SaleInvoice updated!');
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
        $saleInvoice = SaleInvoice::where('id', $id)->first();
        if ($saleInvoice) {
            $saleInvoice->delete();
            $saleInvoice->saleInvoiceDetails()->delete();
        }
        return redirect('sale-invoice')->with('flash_message', 'SaleInvoice deleted!');
    }
}
