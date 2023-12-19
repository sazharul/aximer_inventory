<div class="form-group {{ $errors->has('district_id') ? 'has-error' : ''}}">
    <label for="district_id" class="control-label">{{ 'District *' }}</label>

    <select class="form-control" name="district_id" required>
        @php
            $district = \App\Models\District::where('status', 1)->get();
        @endphp
        <option value="">Select One</option>
        @foreach($district as $item)
            <option value="{{ $item->id }}" {{ (isset($area->district_id) && $area->district_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
        @endforeach
    </select>
    {!! $errors->first('district_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($area->name) ? $area->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <select class="form-control" name="status">
        <option value="1" {{ (isset($area->status) && $area->status == 1) ? 'selected' : '' }}>Active</option>
        <option value="0" {{ (isset($area->status) && $area->status == 0) ? 'selected' : '' }}>InActive</option>
    </select>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
