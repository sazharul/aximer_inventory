<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\PrivacyPolicy;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Str;

class ApiController extends BaseController
{
    public function privacy_policy(Request $request){
        $data = PrivacyPolicy::first();
        return $this->sendResponse($data, 'Privacy policy retrieved successfully.');
    }

    public function slider_list(Request $request)
    {
        $slider = Slider::where('status', 1)->get();

        return $this->sendResponse($slider, 'Slider list retrieved successfully.');
    }

    public function order_list(Request $request)
    {
        $keyword = $request->get('search');
        if ($request->get('pagination')) {
            $perPage = $request->get('pagination');
        } else {
            $perPage = 15;
        }

        $products = Order::where('user_id', auth()->user()->id)
            ->with('orderDetails', 'area')
            ->where(function ($query) use ($keyword) {
                if (isset($keyword)) {
                    $query->where('user_name', 'LIKE', "%$keyword%")
                        ->orWhere('user_phone', 'LIKE', "%$keyword%");
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return $this->sendResponse($products, 'Order list retrieved successfully.');

    }

    public function order(Request $request)
    {

        $order = $request->except('order_details');
        $order['user_id'] = Auth::user()->id;
        $order['address'] = Auth::user()->address;

        $str = Order::orderBy('id', 'desc')->first()->id;
        $order['order_id'] = date('y').date('m'). str_pad($str,4,"0",STR_PAD_LEFT);

        $order = Order::create($order);
        $orderDetails = json_decode($request->order_details, true);

        foreach ($orderDetails as $item) {
            $allDetails = $item;
            $allDetails['order_id'] = $order->id;
            OrderDetails::create($allDetails);
        }

        $data = Order::where('id', $order->id)->with('orderDetails')->first();

        return $this->sendResponse($data, 'Order Placed successfully.');
    }

    public function my_profile()
    {
        $my_profile = Auth::user();
        $user = User::where('id', $my_profile->id)->with('district', 'area')->first();
        return $this->sendResponse($user, 'My profile retrieved successfully.');
    }

    public function update_profile(Request $request)
    {

        $my_profile = Auth::user();

        if (!$my_profile) {
            return $this->sendError('Unauthorized.', ['error' => 'Unauthorized or User Not Found']);
        }

        $user = User::where('id', $my_profile->id)->with('district', 'area')->first();
        $user->update($request->all());

        return $this->sendResponse($user, 'My profile updated successfully.');
    }


    public function category()
    {
        $category = Category::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();

        return $this->sendResponse($category, 'Category retrieved successfully.');
    }

    public function company(Request $request)
    {
        $keyword = $request->get('search');

        if ($request->get('paginate')) {
            $perPage = $request->get('paginate');
        } else {
            $perPage = 15;
        }

        if (!empty($keyword)) {
            $company = Company::where('name', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orderBy('name', 'asc')->paginate($perPage);
        } else {
            $company = Company::orderBy('name', 'asc')->paginate($perPage);
        }

        return $this->sendResponse($company, 'Company retrieved successfully.');
    }
}
