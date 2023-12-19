<div class="form-group {{ $errors->has('customer_name') ? 'has-error' : ''}}">
    <label for="customer_name" class="control-label">{{ 'Customer Name' }}</label>
    <input class="form-control" name="customer_name" type="text" id="customer_name" value="{{ isset($customer->customer_name) ? $customer->customer_name : ''}}" >
    {!! $errors->first('customer_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
    <label for="phone_number" class="control-label">{{ 'Phone Number' }}</label>
    <input class="form-control" name="phone_number" type="text" id="phone_number" value="{{ isset($customer->phone_number) ? $customer->phone_number : ''}}" >
    {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="email" id="email" value="{{ isset($customer->email) ? $customer->email : ''}}" >
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="control-label">{{ 'Address' }}</label>
    <textarea class="form-control" name="address" id="address" rows="3" cols="3">{{ isset($customer->address) ? $customer->address : ''}}</textarea>
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('contact_person') ? 'has-error' : ''}}">
    <label for="contact_person" class="control-label">{{ 'Contact Person' }}</label>
    <input class="form-control" name="contact_person" type="text" id="contact_person" value="{{ isset($customer->contact_person) ? $customer->contact_person : ''}}" >
    {!! $errors->first('contact_person', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('origin') ? 'has-error' : ''}}">
    <label for="origin" class="control-label">{{ 'Origin' }}</label>
    <input class="form-control" name="origin" type="text" id="origin" value="{{ isset($customer->origin) ? $customer->origin : ''}}" >
    {!! $errors->first('origin', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
