@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Investor</div>
                    <div class="card-body">
                     <a href="{{ url('/investor/create') }}" class="btn btn-success btn-sm" title="Add New Investor">
                           <i class="fa fa-plus" aria-hidden="true"></i> Add New
                       </a>

{{--                        <form method="GET" action="{{ url('/investor') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search"--}}
{{--                              style="display: inline-block;float: right;">--}}
{{--                            <div class="input-group">--}}
{{--                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">--}}
{{--                                <span class="input-group-append">--}}
{{--                                    <button class="btn btn-secondary" type="submit">--}}
{{--                                        <i class="fa fa-search"></i>--}}
{{--                                    </button>--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                        </form>--}}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Invest Amount</th>
                                    <th>Current Rate Per Percentage</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($investor as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->investor_name }}</td>
                                        <td>{{ $item->phone_number}}</td>
                                        <td>{{ $item->email}}</td>
                                        <td>{{ $item->address}}</td>
                                        <td>{{ $item->amount}}</td>
                                        <td>{{ $item->per_percentage}}</td>
                                        <td>

                                            <a href="{{ url('/investor/' . $item->id . '/edit') }}" title="Edit investor">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                            </a>

                                           <form method="POST" action="{{ url('/investor' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                               {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete investor"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $investor->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
