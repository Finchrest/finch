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
                <div class="instaFeedDetails w-100">
                  <a href="javascript:void(0);" class="d-block position-relative p-3">
                    <div class="fbTasteBest w-100 position-relative">
                      <img src="{{ asset('front-assets/images/insta/insta_posts/1.jpg') }}" data-original="" class="img-fluid lazy" alt="No Image">
                    </div>
                    <div class=" MobileOrderMenu text-center pt-4">
                      <p class="">MUMBAI</p>
                      <p class="three-line-text mb-0">Insta Story Of Finch Brew Cafes</p>
                    </div>
                  </a>
                  <ul class="list-unstyled ShareIcons clearfix py-3 w-100">
                    <li>
                      <a href="javascript:void(0);" class="d-block text-white pr-2 mr-2">
                      <img src="{{ asset('front-assets/images/icons/like.svg') }}" class="img-fluid" alt="No Image">
                      <span>0</span>
                      </a> 
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="d-block text-white pr-2 mr-2">
                      <img src="{{ asset('front-assets/images/icons/commnent.svg') }}" class="img-fluid" alt="No Image">
                      <span>0</span>
                      </a> 
                    </li>
                    <li class="float-right">
                      <a href="javascript:void(0);" class="d-block text-white" style="font-size: 20px;">
                      <i class="fa fa-share-alt" aria-hidden="true"></i>
                      </a> 
                    </li>
                  </ul>
                </div>
                <div class="instaFeedDetails w-100">
                  <a href="javascript:void(0);" class="d-block position-relative p-3">
                    <div class="fbTasteBest w-100 position-relative">
                      <img src="{{ asset('front-assets/images/insta/insta_posts/2.jpg') }}" data-original="" class="img-fluid lazy" alt="No Image">
                    </div>
                    <div class=" MobileOrderMenu text-center pt-4">
                      <p class="">MUMBAI</p>
                      <p class="three-line-text mb-0">"Insta Story Of Finch Brew Cafes"</p>
                    </div>
                  </a>
                  <ul class="list-unstyled ShareIcons clearfix py-3 w-100">
                    <li>
                      <a href="javascript:void(0);" class="d-block text-white pr-2 mr-2">
                      <img src="{{ asset('front-assets/images/icons/like.svg') }}" class="img-fluid" alt="No Image">
                      <span>0</span>
                      </a> 
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="d-block text-white pr-2 mr-2">
                      <img src="{{ asset('front-assets/images/icons/commnent.svg') }}" class="img-fluid" alt="No Image">
                      <span>0</span>
                      </a> 
                    </li>
                    <li class="float-right">
                      <a href="javascript:void(0);" class="d-block text-white" style="font-size: 20px;">
                      <i class="fa fa-share-alt" aria-hidden="true"></i>
                      </a> 
                    </li>
                  </ul>
                </div>
                <div class="instaFeedDetails w-100">
                  <a href="javascript:void(0);" class="d-block position-relative p-3">
                    <div class="fbTasteBest w-100 position-relative">
                      <img src="{{ asset('front-assets/images/insta/insta_posts/3.jpg') }}" data-original="" class="img-fluid lazy" alt="No Image">
                    </div>
                    <div class=" MobileOrderMenu text-center pt-4">
                      <p class="">MUMBAI</p>
                      <p class="three-line-text mb-0">Insta Story Of Finch Brew Cafes</p>
                    </div>
                  </a>
                  <ul class="list-unstyled ShareIcons clearfix py-3 w-100">
                    <li>
                      <a href="javascript:void(0);" class="d-block text-white pr-2 mr-2">
                      <img src="{{ asset('front-assets/images/icons/like.svg') }}" class="img-fluid" alt="No Image">
                      <span>0</span>
                      </a> 
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="d-block text-white pr-2 mr-2">
                      <img src="{{ asset('front-assets/images/icons/commnent.svg') }}" class="img-fluid" alt="No Image">
                      <span>0</span>
                      </a> 
                    </li>
                    <li class="float-right">
                      <a href="javascript:void(0);" class="d-block text-white" style="font-size: 20px;">
                      <i class="fa fa-share-alt" aria-hidden="true"></i>
                      </a> 
                    </li>
                  </ul>
                </div>
                <div class="instaFeedDetails w-100">
                  <a href="javascript:void(0);" class="d-block position-relative p-3">
                    <div class="fbTasteBest w-100 position-relative">
                      <img src="{{ asset('front-assets/images/insta/insta_posts/4.jpg') }}" data-original="" class="img-fluid lazy" alt="No Image">
                    </div>
                    <div class=" MobileOrderMenu text-center pt-4">
                      <p class="">MUMBAI</p>
                      <p class="three-line-text mb-0">Insta Story Of Finch Brew Cafes</p>
                    </div>
                  </a>
                  <ul class="list-unstyled ShareIcons clearfix py-3 w-100">
                    <li>
                      <a href="javascript:void(0);" class="d-block text-white pr-2 mr-2">
                      <img src="{{ asset('front-assets/images/icons/like.svg') }}" class="img-fluid" alt="No Image">
                      <span>0</span>
                      </a> 
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="d-block text-white pr-2 mr-2">
                      <img src="{{ asset('front-assets/images/icons/commnent.svg') }}" class="img-fluid" alt="No Image">
                      <span>0</span>
                      </a> 
                    </li>
                    <li class="float-right">
                      <a href="javascript:void(0);" class="d-block text-white" style="font-size: 20px;">
                      <i class="fa fa-share-alt" aria-hidden="true"></i>
                      </a> 
                    </li>
                  </ul>
                </div>
                <div class="instaFeedDetails w-100">
                  <a href="javascript:void(0);" class="d-block position-relative p-3">
                    <div class="fbTasteBest w-100 position-relative">
                      <img src="{{ asset('front-assets/images/insta/insta_posts/5.jpg') }}" data-original="" class="img-fluid lazy" alt="No Image">
                    </div>
                    <div class=" MobileOrderMenu text-center pt-4">
                      <p class="">MUMBAI</p>
                      <p class="three-line-text mb-0">Insta Story Of Finch Brew Cafes</p>
                    </div>
                  </a>
                  <ul class="list-unstyled ShareIcons clearfix py-3 w-100">
                    <li>
                      <a href="javascript:void(0);" class="d-block text-white pr-2 mr-2">
                      <img src="{{ asset('front-assets/images/icons/like.svg') }}" class="img-fluid" alt="No Image">
                      <span>0</span>
                      </a> 
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="d-block text-white pr-2 mr-2">
                      <img src="{{ asset('front-assets/images/icons/commnent.svg') }}" class="img-fluid" alt="No Image">
                      <span>0</span>
                      </a> 
                    </li>
                    <li class="float-right">
                      <a href="javascript:void(0);" class="d-block text-white" style="font-size: 20px;">
                      <i class="fa fa-share-alt" aria-hidden="true"></i>
                      </a> 
                    </li>
                  </ul>
                </div>
                <div class="instaFeedDetails w-100">
                  <a href="javascript:void(0);" class="d-block position-relative p-3">
                    <div class="fbTasteBest w-100 position-relative">
                      <img src="{{ asset('front-assets/images/insta/insta_posts/6.jpg') }}" data-original="" class="img-fluid lazy" alt="No Image">
                    </div>
                    <div class=" MobileOrderMenu text-center pt-4">
                      <p class="">MUMBAI</p>
                      <p class="three-line-text mb-0">Insta Story Of Finch Brew Cafes</p>
                    </div>
                  </a>
                  <ul class="list-unstyled ShareIcons clearfix py-3 w-100">
                    <li>
                      <a href="javascript:void(0);" class="d-block text-white pr-2 mr-2">
                      <img src="{{ asset('front-assets/images/icons/like.svg') }}" class="img-fluid" alt="No Image">
                      <span>0</span>
                      </a> 
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="d-block text-white pr-2 mr-2">
                      <img src="{{ asset('front-assets/images/icons/commnent.svg') }}" class="img-fluid" alt="No Image">
                      <span>0</span>
                      </a> 
                    </li>
                    <li class="float-right">
                      <a href="javascript:void(0);" class="d-block text-white" style="font-size: 20px;">
                      <i class="fa fa-share-alt" aria-hidden="true"></i>
                      </a> 
                    </li>
                  </ul>
                </div>
                <div class="instaFeedDetails w-100">
                  <a href="javascript:void(0);" class="d-block position-relative p-3">
                    <div class="fbTasteBest w-100 position-relative">
                      <img src="{{ asset('front-assets/images/insta/insta_posts/7.jpg') }}" data-original="" class="img-fluid lazy" alt="No Image">
                    </div>
                    <div class=" MobileOrderMenu text-center pt-4">
                      <p class="">MUMBAI</p>
                      <p class="three-line-text mb-0">Insta Story Of Finch Brew Cafes</p>
                    </div>
                  </a>
                  <ul class="list-unstyled ShareIcons clearfix py-3 w-100">
                    <li>
                      <a href="javascript:void(0);" class="d-block text-white pr-2 mr-2">
                      <img src="{{ asset('front-assets/images/icons/like.svg') }}" class="img-fluid" alt="No Image">
                      <span>0</span>
                      </a> 
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="d-block text-white pr-2 mr-2">
                      <img src="{{ asset('front-assets/images/icons/commnent.svg') }}" class="img-fluid" alt="No Image">
                      <span>0</span>
                      </a> 
                    </li>
                    <li class="float-right">
                      <a href="javascript:void(0);" class="d-block text-white" style="font-size: 20px;">
                      <i class="fa fa-share-alt" aria-hidden="true"></i>
                      </a> 
                    </li>
                  </ul>
                </div>
                <div class="instaFeedDetails w-100">
                  <a href="javascript:void(0);" class="d-block position-relative p-3">
                    <div class="fbTasteBest w-100 position-relative">
                      <img src="{{ asset('front-assets/images/insta/insta_posts/8.jpg') }}" data-original="" class="img-fluid lazy" alt="No Image">
                    </div>
                    <div class=" MobileOrderMenu text-center pt-4">
                      <p class="">MUMBAI</p>
                      <p class="three-line-text mb-0">Insta Story Of Finch Brew Cafes</p>
                    </div>
                  </a>
                  <ul class="list-unstyled ShareIcons clearfix py-3 w-100">
                    <li>
                      <a href="javascript:void(0);" class="d-block text-white pr-2 mr-2">
                      <img src="{{ asset('front-assets/images/icons/like.svg') }}" class="img-fluid" alt="No Image">
                      <span>0</span>
                      </a> 
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="d-block text-white pr-2 mr-2">
                      <img src="{{ asset('front-assets/images/icons/commnent.svg') }}" class="img-fluid" alt="No Image">
                      <span>0</span>
                      </a> 
                    </li>
                    <li class="float-right">
                      <a href="javascript:void(0);" class="d-block text-white" style="font-size: 20px;">
                      <i class="fa fa-share-alt" aria-hidden="true"></i>
                      </a> 
                    </li>
                  </ul>
                </div>
                <div class="instaFeedDetails w-100">
                  <a href="javascript:void(0);" class="d-block position-relative p-3">
                    <div class="fbTasteBest w-100 position-relative">
                      <img src="{{ asset('front-assets/images/insta/insta_posts/9.jpg') }}" data-original="" class="img-fluid lazy" alt="No Image">
                    </div>
                    <div class=" MobileOrderMenu text-center pt-4">
                      <p class="">MUMBAI</p>
                      <p class="three-line-text mb-0">Insta Story Of Finch Brew Cafes</p>
                    </div>
                  </a>
                  <ul class="list-unstyled ShareIcons clearfix py-3 w-100">
                    <li>
                      <a href="javascript:void(0);" class="d-block text-white pr-2 mr-2">
                      <img src="{{ asset('front-assets/images/icons/like.svg') }}" class="img-fluid" alt="No Image">
                      <span>0</span>
                      </a> 
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="d-block text-white pr-2 mr-2">
                      <img src="{{ asset('front-assets/images/icons/commnent.svg') }}" class="img-fluid" alt="No Image">
                      <span>0</span>
                      </a> 
                    </li>
                    <li class="float-right">
                      <a href="javascript:void(0);" class="d-block text-white" style="font-size: 20px;">
                      <i class="fa fa-share-alt" aria-hidden="true"></i>
                      </a> 
                    </li>
                  </ul>
                </div>

        </div>
