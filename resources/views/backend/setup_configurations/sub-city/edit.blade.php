@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Sub City Information')}}</h5>
</div>

<div class="row">
  <div class="col-lg-8 mx-auto">
      <div class="card">
          <div class="card-body p-0">
              <ul class="nav nav-tabs nav-fill border-light">
    			</ul>
              <form class="p-4" action="{{ route('sub-city.update', $sub_city->id) }}" method="POST" enctype="multipart/form-data">
                  <input name="_method" type="hidden" value="PATCH">
                  @csrf
                  <div class="form-group mb-3">
                      <label for="name">{{translate('Name')}}</label>
                      <input type="text" placeholder="{{translate('Name')}}" value="{{ $sub_city->name }}" name="name" class="form-control" required>
                  </div>

                  <div class="form-group">
                      <label for="city_id">{{translate('City')}}</label>
                      <select class="select2 form-control aiz-selectpicker" name="city_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
                          @foreach ($cities as $city)
                              <option value="{{ $city->id }}" @if($city->id == $sub_city->city_id) selected @endif>{{ $city->name }}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="form-group mb-3">
                      <label for="name">{{translate('Cost')}}</label>
                      <input type="number" min="0" step="0.01" placeholder="{{translate('Cost')}}" name="cost" class="form-control" value="{{ $sub_city->cost }}" required>
                  </div>


                  <div class="form-group mb-3 text-right">
                      <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

@endsection
