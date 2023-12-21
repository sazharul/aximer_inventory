<?php

namespace App\Http\Controllers;

use App\Models\CashCollection;
use App\Models\Expense;
use App\Models\Order;
use App\Models\PayPurchase;
use App\Models\PurchaseInvoice;
use App\Models\SaleInvoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $today = Carbon::now()->toDateString();

        $data['total_sale_invoice'] = SaleInvoice::sum('total');
        $data['today_sale_invoice'] = SaleInvoice::where('date', $today)->sum('total');
        $data['this_month_sale_invoice'] = SaleInvoice::whereMonth('date', date('m'))->sum('total');

        $data['total_purchase_invoice'] = PurchaseInvoice::sum('total');
        $data['today_purchase_invoice'] = PurchaseInvoice::where('date', $today)->sum('total');
        $data['this_month_purchase_invoice'] = PurchaseInvoice::whereMonth('date', date('m'))->sum('total');

        $data['total_cash_collection_invoice'] = CashCollection::sum('amount');
        $data['today_cash_collection_invoice'] = CashCollection::where('date', $today)->sum('amount');
        $data['this_month_cash_collection_invoice'] = CashCollection::whereMonth('date', date('m'))->sum('amount');

        $data['total_expense_invoice'] = Expense::sum('amount');
        $data['today_expense_invoice'] = Expense::where('created_at', $today)->sum('amount');
        $data['this_month_expense_invoice'] = Expense::whereMonth('created_at', date('m'))->sum('amount');

        $data['total_payment_invoice'] = PayPurchase::sum('amount');
        $data['today_payment_invoice'] = PayPurchase::where('date', $today)->sum('amount');
        $data['this_month_payment_invoice'] = PayPurchase::whereMonth('date', date('m'))->sum('amount');

        return view('dashboard', $data);
    }

    public function user_list()
    {
        $data['users'] = User::where('role', '!=', 'admin')->where('status', 'Pending')->paginate(15);
        $data['status'] = 'Pending';
        return view('users.index', $data);
    }

    public function approved_user_list()
    {
        $data['users'] = User::where('role', '!=', 'admin')->where('status', 'Approved')->paginate(15);
        $data['status'] = 'Approved';
        return view('users.index', $data);
    }

    public function approved_user($id)
    {
        $data['users'] = User::where('id', $id)->update([
            'status' => 'Approved'
        ]);
        return back();
    }
}
