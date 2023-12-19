<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
        $date = $request->input('month');

        if (!isset($date)){
            $data['today_order'] = Order::whereDate('created_at', Carbon::today())->count();
            $data['today_sell'] = Order::whereDate('created_at', Carbon::today())->whereIn('status', ['Approved', 'Delivered'])->sum('total');

            $year = date('Y');
            $month = date('m');

            $data['monthly_order'] = Order::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->count();
            $data['monthly_sell'] = Order::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->whereIn('status', ['Approved', 'Delivered'])->sum('total');

            $data['total_order'] = Order::count();
            $data['total_sell'] = Order::whereIn('status', ['Approved', 'Delivered'])->sum('total');
        }else {
            $data['today_order'] = Order::whereDate('created_at', Carbon::today())->count();
            $data['today_sell'] = Order::whereDate('created_at', Carbon::today())->whereIn('status', ['Approved', 'Delivered'])->sum('total');

            $data['year'] = explode('-',$date)[0];
            $data['month'] = explode('-',$date)[1];

            $data['monthly_order'] = Order::whereYear('created_at', '=', $data['year'])->whereMonth('created_at', '=', $data['month'])->count();
            $data['monthly_sell'] = Order::whereYear('created_at', '=', $data['year'])->whereMonth('created_at', '=', $data['month'])->whereIn('status', ['Approved', 'Delivered'])->sum('total');

            $data['total_order'] = Order::count();
            $data['total_sell'] = Order::whereIn('status', ['Approved', 'Delivered'])->sum('total');
        }


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
