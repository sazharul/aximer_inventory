@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Daily Cash Closing</div>
                    <div class="card-body">
                        <form method="GET" action="{{ url('/daily-cash-closing') }}" accept-charset="UTF-8"
                              class="form-inline my-2 my-lg-0 float-right" role="search"
                              style="display: inline-block;">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}" style="display: inline-block; width: 200px;">
                                        <label for="">Select Date</label>
                                        <input type="date" class="form-control" name="date" value="{{ request('date') }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary" style="margin-top: 30px;">Submit</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered today_cash">
                                <tr>
                                    <th>Opening Cash</th>
                                    <td>{{ $opening_cash ?? 0 }}</td>
                                </tr>

                                <tr>
                                    <th>Cash Collection</th>
                                    <td>{{ $cash_collection ?? 0 }}</td>
                                </tr>

                                <tr>
                                    <th>Purchase Payment</th>
                                    <td>{{ $purchase_payment ?? 0 }}</td>
                                </tr>

                                <tr>
                                    <th>Expense</th>
                                    <td>{{ $expense ?? 0 }}</td>
                                </tr>

                                <tr>
                                    <th>Total Cash</th>
                                    <td>{{ $opening_cash + $cash_collection - $purchase_payment - $expense }}</td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
