@extends('frontend.layouts.app')

@section('content')

    {{-- Categories , Sliders . Today's deal --}}
    <div class="home-banner-area mb-4">
        <div class="container-fluid">
            <div class="row gutters-10 position-relative">

                @php
                    $num_todays_deal = count(filter_products(\App\Product::where('published', 1)->where('todays_deal', 1 ))->get());
                    $featured_categories = \App\Category::where('featured', 1)->get();
                @endphp
                
                <div class="col-lg-12">
                    
                    @if (get_setting('home_slider_images') != null)
                    <div class="owl-carousel owl-carousel-slider owl-theme mb-3 main-home-slider">
                        @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
                        @foreach ($slider_images as $key => $value)
                            <div class="item">
                                <img src="{{ uploaded_asset($slider_images[$key]) }}" style="height:360px;" alt="{{ env('APP_NAME')}} promo">
                            </div>
                        @endforeach
                    </div>
                    @endif
                    

                    @if (count($featured_categories) > 0)
                    <!-- for row -->
                    <div class="container mb-3" style="text-align: center;">
                        <div class="owl-carousel owl-carousel-category owl-theme d-flex flex-row justify-content-around">
                            @foreach ($featured_categories->take(7) as $key => $category)
                            <!-- for col outer box-->
                            <div class="p-2 item">
                                <!-- inner box -->
                                <div class="inner-box">
                                    <a href="{{ route('products.category', $category->slug) }}" title="{{ $category->getTranslation('name') }}" class="category-text-link">
                                        <!-- for image only -->
                                        <div class="image-only-wrapper" style="background-color:{{ $category->bg_color }};">
                                            <img src="{{ uploaded_asset($category->banner) }}" alt="{{ $category->getTranslation('name') }}" class="img-fluid mx-auto" style="width:100%; ">
                                        </div>
                                        <div class="text-only-box">
                                            <span class="category-text opacity-90">{{ $category->getTranslation('name') }}</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                </div>

            </div>
        </div>
    </div>

    {{-- Banner section 1 --}}
    @if (get_setting('home_banner1_images') != null)
    <div class="mb-4 mt-4">
        <div class="container">
            <div class="row gutters-10">
                @php $banner_1_imags = json_decode(get_setting('home_banner1_images')); @endphp
                @foreach ($banner_1_imags as $key => $value)
                    <div class="col-xl col-md-6">
                        <div class="mb-3 mb-lg-0">
                            <a href="{{ json_decode(get_setting('home_banner1_links'), true)[$key] }}" class="d-block text-reset">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($banner_1_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif


    {{-- Flash Deal --}}
    @php
        $flash_deal = \App\FlashDeal::where('status', 1)->where('featured', 1)->first();
    @endphp
    @if($flash_deal != null && strtotime(date('Y-m-d H:i:s')) >= $flash_deal->start_date && strtotime(date('Y-m-d H:i:s')) <= $flash_deal->end_date)
    <section class="mb-4">
        <div class="container">
            <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">

                <div class="d-flex flex-wrap mb-3 align-items-baseline border-bottom">
                    <h3 class="h5 fw-700 mb-0">
                        <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Flash Sale') }}</span>
                    </h3>
                    <div class="aiz-count-down ml-auto ml-lg-3 align-items-center" data-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>
                    <a href="{{ route('flash-deal-details', $flash_deal->slug) }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md w-100 w-md-auto">{{ translate('View More') }}</a>
                </div>

                <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
                    @foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product)
                        @php
                            $product = \App\Product::find($flash_deal_product->product_id);
                        @endphp
                        @if ($product != null && $product->published != 0)
                            <div class="carousel-box">
                                <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                    <div class="position-relative">
                                        <a href="{{ route('product', $product->slug) }}" class="d-block">
                                            <img
                                                class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                alt="{{  $product->getTranslation('name')  }}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                            >
                                        </a>
                                        <div class="absolute-top-right aiz-p-hov-icon">
                                            <a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}" data-placement="left">
                                                <i class="la la-heart-o"></i>
                                            </a>
                                            <a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to compare') }}" data-placement="left">
                                                <i class="las la-sync"></i>
                                            </a>
                                            <a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to cart') }}" data-placement="left">
                                                <i class="las la-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="p-md-3 p-2 text-left">
                                        <div class="fs-15">
                                            @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                <del class="fw-600 opacity-50 mr-1">{{ home_base_price($product->id) }}</del>
                                            @endif
                                            <span class="fw-700 text-primary">{{ home_discounted_base_price($product->id) }}</span>
                                        </div>
                                        <div class="rating rating-sm mt-1">
                                            {{ renderStarRating($product->rating) }}
                                        </div>
                                        <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                            <a href="{{ route('product', $product->slug) }}" class="d-block text-reset">{{  $product->getTranslation('name')  }}</a>
                                        </h3>
                                        @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                            <div class="rounded px-2 mt-2 bg-soft-primary border-soft-primary border">
                                                {{ translate('Club Point') }}:
                                                <span class="fw-700 float-right">{{ $product->earn_point }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif


    {{-- Featured Section --}}
    <div id="section_featured">

    </div>

    {{-- Best Selling  --}}
    <div id="section_best_selling">

    </div>


    {{-- Banner Section 2 --}}
    @if (get_setting('home_banner2_images') != null)
    <div class="mb-4">
        <div class="container">
            <div class="row gutters-10">
                @php $banner_2_imags = json_decode(get_setting('home_banner2_images')); @endphp
                @foreach ($banner_2_imags as $key => $value)
                    <div class="col-xl col-md-6">
                        <div class="mb-3 mb-lg-0">
                            <a href="{{ json_decode(get_setting('home_banner2_links'), true)[$key] }}" class="d-block text-reset">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($banner_2_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- Category wise Products --}}
    <div id="section_home_categories">

    </div>

    {{-- Classified Product --}}
    @if(\App\BusinessSetting::where('type', 'classified_product')->first()->value == 1)
        @php
            $classified_products = \App\CustomerProduct::where('status', '1')->where('published', '1')->take(10)->get();
        @endphp
           @if (count($classified_products) > 0)
               <section class="mb-4">
                   <div class="container">
                       <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
                            <div class="d-flex mb-3 align-items-baseline border-bottom">
                                <h3 class="h5 fw-700 mb-0">
                                    <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Classified Ads') }}</span>
                                </h3>
                                <a href="{{ route('customer.products') }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View More') }}</a>
                            </div>
                           <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
                               @foreach ($classified_products as $key => $classified_product)
                                   <div class="carousel-box">
                                        <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                            <div class="position-relative">
                                                <a href="{{ route('customer.product', $classified_product->slug) }}" class="d-block">
                                                    <img
                                                        class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($classified_product->thumbnail_img) }}"
                                                        alt="{{ $classified_product->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                    >
                                                </a>
                                                <div class="absolute-top-left pt-2 pl-2">
                                                    @if($classified_product->conditon == 'new')
                                                       <span class="badge badge-inline badge-success">{{translate('new')}}</span>
                                                    @elseif($classified_product->conditon == 'used')
                                                       <span class="badge badge-inline badge-danger">{{translate('Used')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="p-md-3 p-2 text-left">
                                                <div class="fs-15 mb-1">
                                                    <span class="fw-700 text-primary">{{ single_price($classified_product->unit_price) }}</span>
                                                </div>
                                                <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                    <a href="{{ route('customer.product', $classified_product->slug) }}" class="d-block text-reset">{{ $classified_product->getTranslation('name') }}</a>
                                                </h3>
                                            </div>
                                       </div>
                                   </div>
                               @endforeach
                           </div>
                       </div>
                   </div>
               </section>
           @endif
       @endif

    {{-- Banner Section 2 --}}
    @if (get_setting('home_banner3_images') != null)
    <div class="mb-4">
        <div class="container">
            <div class="row gutters-10">
                @php $banner_3_imags = json_decode(get_setting('home_banner3_images')); @endphp
                @foreach ($banner_3_imags as $key => $value)
                    <div class="col-xl col-md-6">
                        <div class="mb-3 mb-lg-0">
                            <a href="{{ json_decode(get_setting('home_banner3_links'), true)[$key] }}" class="d-block text-reset">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($banner_3_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- Best Seller --}}
    @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
    <div id="section_best_sellers">

    </div>
    @endif

    {{-- Top 10 categories and Brands --}}

    <section class="mb-4">
        <div class="container">
            <div class="row">
                
                @if (get_setting('top10_categories') >= 7)
                    <div class="col-lg-12">
                        <div class="d-flex mb-3 align-items-baseline border-bottom">
                            <h3 class="h6 fw-700 mb-0">
                                <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Top 10 Categories') }}</span>
                            </h3>
                            <a href="{{ route('categories.all') }}" class="ml-auto mr-0 btn-decor">{{ translate('View All Categories') }}</a>
                            <!--<a href="{{ route('categories.all') }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View All Categories') }}</a>-->
                        </div>
                        <!--<div class="d-flex mb-3 align-items-baseline" style="margin-left:-50px">-->
                        <!--        @php $top10_categories = json_decode(get_setting('top10_categories')); @endphp-->
                                
                        <!--        <ul class="brand-carousel js-brand-carousel slick-arrows-aside-simple slick-initialized slick-slider">-->
                        <!--            <div class="slick-list draggable">-->
                        <!--                <div class="owl-carousel owl-carousel-category owl-theme d-flex flex-row justify-content-around slick-track" style="margin-left:0px !important; opacity: 1; width: 1330px; transform: translate3d(0px, 0px, 0px);">-->
                                            
                        <!--                    @foreach ($top10_categories as $key => $value)-->
                        <!--                        @php $category = \App\Category::find($value); @endphp-->
                        <!--                        @if ($category != null)-->
                        <!--                            <li class="p-2 item slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 160px;">-->
                        <!--                                <a href="{{ route('products.category', $category->slug) }}" tabindex="0">-->
                        <!--                                    <img src="{{ uploaded_asset($category->banner) }}" data-src="{{ uploaded_asset($category->banner) }}" alt="{{ $category->getTranslation('name') }}" class=" lazyloaded" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">-->
                        <!--                                </a>-->
                        <!--                            </li>-->
                        <!--                        @endif-->
                        <!--                    @endforeach-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </ul>-->
                        <!--    </div>-->
                            
                        @php $top10_categories = json_decode(get_setting('top10_categories')); @endphp
                        
                        <!-- for row -->
                        <div class="container mb-4" style="text-align: center;">
                            <div class="owl-carousel owl-carousel-category owl-theme d-flex flex-row justify-content-around">
                                @foreach ($top10_categories as $key => $value)
                                @php $category = \App\Category::find($value); @endphp
                                @if ($category != null)
                                    <!-- for col outer box-->
                                    <div class="p-2 item">
                                        <!-- inner box -->
                                        <div class="inner-box">
                                            <a href="{{ route('products.category', $category->slug) }}" title="{{ $category->getTranslation('name') }}" class="category-text-link">
                                                <!-- for image only -->
                                                <div class="image-only-wrapper" style="background-color:#FB4D4F;">
                                                    <img src="{{ uploaded_asset($category->banner) }}" alt="{{ $category->getTranslation('name') }}" class="img-fluid mx-auto" style="width:100%; ">
                                                </div>
                                                <div class="text-only-box">
                                                    <span class="category-text opacity-90">{{ $category->getTranslation('name') }}</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                
                @if (get_setting('top10_brands') >= 7)
                    <div class="col-lg-12">
                        <div class="d-flex mb-3 align-items-baseline border-bottom">
                            <h3 class="h6 fw-700 mb-0">
                                <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Top 10 Brands') }}</span>
                            </h3>
                            <a href="{{ route('brands.all') }}" class="ml-auto mr-0 btn-decor">{{ translate('View All Brands') }}</a>
                        </div>
                            
                        @php $top10_brands = json_decode(get_setting('top10_brands')); @endphp
                        
                        <!-- for row -->
                        <div class="container mb-4" style="text-align: center;">
                            <div class="owl-carousel owl-carousel-category owl-theme d-flex flex-row justify-content-around">
                                @foreach ($top10_brands as $key => $value)
                                @php $brand = \App\Brand::find($value); @endphp
                                @if ($brand != null)
                                    <!-- for col outer box-->
                                    <div class="p-2 item">
                                        <!-- inner box -->
                                        <div class="inner-box">
                                            <a href="{{ route('products.brand', $brand->slug) }}" title="{{ $brand->getTranslation('name') }}" class="category-text-link">
                                                <!-- for image only -->
                                                <div class="image-only-wrapper" style="background-color:#FB4D4F;">
                                                    <img src="{{ uploaded_asset($brand->logo) }}" alt="{{ $brand->getTranslation('name') }}" class="img-fluid mx-auto" style="width:100%; ">
                                                </div>
                                                <div class="text-only-box">
                                                    <span class="category-text opacity-90">{{ $brand->getTranslation('name') }}</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                
            </div>
        </div>
    </section>
    
   
    
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_featured').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_selling').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories').html(data);
                AIZ.plugins.slickCarousel();
            });

            @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
            $.post('{{ route('home.section.best_sellers') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_sellers').html(data);
                AIZ.plugins.slickCarousel();
            });
            @endif
        });
    </script>
@endsection
