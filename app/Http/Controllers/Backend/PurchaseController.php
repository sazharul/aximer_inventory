<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    
        return view('backend.purchase.index' );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        if($request->ajax()){
 
            $data= Product::where('id','like','%'.$request->search.'%')
            ->orwhere('name','like','%'.$request->search.'%')
            ->orwhere('code','like','%'.$request->search.'%')->get();
 
            $output='';
            if(count($data)>0){
                $output ='
                    <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Code</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Total Calculate</th>
                    </tr>
                    </thead>
                    <tbody>';
                        foreach($data as $row){
                            $output .='
                            <tr>
                            <th scope="row">'.$row->id.'</th>
                          
                            <td>'.$row->code.'</td>
                            <td>'.$row->name.'</td>
                            <td>'.$row->code.'</td>
                            </tr>
                            ';
                        }
                $output .= '
                    </tbody>
                    </table>';
            }
            else{
                $output .='No results';
            }
            return $output;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
