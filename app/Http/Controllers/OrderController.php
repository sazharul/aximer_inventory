<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function remove_all_flash_sale()
    {
        Product::where('is_flash_sale', 1)->update([
            'discount_price' => 0,
            'discount_percentage' => 0,
            'is_flash_sale' => 0
        ]);
        return to_route('flash_sale');
    }

    public function remove_flash_sale($id)
    {
        Product::where('id', $id)->update([
            'discount_price' => 0,
            'discount_percentage' => 0,
            'is_flash_sale' => 0
        ]);
        return to_route('flash_sale');
    }

    public function save_flash_sale(Request $request)
    {
        $product_list = $request->product_id;

        $requestData = $request->all();

        if (isset($product_list)) {
            foreach ($product_list as $item) {

                if ($requestData['discount_price' . $item] && $requestData['discount_percentage' . $item]) {
                    Product::where('id', $item)->update([
                        'discount_price' => $requestData['discount_price' . $item],
                        'discount_percentage' => $requestData['discount_percentage' . $item],
                        'is_flash_sale' => 1
                    ]);
                }
            }
        }


        return to_route('flash_sale');
    }

    public function add_flash_sale(Request $request)
    {
        $keyword = $request->get('search');

        $data['product'] = DB::table("products")
            ->leftJoin('categories', function ($join) {
                $join->on('products.category_id', '=', 'categories.id');
            })
            ->leftJoin('companies', function ($join) {
                $join->on('products.company_id', '=', 'companies.id');
            })
            ->select(
                'products.id',
                'products.image',
                'products.name',
                'products.category_id',
                'products.company_id',
                'products.price',
                'products.discount_price',
                'products.discount_percentage',
                'products.is_flash_sale',
                'categories.name as category_name',
                'companies.name as company_name',
                'products.status'
            )
            ->where(function ($query) use ($keyword) {

                if (isset($keyword)){
                    $query->where('products.name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('categories.name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('companies.name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('products.price', 'LIKE', '%' . $keyword . '%');
                }
            })
            ->where('products.status', 1)
            ->where('products.is_flash_sale', 0)
            ->paginate(15);

        return view('backend.product.add_flash_sale', $data);
    }

    public function flash_sale(Request $request)
    {
        $keyword = $request->get('search');

        $data['product'] = DB::table("products")
            ->leftJoin('categories', function ($join) {
                $join->on('products.category_id', '=', 'categories.id');
            })
            ->leftJoin('companies', function ($join) {
                $join->on('products.company_id', '=', 'companies.id');
            })
            ->select(
                'products.id',
                'products.image',
                'products.name',
                'products.category_id',
                'products.company_id',
                'products.price',
                'products.discount_price',
                'products.discount_percentage',
                'products.is_flash_sale',
                'categories.name as category_name',
                'companies.name as company_name',
                'products.status'
            )
            ->where(function ($query) use ($keyword) {

                if (isset($keyword)){
                    $query->where('products.name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('categories.name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('companies.name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('products.price', 'LIKE', '%' . $keyword . '%');
                }
            })
            ->where('products.status', 1)
            ->where('products.is_flash_sale', 1)
            ->paginate(15);


        return view('backend.product.flash_sale', $data);
    }

    public function update_flash_sale(Request $request)
    {
        $product_list = $request->product_id;
        $requestData = $request->all();
        if (isset($product_list)) {
            foreach ($product_list as $item) {
                if ($requestData['discount_price' . $item] && $requestData['discount_percentage' . $item]) {
                    Product::where('id', $item)->update([
                        'discount_price' => $requestData['discount_price' . $item],
                        'discount_percentage' => $requestData['discount_percentage' . $item],
                        'is_flash_sale' => 1
                    ]);
                }
            }
        }
        return to_route('flash_sale');
    }

    public function flash_sale_edit(Request $request)
    {
        $keyword = $request->get('search');

        $data['product'] = DB::table("products")
            ->leftJoin('categories', function ($join) {
                $join->on('products.category_id', '=', 'categories.id');
            })
            ->leftJoin('companies', function ($join) {
                $join->on('products.company_id', '=', 'companies.id');
            })
            ->select(
                'products.id',
                'products.image',
                'products.name',
                'products.category_id',
                'products.company_id',
                'products.price',
                'products.discount_price',
                'products.discount_percentage',
                'products.is_flash_sale',
                'categories.name as category_name',
                'companies.name as company_name',
                'products.status'
            )
            ->where(function ($query) use ($keyword) {

                if (isset($keyword)){
                    $query->where('products.name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('categories.name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('companies.name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('products.price', 'LIKE', '%' . $keyword . '%');
                }
            })
            ->where('products.status', 1)
            ->where('products.is_flash_sale', 1)
            ->paginate(15);

        return view('backend.product.flash_sale_edit', $data);
    }

    public function order_delivered($id)
    {
        Order::where('id', $id)->update([
            'status' => 'Delivered'
        ]);
        return back();
    }

    public function order_cancel($id)
    {
        Order::where('id', $id)->update([
            'status' => 'Cancel'
        ]);

        OrderDetails::where('order_id', $id)->update([
            'status' => 'cancel'
        ]);
        return back();
    }

    public function order_approve($id)
    {
        Order::where('id', $id)->update([
            'status' => 'Approved'
        ]);

        return back();
    }

    public function order_invoice($id)
    {
        $data['order'] = Order::where('id', $id)->with('orderDetails', 'user_info')->orderBy('created_at', 'desc')->first();
        return view('backend.orders.invoice', $data);
    }

    public function pending_order_list(Request $request)
    {
        $area = $request->get('area');
        $date = $request->get('date');
        $data['date'] = $date;
        $data['search_area'] = $area;

        $pagination = $request->get('pagination');
        $data['pagination'] = $pagination;


        $data['order_list'] = Order::with('orderDetails', 'user_info')
            ->where('status', 'Pending')
            ->where(function ($query) use ($area, $date) {
                if (isset($area)) {
                    $query->where('area_id', $area);
                }
                if (isset($date)) {
                    $query->whereDate('created_at', $date);
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate($pagination);

        $data['area'] = Area::where('status', 1)->get();
        $data['status'] = 'Pending';

        return view('backend.orders.index', $data);
    }

    public function approved_order_list(Request $request)
    {
        $area = $request->get('area');
        $date = $request->get('date');
        $data['date'] = $date;
        $data['search_area'] = $area;
        $pagination = $request->get('pagination');
        $data['pagination'] = $pagination;

        $data['order_list'] = Order::with('orderDetails', 'user_info')
            ->where('status', 'Approved')
            ->where(function ($query) use ($area, $date) {
                if (isset($area)) {
                    $query->where('area_id', $area);
                }
                if (isset($date)) {
                    $query->whereDate('created_at', $date);
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate($pagination);

        $data['area'] = Area::where('status', 1)->get();
        $data['status'] = 'Approved';
        return view('backend.orders.index', $data);
    }

    public function cancel_order_list(Request $request)
    {
        $area = $request->get('area');
        $date = $request->get('date');
        $data['date'] = $date;
        $data['search_area'] = $area;
        $pagination = $request->get('pagination');
        $data['pagination'] = $pagination;

        $data['order_list'] = Order::with('orderDetails', 'user_info')
            ->where('status', 'Cancel')
            ->where(function ($query) use ($area, $date) {
                if (isset($area)) {
                    $query->where('area_id', $area);
                }
                if (isset($date)) {
                    $query->whereDate('created_at', $date);
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate($pagination);

        $data['area'] = Area::where('status', 1)->get();
        $data['status'] = 'Cancel';
        return view('backend.orders.index', $data);
    }

    public function delivered_order_list(Request $request)
    {
        $area = $request->get('area');
        $date = $request->get('date');
        $data['date'] = $date;
        $data['search_area'] = $area;
        $pagination = $request->get('pagination');
        $data['pagination'] = $pagination;

        $data['order_list'] = Order::with('orderDetails', 'user_info')
            ->where('status', 'Delivered')
            ->where(function ($query) use ($area, $date) {
                if (isset($area)) {
                    $query->where('area_id', $area);
                }
                if (isset($date)) {
                    $query->whereDate('created_at', $date);
                }
            })
            ->orderBy('created_at', 'desc')->paginate($pagination);

        $data['area'] = Area::where('status', 1)->get();
        $data['status'] = 'Delivered';
        return view('backend.orders.index', $data);
    }


    public function delivery_invoice(Request $request)
    {
        $area = $request->get('area');
        $date = $request->get('date');
        $data['date'] = $date;
        $data['search_area'] = $area;
        $pagination = $request->get('pagination');
        $data['pagination'] = $pagination;

        $area_name_search = Area::where('id', $area)->first();
        $data['area_name'] = isset($area_name_search) ? $area_name_search->name : '';


        $data['order_list'] = Order::with('orderDetails', 'user_info')
            ->where('status', 'Approved')
            ->where(function ($query) use ($area, $date) {
                if (isset($area)) {
                    $query->where('area_id', $area);
                }
                if (isset($date)) {
                    $date_check = Carbon::parse($date);
                    $date_check = $date_check->subDays(1);

                    $query->whereDate('created_at', $date_check)
                        ->whereTime('created_at', '<=', '18:00:00');
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate($pagination);


        $data['area'] = Area::where('status', 1)->get();
        $data['status'] = 'Delivered';
        return view('backend.orders.delivery_invoice', $data);
    }

    public function sold_product(Request $request)
    {
        $date = $request->get('date');

        $from = date($date . ' 06:00:01');

        $to_Date = Carbon::parse($date)->addDay()->format('Y-m-d');
        $to = date($to_Date . ' 05:59:59');

        $start_date = Carbon::parse($from);
        $end_date = Carbon::parse($to);

        $data['percentage'] = $request->get('percentage');
        $data['date'] = $date;

        $pagination = $request->get('pagination');
        $data['pagination'] = $pagination;


        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        if (!isset($pagination)){
            $pagination = 1000;
        }

        $data['product_list'] = OrderDetails::where('status', '!=', 'cancel')
            ->where(function ($query) use ($date, $start_date, $end_date) {
                if (isset($date)) {
                    $query->whereBetween('created_at', [$start_date , $end_date]);
                }
            })
            ->groupBy('product_id')
            ->orderBy('name', 'asc')
            ->paginate($pagination);

        return view('backend.orders.sold_product', $data);
    }
}