<!--         <div class="owl-carousel owl-theme fbFoodLists" id="instaFeedsOwl">
          @if($insta_datas)
            @foreach($insta_datas as $insta_data)
              @if($insta_data->media_type == 'IMAGE')
                <div class="instaFeedDetails w-100">
                  <a href="javascript:void(0);" class="d-block position-relative p-3">
                    <div class="fbTasteBest w-100 position-relative">
                      <img src="{{ asset('front-assets/images/lazy_loader.jpg') }}" data-original="{{ $insta_data->media_url }}" class="img-fluid lazy" alt="No Image">
                    </div>
                    <div class=" MobileOrderMenu text-center pt-4">
                      <p class="">MUMBAI</p>
                      <p class="three-line-text mb-0">Insta Story Of Finch Brew Cafes</p>
                    </div>
                  </a>
                  <ul class="list-unstyled ShareIcons clearfix py-3 w-100">
                    <li>
                      <a href="javascript:void(0);" class="d-block text-white pr-2 mr-2">
                      <img src="{{ asset('front-assets/images/icons/like.svg') }}" class="img-fluid" alt="No Image">
                      <span>{{$insta_data->like_count}}</span>
                      </a> 
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="d-block text-white pr-2 mr-2">
                      <img src="{{ asset('front-assets/images/icons/commnent.svg') }}" class="img-fluid" alt="No Image">
                      <span>{{$insta_data->comments_count}}</span>
                      </a> 
                    </li>
                    <li class="float-right">
                      <a href="javascript:void(0);" class="d-block text-white" style="font-size: 20px;">
                      <i class="fa fa-share-alt" aria-hidden="true"></i>
                      </a> 
                    </li>
                  </ul>
                </div>
              @endif
            @endforeach
          @endif
        </div> -->
      </div>
    </div>
  </div>
</section>
<!--**********|| Value Proposition Section ||**********-->
@endsection