<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ 'Image' }} {{ isset($product) ? '' : '*'}}</label>
    <input class="form-control" name="image" type="file" id="image" {{ isset($product) ? '' : 'required'}} value="{{ isset($product->image) ? $product->image : ''}}">
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name *' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($product->name) ? $product->name : ''}}">
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
    <label for="category_id" class="control-label">{{ 'Category *' }}</label>

    <select class="form-control" name="category_id">
        @php
            $categories = \App\Models\Category::where('status', 1)->get();
        @endphp
        @foreach($categories as $item)
            <option value="{{ $item->id }}" {{ (isset($product->category_id) && $product->category_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
        @endforeach
    </select>

    {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('supplier_id') ? 'has-error' : ''}}">
    <label for="supplier_id" class="control-label">{{ 'Supplier *' }}</label>

    <select class="form-control" name="supplier_id">
        @php
            $supplier = \App\Models\Supplier::get();
        @endphp
        @foreach($supplier as $item)
            <option value="{{ $item->id }}" {{ (isset($product->supplier_id) && $product->supplier_id == $item->id) ? 'selected' : '' }}>{{ $item->supplier_name }}</option>
        @endforeach
    </select>

    {!! $errors->first('supplier_id', '<p class="help-block">:message</p>') !!}
</div>
{{--
    <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
        <label for="price" class="control-label">{{ 'Price *' }}</label>
        <input class="form-control" name="price" type="number" id="price" value="{{ isset($product->price) ? $product->price : ''}}" step="any">
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div> --}}


<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    <label for="code" class="control-label">{{ 'Product Code *' }}</label>
    <input class="form-control" name="code" type="text" id="code" value="{{ isset($product->code) ? $product->code : ''}}">
    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('product_color') ? 'has-error' : ''}}">
    <label for="product_color" class="control-label">{{ 'Product Color' }}</label>
    <input class="form-control" name="product_color" type="text" id="product_color"
           value="{{ isset($product->product_color) ? $product->product_color : ''}}">
    {!! $errors->first('product_color', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('product_size') ? 'has-error' : ''}}">
    <label for="product_size" class="control-label">{{ 'Product Size' }}</label>
    <input class="form-control" name="product_size" type="text" id="product_size"
           value="{{ isset($product->product_size) ? $product->product_size : ''}}">
    {!! $errors->first('product_size', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('origin') ? 'has-error' : ''}}">
    <label for="origin" class="control-label">{{ 'Origin*' }}</label>
    <input class="form-control" name="origin" type="text" id="origin" value="{{ isset($product->origin) ? $product->origin : ''}}">
    {!! $errors->first('origin', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status *' }}</label>
    <select class="form-control" name="status">
        <option value="1" {{ (isset($product->status) && $product->status == 1) ? 'selected' : '' }}>Active</option>
        <option value="0" {{ (isset($product->status) && $product->status == 0) ? 'selected' : '' }}>InActive</option>
    </select>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
