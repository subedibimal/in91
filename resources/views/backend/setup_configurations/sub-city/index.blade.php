@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
    	<div class="row align-items-center">
    		<div class="col-md-12">
    			<h1 class="h3">{{-- {{translate('All cities')}} --}} All Sub Cities</h1>
    		</div>
    	</div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header row gutters-5">
                    <div class="col text-center text-md-left">
                        <h5 class="mb-md-0 h6">{{-- {{ translate('Cities') }} --}} All Sub Cities</h5>
                    </div>
                    <div class="col-md-4">
                        <form class="" id="sort_cities" action="" method="GET">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name & Enter') }}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table aiz-table mb-0">
                        <thead>
                            <tr>
                                <th data-breakpoints="lg">#</th>
                                <th>{{translate('Name')}}</th
                                ><th>{{translate('City')}}</th>
                                <th>{{translate('Country')}}</th>
                                <th data-breakpoints="lg">{{translate('Cost')}}</th>
                                <th data-breakpoints="lg" class="text-right">{{translate('Options')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subCities as $key => $subCity)
                                <tr>
                                    <td>{{-- {{ ($key+1) + ($sub->currentPage() - 1)*$sub->perPage() }} --}}</td>
                                    <td>{{ $subCity->name }}</td>
                                    <td>{{ $subCity->city->name ?? '' }}</td>
                                    <td>{{ $subCity->city->country->name ?? '' }}</td>
                                    <td>{{ $subCity->cost }}</td>
                                    <td class="text-right">
                                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="" title="{{ translate('Edit') }}">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="" title="{{ translate('Delete') }}">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                            @endforelse
                        </tbody>
                    </table>
                    <div class="aiz-pagination">
                        {{ $cities->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
    		<div class="card">
    			<div class="card-header">
    				<h5 class="mb-0 h6">{{ translate('Add New city') }}</h5>
    			</div>
    			<div class="card-body">
    				<form action="{{ route('sub-city.store') }}" method="POST">
    					@csrf
    					<div class="form-group mb-3">
    						<label for="name">{{translate('Name')}}</label>
    						<input type="text" placeholder="{{translate('Name')}}" name="name" class="form-control" required>
    					</div>

                        <div class="form-group">
                            <label for="city_id">{{translate('City')}}</label>
                            {{-- <select class="select2 form-control aiz-selectpicker" name="country_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
                                @foreach ($countries as $country)
                                    <optgroup label="{{ $country->name }}">{{ $country->name }}</optgroup>
                                @endforeach
                            </select> --}}
                            <select class="form-control" name="city_id">
                            	<option value="">Select City</option>
                            	 @forelse ($countries as $country)
                            	 <optgroup label="{{ $country->name }}">
                            	 	@forelse($country->cities as $city)
                            	 	<option value="{{ $city->id }}">{{ $city->name }}</option>
                            	 	@empty
                            	 	@endforelse
                            	 	


                            	 </optgroup>
                                 @empty
                            	 @endforelse

                            </select>
                        </div>

                        <div class="form-group mb-3">
    						<label for="name">{{translate('Cost')}}</label>
    						<input type="number" min="0" step="0.01" placeholder="{{translate('Cost')}}" name="cost" class="form-control" required>
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

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">

        function update_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
        }

    </script>
@endsection
