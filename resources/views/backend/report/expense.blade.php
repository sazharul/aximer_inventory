@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Expense</div>
                    <div class="card-body">
                        <form method="GET" action="{{ url('/expense-report') }}" accept-charset="UTF-8"
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
                                                $categories = \App\Models\ExpenseCategory::where('status', 1)->get();
                                            @endphp
                                            <option value="All">All</option>
                                            @foreach($categories as $item)
                                                <option
                                                    value="{{ $item->name }}" {{ (request('category') == $item->name) ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary" style="margin-top: 30px;">Submit</button>
                                </div>
                            </div>
                        </form>

                        <div class="box_expense">
                            <h3><b>Total Expense: </b> {{ $expense_total ?? 0 }}</h3>
                        </div>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Note</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($expense as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ (isset($item->expenseCategory)) ? $item->expenseCategory->name : '' }}</td>
                                            <td>{{ $item->note }}</td>
                                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $item->amount }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $expense->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
