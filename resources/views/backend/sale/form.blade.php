<div class="form-group {{ $errors->has('purchase_id') ? 'has-error' : ''}}">
    <label for="purchase_id" class="control-label">{{ 'Purchase Id' }}</label>
    <input class="form-control" name="purchase_id" type="text" id="purchase_id" value="{{ isset($purchase->purchase_id) ? $purchase->purchase_id : ''}}" >
    {!! $errors->first('purchase_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
    <label for="total" class="control-label">{{ 'Total' }}</label>
    <input class="form-control" name="total" type="text" id="total" value="{{ isset($purchase->total) ? $purchase->total : ''}}" >
    {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control" name="status" type="text" id="status" value="{{ isset($purchase->status) ? $purchase->status : ''}}" >
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
