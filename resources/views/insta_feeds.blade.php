@extends('layouts.app')
@section('content')
<!--**********|| Value Proposition Section ||**********-->
<section class="w-100 clearfix instaFeedPage ValueProposition" id="instaFeedPage">
  <div class="BgBannerImage1 position-absolute w-100"> 
    <img src="{{ asset('front-assets/images/banner8.png') }}" class="img-fluid BannerImg1 BannerImg3">
    <img src="{{ asset('front-assets/images/banner2.png') }}" class="img-fluid BannerImg1 BannerImg4">
  </div>
  <div class="container-fluid">
    <div class="fbFinchInfoDetails fbFinchInstaFeedDetails">
      <div class="HeadingText HeadingText2 text-center mb-4">
        <h3 class="mb-3">GALLERY</h3>
        <p class="mb-0 text-capitalize">CHECK THE AMAZING EXPERIENCES OUR CLIENTS HAD WITH US</p>
      </div>
      <div class="fbPlatesFood w-100 clearfix p-md-4">
        <div class="owl-carousel owl-theme fbFoodLists" id="instaFeedsOwl">
                @foreach($instaPosts as $instafeeds)
                <div class="instaFeedDetails w-100">
                  <a href="{{url($instafeeds->permalink)}}" class="d-block position-relative p-3" target="_blank">
                    <div class="fbTasteBest w-100 position-relative">
                      <img src="{{ $instafeeds->media_url }}" data-original="" class="img-fluid lazy" alt="No Image">
                    </div>
                    <!-- <div class=" MobileOrderMenu text-center pt-4">
                      <p class="">MUMBAI</p>
                      <p class="three-line-text mb-0">Insta Story Of Finch Brew Cafes</p>
                    </div> -->
                  </a>
                 
                </div>
                @endforeach

        </div>
      </div>
    </div>
  </div>
</section>
<!--**********|| Value Proposition Section ||**********-->
@endsection