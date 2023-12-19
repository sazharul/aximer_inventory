@extends('layouts.app')
@section('css')
    <style>
        @media print {
            @page {
                margin: 15px;
                padding: 10px 20px;
            }
            .no-print, .no-print *
            {
                display: none !important;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $status }} Order List</div>
                    <div class="card-body">

                        <form method="GET">
                            <div class="row">
                                <div class="form-group col-lg-3 col-sm-6 col-12">
                                    <lable>Select Area</lable>
                                    <select class="form-control" name="area">
                                        <option value="">All Area</option>
                                        @foreach($area as $item)
                                            <option value="{{ $item->id }}" {{ (isset($search_area) && $search_area == $item->id) ? 'selected' : ''  }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-lg-3 col-sm-6 col-12">
                                    <lable>Date</lable>
                                    <input type="date" class="form-control" name="date" value="{{ isset($date) ? $date : '' }}">
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

                        <button class="btn btn-primary float-end" onclick="print_invoice()">Print</button>
                        <br/>
                        <br/>
                        <div class="table-responsive" id="print_section">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Area</th>
                                    <th>Address</th>
                                    <th>Name</th>
                                    <th>Number</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th class="no-print">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order_list as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ isset($item->area) ? $item->area->name : '' }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->user_name }}</td>
                                        <td>{{ $item->user_phone }}</td>
                                        <td>{{ $item->total }} TK</td>
                                        <td>{{ $item->status }}</td>
                                        <td class="no-print">

                                            @if($status == 'Pending')
                                                <a href="{{ route('order_approve', $item->id) }}" class="btn btn-primary btn-sm"><i
                                                        class="fa fa-pencil-square-o" aria-hidden="true"></i> Approved</a>

                                                <a href="{{ route('order_cancel', $item->id) }}" class="btn btn-secondary btn-sm"><i
                                                        class="fa fa-pencil-square-o" aria-hidden="true"></i> Cancel</a>
                                            @endif

                                            @if($status == 'Approved')
                                                    <a href="{{ route('order_delivered', $item->id) }}" class="btn btn-primary btn-sm"><i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i> Delivered</a>
                                            @endif

                                            <a href="{{ route('order_invoice', $item->id) }}" title="Details">
                                                <button class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Details</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $order_list->appends(request()->query())->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function print_invoice(){
            var printContents = document.getElementById('print_section').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
