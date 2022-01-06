<div class="modal fade text-left" id="newStatusCustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel140"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title white" id="myModalLabel140">Change Status Customer</h5>
      </div>
      <form action="{{route('change.status.customer')}}" method="post">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="modal-body">
          <input type="hidden" name="customer_id" id="customer" value="">
          <div class="form-group col-md-12">
            <label for="status">New Status</label>
            <select id="status" class="form-control" name="status" required>
              <option value="new">New</option>
              <option value="active">Active</option>
              <option value="suspended">Suspended</option>
              <option value="cancelled">Cancelled</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">No</span>
          </button>

          <button type="submit" class="btn btn-warning ml-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Yes</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>