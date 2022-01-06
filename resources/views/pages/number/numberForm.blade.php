<div class="form py-2 mb-2">
  <div class="form-row row">
    <div class="form-group col-md-5">
      <label for="number">Number</label>
      <input type="text" class="form-control" placeholder="Inform the number" minlength="8" maxlength="14" value="{{isset($number) ? $number->number : old('number')}}" id="number" name="number" required>
    </div>
    <div class="form-group col-md-3">
      <label for="customer">Customer</label>
      <select id="customer" class="form-control" name="customer_id" required>
        @foreach ($customers as $item)
          <option {{isset($number) && $number->customer_id == $item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="status">Status</label>
      <select id="status" class="form-control" name="status" required>
        <option {{isset($number) && $number->status == 'active' ? 'selected' : ''}} value="active">Active</option>
        <option {{isset($number) && $number->status == 'inactive' ? 'selected' : ''}} value="inactive">Inactive</option>
        <option {{isset($number) && $number->status == 'cancelled' ? 'selected' : ''}} value="cancelled">Cancelled</option>
      </select>
    </div>
  </div>
</div>