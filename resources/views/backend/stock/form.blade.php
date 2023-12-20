<div class="form-group {{ $errors->has('product_id') ? 'has-error' : ''}}">
    <label for="product_id" class="control-label">{{ 'Select Product' }}</label>
    @php
        $products = \App\Models\Product::where('status', 1)->get();
    @endphp

    <select class="form-control js-example-basic-single select_product" name="product_id" required>
        <option value="">Select Product</option>
        @foreach($products as $item)
            <option value="{{ $item->id }}" {{ (isset($stock->product_id) && $item->id == $stock->product_id) ? 'selected' : '' }}>{{ $item->name }} (Code : {{ $item->code }})</option>
        @endforeach
    </select>

    {!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('purchase_id') ? 'has-error' : ''}}">
    <label for="purchase_id" class="control-label">{{ 'Select Purchase ID' }}</label>

    @php
        $purchase = \App\Models\Purchase::get();
    @endphp

    <select class="form-control js-example-basic-single select_purchase_id" name="purchase_id" required>
        <option value="">Select Purchase ID</option>
        @foreach($purchase as $item)
            <option value="{{ $item->id }}" {{ (isset($stock->purchase_id) && $item->id == $stock->purchase_id) ? 'selected' : '' }}>{{ $item->purchase_id }}</option>
        @endforeach
    </select>

    {!! $errors->first('purchase_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group {{ $errors->has('qty') ? 'has-error' : ''}}">
    <label for="qty" class="control-label">{{ 'QTY' }}</label>
    <input class="form-control" name="qty" type="number" id="qty" value="{{ isset($stock->qty) ? $stock->qty : ''}}" required>
    {!! $errors->first('qty', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
    <label for="date" class="control-label">{{ 'Date' }}</label>
    <input class="form-control" name="date" type="date" id="date" value="{{ isset($stock->date) ? $stock->date : ''}}">
    {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Add Stock' }}">
</div>
