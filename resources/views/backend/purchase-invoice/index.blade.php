@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Purchase Invoice</div>
                    <div class="card-body">
                        <a href="{{ url('/purchase-invoice/create') }}" class="btn btn-success btn-sm" title="Add New PurchaseInvoice">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/purchase-invoice') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right"
                              role="search" style="display: inline-block;float: right;">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Purchase ID</th>
                                        <th>Date</th>
                                        <th>Payment Type</th>
                                        <th>Total</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($purchaseinvoice as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->purchase_no }}</td>
                                            <td>{{ $item->date }}</td>
                                            <td>{{ $item->payment_type }}</td>
                                            <td>{{ $item->total }}</td>
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
                                                                <form method="POST" action="{{ route('pay_purchase_due', $item->id) }}">
                                                                    @csrf
                                                                    <div class="modal-header" style="text-align: left;">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            <b>Supplier Name :</b>
                                                                            {{ (isset($item->supplierDetails)) ? $item->supplierDetails->name : '' }}
                                                                            <br>
                                                                            <b>Sale ID :</b>
                                                                            {{ $item->purchase_no }}
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
                                            <td>

                                                <a href="{{ url('/purchase-invoice/' . $item->id . '/edit') }}" title="Edit PurchaseInvoice">
                                                    <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                    </button>
                                                </a>

                                                <form method="POST" action="{{ url('/purchase-invoice' . '/' . $item->id) }}" accept-charset="UTF-8"
                                                      style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete PurchaseInvoice"
                                                            onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                                                                                                     aria-hidden="true"></i> Delete
                                                    </button>
                                                </form>

                                                <a href="{{ route('purchase-invoice.show', $item->id) }}" title="Edit PurchaseInvoice">
                                                    <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> View Invoice
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $purchaseinvoice->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
