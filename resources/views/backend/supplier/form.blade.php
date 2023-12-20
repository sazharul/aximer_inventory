<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Supplier Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($supplier->name) ? $supplier->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
    <label for="phone_number" class="control-label">{{ 'Phone Number' }}</label>
    <input class="form-control" name="phone_number" type="text" id="phone_number" value="{{ isset($supplier->phone_number) ? $supplier->phone_number : ''}}" >
    {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="email" id="email" value="{{ isset($supplier->email) ? $supplier->email : ''}}" >
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="control-label">{{ 'Address' }}</label>
    <textarea class="form-control" name="address" id="address" rows="3" cols="3">{{ isset($supplier->address) ? $supplier->address : ''}}</textarea>
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('contact_person') ? 'has-error' : ''}}">
    <label for="contact_person" class="control-label">{{ 'Contact Person' }}</label>
    <input class="form-control" name="contact_person" type="text" id="contact_person" value="{{ isset($supplier->contact_person) ? $supplier->contact_person : ''}}" >
    {!! $errors->first('contact_person', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('origin') ? 'has-error' : ''}}">
    <label for="origin" class="control-label">{{ 'Origin' }}</label>
    <input class="form-control" name="origin" type="text" id="origin" value="{{ isset($supplier->origin) ? $supplier->origin : ''}}" >
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
