@extends('layouts.pos_layout')

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 5px;">
            <div class="col-md-12">
                <div class="card mb-0">
                    <h4>
                        <b>Edit Sale</b>

                        <a href="{{ url('/sale') }}" title="Back" class="float-end">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
                        </a>
                    </h4>
                    <div class="card-body pos_screen_section">
                        <form method="POST" action="{{ route('sale.update', $sale->id) }}" accept-charset="UTF-8" class="form-horizontal"
                              enctype="multipart/form-data">
                            @method("PUT")
                            {{ csrf_field() }}

                            <div class="row mb-3">
                                <div class="col-sm-6 col-12">
                                    <div class="form-group {{ $errors->has('product') ? 'has-error' : ''}}">
                                        <label for="product" class="control-label">{{ 'Select Product' }}</label>
                                        <select class="form-control js-example-basic-single select_product" name="product_list">
                                            <option value="">Select Product</option>
                                            @foreach($products as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }} (Code : {{ $item->code }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="form-group {{ $errors->has('supplier_id') ? 'has-error' : ''}}">
                                        <label for="supplier_id" class="control-label">{{ 'Supplier' }}</label>
                                        <select class="form-control js-example-basic-single" name="supplier_name" required>
                                            <option value="">Select Supplier</option>
                                            @foreach($supplier as $item)
                                                <option
                                                    value="{{ $item->name }}" {{ ($sale->supplier_name === $item->name) ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <div class="tableFixHead">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 3%;" class="text-center">SL.</th>
                                                    <th>Code</th>
                                                    <th>Item Name</th>
                                                    <th style="width: 10%;">Qty</th>
                                                    <th style="width: 15%;">Unit Price</th>
                                                    <th style="width: 15%;" class="text-center">Total</th>
                                                    <th style="width: 15%;" class="text-center">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach($sale->saleDetails as $item)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td>{{ $item->code }}</td>
                                                        <td>{{ $item->product_name }}</td>
                                                        <td>
                                                            <input type="hidden" value="{{ $item->product_id }}" name="product_id[]">
                                                            <input type="number" name="qty[]" class="form-control qty" onkeyup="calculateTotalPrice(this)"
                                                                   value="{{ $item->qty }}">
                                                        </td>
                                                        <td>
                                                            <input type="number" name="unit_price[]" class="form-control price"
                                                                   onkeyup="calculateTotalPrice(this)" value="{{ $item->price }}">
                                                        </td>
                                                        <td class="text-center">
                                                            <b class="total">{{ $item->qty*$item->price }}</b>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="javascript:void(0);" class="remove_btn" onclick="remove_table_column(this)">Delete</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-3 col-12">
                                    <h5 style="text-align: right;">Grand Total : <b class="grand_total">{{ $sale->total }}</b></h5>
                                    {{--                                    <div class="form-group {{ $errors->has('total_amount') ? 'has-error' : ''}}">--}}
                                    {{--                                        <label for="total_amount" class="control-label">{{ 'Total Amount' }}</label>--}}
                                    {{--                                        <input class="form-control" name="total_amount" type="text" id="total_amount"--}}
                                    {{--                                               value="{{ isset($supplier->total_amount) ? $supplier->total_amount : ''}}">--}}
                                    {{--                                        {!! $errors->first('total_amount', '<p class="help-block">:message</p>') !!}--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>

                            {{--                            <div class="row justify-content-end">--}}
                            {{--                                <div class="col-sm-3 col-12">--}}
                            {{--                                    <div class="form-group {{ $errors->has('discount') ? 'has-error' : ''}}">--}}
                            {{--                                        <label for="discount" class="control-label">{{ 'Discount' }}</label>--}}
                            {{--                                        <input class="form-control" name="discount" type="text" id="discount"--}}
                            {{--                                               value="{{ isset($supplier->discount) ? $supplier->discount : ''}}">--}}
                            {{--                                        {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}

                            {{--                            <div class="row justify-content-end">--}}
                            {{--                                <div class="col-sm-6 col-12">--}}
                            {{--                                    <div class="form-group {{ $errors->has('discount') ? 'has-error' : ''}}">--}}
                            {{--                                        <label for="discount" class="control-label">{{ 'Description' }}</label>--}}
                            {{--                                        <input class="form-control" name="discount" type="text" id="discount"--}}
                            {{--                                               value="{{ isset($supplier->discount) ? $supplier->discount : ''}}">--}}
                            {{--                                        {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}

                            {{--                                <div class="col-sm-6 col-12">--}}
                            {{--                                    <div class="form-group {{ $errors->has('discount') ? 'has-error' : ''}}">--}}
                            {{--                                        <label for="discount" class="control-label">{{ 'Paid Amount' }}</label>--}}
                            {{--                                        <input class="form-control" name="discount" type="text" id="discount"--}}
                            {{--                                               value="{{ isset($supplier->discount) ? $supplier->discount : ''}}">--}}
                            {{--                                        {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}

                            {{--                                <div class="col-sm-6 col-12">--}}
                            {{--                                    <div class="form-group {{ $errors->has('payment_type') ? 'has-error' : ''}}">--}}
                            {{--                                        <label for="payment_type" class="control-label">{{ 'Payment Type' }}</label>--}}
                            {{--                                        <input class="form-control" name="payment_type" type="text" id="payment_type"--}}
                            {{--                                               value="{{ isset($supplier->payment_type) ? $supplier->payment_type : ''}}">--}}
                            {{--                                        {!! $errors->first('payment_type', '<p class="help-block">:message</p>') !!}--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}

                            {{--                                <div class="col-sm-6 col-12">--}}
                            {{--                                    <div class="form-group {{ $errors->has('due_amount') ? 'has-error' : ''}}">--}}
                            {{--                                        <label for="due_amount" class="control-label">{{ 'Due Amount' }}</label>--}}
                            {{--                                        <input class="form-control" name="due_amount" type="text" id="due_amount"--}}
                            {{--                                               value="{{ isset($supplier->due_amount) ? $supplier->due_amount : ''}}">--}}
                            {{--                                        {!! $errors->first('due_amount', '<p class="help-block">:message</p>') !!}--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
