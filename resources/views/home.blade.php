@extends('layouts.app')
@section('content')
<style>
  th,td{
    color: #fff;
  }
  .homevideo video {
    width: 100%;
}
.homevideo {
    background: #fbfafb;
}
.fbBeerHeader {
    position: unset;
}
.BottomHeader.sticky {
    background: #223752bd;
}
.footer_class {
    box-shadow: 0px 0px 10px grey;
    height: 100px;
    color: white;
}
</style>
<!--**********|| Location Section ||**********-->
    <section class="w-100 clearfix fbFindLocation ShowOnMobile ShowInMob">
      <div class="fbLocateCenter1 p-3">
        <div class="fbLocate w-100 clearfix">
          <div class="fbDevourTaste w-100 pt-3 HeadingText">
            <h3>DEVOUR A CRAFTED TASTE</h3>
            <p class="mb-0 pb-3">If you're looking for a place with world cuisine and a freshly brewed beer destination, your search ends here!</p>
          </div>
        </div>
      </div>
    </section>
    <!--**********|| Location Section ||**********-->
    <!--**********|| Home Banner Section ||**********-->
    <section class="w-100 clearfix fbHomeBanner" id="fbHomeBanner">
    <div class="homevideo">
    <div class="p-0">
        <video autoplay muted loop id="myVideo">
  <source src="{{ asset('front-assets/images/frenchises/home_video.mp4') }}" type="video/mp4">
