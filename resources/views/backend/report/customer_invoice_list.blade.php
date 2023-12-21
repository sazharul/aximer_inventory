@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Customer Sale Invoice</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Sale ID</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Payment Type</th>
                                        <th>Total</th>
                                        <th>Discount</th>
                                        <th>Paid</th>
                                        <th style="text-align: center">Due</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($saleinvoice as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->sale_no }}</td>
                                            <td>{{ (isset($item->customerDetails)) ? $item->customerDetails->name : '' }}</td>
                                            <td>{{ $item->date }}</td>
                                            <td>{{ $item->payment_type }}</td>
                                            <td>{{ $item->total }}</td>
                                            <td>{{ $item->discount }}</td>
                                            <td>{{ $item->paid }}</td>
                                            <td style="text-align: center">
                                                {{ $item->due }} <br>
                                                @if($item->due > 0)
                                                    <a href="#" class="btn btn-primary btn-sm" style="font-size: 12px;" data-bs-toggle="modal"
                                                       data-bs-target="#exampleModal{{ $item->id }}">Pay Now</a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form method="POST" action="{{ route('pay_sale_due', $item->id) }}">
                                                                    @csrf
                                                                    <div class="modal-header" style="text-align: left;">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            <b>Customer Name :</b>
                                                                            {{ (isset($item->customerDetails)) ? $item->customerDetails->name : '' }}
                                                                            <br>
                                                                            <b>Sale ID :</b>
                                                                            {{ $item->sale_no }}
                                                                        </h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body" style="text-align: left">
                                                                        <h3><b>Total Due: </b> {{ $item->due }}</h3>
                                                                        <div class="form-group">
                                                                            <label>Pay Amount</label>
                                                                            <input type="number" name="payment_amount" class="form-control"
                                                                                   max="{{ $item->due }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                                    </div>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $saleinvoice->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
