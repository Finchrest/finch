@extends('layouts.app')

@section('content')
   <!--**********|| Value Proposition Section ||**********-->
    <section class="w-100 clearfix ValuePropositionDetails ValueProposition" id="ValuePropositionDetails">
      <div class="BgBannerImage1 position-absolute w-100"> 
        <img src="{{ asset('front-assets/images/banner8.png') }}" class="img-fluid BannerImg1 BannerImg3">
        <img src="{{ asset('front-assets/images/banner2.png') }}" class="img-fluid BannerImg1 BannerImg4">
      </div>
      <div class="container">
        <div class="fbFinchInfoDetails">
          <div class="HeadingText HeadingText2 text-center mb-4">
            <h3 class="mb-3">{{$place->name}}</h3>
            <p class="mb-0 text-capitalize">{{$place->sub_description}}</p>
          </div>
          <div class="w-100 FinchMegaCafe pb-5 mb-xl-5">
            <div class="w-100 MegaParties text-center">
              <div class="d-block text-white">
                <div class="fbUpperHeading w-100">
                  <p class="m-0">Craft Beer, Global Cuisine and Mixology</p>
                  <p class="m-0">{{$place->address}}</p>
                  <p class="mb-0 contactInfo">
                    <a href="tel:{{$place->phone_1}}"  style="font-weight: 500;">{{$place->phone_1}}</a>
                    <?php if($place->phone_2 > 0)echo '<span> | </span><a href="tel:'.$place->phone_2.'" style="font-weight: 500;">'.$place->phone_2.'</a>' ?>
                  </p>
                </div>
                <div class="fbMegaImage w-100 mt-5 mb-4">
                  <img src="{{$placeImage}}" class="img-fluid" alt="NO Image">
                </div>
                 <a href="{{url('product/'.$place->id)}}" class="text-capitalize d-inline-block nav-link btn m-0 onOrder onOrder2 px-3 mt-3">See Menu</a>
              </div>
            </div>
          </div>
          <div class="FinchMegaInfo w-100">
            <div class="FbFinchBrefCafe w-100">
              <div class="HeadingText HeadingText2">
                <h3 class="">Description</h3>
                <p>{{$place->description}}</p>
              </div>
            </div>
            <div class="FbFinchBrefCafe w-100">
              <div class="HeadingText HeadingText2">
                <h3 class="">Galleries</h3>
                @if($place_images)
                <div class="fbPlatesFood ms-gallery-group">
                  <div class="fbFoodLists gallery" id="">
                  @foreach($place_images as $place_image)
                  <a href="{{$place_image}}" class="big">
                      <img src="{{$place_image}}" alt="" title="{{$place->name}} Images" class="img-fluid">
                    </a>
                  @endforeach
                </div>
                </div>
                @endif
              </div>
            </div>
            <div class="AreYouReady w-100 text-center bdr_btm_1">
              <div class="HeadingText HeadingText2">
                <h3 class="mb-3 text-white">Are  You Ready to Bring <span>Finch Mega</span></h3>
                <!-- <p class="text-capitalize">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p> -->
              </div>
              <div class="GrabBtn1 pt-4">
                <a href="{{route('contact')}}" class="btn m-0 onOrder onOrder2">Request Free info</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- <script src="{{ asset('front-assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/miniset.js') }}"></script>
    <script >
        $( document ).ready(function() {
            $('#ms-gallery').showGallery({
                'imgCounter': true,
                'width': 165,
                'height': 95
            });
        });
    </script> -->
	
	
<!--**********|| see What Offer Section ||**********-->
<section class="w-100 clearfix SeeWhatOther py-5 position-relative" id="SeeWhatOther" style="padding: 0px 0px 50px !important;">
      <div class="HeadingText HeadingText2 text-center mb-3">
        <h3 class="mb-3">Finch Brew Cafe Is On Social Media</h3>
          <p class="mb-0 pb-3">@FINCHBREWCAFE</p>
        </div>
      <div class="fbOtherShare w-100 clearfix">
        <div class=" fbShareLists" id="fbShareListsOwl1">
            <a href="{{route('instagram_feeds')}}" class="">
              <img src="{{ asset('front-assets/images/insta/insta_posts/1.jpg') }}" class="img-fluid lazy" alt="No Image">
            </a> 
            <a href="{{route('instagram_feeds')}}" class="">
              <img src="{{ asset('front-assets/images/insta/insta_posts/2.jpg') }}" class="img-fluid lazy" alt="No Image">
            </a>
            <a href="{{route('instagram_feeds')}}" class="">
              <img src="{{ asset('front-assets/images/insta/insta_posts/3.jpg') }}" class="img-fluid lazy" alt="No Image">
            </a> 
            <a href="{{route('instagram_feeds')}}" class="">
              <img src="{{ asset('front-assets/images/insta/insta_posts/4.jpg') }}" class="img-fluid lazy" alt="No Image">
            </a> 
            <a href="{{route('instagram_feeds')}}" class="">
              <img src="{{ asset('front-assets/images/insta/insta_posts/5.jpg') }}" class="img-fluid lazy" alt="No Image">
            </a> 
            <a href="{{route('instagram_feeds')}}" class="">
              <img src="{{ asset('front-assets/images/insta/insta_posts/6.jpg') }}" class="img-fluid lazy" alt="No Image">
            </a> 
            <a href="{{route('instagram_feeds')}}" class="">
              <img src="{{ asset('front-assets/images/insta/insta_posts/7.jpg') }}" class="img-fluid lazy" alt="No Image">
            </a> 
            <a href="{{route('instagram_feeds')}}" class="">
              <img src="{{ asset('front-assets/images/insta/insta_posts/8.jpg') }}" class="img-fluid lazy" alt="No Image">
            </a> 
            <a href="{{route('instagram_feeds')}}" class="">
              <img src="{{ asset('front-assets/images/insta/insta_posts/9.jpg') }}" class="img-fluid lazy" alt="No Image">
            </a> 
            </div>
      </div>
    </section>
@endsection
