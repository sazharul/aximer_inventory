@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Flash Sale</div>
                    <div class="card-body">
                        <a href="{{ route('flash_sale') }}" class="btn btn-dark btn-sm" title="Add New Product">
                            Back
                        </a>

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

                        <form action="{{ route('update_flash_sale') }}" method="POST">
                            @csrf
                            <br>
                            <br>
                            <button class="btn btn-primary float-end" type="submit">Save Flash Sale</button>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img style="width: 120px; height: 60px;" src="{{ asset($item->image) }}" alt="">
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->category_name }}</td>
                                            <td>{{ $item->company_name }}</td>
                                            <td>{{ $item->price }} TK</td>

                                            <td style="width: 140px">
                                                <input type="hidden" name="product_id[]" value="{{ $item->id }}">
                                                <input type="hidden" value="{{ $item->price }}" id="price{{ $item->id }}">
                                                <input type="number" value="{{ number_format((float)$item->discount_price, 2, '.', '') }}" step="any" name="discount_price{{ $item->id }}" id="discount_price{{ $item->id }}" class="form-control discount_price" data-price="{{ $item->id }}">
                                            </td>

                                            <td style="width: 140px">
                                                <input type="number" value="{{ number_format((float)$item->discount_percentage, 2, '.', '') }}" step="any" name="discount_percentage{{ $item->id }}" id="discount_percentage{{ $item->id }}" class="form-control discount_percentage" data-percentage="{{ $item->id }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination-wrapper"> {!! $product->appends(['search' => Request::get('search')])->render() !!} </div>
                            </div>

                            <button class="btn btn-primary float-end" type="submit">Save Flash Sale</button>
                            <br/>
                            <br/>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
