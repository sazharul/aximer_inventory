@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Product</div>
                    <div class="card-body">
                        <div style="display: inline-block; width: 100%;">
                            <a href="{{ url('/product/create') }}" class="btn btn-success btn-sm" title="Add New Product">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add New
                            </a>

                            <form method="GET" action="{{ url('/product') }}" accept-charset="UTF-8"
                                  class="form-inline my-2 my-lg-0 float-right" role="search"
                                  style="display: inline-block;float: right;">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Search..."
                                           value="{{ request('search') }}">
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
                                        <th>Product Code</th>
                                        <th>Product Name</th>
                                        <th>Product Category</th>
                                        <th>Product Supplier</th>
                                        <th>Origin</th>
                                        <th>Product Color</th>


                                        <th>Product Image</th>
                                        <th>Product Size</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->code }} </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->category_name }}</td>
                                            <td>{{ $item->supplier_name }}</td>
                                            <td>
                                                @isset($item)
                                                    {{ $item->origin ?? 'origin' }}
                                                @endisset

                                            </td>
                                            <td>{{ $item->product_color }} </td>

                                            <td>
                                                <img style="width: 120px; max-height: 60px; height: auto;"
                                                     src="{{ asset($item->image) }}" alt="">
                                            </td>

                                            <td>{{ $item->product_size }} </td>


                                            <td>{{ $item->status == 1 ? 'Active' : 'InActive' }}</td>
                                            <td>

                                                <a href="{{ url('/product/' . $item->id . '/edit') }}"
                                                   title="Edit Product">
                                                    <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                                              aria-hidden="true"></i> Edit
                                                    </button>
                                                </a>

                                                <form method="POST" action="{{ url('/product' . '/' . $item->id) }}"
                                                      accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            title="Delete Product"
                                                            onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i>
                                                        Delete
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
