@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Customer Outstanding Report</div>
                    <div class="card-body">
                        <form method="GET" action="{{ url('/customer-outstanding-report') }}" accept-charset="UTF-8"
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
                                    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}" style="display: inline-block; width: 200px;">
                                        <label for="">Select Customer</label>
                                        <select class="form-control" name="customer">
                                            @php
                                                $categories = \App\Models\Customer::where('status', 1)->get();
                                            @endphp
                                            <option value="All">All</option>
                                            @foreach($categories as $item)
                                                <option
                                                    value="{{ $item->name }}" {{ (request('customer') == $item->name) ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary" style="margin-top: 30px;">Submit</button>
                                </div>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Number</th>
                                        <th>Total Sale</th>
                                        <th>Total Discount</th>
                                        <th>Total Paid</th>
                                        <th>Total Due</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customer as $item)
                                        @php
                                            $sale = \App\Models\Sale::where('customer_id', $item->id)->pluck('id');
                                            $sale_invoice = \App\Models\SaleInvoice::where(function ($query) use ($sale) {
                                                    if (isset($sale)) {
                                                        $query->whereIn('sale_id', $sale);
                                                    }
                                                })
                                                ->where(function ($query) use ($start_date) {
                                                    if (isset($start_date)) {
                                                        $query->whereDate('created_at', '>=', $start_date);
                                                    }
                                                })
                                                ->where(function ($query) use ($end_date) {
                                                    if (isset($end_date)) {
                                                        $query->whereDate('created_at', '<=', $end_date);
                                                    }
                                                });

                                            $total_sale = $sale_invoice->sum('total');
                                            $total_discount = $sale_invoice->sum('discount');
                                            $total_paid = $sale_invoice->sum('paid');
                                            $total_due = $sale_invoice->sum('due');
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->phone_number }}</td>
                                            <td>{{ $total_sale }}</td>
                                            <td>{{ $total_discount }}</td>
                                            <td>{{ $total_paid }}</td>
                                            <td>{{ $total_due }}</td>
                                            <td>
                                                <a href="{{ route('customer_invoice_list', $item->id) }}" class="btn btn-primary btn-sm">All Sale Invoice</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $customer->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
