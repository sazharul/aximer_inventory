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
                        <form method="POST" action="{{ route('sale-invoice.update', $saleinvoice->id) }}" accept-charset="UTF-8" class="form-horizontal"
                              enctype="multipart/form-data">
                            @method("PUT")
                            {{ csrf_field() }}

                            <div class="row mb-3">
                                <div class="col-sm-6 col-12">
                                    <div class="form-group {{ $errors->has('sale') ? 'has-error' : ''}}">
                                        <label for="sale" class="control-label">{{ 'Select Sale ID :' }}</label>
                                        <b> {{ $saleinvoice->sale_no }} </b>
                                        {{--                                        <select class="form-control js-example-basic-single select_sale_id" name="sale_id" required>--}}
                                        {{--                                            <option value="">Select Sale ID</option>--}}
                                        {{--                                            @foreach($sale as $item)--}}
                                        {{--                                                <option value="{{ $item->id }}">{{ $item->sale_id }}</option>--}}
                                        {{--                                            @endforeach--}}
                                        {{--                                        </select>--}}
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="form-group {{ $errors->has('supplier_id') ? 'has-error' : ''}}">
                                        <label for="supplier_id" class="control-label">{{ 'Date :' }}</label>
                                        <b> {{ $saleinvoice->date }} </b>
                                        {{--                                        <input type="date" class="form-control" required name="date">--}}
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
                                                @foreach($saleinvoice->saleInvoiceDetails as $item)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td>{{ $item->code }}</td>
                                                        <td>{{ $item->product_name }}</td>
                                                        <td class="text-center">{{ $item->qty }}</td>
                                                        <td class="text-center">{{ $item->price }}</td>
                                                        <td class="text-center">{{ $item->total }}</td>
                                                    </tr>
                                                @endforeach
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
                                            <td class="textAlignRight"><b class="grand_total">{{ $saleinvoice->total }}</b></td>
                                        </tr>

                                        <tr>
                                            <td>Discount Amount</td>
                                            <td>
                                                <input min="1" required style="width: 150px;" class="form-control textAlignRight discount_amount"
                                                       onkeyup="PaidAmount(this)" name="discount_amount" type="number" value="{{ $saleinvoice->discount }}">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Paid Amount</td>
                                            <td>
                                                <input min="1" required style="width: 150px;" max="{{ $saleinvoice->total }}" value="{{ $saleinvoice->paid }}"
                                                       class="form-control textAlignRight paid_amount"
                                                       onkeyup="PaidAmount(this)" name="paid_amount" type="number">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Payment Type</td>
                                            <td>
                                                <select class="form-control" name="payment_type" required>
                                                    <option value="Cash" {{ $saleinvoice->payment_type === 'Cash' ? 'selected' : '' }}>Cash</option>
                                                    <option value="Bank Transfer" {{ $saleinvoice->payment_type === 'Bank Transfer' ? 'selected' : '' }}>Bank
                                                        Transfer
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Due Amount</td>
                                            <td class="textAlignRight">
                                                <b class="due_amount">{{ $saleinvoice->due }}</b>
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
