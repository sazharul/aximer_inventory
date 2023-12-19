@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Flash Sale List</div>
                    <div class="card-body">
                        <form method="GET" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search"
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

                        <br/>
                        <br/>

                        <div style="display: inline-block; width: 100%">
                            <a href="{{ route('add_flash_sale') }}" class="btn btn-success btn-sm" title="Add more">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add more
                            </a>

                            <a href="{{ route('flash_sale_edit') }}" class="btn btn-primary btn-sm" title="Edit">Edit</a>

                            <form method="get" action="{{ route('remove_all_flash_sale') }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-secondary float-end" title="Delete Product"
                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                    Delete All Flash Sale
                                </button>
                            </form>
                        </div>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Company</th>
                                    <th>Price</th>
                                    <th>Discount Price</th>
                                    <th>Discount Percentage</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img style="width: 120px; height: 60px" src="{{ asset($item->image) }}" alt="">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->category_name }}</td>
                                        <td>{{ $item->company_name }}</td>
                                        <td>{{ $item->price }} TK</td>
                                        <td>{{ $item->discount_price }} TK</td>
                                        <td>{{ $item->discount_percentage }} %</td>
                                        <td>{{ ($item->status == 1) ? 'Active' : 'InActive' }}</td>
                                        <td>
                                            <form method="get" action="{{ route('remove_flash_sale', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-secondary btn-sm" title="Delete Product"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $product->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
