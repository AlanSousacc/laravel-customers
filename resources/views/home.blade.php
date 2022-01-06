@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{ __('Dashboard') }}</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <div class="row">
            <div class="col-md-4">
              <div class="card bg-light mb-3">
                <div class="card-header"><h1 class="display-9">Customers</h1></div>
                <div class="card-body">
                  <h1 class="display-4 text-center">{{$customer}}</h1>
                  <div class="row">
                    <div class="col text-center">
                      <a class="btn btn-outline-secondary" href="{{route('customers.index')}}" role="button">Show <i class="bx bx-right-arrow-alt"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card bg-light mb-3">
                <div class="card-header"><h1 class="display-9">Numbers</h1></div>
                <div class="card-body">
                  <h1 class="display-4 text-center">{{$numbers}}</h1>
                  <div class="row">
                    <div class="col text-center">
                      <a class="btn btn-outline-secondary" href="{{route('numbers.index')}}" role="button">Show <i class="bx bx-right-arrow-alt"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card bg-light mb-3">
                <div class="card-header"><h1 class="display-9">Numbers Preferences</h1></div>
                <div class="card-body">
                  <h1 class="display-4 text-center">{{$nbpref}}</h1>
                  <div class="row">
                    <div class="col text-center">
                      <a class="btn btn-outline-secondary" href="{{route('numbers-preferences.index')}}" role="button">Show <i class="bx bx-right-arrow-alt"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection