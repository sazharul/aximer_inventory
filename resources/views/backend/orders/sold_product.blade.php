@extends('layouts.app')
@section('css')
    <style>
        .table-bordered td,
        .table-bordered th {
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .table-bordered th {
            padding: 4px 10px !important;
        }

        .table-bordered td {
            padding: 1px 10px !important;
        }

        @page {
            margin: 0;
        }

        @media print {
            .no-print, .no-print * {
                display: none !important;
            }
        }
    </style>
@endsection
@section('content')
    @php
        function price_format($foo){
             return number_format((float)$foo, 2, '.', '');
        }
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Sold Product List</div>
                    <div class="card-body">

                        <form method="GET">
                            <div class="row">
                                <div class="form-group col-lg-3 col-sm-6 col-12">
                                    <lable>Date</lable>
                                    <input type="date" class="form-control" name="date" value="{{ isset($date) ? $date : '' }}">
                                </div>

                                <div class="form-group col-lg-2 col-sm-6 col-12">
                                    <lable>Percentage</lable>
                                    <input type="number" class="form-control" name="percentage" min="1" value="{{ isset($percentage) ? $percentage : '' }}">
                                </div>

                                <div class="form-group col-lg-1 col-sm-3 col-12">
                                    <lable>Show</lable>
                                    <input type="number" class="form-control" name="pagination" min="1" value="{{ isset($pagination) ? $pagination : '' }}">
                                </div>
                                <div class="col-lg-1 col-sm-6 col-12">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 20px">Submit</button>
                                </div>
                            </div>
                        </form>

                        <button class="btn btn-primary float-end" onclick="print_invoice2()">Print 2</button>
                        <button class="btn btn-primary float-end" style="margin-right: 10px;" onclick="print_invoice()">Print 1</button>
                        <br/>
                        <br/>

                        <div id="print_section">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Qty</th>
                                            <th class="print_2">Rate</th>
                                            <th class="print_2">Amount</th>
                                            <th style="width: 200px">Percentage ({{ isset($percentage) ? $percentage : '' }} %)</th>
                                            <th style="width: 200px">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_amount = 0;
                                            $total_percent_amount = 0;
                                        @endphp
                                        @foreach($product_list as $item)
                                            @php
                                                $single_sell_amount = \App\Models\OrderDetails::where('product_id', $item->product_id)->where(function ($query) use ($date, $start_date, $end_date) {
                                                    if (isset($date)) {
                                                        $query->whereBetween('created_at', [$start_date , $end_date]);
                                                    }
                                                })->sum('net_amount');

                                                $single_sell_qty = \App\Models\OrderDetails::where('product_id', $item->product_id)->where(function ($query) use ($date, $start_date, $end_date) {
                                                    if (isset($date)) {
                                                        $query->whereBetween('created_at', [$start_date , $end_date]);
                                                    }
                                                })->sum('qty');

                                                $rate = $single_sell_amount/$single_sell_qty;
                                                $total_amount = $total_amount+$single_sell_amount;
                                                $singel_percent_amount = $rate - ($rate*($percentage/100));
                                                $total_percent_amount = $total_percent_amount+$singel_percent_amount;

                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $single_sell_qty }}</td>
                                                <td class="print_2">{{ price_format($single_sell_amount/$single_sell_qty) }} TK</td>
                                                <td class="print_2">{{ price_format($single_sell_amount) }} TK</td>
                                                <td>
                                                    @if(isset($percentage))
                                                        {{ price_format($singel_percent_amount) }} TK
                                                    @endif
                                                </td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td class="print_2"></td>
                                            <td class="print_2"></td>
                                            <td><b>Total : </b> {{ price_format($total_amount) }} TK</td>
                                            <td><b>Total : </b> {{ ( isset($percentage) && $percentage > 0) ? price_format($total_percent_amount) : 0}} TK</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function print_invoice() {
            var printContents = document.getElementById('print_section').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }

        function print_invoice2() {
            $(".print_2").hide()
            var printContents = document.getElementById('print_section').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            $(".print_2").show()
        }
    </script>
@endsection
