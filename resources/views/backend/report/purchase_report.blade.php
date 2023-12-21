@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Purchase Report</div>
                    <div class="card-body">
                        <form method="GET" action="{{ url('/purchase-report') }}" accept-charset="UTF-8"
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
                                        <label for="">Select Category</label>
                                        <select class="form-control" name="category">
                                            @php
                                                $categories = \App\Models\Category::where('status', 1)->get();
                                            @endphp
                                            <option value="All">All</option>
                                            @foreach($categories as $item)
                                                <option
                                                    value="{{ $item->id }}" {{ (request('category') == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
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
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $item)
                                        @php
                                            $purchase_list = \App\Models\PurchaseInvoice::where(function ($query) use ($start_date) {
                                                                if (isset($start_date)) {
                                                                    $query->whereDate('date', '>=', $start_date);
                                                                }
                                                            })
                                                            ->where(function ($query) use ($end_date) {
                                                                if (isset($end_date)) {
                                                                    $query->whereDate('date', '<=', $end_date);
                                                                }
                                                            })->pluck('id');


                                            $purchase_invoice = \App\Models\PurchaseInvoiceDetail::where('product_id', $item->id)
                                                             ->where(function ($query) use ($purchase_list) {
                                                                if (isset($purchase_list)) {
                                                                    $query->whereIn('purchase_invoices_id', $purchase_list);
                                                                }
                                                            });

                                            $total_qty = $purchase_invoice->sum('qty');
                                            $total_price = $purchase_invoice->sum('total');
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $total_qty ?? 0 }}</td>
                                            <td>{{ $total_price ?? 0 }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $products->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
