@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Purchase {{ $purchase->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/purchase') }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
                        </a>

                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th> Purchase ID</th>
                                        <td> {{ $purchase->purchase_id }} </td>
                                    </tr>
                                    <tr>
                                        <th> Supplier Name</th>
                                        <td> {{ $purchase->supplier_name }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 3%;" class="text-center">SL.</th>
                                            <th>Code</th>
                                            <th>Item Name</th>
                                            <th style="width: 10%;">Qty</th>
                                            <th style="width: 15%;">Unit Price</th>
                                            <th style="width: 15%;" class="text-center">Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($purchase->purchaseDetails as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $item->code }}</td>
                                                <td>{{ $item->product_name }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td class="text-center">
                                                    <b class="total">{{ $item->total }}</b>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2" style="text-align: center;">
                                                <b>Grand Total :</b>
                                            </td> <td colspan="1" style="text-align: center;">
                                                <b> {{ $purchase->total }}</b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
