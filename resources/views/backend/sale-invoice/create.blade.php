@extends('layouts.pos_layout')

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 5px;">
            <div class="col-md-12">
                <div class="card mb-0">
                    <h4>
                        <b>Create New Sale Invoice</b>

                        <a href="{{ url('/sale-invoice') }}" title="Back" class="float-end">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
                        </a>
                    </h4>
                    <div class="card-body pos_screen_section">
                        <form method="POST" action="{{ url('/sale-invoice') }}" accept-charset="UTF-8" class="form-horizontal"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="row mb-3">
                                <div class="col-sm-6 col-12">
                                    <div class="form-group {{ $errors->has('sale') ? 'has-error' : ''}}">
                                        <label for="sale" class="control-label">{{ 'Select Sale ID' }}</label>
                                        <select class="form-control js-example-basic-single select_sale_id" name="sale_id" required>
                                            <option value="">Select Sale ID</option>
                                            @foreach($sale as $item)
                                                <option value="{{ $item->id }}">{{ $item->sale_id }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="form-group {{ $errors->has('supplier_id') ? 'has-error' : ''}}">
                                        <label for="supplier_id" class="control-label">{{ 'Date' }}</label>
                                        <input type="date" class="form-control" required name="date">
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
                                                </tr>
                                            </thead>

                                            <tbody>

                                                {{--                                                <tr>--}}
                                                {{--                                                    <td class="text-center">1</td>--}}
                                                {{--                                                    <td>1111</td>--}}
                                                {{--                                                    <td>This is good name</td>--}}
                                                {{--                                                    <td>--}}
                                                {{--                                                        <input type="number" name="qty" class="form-control qty">--}}
                                                {{--                                                    </td>--}}
                                                {{--                                                    <td>--}}
                                                {{--                                                        <input type="number" name="unit_price" class="form-control price">--}}
                                                {{--                                                    </td>--}}
                                                {{--                                                    <td class="text-center">--}}
                                                {{--                                                        <b class="total">15215</b>--}}
                                                {{--                                                    </td>--}}
                                                {{--                                                    <td class="text-center">--}}
                                                {{--                                                        <a href="javascript:void(0);" class="remove_btn" onclick="remove_table_column(this)">Delete</a>--}}
                                                {{--                                                    </td>--}}
                                                {{--                                                </tr>--}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-4 col-12">
                                    <table style="border: none; float: right">
                                        <tr>
                                            <td>Total Amount</td>
                                            <td class="textAlignRight"><b class="grand_total">0.00</b></td>
                                        </tr>

                                        <tr>
                                            <td>Discount Amount</td>
                                            <td>
                                                <input min="1" required style="width: 150px;" class="form-control textAlignRight discount_amount"
                                                       onkeyup="PaidAmount(this)" name="discount_amount" type="number">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Paid Amount</td>
                                            <td>
                                                <input min="1" required style="width: 150px;" class="form-control textAlignRight paid_amount"
                                                       onkeyup="PaidAmount(this)" name="paid_amount" type="number">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Payment Type</td>
                                            <td>
                                                <select class="form-control" name="payment_type" required>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Bank Transfer">Bank Transfer</option>
                                                </select>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Due Amount</td>
                                            <td class="textAlignRight">
                                                <b class="due_amount">0.00</b>
                                            </td>
                                        </tr>
                                    </table>
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
