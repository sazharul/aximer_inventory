@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Product</div>
                    <div class="card-body">
                        <div style="display: inline-block; width: 100%;">


                            <form method="GET" action="{{ url('/stock-report') }}" accept-charset="UTF-8"
                                  class="form-inline my-2 my-lg-0 float-right" role="search"
                                  style="display: inline-block;">

                                <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}" style="display: inline-block; width: 400px;">
                                    <select class="form-control" name="category" onchange="this.form.submit()">
                                        @php
                                            $categories = \App\Models\Category::where('status', 1)->get();
                                        @endphp
                                        <option value="All">All</option>
                                        @foreach($categories as $item)
                                            <option
                                                value="{{ $item->name }}" {{ (request('category') == $item->name) ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </form>


                            <form method="GET" action="{{ url('/stock-report') }}" accept-charset="UTF-8"
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
                                        <th>Stock QTY</th>
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
                                            <td>{{ $item->stock }}</td>
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
