@extends('layouts.app')

@section('content')
<!--**********|| Value Proposition Section ||**********-->
<section class="w-100 clearfix AboutUs ValueProposition" id="AboutUs">
  <div class="BgBannerImage1 position-absolute w-100"> 
    <img src="{{ asset('front-assets/images/banner8.png') }}" class="img-fluid BannerImg1 BannerImg3">
    <img src="{{ asset('front-assets/images/banner2.png') }}" class="img-fluid BannerImg1 BannerImg4">
  </div>
  <div class="container-fluid">
    <div class="fbFinchInfoDetails">
      <div class="HeadingText HeadingText2 text-center mb-4">
        <h3 class="mb-3">Our Services</h3>
      </div>
      <div class="FinchMegaInfo w-100">
        <div class="FbFinchBrefCafe w-100">
          
          <div class="HeadingText HeadingText2">
            <h3 class="">Our Service</h3>
            <p class="text-capitalize">In your daily busy life, The Finch Brew Cafe is the Most Relaxing Place for formal and informal meeting and socializing. Our warm welcoming staﬀ are always happy to serve you.</p>
          </div>
          <div class="HeadingText HeadingText2">
            <h3 class="">Good Food</h3>
            <p class="text-capitalize">We may not be able to travel to every country on Earth, but The Finch Brew Café is the great a place to get a taste of a different culture is to sample its signature dishes.</p>
          </div>
          <div class="HeadingText HeadingText2">
            <div class="row pb-4" style="justify-content: space-between;align-items: center;">
              <div class="col-lg-8 col-md-7 p-3">
            <h3 class="">Our Food</h3>
            <ul style="padding:0px !important;">
              <li>Bacon Mushroom & Ricotta Omelette</li>
              <li>Balinese Curry Bowl </li>
              <li>Butter Chicken Coins</li>
              <li>Beetroot Halwa Canoli With Rabri Foam </li>
              <li>And Many More Global Cuisine</li>  
            </ul>
          </div>
            <div class="ImgFOods col-lg-4 col-md-5 p-3 text-md-right text-center">
              <img src="{{ asset('front-assets/images/services/f1.jpg') }}" class="img-fluid" alt="No Image" style="max-height: 300px;">
            </div>
            </div>
          </div>
          <div class="HeadingText HeadingText2">
            <div class="row pb-4" style="justify-content: space-between;align-items: center;">
              <div class="col-lg-8 col-md-7 p-3">
            <h3 class="">Our CRAFT Beers</h3>
            <p class="text-capitalize">If you’re looking for a place with world cuisine and a Freshly Brewed Beer Destination, your search ends here! , We serve 6 craft beers form all over the word </p>
            <p>Namely -</p>
            <ul style="padding:0px !important;">
              <li>Wizard of Wit – Belgian Wit, variety of from Belgium</li>
              <li>Bombay Dock – Indian Pale Ale, From Britain</li>
              <li>Barbara Weissand – Hefeweizen, Germany </li>
              <li>Cloud Black – Oat Meal Stout, from Germany </li>
              <li>Pip ‘N’ Peel – Apple Cider, Our Indian Way</li>
              <li>kolsch – Lager, universal truth</li>  
            </ul>
          </div>
            <div class="ImgFOods col-lg-4 col-md-5 p-3 text-md-right text-center">
              <img src="{{ asset('front-assets/images/services/b1.jpg') }}" class="img-fluid" alt="No Image" style="max-height: 300px;">
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="w-100 clearfix FinchMegaCafe bdr_btm_1">
        <div class="row">
            <?php
            for($i = 1; $i < 6; $i++){ ?>
            @if($i == 1)
            <div class="col-lg-4 col-sm-9 fbColSet d-none">
              <div class="w-100 MegaParties text-center">
                <a href="{{url('information_details/7')}}" class="d-block text-white">
                  <div class="fbUpperHeading w-100">
                    <h5>FINCH - MUMBAI</h5>
                    <p>Craft Beer, Global Cuisine and Mixology</p>
                  </div>
                  <div class="fbMegaImage w-100">
                    <img src="{{ asset('front-assets/images/about_us/img2.png') }}" class="img-fluid" alt="NO Image">
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
            @elseif($i == 2)
            <div class="col-lg-4 col-sm-9 fbColSet d-none">
              <div class="w-100 MegaParties text-center">
                <a href="javascript:void(0);" class="d-block text-white">
                  <div class="fbUpperHeading w-100">
                    <h5>FINCH - CHANDIGARH</h5>
                      <p>Craft Beer, Global Cuisine and Mixology</p>
                  </div>
                  <div class="fbMegaImage w-100">
                    <img src="{{ asset('front-assets/images/about_us/chandigarh.jpg') }}" class="img-fluid" alt="NO Image">
                  </div>
                  <div class="fbMegaTexts w-100 py-3">
                    <ul class="list-unstyled megaTextLists m-0">
                      <li>Social gathering</li>
                      <li>Suitable for Corporate events</li>
                      <li>Business Meetings</li>
                      <li>Craft beer and curated drinks along</li>
                      <li>with complementing cuisine</li> 
                    </ul>
                  </div>
                </a>
              </div>
            </div>
            @elseif($i == 3)
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
                    <ul class="list-unstyled megaTextLists m-0">
                      <li>Socialising Place</li>
                      <li>Attractive Price Points</li>
                      <li>Quick catchup place</li>
                      <li>Global Cuisine</li>
                      <li>Craft Beer & Curated drinks</li>
                    </ul>
                  </div>
                </a>
              </div>
            </div>
            @elseif($i == 4)
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
                    <ul class="list-unstyled megaTextLists m-0">
                      <li>Socialising Place</li>
                      <li>Attractive Price Points</li>
                      <li>Quick catchup place</li>
                      <li>Global Cuisine</li>
                      <li>Beer & Curated drinks</li>
                    </ul>
                  </div>
                </a>
              </div>
            </div>
            @elseif($i == 5)
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
                    <ul class="list-unstyled megaTextLists m-0">
                      <li>Socialising Place</li>
                      <li>Attractive Price Points</li>
                      <li>Quick catchup place</li>
                      <li>Global Cuisine</li>
                      <li>Beer & Curated drinks</li>
                    </ul>
                  </div>
                </a>
              </div>
            </div>
            @endif
            <?php } ?>
          </div>
        </div>
  </div>
</section>
<!--**********|| Value Proposition Section ||**********-->

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
<!--**********|| see What Other Section ||**********-->
<style type="text/css">
  @media(min-width: 1500px){
  .ValueProposition .container {
    max-width: 1300px;
}
}
</style>
@endsection
