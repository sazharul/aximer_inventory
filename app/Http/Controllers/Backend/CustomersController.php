<?php

namespace App\Http\Controllers\Backend;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $customer = Customer::where('name', 'LIKE', "%$keyword%")
                ->orWhere('phone_number', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('contact_person', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $customer = Customer::latest()->paginate($perPage);
        }

        return view('backend.customer.index', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone_number' => ['required'],
            'email' => 'required|string|email',
            'address' => 'required',
            'contact_person' => 'required',
            'origin' => 'required',
        ]);

        $requestData = $request->all();

        Customer::create($requestData);

        return redirect('customer')->with('flash_message', 'Customer added!');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $customer = Customer::findOrFail($id);

        return view('backend.customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        return view('backend.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = $request->all();

        $customer = Customer::findOrFail($id);
        $customer->update($requestData);

        return redirect('customer')->with('flash_message', 'Customer updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Customer::destroy($id);

        return redirect('customer')->with('flash_message', 'Customer deleted!');
    }
}
