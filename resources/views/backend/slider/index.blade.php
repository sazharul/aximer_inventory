@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">Slider</div>
                    <div class="card-body">
                        <a href="{{ url('/slider/create') }}" class="btn btn-success btn-sm" title="Add New Slider">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

{{--                        <form method="GET" action="{{ url('/slider') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search"--}}
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
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($slider as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img style="width: 120px" src="{{ asset($item->image) }}" alt="">
                                        </td>
                                        <td>{{ ($item->status == 1) ? 'Active' : 'InActive' }}</td>
                                        <td>

                                            <a href="{{ url('/slider/' . $item->id . '/edit') }}" title="Edit Slider">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                            </a>

                                            <form method="POST" action="{{ url('/slider' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Slider"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $slider->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
