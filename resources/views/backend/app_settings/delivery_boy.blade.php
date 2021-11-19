@extends('backend.layouts.app')
@section('content')

@php
$business = App\Models\GeneralSetting::first();
@endphp

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col">
			<h1 class="h3">{{ translate('Delivery Boy App') }}</h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-8 mx-auto">
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Delivery Boy App Settings') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('app_setup.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					 <div class="form-group row">
                            <label class="col-md-3 col-from-label">{{translate('App Name')}}</label>
                            <div class="col-md-8">
                                <input type="hidden" name="types[]" value="delivery_boy_app_name">
        	                    <input type="text" name="delivery_boy_app_name" class="form-control" placeholder="{{ translate('App Name') }}" value="{{ get_appsetting('delivery_boy_app_name') }}">
                            </div>
                        </div>
                        <div class="form-group row">
    						<label class="col-md-3 col-from-label">{{ translate('Message') }}</label>
                            <div class="col-md-8">
        						<input type="hidden" name="types[]" value="delivery_boy_app_message">
        						<textarea class="resize-off form-control" placeholder="Message" name="delivery_boy_app_message">{{  get_appsetting('delivery_boy_app_message') }}</textarea>
                            </div>
    					</div>
    					<div class="form-group row">
    						<label class="col-md-3 col-from-label">{{ translate('Offer') }}</label>
                            <div class="col-md-8">
        						<input type="hidden" name="types[]" value="delivery_boy_app_offer">
        						<textarea class="resize-off form-control" placeholder="Offer" name="delivery_boy_app_offer">{{  get_appsetting('delivery_boy_app_offer') }}</textarea>
                            </div>
    					</div>
    					<hr>
    					<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Primary color')}}</label>
							<div class="col-md-8">
								<div class="form-group">
								    <input type="hidden" name="types[]" value="delivery_boy_primary_color">
									<input type="color" name="delivery_boy_primary_color" value="{{ get_appsetting('delivery_boy_primary_color') }}">
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Secondary color')}}</label>
							<div class="col-md-8">
								<div class="form-group">
								    <input type="hidden" name="types[]" value="delivery_boy_secondary_color">
									<input type="color" name="delivery_boy_secondary_color" value="{{ get_appsetting('delivery_boy_secondary_color') }}">
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Third color')}}</label>
							<div class="col-md-8">
								<div class="form-group">
								    <input type="hidden" name="types[]" value="delivery_boy_third_color">
									<input type="color" name="delivery_boy_third_color" value="{{ get_appsetting('delivery_boy_third_color') }}">
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Global color')}}</label>
							<div class="col-md-8">
								<div class="form-group">
								    <input type="hidden" name="types[]" value="delivery_boy_global_color">
									<input type="color" name="delivery_boy_global_color" value="{{ get_appsetting('delivery_boy_global_color') }}">
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Button 1 color')}}</label>
							<div class="col-md-8">
								<div class="form-group">
								    <input type="hidden" name="types[]" value="delivery_boy_button1_color">
									<input type="color" name="delivery_boy_button1_color" value="{{ get_appsetting('delivery_boy_button1_color') }}">
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Button 2 color')}}</label>
							<div class="col-md-8">
								<div class="form-group">
								    <input type="hidden" name="types[]" value="delivery_boy_button2_color">
									<input type="color" name="delivery_boy_button2_color" value="{{ get_appsetting('delivery_boy_button2_color') }}">
								</div>
							</div>
						</div>
						<hr>
					<div class="form-group row">
	                    <label class="col-md-3 col-from-label">{{ translate('App Logo') }}</label>
						<div class="col-md-8">
		                    <div class=" input-group " data-toggle="aizuploader" data-type="image">
		                        <div class="input-group-prepend">
		                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
		                        </div>
		                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
								<input type="hidden" name="types[]" value="delivery_boy_app_logo">
		                        <input type="hidden" name="delivery_boy_app_logo" class="selected-files" value="{{ get_appsetting('delivery_boy_app_logo') }}">
		                    </div>
		                    <div class="file-preview"></div>
						</div>
	                </div>
	                <div class="form-group row">
	                    <label class="col-md-3 col-from-label">{{ translate('Splash Image') }}</label>
						<div class="col-md-8">
		                    <div class=" input-group " data-toggle="aizuploader" data-type="image">
		                        <div class="input-group-prepend">
		                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
		                        </div>
		                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
								<input type="hidden" name="types[]" value="delivery_boy_splash_image">
		                        <input type="hidden" name="delivery_boy_splash_image" class="selected-files" value="{{ get_appsetting('delivery_boy_splash_image') }}">
		                    </div>
		                    <div class="file-preview"></div>
						</div>
	                </div>
	                <div class="form-group row">
	                    <label class="col-md-3 col-from-label">{{ translate('Login Image') }}</label>
						<div class="col-md-8">
		                    <div class=" input-group " data-toggle="aizuploader" data-type="image">
		                        <div class="input-group-prepend">
		                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
		                        </div>
		                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
								<input type="hidden" name="types[]" value="delivery_boy_login_image">
		                        <input type="hidden" name="delivery_boy_login_image" class="selected-files" value="{{ get_appsetting('delivery_boy_login_image') }}">
		                    </div>
		                    <div class="file-preview"></div>
						</div>
	                </div>
	                <div class="form-group row">
	                    <label class="col-md-3 col-from-label">{{ translate('Registration Image') }}</label>
						<div class="col-md-8">
		                    <div class=" input-group " data-toggle="aizuploader" data-type="image">
		                        <div class="input-group-prepend">
		                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
		                        </div>
		                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
								<input type="hidden" name="types[]" value="delivery_boy_registration_image">
		                        <input type="hidden" name="delivery_boy_registration_image" class="selected-files" value="{{ get_appsetting('delivery_boy_registration_image') }}">
		                    </div>
		                    <div class="file-preview"></div>
						</div>
	                </div>
	                <div class="form-group row">
	                    <label class="col-md-3 col-from-label">{{ translate('Square Logo') }}</label>
						<div class="col-md-8">
		                    <div class=" input-group " data-toggle="aizuploader" data-type="image">
		                        <div class="input-group-prepend">
		                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
		                        </div>
		                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
								<input type="hidden" name="types[]" value="delivery_boy_square_logo">
		                        <input type="hidden" name="delivery_boy_square_logo" class="selected-files" value="{{ get_appsetting('delivery_boy_square_logo') }}">
		                    </div>
		                    <div class="file-preview"></div>
						</div>
	                </div>
	                <div class="form-group row">
	                    <label class="col-md-3 col-from-label">{{ translate('Placeholder Image') }}</label>
						<div class="col-md-8">
		                    <div class=" input-group " data-toggle="aizuploader" data-type="image">
		                        <div class="input-group-prepend">
		                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
		                        </div>
		                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
								<input type="hidden" name="types[]" value="delivery_boy_placeholder_image">
		                        <input type="hidden" name="delivery_boy_placeholder_image" class="selected-files" value="{{ get_appsetting('delivery_boy_placeholder_image') }}">
		                    </div>
		                    <div class="file-preview"></div>
						</div>
	                </div>
                 
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
