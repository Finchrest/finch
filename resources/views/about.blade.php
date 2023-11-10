@extends('layouts.app')

@section('content')

<!--**********|| Value Proposition Section ||**********-->
<section class="w-100 clearfix AboutUs ValueProposition" id="AboutUs">
  <div class="BgBannerImage1 position-absolute w-100">
    <img src="{{ asset('front-assets/images/banner8.png') }}" class="img-fluid BannerImg1 BannerImg3">
    {{-- <img src="{{ asset('front-assets/images/banner2.png') }}" class="img-fluid BannerImg1 BannerImg4"> --}}
  </div>
  <div class="container-fluid">
    <div class="fbFinchInfoDetails">
      <div class="HeadingText HeadingText2 text-center mb-4">
        <h3 class="mb-3">About Us</h3>
      </div>
      <div class="FinchMegaInfo w-100">
        <div class="FbFinchBrefCafe w-100">
          <div class="HeadingText HeadingText2">
            <h3 class="">The Finch BrewCafé</h3>
            <p>The Finch Brew Cafe is a distinctive destination for the best international cuisine and best crafted brews. We celebrate extraordinary ﬂavours of our local and imported fresh ingredients in our kitchen to be served in a vibrant and contemporary setting. We serve a wide variety of freshly prepared deliciously food and brews .</p>
          </div>
          <div class="HeadingText HeadingText2">
            <h3 class="">About Us</h3>
            <p>The Finch BrewCafe uses top-quality ingredients in our food and beverages, as well as a variety of freshly prepared nutritious items. Our experts strive to provide one-on-one services and create a welcoming environment for customers to enjoy their socializing experiences.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="w-100 clearfix FinchMegaCafe bdr_btm_1">
      <div class="row">
        <?php
        for ($i = 1; $i < 6; $i++) { ?>
          @if($i == 1)
          <div class="col-lg-4 col-sm-9 fbColSet d-none">
            <div class="w-100 MegaParties text-center">
              <a href="{{url('information_details/pawai')}}" class="d-block text-white">
                <div class="fbUpperHeading w-100">
                  <h5>FINCH - MUMBAI</h5>
                  <p class="m-0">Central Avenue, Hiranandani Gardens, Powai, Mumbai, Maharashtra 400076</p>
                  <p>Contact No: 022 4979 3739 / 917304928954</p>
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
          <div class="col-lg-4 col-sm-9 fbColSet d-none">
            <div class="w-100 MegaParties text-center">
              <a href="{{url('information_details/pawai')}}" class="d-block text-white">
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
                    <li>Global Cuisine</li>
                    <li>Quick catchup place</li>
                    <li>Craft Beer & Curated drinks</li>
                  </ul>
                </div>
              </a>
            </div>
          </div>
          @elseif($i == 4)
          <div class="col-lg-4 col-sm-9 fbColSet">
            <div class="w-100 MegaParties text-center">
              <a href="{{url('information_details/finch-brewcafe')}}" class="d-block text-white">
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
                    <li>Live Music</li>
                  </ul>
                </div>
              </a>
            </div>
          </div>
          @elseif($i == 5)
          <div class="col-lg-4 col-sm-9 fbColSet">
            <div class="w-100 MegaParties text-center">
              <a href="{{url('information_details/finch-brewcafe-jalandhar')}}" class="d-block text-white">
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
                    <li>Live Music</li>
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
<section class="w-100 clearfix SeeWhatOther py-5 position-relative d-none" id="SeeWhatOther" style="padding: 0px 0px 50px !important;">
  <div class="HeadingText HeadingText2 text-center mb-3">
    <h3 class="mb-3">Finch Brew Cafe Is On Social Media</h3>
    <p class="mb-0 pb-3">@FINCHBREWCAFE</p>
  </div>
  <div class="fbOtherShare w-100 clearfix">
    <div class=" fbShareLists" id="fbShareListsOwl1">
      <?php $count = 0; ?>
      @foreach($instaPosts as $instafeeds)
      <?php if ($count == 9) break; ?>
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
 
</section>
<footer>
  <div class="footer_class">
    <p class="pl-5 pt-5">Owned by :- Plutusone Hospitality Pvt. Ltd.</p>
     </div>
</footer>

<!--**********|| see What Other Section ||**********-->
<style type="text/css">
  @media(min-width: 992px) {
    .MegaParties .fbUpperHeading p {
      min-height: 50px;
    }
  }
</style>
@endsection