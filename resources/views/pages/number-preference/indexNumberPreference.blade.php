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
            <h4 class="card-title col-md-8">Numbers Preferences</h4>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive-sm">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#ID</th>
                  <th>Number Id</th>
                  <th>Name</th>
                  <th>Value</th>
                  <th class="text-center">Options</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($numbpref as $item)
                <tr>
                  <th scope="row">{{$item->id}}</th>
                  <td>{{$item->number_id}}</td>
                  <td>{{$item->name}}</td>
                  <td>{{$item->value}}</td>
                  <td class="text-center">
                    <div class="btn-group">
                      <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('numbers-preferences.edit', $item->id)}}"><i class="bx bxs-edit-alt mr-1"></i> Edit Number Preference</a>
                        <a class="dropdown-item" href="{{$item->id}}" data-contid={{$item->id}} data-target="#delete" data-toggle="modal"><i class="bx bx-x-circle mr-1"></i> Delete Number Preference</a>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="d-flex justify-content-between">
						<div class="justify-content-start"><p>Showing {{$numbpref->count()}} numbers preferences of a total of {{$numbpref->total()}}</p></div>
						<div class="justify-content-end">{{$numbpref->links()}}</div>
					</div>
        </div>
      </div>
    </div>
  </div>
  @include('pages.number-preference.modalExcluirNumberPreference')
</div>
@push('scripts')
<script src='{{asset('js/javascript/generic.js')}}'></script>
@endpush
@endsection