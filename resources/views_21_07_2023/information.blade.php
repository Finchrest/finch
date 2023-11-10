@extends('layouts.app')

@section('content')
<?php
// echo "<pre>";
// print_r($getLocation);
// die;
?>
<!--**********|| Value Proposition Section ||**********-->
<section class="w-100 clearfix fbEnjoyPrime py-5 my-xl-5 bdr_btm_1" id="fbEnjoyPrime">
  <div class="container">
    <div class="HeadingText HeadingText2 text-center mb-4">
      <h3 class="mb-3">CHECK OUR PLACES</h3>
    </div>
    <div class="PrimePlaces w-100 clearfix">
      <div class="row">
        @foreach($places as $k => $place)
        @if($k < 4) @php $images=get_place_image_explode($place->file_ids);
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
                <p class="mb-0 text-white contactInfo"><a href="tel:{{$place->phone_1}}" style="font-weight: 500;">{{$place->phone_1}}</a><?php if ($place->phone_2 > 0) echo '<span> | </span><a href="tel:' . $place->phone_2 . '" style="font-weight: 500;">' . $place->phone_2 . '</a>' ?></p>
                <a href="{{url('product/'.$place->slug.'/drinks')}}" class="text-capitalize d-inline-block nav-link btn m-0 onOrder onOrder2 px-3 mt-3">See Menu</a>
              </div>
            </div>
          </div>
          @endif
          @endforeach

      </div>
    </div>
  </div>
  <img src="{{ asset('front-assets/images/banner2.png') }}" class="img-fluid BannerImg1 d-none d-md-block">
</section>
<!--**********|| see What Offer Section ||**********-->
<section class="w-100 clearfix SeeWhatOther py-5 position-relative d-none" id="SeeWhatOther" style="padding: 70px 0px 50px !important;">
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
<!--**********|| see What Other Section ||**********-->
@endsection