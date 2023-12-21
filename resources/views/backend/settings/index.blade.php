@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Settings</div>
                    <div class="card-body">
{{--                                                <a href="{{ url('/settings/create') }}" class="btn btn-success btn-sm" title="Add New Setting">--}}
{{--                                                    <i class="fa fa-plus" aria-hidden="true"></i> Add New--}}
{{--                                                </a>--}}

                        {{--                        <form method="GET" action="{{ url('/settings') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search"--}}
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
                                        <th>Title</th>
                                        <th>Logo</th>
                                        <th>Fav Icon</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($settings as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>
                                                <img style="width: 200px" src="{{ asset($item->logo) }}" alt="">
                                            </td>

                                            <td>
                                                <img style="width: 200px" src="{{ asset($item->fav_icon) }}" alt="">
                                            </td>

                                            <td>{{ $item->mobile }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->address }}</td>


                                            <td>

                                                <a href="{{ url('/settings/' . $item->id . '/edit') }}" title="Edit Setting">
                                                    <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                    </button>
                                                </a>

                                                {{--                                                <form method="POST" action="{{ url('/settings' . '/' . $item->id) }}" accept-charset="UTF-8"--}}
                                                {{--                                                      style="display:inline">--}}
                                                {{--                                                    {{ method_field('DELETE') }}--}}
                                                {{--                                                    {{ csrf_field() }}--}}
                                                {{--                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Setting"--}}
                                                {{--                                                            onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"--}}
                                                {{--                                                                                                                     aria-hidden="true"></i> Delete--}}
                                                {{--                                                    </button>--}}
                                                {{--                                                </form>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $settings->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
