@extends('layouts.app')

@section('content')
 <!--**********|| Value Proposition Section ||**********-->
  <?php if($getLocation == 2){ ?>
 <section class="pageBanner d-none d-lg-table w-100 clearfix bgMumbai">
  <div class="pageOverlay w-100">
   <div class="container">
     <!-- <div class="HeadingText HeadingText2 text-center">
          <h3 class="mb-2">Our Value Proposition</h3>
          <p class="mb-0 text-capitalize">List of Our Value Proposition</p>
        </div> -->
   </div>
   </div>
 </section>
 <?php } ?>
 <?php if($getLocation == 7){ ?>
 <section class="pageBanner d-none d-lg-table w-100 clearfix bgJalndhar">
  <div class="pageOverlay w-100">
   <div class="container">
     <!-- <div class="HeadingText HeadingText2 text-center">
          <h3 class="mb-2">Our Value Proposition</h3>
          <p class="mb-0 text-capitalize">List of Our Value Proposition</p>
        </div> -->
   </div>
   </div>
 </section>
 <?php } ?>
 <?php if($getLocation == 8){ ?>
 <section class="pageBanner d-none d-lg-table w-100 clearfix bgAmrit">
  <div class="pageOverlay w-100">
   <div class="container">
     <!-- <div class="HeadingText HeadingText2 text-center">
          <h3 class="mb-2">Our Value Proposition</h3>
          <p class="mb-0 text-capitalize">List of Our Value Proposition</p>
        </div> -->
   </div>
   </div>
 </section>
 <?php } ?>
    <section class="w-100 clearfix ValueProposition finchInfoPage" id="ValueProposition" style="padding-bottom:0px !important;">
      <div class="BgBannerImage1 position-absolute w-100"> 
        <img src="{{ asset('front-assets/images/banner8.png') }}" class="img-fluid BannerImg1 BannerImg3">
        <img src="{{ asset('front-assets/images/banner7.png') }}" class="img-fluid BannerImg1 BannerImg4">
      </div>
      <div class="container-fluid">
        <div class="HeadingText HeadingText2 text-center mb-4 d-block d-lg-none">
          <h3 class="mb-3">Our Value Proposition</h3>
          <p class="mb-0 text-capitalize">List of Our Value Proposition</p>
        </div>
        <div class="w-100 clearfix FinchMegaCafe bdr_btm_1">
		<?php if($getLocation !=''){ ?>
		 <div class="row">
		 <?php if($getLocation == 2){ ?>
      <div class="col-lg-4 col-sm-9 fbColSet">
              <div class="w-100 MegaParties text-center">
                <a href="{{url('information_details/7')}}" class="d-block text-white">
                  <div class="fbUpperHeading w-100">
                    <h5>FINCH BREW CAFE - MUMBAI</h5>
                    <p class="m-0">Central Avenue, Hiranandani Gardens, Powai, Mumbai, Maharashtra 400076</p>
                    <p>Contact No: 022 4979 3739 / 917304928954</p>
                  </div>
                  <div class="fbMegaImage w-100">
                    <img src="{{ asset('front-assets/images/about_us/brew.jpg') }}" class="img-fluid" alt="NO Image">
                  </div>
                  <div class="fbMegaTexts w-100 py-3">
                    <ul class="list-unstyled megaTextLists m-0 text-capitalize">
                      <li>Socialising Place</li>
                      <li>Attractive Price Points</li>
                      <li>Quick catchup place</li>
                      <li>Global Cuisine</li>
                      <li>Craft Beer & Curated drinks</li>
                    </ul>
                  </div>
				  
                </a>
				<a href="{{url('product/7')}}" class="text-capitalize d-inline-block nav-link btn m-0 onOrder onOrder2 px-3 mt-3">See Menu</a>
              </div>
            </div>
		 <?php } ?>
     <?php if($getLocation == 7){ ?>
      <div class="col-lg-4 col-sm-9 fbColSet">
              <div class="w-100 MegaParties text-center">
                <a href="{{url('information_details/10')}}" class="d-block text-white">
                  <div class="fbUpperHeading w-100">
                    <h5>FINCH BREW CAFE - JALANDHAR</h5>
                     <p class="m-0">Plot No. 199- A , Ground Floor, Model Town, Jalandhar, Punjab 144003</p>
                    <p>Contact No: 074280 81017</p>
                  </div>
                  <div class="fbMegaImage w-100">
                    <img src="{{ asset('front-assets/images/about_us/jalandhar.jpg') }}" class="img-fluid" alt="NO Image">
                  </div>
                  <div class="fbMegaTexts w-100 py-3">
                    <ul class="list-unstyled megaTextLists m-0 text-capitalize">
                      <li>Socialising Place</li>
                      <li>Attractive Price Points</li>
                      <li>Quick catchup place</li>
                      <li>Global Cuisine</li>
                      <li>Beer & Curated drinks</li>
                    </ul>
                  </div>
				 
                </a>
				 <a href="{{url('product/10')}}" class="text-capitalize d-inline-block nav-link btn m-0 onOrder onOrder2 px-3 mt-3">See Menu</a>
              </div>
            </div>
     <?php } ?>
     <?php if($getLocation == 8){ ?>
      <div class="col-lg-4 col-sm-9 fbColSet">
              <div class="w-100 MegaParties text-center">
                 <a href="{{url('information_details/9')}}" class="d-block text-white">
                  <div class="fbUpperHeading w-100">
                    <h5>FINCH BREW CAFE - AMRITSAR</h5>
                    <p class="m-0">S.C.O. No. 22, 97 Acre Scheme, Ranjit Avenue,, Amritsar, Punjab 143001</p>
                    <p>Contact No: 074280 81018</p>
                  </div>
                  <div class="fbMegaImage w-100">
                    <img src="{{ asset('front-assets/images/about_us/amritsar.jpg') }}" class="img-fluid" alt="NO Image">
                  </div>
                  <div class="fbMegaTexts w-100 py-3">
                    <ul class="list-unstyled megaTextLists m-0 text-capitalize">
                      <li>Socialising Place</li>
                      <li>Attractive Price Points</li>
                      <li>Quick catchup place</li>
                      <li>Global Cuisine</li>
                      <li>Beer & Curated drinks</li>
                    </ul>
                  </div>
                </a>
				 <a href="{{url('product/9')}}" class="text-capitalize d-inline-block nav-link btn m-0 onOrder onOrder2 px-3 mt-3">See Menu</a>
              </div>
            </div>
     <?php } ?>
		<?php }else{ ?>
          <div class="row">
            @foreach($places as $place)
              <?php
                $images = get_place_image_explode($place->file_ids);
                $icon_image = asset($place->IconId->file);
                $image = asset($place->FileId->file);
              ?>
              <div class="col-lg-4 col-sm-9 fbColSet">
                <div class="w-100 MegaParties text-center">
                  <a href="{{url('information_details/'.$place->id)}}" class="d-block text-white">
                    <div class="fbUpperHeading w-100">
                      <h5>{{$place->name}}</h5>
                      <p>Format : with micro-brewery <span>8000 sq.ft.</span></p>
                    </div>
                    <div class="fbMegaImage w-100">
                      <img src="{{$image}}" class="img-fluid" alt="NO Image">
                    </div>
                    <div class="fbMegaTexts w-100 py-3">
                      <ul class="list-unstyled megaTextLists m-0">
                        <li>Comfortable Environment</li>
                        <li>Party Place</li>
                        <li>Live Music</li>
                        <li>Classy Ambience</li>
                        <li>In-house Brewery</li>
                        <li>Exotic Food</li>
                      </ul>
                    </div>
                  </a>
                </div>
              </div>
            @endforeach
          </div>
		<?php } ?>
        </div>
      
      </div>
    </section>
    <!--**********|| see What Offer Section ||**********-->
<section class="w-100 clearfix SeeWhatOther py-5 position-relative" id="SeeWhatOther" style="padding: 70px 0px 50px !important;">
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
