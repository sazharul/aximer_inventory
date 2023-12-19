<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Investor;
class InvestorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $investor = Investor::where('investor_name', 'LIKE', "%$keyword%")
                ->orWhere('phone_number', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $investor = Investor::latest()->paginate($perPage);
        }

        return view('backend.investor.index', compact('investor'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('backend.investor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'investor_name' => 'required|string',
            'phone_number' => ['required'],
            'email' => 'required|string|email',
            'address' => 'required',
            'amount' => 'required',
            'per_percentage' => 'required|integer'
        ]);
        $requestData = $request->all();
        Investor::create($requestData);
        return redirect('investor')->with('flash_message', 'Investor added!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $supplier = Investor::findOrFail($id);
        return view('backend.investor.show', compact('investor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $investor = Investor::findOrFail($id);

        return view('backend.investor.edit', compact('investor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = $request->all();

        $investor = Investor::findOrFail($id);
        $investor->update($requestData);

        return redirect('investor')->with('flash_message', 'Investor updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Investor::destroy($id);

        return redirect('investor')->with('flash_message', 'Investor deleted!');
    }
}
