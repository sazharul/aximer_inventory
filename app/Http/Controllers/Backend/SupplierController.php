<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $supplier = Supplier::where('customer_name', 'LIKE', "%$keyword%")
                ->orWhere('phone_number', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $supplier = Supplier::latest()->paginate($perPage);
        }

        return view('backend.supplier.index', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required|string',
            'phone_number' => ['required'],
            'email' => 'required|string|email',
            'address' => 'required',
            'contact_person' => 'required',
            'origin' => 'required',
        ]);
        
        $requestData = $request->all();

        Supplier::create($requestData);

        return redirect('supplier')->with('flash_message', 'Supplier added!');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('backend.supplier.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('backend.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = $request->all();

        $supplier = Supplier::findOrFail($id);
        $supplier->update($requestData);

        return redirect('supplier')->with('flash_message', 'Supplier updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Supplier::destroy($id);

        return redirect('supplier')->with('flash_message', 'Supplier deleted!');
    }
   
}
