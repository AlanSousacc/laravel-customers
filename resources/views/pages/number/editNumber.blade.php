@extends('layouts.app')

@section('content')
<div class="col-md-4 offset-4 fixed-top mt-3" style="z-index: 9999;">
  @include('layouts.messages.master-message')
</div>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Edit Number</h4>
        </div>
        <div class="card-body">
          <form action="{{route('numbers.update', $number->id)}}" method="post">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @include('pages.number.numberForm')
            <div class="col-12 d-flex justify-content-end">
              <button type="submit" class="btn btn-primary mr-1">Save Number</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@push('scripts')
</script>
@endpush
@endsection