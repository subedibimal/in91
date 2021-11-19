@extends('backend.layouts.app')

@section('content')

@php
$business = App\Models\GeneralSetting::first();
@endphp

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col">
			<h1 class="h3">{{ translate('Customer App') }}</h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-8 mx-auto">
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Customer App Settings') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('app_setup.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					 <div class="form-group row">
                            <label class="col-md-3 col-from-label">{{translate('App Name')}}</label>
                            <div class="col-md-8">
                                <input type="hidden" name="types[]" value="app_name">
        	                    <input type="text" name="app_name" class="form-control" placeholder="{{ translate('App Name') }}" value="{{ get_appsetting('app_name') }}">
                            </div>
                        </div>
                        <div class="form-group row">
    						<label class="col-md-3 col-from-label">{{ translate('Message') }}</label>
                            <div class="col-md-8">
        						<input type="hidden" name="types[]" value="app_message">
        						<textarea class="resize-off form-control" placeholder="Message" name="app_message">{{  get_appsetting('app_message') }}</textarea>
                            </div>
    					</div>
    					<div class="form-group row">
    						<label class="col-md-3 col-from-label">{{ translate('Offer') }}</label>
                            <div class="col-md-8">
        						<input type="hidden" name="types[]" value="app_offer">
        						<textarea class="resize-off form-control" placeholder="Offer" name="app_offer">{{  get_appsetting('app_offer') }}</textarea>
                            </div>
    					</div>
    					<hr>
    					<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Primary color')}}</label>
							<div class="col-md-8">
								<div class="form-group">
								    <input type="hidden" name="types[]" value="primary_color">
									<input type="color" name="primary_color" value="{{ get_appsetting('primary_color') }}">
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Secondary color')}}</label>
							<div class="col-md-8">
								<div class="form-group">
								    <input type="hidden" name="types[]" value="secondary_color">
									<input type="color" name="secondary_color" value="{{ get_appsetting('secondary_color') }}">
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Third color')}}</label>
							<div class="col-md-8">
								<div class="form-group">
								    <input type="hidden" name="types[]" value="third_color">
									<input type="color" name="third_color" value="{{ get_appsetting('third_color') }}">
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Global color')}}</label>
							<div class="col-md-8">
								<div class="form-group">
								    <input type="hidden" name="types[]" value="global_color">
									<input type="color" name="global_color" value="{{ get_appsetting('global_color') }}">
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Button 1 color')}}</label>
							<div class="col-md-8">
								<div class="form-group">
								    <input type="hidden" name="types[]" value="button1_color">
									<input type="color" name="button1_color" value="{{ get_appsetting('button1_color') }}">
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Button 2 color')}}</label>
							<div class="col-md-8">
								<div class="form-group">
								    <input type="hidden" name="types[]" value="button2_color">
									<input type="color" name="button2_color" value="{{ get_appsetting('button2_color') }}">
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
								<input type="hidden" name="types[]" value="app_logo">
		                        <input type="hidden" name="app_logo" class="selected-files" value="{{ get_appsetting('app_logo') }}">
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
								<input type="hidden" name="types[]" value="splash_image">
		                        <input type="hidden" name="splash_image" class="selected-files" value="{{ get_appsetting('splash_image') }}">
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
								<input type="hidden" name="types[]" value="login_image">
		                        <input type="hidden" name="login_image" class="selected-files" value="{{ get_appsetting('login_image') }}">
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
								<input type="hidden" name="types[]" value="registration_image">
		                        <input type="hidden" name="registration_image" class="selected-files" value="{{ get_appsetting('registration_image') }}">
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
								<input type="hidden" name="types[]" value="square_logo">
		                        <input type="hidden" name="square_logo" class="selected-files" value="{{ get_appsetting('square_logo') }}">
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
								<input type="hidden" name="types[]" value="placeholder_image">
		                        <input type="hidden" name="placeholder_image" class="selected-files" value="{{ get_appsetting('placeholder_image') }}">
		                    </div>
		                    <div class="file-preview"></div>
						</div>
	                </div>
                  {{--  <div class="form-group row">
						<label class="col-md-3 col-from-label">{{translate('Show Language Switcher?')}}</label>
						<div class="col-md-8">
							<label class="aiz-switch aiz-switch-success mb-0">
								<input type="hidden" name="types[]" value="show_language_switcher">
								<input type="checkbox" name="show_language_switcher" @if( get_appsetting('show_language_switcher') == 'on') checked @endif>
								<span></span>
							</label>
						</div>
					</div>
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{translate('Show Currency Switcher?')}}</label>
						<div class="col-md-8">
							<label class="aiz-switch aiz-switch-success mb-0">
								<input type="hidden" name="types[]" value="show_currency_switcher">
								<input type="checkbox" name="show_currency_switcher" @if( get_appsetting('show_currency_switcher') == 'on') checked @endif>
								<span></span>
							</label>
						</div>
					</div>
	                <div class="form-group row pb-2">
						<label class="col-md-3 col-from-label">{{translate('Enable stikcy header?')}}</label>
						<div class="col-md-8">
							<label class="aiz-switch aiz-switch-success mb-0">
								<input type="hidden" name="types[]" value="header_stikcy">
								<input type="checkbox" name="header_stikcy" @if( get_appsetting('header_stikcy') == 'on') checked @endif>
								<span></span>
							</label>
						</div>
					</div>

					<div class="border-top pt-3 ">
						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Header Message')}}</label>
							<div class="col-md-8">
								<div class="form-group">
									<input type="text" class="form-control" name="header_msg" value="{{ $business->header_msg }}">
								</div>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Phone Number')}}</label>
							<div class="col-md-8">
								<div class="form-group">
									<input type="text" class="form-control" name="phone" value="{{ $business->phone }}">
								</div>
							</div>
						</div>
					</div>
                
					<div class="border-top pt-3 ">
						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Promo Line')}}</label>
							<div class="col-md-8">
								<div class="form-group">
									<textarea name="promo_line" rows="4" class="form-control">{{ $business->promo_line }}</textarea>
								</div>
							</div>
						</div>
                        
                        <div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Promo Background Option')}}</label>
							<div class="col-md-8">
								<div class="form-group">
									<select name="promo_option" class="form-control">
									    <option value="image" @if($business->promo_option == 'image') selected @endif>Background Image</option>
									    <option value="color" @if($business->promo_option == 'color') selected @endif>Background Color</option>
									</select>
								</div>
							</div>
						</div>
                        
						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Background color')}}</label>
							<div class="col-md-8">
								<div class="form-group">
									<input type="color" name="promo_bgcolor" value="{{ $business->promo_bgcolor }}">
								</div>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{translate('Font color')}}</label>
							<div class="col-md-8">
								<div class="form-group">
									<input type="color" name="promo_fontcolor" value="{{ $business->promo_fontcolor }}">
								</div>
							</div>
						</div> 

						<div class="form-group row">
							<label class="col-md-3 col-from-label">{{ translate('Promo Image') }}</label>
							<div class="col-md-8">
								<div class=" input-group " data-toggle="aizuploader" data-type="image">
									<div class="input-group-prepend">
										<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
									</div>
									<div class="form-control file-amount">{{ translate('Choose File') }}</div>
									<input type="hidden" name="promo_bgimg" class="selected-files" value="">
								</div>
								<div class="file-preview"></div>
							</div>
						</div> --}}

						
					</div>

				{{--	<div class="border-top pt-3">
						<label class="">{{translate('Header Nav Menu')}}</label>
						<div class="header-nav-menu">
							<input type="hidden" name="types[]" value="header_menu_labels">
							<input type="hidden" name="types[]" value="header_menu_links">
							@if (get_appsetting('header_menu_labels') != null)
								@foreach (json_decode( get_appsetting('header_menu_labels'), true) as $key => $value)
									<div class="row gutters-5">
										<div class="col-4">
											<div class="form-group">
												<input type="text" class="form-control" placeholder="Label" name="header_menu_labels[]" value="{{ $value }}">
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<input type="text" class="form-control" placeholder="{{ translate('Link with') }} http:// {{ translate('or') }} https://" name="header_menu_links[]" value="{{ json_decode(App\BusinessSetting::where('type', 'header_menu_links')->first()->value, true)[$key] }}">
											</div>
										</div>
										<div class="col-auto">
											<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
												<i class="las la-times"></i>
											</button>
										</div>
									</div>
								@endforeach
							@endif
						</div>
						<button
							type="button"
							class="btn btn-soft-secondary btn-sm"
							data-toggle="add-more"
							data-content='<div class="row gutters-5">
								<div class="col-4">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Label" name="header_menu_labels[]">
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="{{ translate('Link with') }} http:// {{ translate('or') }} https://" name="header_menu_links[]">
									</div>
								</div>
								<div class="col-auto">
									<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
										<i class="las la-times"></i>
									</button>
								</div>
							</div>'
							data-target=".header-nav-menu">
							{{ translate('Add New') }}
						</button>
					</div> --}}
					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
