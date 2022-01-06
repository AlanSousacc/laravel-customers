<div class="form py-2 mb-2">
  <div class="form-row row">
    <div class="form-group col-md-5">
      <label for="name">Name</label>
      <input type="text" class="form-control" placeholder="Inform the customer's name" value="{{isset($customer) ? $customer->name : old('name')}}" id="name" name="name" required>
    </div>
    <div class="form-group col-md-3">
      <label for="document">Document</label>
      <input type="text" class="form-control" placeholder="Inform the customer document" id="document" value="{{isset($customer) ? $customer->document : old('document')}}" name="document" maxlength="12" minlength="6" required>
    </div>
    <div class="form-group col-md-4">
      <label for="status">Status</label>
      <select id="status" class="form-control" name="status" required>
        <option {{isset($customer) && $customer->status == 'new' ? 'selected' : ''}} value="new">New</option>
        <option {{isset($customer) && $customer->status == 'active' ? 'selected' : ''}} value="active">Active</option>
        <option {{isset($customer) && $customer->status == 'suspended' ? 'selected' : ''}} value="suspended">Suspended</option>
        <option {{isset($customer) && $customer->status == 'cancelled' ? 'selected' : ''}} value="cancelled">Cancelled</option>
      </select>
    </div>
  </div>
</div>