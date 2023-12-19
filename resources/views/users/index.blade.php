@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $status }} User List</div>
                    <div class="card-body">


                        <div style="display: inline-block;width: 100%;">
                            <form method="GET" action="{{ url('/category') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search"
                                  style="display: inline-block;float: right;">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                    <span class="input-group-append">
                                                            <button class="btn btn-secondary" type="submit">
                                                                <i class="fa fa-search"></i>
                                                            </button>
                                                        </span>
                                </div>
                            </form>
                        </div>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>District</th>
                                    <th>Area</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    @if($status != 'Approved')
                                        <th>Actions</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ isset($item->district) ? $item->district->name : '' }}</td>
                                        <td>{{ isset($item->area) ? $item->area->name : '' }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->status }}</td>
                                        @if($status != 'Approved')
                                            <td>
                                                <a href="{{ url('/approved-user/' . $item->id) }}" title="Edit Category">
                                                    <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Approved
                                                    </button>
                                                </a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $users->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
