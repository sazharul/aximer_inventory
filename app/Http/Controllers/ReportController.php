<?php

namespace App\Http\Controllers;

use App\Models\CashCollection;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Sale;
use App\Models\SaleInvoice;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function cash_collection_report(Request $request)
    {
        $data['start_date'] = $start_date = $request->get('start_date');
        $data['end_date'] = $end_date = $request->get('end_date');
        $perPage = 20;

        $cash_collection_list = CashCollection::where(function ($query) use ($start_date) {
            if (isset($start_date)) {
                $query->whereDate('created_at', '>=', $start_date);
            }
        })
            ->where(function ($query) use ($end_date) {
                if (isset($end_date)) {
                    $query->whereDate('created_at', '<=', $end_date);
                }
            });


        $data['cash_collection_total'] = $cash_collection_list->sum('amount');
        $data['cash_collection'] = $cash_collection_list->latest()->paginate($perPage);

        return view('backend.report.cash_collection_report', $data);
    }

    public function customer_invoice_list(Request $request, $id)
    {
        $perPage = 20;
        $sale = Sale::where('customer_id', $id)->pluck('id');
        $data['saleinvoice'] = SaleInvoice::whereIn('sale_id', $sale)->paginate($perPage);

        return view('backend.report.customer_invoice_list', $data);
    }

    public function customer_outstanding_report(Request $request)
    {
        $customer_name = $request->get('customer');
        $data['start_date'] = $request->get('start_date');
        $data['end_date'] = $request->get('end_date');

        $perPage = 20;

        $data['customer'] = Customer::where(function ($query) use ($customer_name) {
            if (isset($customer_name) && $customer_name != 'All') {
                $query->where('name', $customer_name);
            }
        })->paginate($perPage);

        return view('backend.report.customer_outstanding_report', $data);
    }

    public function expense_report(Request $request)
    {
        $keyword = $request->get('search');
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $category = $request->get('category');
        $perPage = 20;

        $expense = Expense::with('expenseCategory')->latest()
            ->where(function ($query) use ($keyword) {
                if (isset($keyword)) {
                    $query->where('category_id', 'LIKE', "%$keyword%")
                        ->orWhere('amount', 'LIKE', "%$keyword%")
                        ->orWhere('note', 'LIKE', "%$keyword%")
                        ->orWhere('status', 'LIKE', "%$keyword%");
                }
            })
            ->where(function ($query) use ($start_date) {
                if (isset($start_date)) {
                    $query->whereDate('created_at', '>=', $start_date);
                }
            })
            ->where(function ($query) use ($end_date) {
                if (isset($end_date)) {
                    $query->whereDate('created_at', '<=', $end_date);
                }
            })
            ->whereHas('expenseCategory', function ($query) use ($category) {
                if (isset($category) && $category != 'All') {
                    $query->where('name', $category);
                }
            });

        $data['expense_total'] = $expense->sum('amount');
        $data['expense'] = $expense->paginate($perPage);

        return view('backend.report.expense', $data);
    }
}
