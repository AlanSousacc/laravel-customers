<div class="form py-2 mb-2">
  <div class="form-row row">
    <div class="form-group col-md-5">
      <label for="number_id">Number ID</label>
      <input type="text" class="form-control" readonly value="{{isset($number) ? $number->id : $numbpref->number_id}}" id="number_id" name="number_id">
    </div>
    <div class="form-group col-md-3">
      <label for="name">Name</label>
      <input type="text" class="form-control" placeholder="Enter the Name" value="{{isset($numbpref) ? $numbpref->name : old('name')}}" id="name" name="name" required>
    </div>
    <div class="form-group col-md-4">
      <label for="value">Value</label>
      <input type="text" class="form-control" placeholder="Enter the Name" value="{{isset($numbpref) ? $numbpref->value : old('value')}}" id="value" name="value" required>
    </div>
  </div>
</div>