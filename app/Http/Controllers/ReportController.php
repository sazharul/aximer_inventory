<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Expense;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function customer_outstanding_report(Request $request)
    {
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $customer_name = $request->get('customer');
        $perPage = 20;

        $customer = Customer::with('saleInvoice')
            ->where(function ($query) use ($customer_name) {
                if (isset($customer_name) && $customer_name != 'All') {
                    $query->where('name', $customer_name);
                }
            })
            ->whereHas('saleInvoice', function ($query) use ($start_date, $end_date) {
                $query->whereHas('saleInvoice', function ($q) use ($start_date, $end_date) {
                    if (isset($start_date)) {
                        $q->whereDate('created_at', '>=', $start_date);
                    }
                    if (isset($end_date)) {
                        $q->whereDate('created_at', '<=', $end_date);
                    }
                });
            });

        $data['customer'] = $customer->paginate($perPage);

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
