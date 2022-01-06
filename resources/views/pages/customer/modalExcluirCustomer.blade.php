<div class="modal fade text-left" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel140"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title white" id="myModalLabel140">Delete Customer</h5>
      </div>
      <form action="{{route('customers.destroy', isset($item) ? $item->id : '')}}" method="post">
        {{method_field('delete')}}
        {{ csrf_field() }}
        <div class="modal-body">
          Are you sure you want to delete this Customer?
          <input type="hidden" name="customer_id" id="contid" value="">
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