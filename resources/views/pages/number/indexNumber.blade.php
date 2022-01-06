@extends('layouts.app')

@section('content')
<div class="col-md-4 offset-8 fixed-top mt-3" style="z-index: 9999;">
  @include('layouts.messages.master-message')
</div>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <h4 class="card-title col-md-8">Numbers</h4>
            <a class="btn btn-light col-md-4" href="{{route('numbers.create')}}"> <i class='bx bx-plus'></i> New Number</a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive-sm">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#ID</th>
                  <th>Number</th>
                  <th>Customer</th>
                  <th>Status</th>
                  <th class="text-center">Options</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($numbers as $item)
                <tr>
                  <th scope="row">{{$item->id}}</th>
                  <td>{{$item->number}}</td>
                  <td>{{$item->customer->name}}</td>
                  <td>
                    @if ($item->status == 'active')
                    <span class="badge alert-success">{{$item->status}}</span>
                    @elseif ($item->status == 'inactive')
                    <span class="badge alert-warning">{{$item->status}}</span>
                    @elseif ($item->status == 'cancelled')
                    <span class="badge alert-danger">{{$item->status}}</span>
                    @endif
                  </td>
                  <td class="text-center">
                    <div class="btn-group">
                      <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('numbers.edit', $item->id)}}"><i class="bx bxs-edit-alt mr-1"></i> Edit Number</a>
                        <a class="dropdown-item" href="{{$item->id}}" data-number={{$item->id}} data-target="#newStatusNumber" data-toggle="modal"><i class="bx bx-transfer mr-1"></i> Change Status</a>
                        <a class="dropdown-item" href="{{route('numbers.preferences.create', $item->id)}}"><i class="bx bx-category mr-1"></i>New Number Preference</a>
                        <a class="dropdown-item" href="{{$item->id}}" data-contid={{$item->id}} data-target="#delete" data-toggle="modal"><i class="bx bx-x-circle mr-1"></i> Delete Number</a>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="d-flex justify-content-between">
						<div class="justify-content-start"><p>Showing {{$numbers->count()}} numbers of a total of {{$numbers->total()}}</p></div>
						<div class="justify-content-end">{{$numbers->links()}}</div>
					</div>
        </div>
      </div>
    </div>
  </div>
  @include('pages.number.modalExcluirNumber')
  @include('pages.number.modalEditarStatusNumber')
</div>
@push('scripts')
<script src='{{asset('js/javascript/generic.js')}}'></script>
@endpush
@endsection