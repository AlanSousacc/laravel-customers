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
            <h4 class="card-title col-md-8">Customers</h4>
            <a class="btn btn-light col-md-4" href="{{route('customers.create')}}"> <i class='bx bx-plus'></i> New Customer</a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive-sm">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#ID</th>
                  <th>Name</th>
                  <th>Document</th>
                  <th>Status</th>
                  <th class="text-center">Options</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($customers as $item)
                <tr>
                  <th scope="row">{{$item->id}}</th>
                  <td>{{$item->name}}</td>
                  <td>{{$item->document}}</td>
                  <td>
                    @if ($item->status == 'new')
                    <span class="badge alert-success">{{$item->status}}</span>
                    @elseif ($item->status == 'suspended')
                    <span class="badge alert-warning">{{$item->status}}</span>
                    @elseif ($item->status == 'cancelled')
                    <span class="badge alert-danger">{{$item->status}}</span>
                    @else
                    <span class="badge alert-primary">{{$item->status}}</span>
                    @endif
                  </td>
                  <td class="text-center">
                    <div class="btn-group">
                      <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('customers.edit', $item->id)}}"><i class="bx bxs-edit-alt mr-1"></i> Edit Customer</a>
                        <a class="dropdown-item" href="{{$item->id}}" data-customer={{$item->id}} data-target="#newStatusCustomer" data-toggle="modal"><i class="bx bx-transfer mr-1"></i> Change Status</a>
                        <a class="dropdown-item" href="{{route('numbers.create', $item->id)}}"><i class="bx bx-category mr-1"></i>New Number</a>
                        <a class="dropdown-item" href="{{$item->id}}" data-contid={{$item->id}} data-target="#delete" data-toggle="modal"><i class="bx bx-x-circle mr-1"></i> Delete Customer</a>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="d-flex justify-content-between">
						<div class="justify-content-start"><p>Showing {{$customers->count()}} customers of a total of {{$customers->total()}}</p></div>
						<div class="justify-content-end">{{$customers->links()}}</div>
					</div>
        </div>
      </div>
    </div>
  </div>
  @include('pages.customer.modalExcluirCustomer')
  @include('pages.customer.modalEditarStatusCustomer')
</div>
@push('scripts')
<script src='{{asset('js/javascript/generic.js')}}'></script>
@endpush
@endsection