</video>
        </div>
        </div>
      <div class="container-fluid p-0">
        
        <div id="homeSlider" class="carousel slide d-none" data-ride="carousel">
          <div class="carousel-indicators1">
            <div class="carousel-indicators2">
              <ul class="carousel-indicators3 carousel-indicators">
                @foreach($banners as $k => $banner)
                  <li data-target="#homeSlider" data-slide-to="{{$k}}" class="@if($k==0){{'active'}}@endif"></li>
                @endforeach
              </ul>
            </div>
          </div>
          <div class="carousel-inner">
            @foreach($banners as $k => $banner)
              <div class="carousel-item @if($k==0){{'active'}}@endif">
              <img src="{{ asset(@$banner->FileId->file) }}"data-original="{{ asset(@$banner->FileId->file) }}" class="img-fluid lazy">
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
    <!--**********|| Home Banner Section ||**********-->
    <!--**********|| Location Section ||**********-->
    <section class="w-100 clearfix fbFindLocation HideOnMobile" id="fbFindLocation" style="background-image:url({{ asset('front-assets/images/banner12.png') }})">
      <div class="fbLocateCenter p-md-5 pt-5">
        <div class="fbLocate w-100 clearfix">
          <form class="d-flex" id="find_form">
            <div class="form-group">
              <select name="find_location" class="form-control" id="find_location">
                <option value="">-Select Location</option>
                  @foreach($locations as $location)
                    <option <?php if(session('location') == $location->id){ echo 'selected'; } ?> value="{{$location->id}}">{{$location->name}}</option>
                  @endforeach
              </select>
            </div>
            <div class="submitBtn ml-2">
              <button type="submit" class="btn fbBtn1" onclick="setLocations('find_location','find_form','find'); return false;">Finch BrewCafe Near Me</button>
            </div>
          </form>
          <div class="fbNearLocate w-100 d-none">
            <a href="javascript:void(0)"><i class="fa fa-flag" aria-hidden="true"></i> Use Current Location</a>
          </div>
          <div class="fbDevourTaste w-100 pt-5 HeadingText">
            <h3>DEVOUR A CRAFTED TASTE</h3>
            <p class="mb-0 pb-3">IF YOU'RE LOOKING FOR A PLACE WITH WORLD CUISINE AND A FRESHLY BREWED BEER DESTINATION, YOUR SEARCH ENDS HERE!</p>
          </div>
        </div>
      </div>
      <div class="BgBannerImage1 w-100 ShowInMob position-relative">
        <p class="text-center ScrollDOwn"><a href="javascript:void(0);">Scroll
          <i class="fa fa-angle-down d-block" aria-hidden="true"></i></a> 
        </p>
        <img src="{{ asset('front-assets/images/pattren1.png') }}" class="img-fluid BannerImg3 w-100">
      </div>
    </section>
    <!--**********|| Location Section ||**********-->
    <!--**********|| Enjoy Prime Section ||**********-->
    <section class="w-100 clearfix fbOrderNowOnline py-5 ShowInMob" id="fbOrderNowOnline">
      <div class="container">
        <div class="HeadingText HeadingText2 text-center">
          <h3 class="mb-3">SELECT A LOCATION TO BEGIN</h3>
        </div>
        <div class="PrimePlaces w-100 clearfix">
                  <form action="" id="changeLcoationForm">
          <input type="hidden" id="getLoc" value="{{$setLocation}}">
          <div class="row">
          @foreach($locations as $location)
          @php
            $loc_image = asset($location->FileId->file);
          @endphp
            <div class="col-md-4 col-sm-6 p-lg-1 py-2">
              <div class="fbBestPlacer w-100 clearfix">
                <div class="PrimePlacesDetails w-100 text-center">
                  <div class="PlaceIcon p-2">
                    <img src="{{$loc_image}}" class="img-fluid" alt="No image">
                  </div>
                  <h5 class="mb-0 pt-2" style="font-size:12px;display:none;">{{$location->name}}</h5>
                  <div class="GrabBtn3 pt-2">
                    <label for="location_id_{{$location->id}}" class="btn m-0 onOrder onOrder2 position-relative <?php if($setLocation == $location->id){ echo 'checked'; } ?>">
                    <input type="radio" name="location_id" <?php if($setLocation == $location->id){ echo 'checked'; } ?> value="{{$location->id}}" onchange="setLocations(this,'changeLcoationForm'); return false;" id="location_id_{{$location->id}}" class="position-absolute">
                    {{$location->name}}
                    </label>
                    
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </form>
        </div>
      </div>
    </section>
    <!--**********|| Enjoy Prime Section ||**********-->
    <!--**********|| Enjoy Prime Section ||**********-->
    <section class="w-100 clearfix fbEnjoyPrime py-5 my-xl-5" id="fbEnjoyPrime">
      <div class="container">
        <div class="HeadingText HeadingText2 text-center mb-4">
        <h3 class="mb-3">CHECK OUR PLACES</h3>
        </div>
        <div class="PrimePlaces w-100 clearfix">
          <div class="row">
            @foreach($places as $k => $place)
              @if($k < 4)
                @php
                  $images = get_place_image_explode($place->file_ids);
                  $icon_image = asset($place->IconId->file);
                  $image = asset($place->file_id);
				  $loc_image = asset($place->Location->FileId->file);
                @endphp
                <div class="col-lg-3 col-md-4 col-sm-6 p-lg-4 py-3">
                  <div class="fbBestPlacer w-100 clearfix">
                    <div class="PrimePlacesImg PrimePlacesOwlImg w-100 owl-carousel owl-theme">
                      @foreach($images as $img)
                        <a href="{{url('information_details/'.$place->slug)}}">
                        <img src="{{$img}}" data-original="{{$img}}" class="img-fluid lazy" alt="No Image">
                          
                        </a>
                      @endforeach
                    </div>
                    <div class="PrimePlacesDetails w-100 text-center">
                      <a href="{{url('information_details/'.$place->slug)}}">
                      <div class="PlaceIcon p-2">
                      <img src="{{$loc_image}}" data-original="{{$loc_image}}" class="img-fluid lazy" alt="No Image" height="20" style="max-height:30px">
                       
                      </div>
                      <h6 class="mb-2 pt-2 one-line-text">{{$place->name}}</h6>
                      <p class="mb-0 two-line-text text-white">{{$place->sub_description}}</p>
                      <p class="mb-0 mt-2 text-white" style="font-weight: 600;">{{$place->address}}</p>
                    </a>
                    <p class="mb-0 text-white contactInfo"><a href="tel:{{$place->phone_1}}"  style="font-weight: 500;">{{$place->phone_1}}</a><?php if($place->phone_2 > 0)echo '<span> | </span><a href="tel:'.$place->phone_2.'" style="font-weight: 500;">'.$place->phone_2.'</a>' ?></p>
                      <a href="{{url('product/'.$place->slug.'/drinks')}}" class="text-capitalize d-inline-block nav-link btn m-0 onOrder onOrder2 px-3 mt-3">See Menu</a>
                    </div>
                  </div>
                </div>
              @endif
            @endforeach
			@if(session('location'))
            <div class="clGetYoursNow w-100 pt-5 text-center">
              <a href="{{route('information')}}" class="btn onOrder onOrder2 btn-lg py-3 px-5">See More</a>
            </div>
			@endif
          </div>
        </div>
      </div>
      <img src="{{ asset('front-assets/images/banner2.png') }}" class="img-fluid BannerImg1 d-none d-md-block">
    </section>
    <!--**********|| Enjoy Prime Section ||**********-->
    <!--**********|| see What Offer Section ||**********-->
    <section class="w-100 clearfix SeeWhatOther py-5 position-relative d-none" id="SeeWhatOther">
      <div class="HeadingText HeadingText2 text-center mb-3">
        <h3 class="mb-3">Finch Brew Cafe Is On Social Media</h3>
          <p class="mb-0 pb-3">@FINCHBREWCAFE</p>
        </div>
      <div class="fbOtherShare w-100 clearfix">
        <div class=" fbShareLists" id="fbShareListsOwl1">
            <?php $count = 0; ?>
            @foreach($instaPosts as $instafeeds)
            <?php if($count == 9) break; ?>
              <a href="{{url($instafeeds->permalink)}}" class="" target="_blank">
                <img src="{{ $instafeeds->media_url }}" class="img-fluid lazy" alt="No Image">
             </a> 
             <?php $count++; ?>
            @endforeach
            </div>
        <div class="clGetYoursNow w-100 pt-5 text-center">
          <a href="{{route('instagram_feeds')}}" class="btn onOrder onOrder2 btn-lg py-3 px-5">See More</a>
        </div>
      </div>
     
      <img src="{{ asset('front-assets/images/banner1.png') }}" class="iimg-fluid BannerImg1 BannerImg2 d-none d-md-block">
    </section>
    <!--**********|| see What Other Section ||**********-->
    <!--**********|| Grab Special Section ||**********-->
    <section class="w-100 clearfix fbGrabSpecial mb-5 pb-5" id="fbGrabSpecial">
      <div class="container-fluid">
        <div class="HeadingText HeadingText2 text-center mb-3">
          <h3 class="mb-3">GRAB SOMETHING SPECIAL</h3>
          <p class="mb-0 pb-3">MAKE THE MOST OUT OF YOUR VISIT TO FINCH WITH SOME AMAZING OFFERS</p>
        </div>
        <div class="fbGrabData w-100 clearfix p-sm-4">
          <div class="fbGrabLists" id="fbGrabListsOwl">
            <div class="grid_content mt-4 ResourcesBoxes d-flex">
            @if($offers)
              @foreach($offers as $offer)
                @php
                  $off_img = asset($offer->FileId->file);
                @endphp
                <a href="javascript:void(0);" class="d-block">
                <img src="{{$off_img}}" data-original="{{$off_img}}" class="img-fluid lazy" alt="No Image">
                </a>
              @endforeach
            @endif
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--**********|| Grab Special Section ||**********-->
    <!--**********|| Finch Products Section ||**********-->
    @if($products)
      @foreach($products as $product)
        @php
          $pimage = asset($product->FileId->file);
        @endphp
        <section class="w-100 clearfix fbMainProducts bg-{{strtolower($product->color)}}">
          <div class="fbOverlayImage fbImg1 w-100 py-5" style="background-image:url({{ asset('front-assets/images/products/banner1.png') }})">
            <div class="OverLyImg w-100 text-center">
              <img src="{{ asset('front-assets/images/products/layer1-1.png') }}" class="OverlayImage1 img-fluid">
            </div>
            <div class="container">
              <div class="fbWitWizard d-table w-100">
                <div class="d-table-cell align-middle">
                  <div class="HeadingText HeadingText2 text-center mb-5">
                    <h3 class="mb-3">{{$product->title}}</h3>
                    <p class="mb-0 pb-3">{{$product->sub_title}}</p>
                  </div>
                  <div class="fbWidthSet clearfix">
                    <div class="clearfix fbWizards text-white d-lg-flex">
                      <div class="fbMiddleData order-lg-2">
                      <img src="{{$pimage}}" data-original="{{$pimage}}" class="img-fluid lazy" alt="No Image">
                       
                      </div>
                      <div class="fbRightData order-lg-1">
                        <div class="d-table h-100 w-100">
                          <ul class="list-unstyled GlassList d-table-cell align-middle">
                            @if(!empty($product->quantity))
                            <li class="my-3">
                              <p class="m-0 fbicon1"><img src="{{ asset('front-assets/images/icons/1.svg') }}" class="img-fluid"></p>
                              <p class="m-0">{{$product->quantity}}</p>
                            </li>
                            @endif
                            @if(!empty($product->percentage))
                            <li class="my-3">
                              <p class="m-0 fbicon1"><img src="{{ asset('front-assets/images/icons/2.svg') }}" class="img-fluid"></p>
                              <p class="m-0">{{$product->percentage}}</p>
                            </li>
                            @endif
                            @if(!empty($product->color))
                            <li class="my-3">
                              <p class="m-0 fbicon1"><img src="{{ asset('front-assets/images/icons/3.svg') }}" class="img-fluid"></p>
                              <p class="m-0">{{ucfirst($product->color)}}</p>
                            </li>
                            @endif
                          </ul>
                        </div>
                      </div>
                      <div class="fbLeftData order-3">
                        <div class="row mb-4">
                          @if(!empty($product->malt))
                          <div class="col-md-6">
                            <div class="fbbrDetails w-100">
                              <h6>Hops</h6>
                              <p class="mb-0 text-uppercase">{{get_malt_explode($product->malt)}}</p>
                            </div>
                          </div>
                          @endif
                          @if(!empty($product->hops))
                          <div class="col-md-6">
                            <div class="fbbrDetails w-100">
                              <h6>Malts</h6>
                              <p class="mb-0 text-uppercase">{{get_hop_explode($product->hops)}}</p>
                            </div>
                          </div>
                          @endif
                        </div>
                        @if(!empty($product->orignal_gravity))
                        <div class="fbbrDetails fbbrDetails2 w-100 mb-5">
                          <h6>Original Gravity</h6>
                          <p class="mb-0">{{$product->orignal_gravity}}</p>
                        </div>
                        @endif
                        <div class="fbbrDetails w-100">
                          @if(!empty($product->title))
                          <h6>Style: {{$product->title}}</h6>
                          @endif
                          @if(!empty($product->description))
                          <p class="">{!!nl2br($product->description)!!}</p>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="OrderNowbtn text-center pt-lg-5  pt-4">
                    <a href="javascript:void(0);" class="btn OdrBtn" onclick="viewProduct(this,`{{$product->id}}`); return false;">
                    Order Now
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      @endforeach
    @endif
  
    <!--**********|| Indulge Food Section ||**********-->
    <!--**********|| Footer Section ||**********-->
    <footer class="w-100 clearfix fbBeerFooter" id="fbBeerFooter" style="background-image: url({{ asset('front-assets/images/banner4.png') }});">
      <div class="container">
        <div class="HeadingText HeadingText2 text-center mb-3">
          <h3 class="mb-3">BEER PASSPORT</h3>
          <p class="mb-0 pb-3">GET UNLIMITED BENEFITS AND SAVINGS.</p>
        </div>
        <div class="fbBeerPassport w-100">
          <div class="row">
            <div class="col-md-8">
              <div class="row">
                <div class="col-6 d-none d-md-flex" style="opacity: 0;visibility: hidden;">
                  <div class="fbFtrLinks w-100">
				  <p style="color:#fff;font-size:12px;font-weight:bold;"> <?php echo nl2br($passport['top-heading']['description'])?></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="fbFtrLinks w-100">
				  <p style="color:#fff;font-size:12px;font-weight:bold;"><?php echo nl2br($passport['top-heading']['description'])?></p>
                 
                  </div>
                  <div class="clGetYoursNow w-100 pt-5 text-center">
                    <p class="btn m-0 onOrder onOrder2" onclick="showPassportPage(this); return false;">Get Your's Passport</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="fbFtrImage w-100">
              <img src="{{ asset('front-assets/images/passport.jpg') }}" data-original="{{ asset('front-assets/images/passport.jpeg') }}" class="img-fluid lazy" alt="No Image">
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <input type="hidden" id="minimumAmount" value="{{ @$Passport_Minimum_Amount }}">
      <input type="hidden" id="remainAmount" value="{{ @$remain_amount }}">
      <input type="hidden" id="is_model_open" value="<?php if($is_model_open){ echo $is_model_open; }else{ echo 0; } ?>">


    </footer>
    <div class="footer_class">
   <p class="pl-5 pt-5">Owned by :- Plutusone Hospitality Pvt. Ltd.</p>
    </div>
    <div class="OrderModalInside">
    <!-- The Modal -->
    <div class="modal OrderShowModal Coupon" id="OrdrTypeModel">
      <div class="modal-dialog h-100">
        <div class="d-table h-100 w-100">
          <div class="d-table-cell align-middle w-100">
            <div class="modal-content">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<style>
  .fbEnjoyPrimeLocation .PlaceIcon img {
    max-height: 40px;
    min-height: 40px;
}
.OrderModalInside .OrderShowModal .modal-content {
      width: 700px;
  }
  .GrabBtn3 label.onOrder input[type=radio] {
    width: 100%;
    height: 100%;
    top: 0;
    right: 0;
    z-index: 1111;
    cursor: pointer;
    opacity: 0;
}
.GrabBtn3 label.checked.onOrder{
    border-color: var(--white) !important;
    background-color: var(--white) !important;
    color: var(--black) !important;
}
</style>
@endsection
@section('page-js-script')
<script>

