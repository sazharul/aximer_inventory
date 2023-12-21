<?php

namespace App\Http\Controllers;

use App\Models\CashCollection;
use App\Models\Expense;
use App\Models\PayPurchase;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DailyCashReportController extends Controller
{
    public function daily_cash_closing(Request $request)
    {
        $data['date'] = $date = $request->get('date');

        if (!isset($date)) {
            $date = Carbon::now()->toDateString();
        }

        $cash_collection = CashCollection::where(function ($query) use ($date) {
            if (isset($date)) {
                $query->whereDate('created_at', '=', $date);
            }
        });

        $payment = PayPurchase::where(function ($query) use ($date) {
            if (isset($date)) {
                $query->whereDate('created_at', '=', $date);
            }
        });

        $expense = Expense::where(function ($query) use ($date) {
            if (isset($date)) {
                $query->whereDate('created_at', '=', $date);
            }
        });


        $before_collection = CashCollection::where(function ($query) use ($date) {
            if (isset($date)) {
                $query->whereDate('created_at', '<', $date);
            }
        })->sum('amount');

        $before_payment = PayPurchase::where(function ($query) use ($date) {
            if (isset($date)) {
                $query->whereDate('created_at', '<', $date);
            }
        })->sum('amount');

        $before_expense = Expense::where(function ($query) use ($date) {
            if (isset($date)) {
                $query->whereDate('created_at', '<', $date);
            }
        })->sum('amount');


        $data['cash_collection'] = $cash_collection->sum('amount');
        $data['purchase_payment'] = $payment->sum('amount');
        $data['expense'] = $expense->sum('amount');
        $data['opening_cash'] = $before_collection - $before_payment - $before_expense;

        return view('backend.report.daily_cash', $data);
    }
}
