<div class="form-group {{ $errors->has('investor_name') ? 'has-error' : ''}}">
    <label for="investor_name" class="control-label">{{ 'Investor Name' }}</label>
    <input class="form-control" name="investor_name" type="text" id="investor_name" value="{{ isset($investor->investor_name) ? $investor->investor_name : ''}}" >
    {!! $errors->first('investor_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
    <label for="phone_number" class="control-label">{{ 'Phone Number' }}</label>
    <input class="form-control" name="phone_number" type="text" id="phone_number" value="{{ isset($investor->phone_number) ? $investor->phone_number : ''}}" >
    {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="email" id="email" value="{{ isset($investor->email) ? $investor->email : ''}}" >
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="control-label">{{ 'Address' }}</label>
    <textarea class="form-control" name="address" id="address" rows="3" cols="3">{{ isset($investor->address) ? $investor->address : ''}}</textarea>
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label for="amount" class="control-label">{{ 'Invesment Amount' }}</label>
    <input class="form-control" name="amount" type="text" id="amount" value="{{ isset($investor->amount) ? $investor->amount : ''}}" >
    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('per_percentage') ? 'has-error' : ''}}">
    <label for="per_percentage" class="control-label">{{ 'Current Rate Per Percentage' }}</label>
    <input class="form-control" name="per_percentage" type="integer" id="per_percentage" value="{{ isset($investor->per_percentage) ? $investor->per_percentage : ''}}" >
    {!! $errors->first('per_percentage', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
