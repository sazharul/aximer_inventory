@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cash Collection Report</div>
                    <div class="card-body">
                        <form method="GET" action="{{ url('/supplier-payment-report') }}" accept-charset="UTF-8"
                              class="form-inline my-2 my-lg-0 float-right" role="search"
                              style="display: inline-block;">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}" style="display: inline-block; width: 200px;">
                                        <label for="">Start Date</label>
                                        <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}" style="display: inline-block; width: 200px;">
                                        <label for="">Start Date</label>
                                        <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}">
                                    </div>
                                </div>

                                <div class="col">
                                    <button class="btn btn-primary" style="margin-top: 30px;">Submit</button>
                                </div>
                            </div>
                        </form>
                        <div class="box_expense">
                            <h3><b>Total Collection: </b> {{ $cash_collection_total ?? 0 }}</h3>
                        </div>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Supplier Name</th>
                                        <th>Purchase Invoice ID</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cash_collection as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{  \Carbon\Carbon::parse($item->date)->format('d-m-Y H:i a') }}</td>
                                            <td>{{ isset($item->supplierInfo) ? $item->supplierInfo->name : '' }}</td>
                                            <td>{{ isset($item->purchaseInvoiceInfo) ? $item->purchaseInvoiceInfo->purchase_invoice_no : '' }}</td>
                                            <td>{{ $item->amount }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $cash_collection->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