setTimeout(function() {

  rememberAmount();

}, 10000);


  $(document).ready(function(){
    var orderType  = "<?php echo session('orderType'); ?>";
    if(orderType == ""){
    showOrderTypeHomePage(this);
    }
      var getLoc = $('#getLoc').val();
      if(getLoc == '' && $('#location_modal').val() != 1){
       // changeLocations();
      }
      
    });
  function viewProduct(e,id){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({  
      url :"{{route('productView')}}",  
      method:"POST",  
      dataType:"json",  
      data:{id:id},
      success: function(data){ 
        if(data.success==1){
          $('#infoModal .modal-content').html(data.view);    
          $('#infoModal').modal('show');    
        }
      },
      error: function(data){ 
        if(typeof data.responseJSON.status !== 'undefined'){
          toastr.error(data.responseJSON.error,'Error');
        }else{
          $.each(data.responseJSON.errors, function( key, value ) {
              toastr.error(value,'Error');
          });
        }
        $(e).find('.st_loader').hide();
      } 
    }); 
	}


  function rememberAmount(){

      var Passport_Remain_Amount = $('#remainAmount').val();
      var Passport_Minimum_Amount = $('#minimumAmount').val();
      var is_model_open = $('#is_model_open').val();
      $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
      $.ajax({
        url: "{{route('remenberAmount')}}",
        method: "POST",
        dataType: "json",
        success: function(data) {
          if (data.success == 0) {
            toastr.error
          } else if (data.success == 1) {

            if(Passport_Remain_Amount>0){ 
                    
              if(parseInt(Passport_Remain_Amount) < parseInt(Passport_Minimum_Amount) ){
                if(is_model_open == 0){

                  $('#modal-dshbored .modal-content').html(data.view);
                  $('#modal-dshbored').modal({
                      backdrop: 'static'
                    });

                }
              }
            }

          }
        }
    });
  } 

	
</script> 
@endsection
