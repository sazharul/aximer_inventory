<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockReportController extends Controller
{
    public function stock_report(Request $request)
    {
        $keyword = $request->get('search');
        $category = $request->get('category');

        if ($category == 'All') {
            $category = null;
        }
        $perPage = 25;

        $data['product'] = DB::table("products")
            ->leftJoin('categories', function ($join) {
                $join->on('products.category_id', '=', 'categories.id');
            })
            ->leftJoin('suppliers', function ($join) {
                $join->on('products.supplier_id', '=', 'suppliers.id');
            })
            ->select(
                'products.id',
                'products.image',
                'products.name',
                'products.category_id',
                'products.supplier_id',
                'products.price',
                'products.code',
                'products.stock',
                'products.product_color',
                'products.product_size',
                'categories.name as category_name',
                'suppliers.name as supplier_name',
                'products.status'
            )
            ->where(function ($query) use ($category) {
                if (isset($category)) {
                    $query->where('categories.name', $category);
                }
            })
            ->where(function ($query) use ($keyword) {
                if (isset($keyword)) {
                    $query->where('products.name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('categories.name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('suppliers.name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('products.price', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('products.code', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('products.product_color', 'LIKE', '%' . $keyword . '%');
                }
            })->orderBy('products.created_at', 'desc')
            ->paginate(15);

        return view('backend.stock-report.index', $data);
    }
}
