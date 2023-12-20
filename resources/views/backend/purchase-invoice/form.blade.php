<div class="form-group {{ $errors->has('purchase_id') ? 'has-error' : ''}}">
    <label for="purchase_id" class="control-label">{{ 'Purchase Id' }}</label>
    <input class="form-control" name="purchase_id" type="text" id="purchase_id" value="{{ isset($purchaseinvoice->purchase_id) ? $purchaseinvoice->purchase_id : ''}}" >
    {!! $errors->first('purchase_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
    <label for="date" class="control-label">{{ 'Date' }}</label>
    <input class="form-control" name="date" type="text" id="date" value="{{ isset($purchaseinvoice->date) ? $purchaseinvoice->date : ''}}" >
    {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('payment_type') ? 'has-error' : ''}}">
    <label for="payment_type" class="control-label">{{ 'Payment Type' }}</label>
    <input class="form-control" name="payment_type" type="text" id="payment_type" value="{{ isset($purchaseinvoice->payment_type) ? $purchaseinvoice->payment_type : ''}}" >
    {!! $errors->first('payment_type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
    <label for="total" class="control-label">{{ 'Total' }}</label>
    <input class="form-control" name="total" type="text" id="total" value="{{ isset($purchaseinvoice->total) ? $purchaseinvoice->total : ''}}" >
    {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('paid') ? 'has-error' : ''}}">
    <label for="paid" class="control-label">{{ 'Paid' }}</label>
    <input class="form-control" name="paid" type="text" id="paid" value="{{ isset($purchaseinvoice->paid) ? $purchaseinvoice->paid : ''}}" >
    {!! $errors->first('paid', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('due') ? 'has-error' : ''}}">
    <label for="due" class="control-label">{{ 'Due' }}</label>
    <input class="form-control" name="due" type="text" id="due" value="{{ isset($purchaseinvoice->due) ? $purchaseinvoice->due : ''}}" >
    {!! $errors->first('due', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control" name="status" type="text" id="status" value="{{ isset($purchaseinvoice->status) ? $purchaseinvoice->status : ''}}" >
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
