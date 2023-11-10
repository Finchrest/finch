@extends('layouts.app')
@section('content')
<link href="{{ asset('front-assets/css/frenchises.css') }}?<?php echo time(); ?>" rel="stylesheet">
<!--**********|| Value Proposition Section ||**********-->
<div class="container">
      <div class="BrewcafeParent">
        <section class="section1" id="firstSection">
          <div class="brewcafe_logo">
            <div class="logoImg position-relative">
              <img src="{{ asset('front-assets/images/logo.png') }}">
             
            </div>
            <div class="logobottomText">
              <p>International Cuisine | Craft Beer | Vibrant & Contemporary Ambience</p>
            </div>
          </div>
        </section>
        <section class="section2 py-4" id="secondSection">
          <div class="aboutSection">
            <div class="aboutHeading mb-5">
              <h3 class="head3">About Finch Brewcafe</h3>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="aboutSection_left">
                  <h5 class="head5" style="text-indent: 0;">Welcoming Environment for Socializing!</h5>
                  <p class="para">The Finch Brewcafe is a distinctive destination, an amalgamation of international cuisine along with crafted beers & drinks.</p>
                  <p class="para">We use top quality ingredients in our food & beverages offer freshly prepared cuisine</p>
                  <p class="para">Our team strives to provide one on one service & create a welcoming environment for customers to enjoy their socializing experience.</p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="aboutSection_right mt-5 mt-lg-0">
                  <div class="right_imig">
                    <img src="{{ asset('front-assets/images/frenchises/img1.jpg') }}">
                  </div>
                  <div class="aboutimgText">
                    <p>Intimate | Comfortable | Freindly Environment</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="section3" id="thirdSection">
          <div class="ouroffering">
            <div class="offeringHeading">
              <h3 class="head3">Our offering</h3>
            </div>
            <div class="offeringImgs">
              <div class="row px-2">
                <div class="col-lg-4 col-sm-6 px-2">
                  <div class="offeringBox">
                    <div class="offeringBoximg">
                      <img src="{{ asset('front-assets/images/frenchises/img2.jpg') }}">
                    </div>
                    <div class="offeringBoxText">
                      <h5 class="mb-0 head5">Good Food </h5>
                      <p class="mb-0 para">Taste of different cultures</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 px-2">
                  <div class="offeringBoximg mt-3 mt-sm-0">
                    <div class="offeringBoximg">
                      <img src="{{ asset('front-assets/images/frenchises/img3.jpg') }}">
                    </div>
                    <div class="offeringBoxText">
                      <h5 class="mb-0 head5">Majestic Ambience </h5>
                      <p class="mb-0 para">Welcoming environment for socializing</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 px-2">
                  <div class="offeringBoximg mt-3 mt-lg-0">
                    <div class="offeringBoximg">
                      <img src="{{ asset('front-assets/images/frenchises/img4.jpg') }}">
                    </div>
                    <div class="offeringBoxText">
                      <h5 class="mb-0 head5">Craft Beer  </h5>
                      <p class="mb-0 para">Freshly Brewed beer destination</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="section4" id="FourthSection">
          <div class="ourvalue">
            <div class="offeringHeading pb-5">
              <h3 class="head3">Our Value Proposition</h3>
            </div>
            <div class="offeringImgs">
              <div class="row align-items-center">
                <div class="col-md-3">
                  <div class="firstTextbox text-center">
                    <h5 class="head5">Finch Brewcafe Format: Craft Beer | 650 – 1000 Sq.ft.</h5>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="secondImgbox mt-5 mt-md-0">
                    <img src="{{ asset('front-assets/images/frenchises/img5.jpg') }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="thirdTextbox text-center mt-5 mt-md-0">
                    <span>Socializing place | Attractive price points | quick catch-up place | Craft beer & Curated drinks</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="section5" id="fifthSection">
          <div class="keyfunction">
            <div class="keyfunctionHeading mb-4">
              <h3 class="head3">Key Support Functions</h3>
              <span>A franchise network only succeeds when the franchisor is experienced, Dedicated & selfish when it comes to supporting its partners. Here’s a brief summary of what you can expect from the team.</span>
            </div>
            <div class="keyfunctionListPart mt-3">
              <div class="keyfunctionlist">
                <span> Site Selection & Build out assistance </span>
                <ul>
                  <li>Our franchise team will provide experienced guidance in the selection of your finch site & well advise you in the design & build out of the club, including prototypical architectural plan with suitable sound system.</li>
                </ul>
              </div>
              <div class="keyfunctionlist">
                <span> Complete Pre-opening training  </span>
                <ul>
                  <li>Comprehensive training will be provided to ensure you & your staff is fully ready before your grand opening.</li>
                </ul>
              </div>
              <div class="keyfunctionlist">
                <span>Our Confidential operations manual</span>
                <ul>
                  <li>You’ll receive a copy our detailed reference guide including exclusive recipes, kitchen prep steps quality control guidelines, job descriptions and much more.
                  </li>
                </ul>
              </div>
              <div class="keyfunctionlist">
                <span>Ongoing training and field support </span>
                <ul>
                  <li>We’ll send representatives out to visit you on regular bases & provide remote support whenever you need it.</li>
                </ul>
              </div>
              <div class="keyfunctionlist">
                <span>Event planning assistance </span>
                <ul>
                  <li>you will haveaccess to our most reliable contacts withnegotiated pricing & terms for organizing the live concerts.</li>
                </ul>
              </div>
              <div class="keyfunctionlist">
                <span>Marketing guidance  </span>
                <ul class="mb-0">
                  <li>From logos and template to receive of marketing material, we’ll help with initial and ongoing promotions of our club.</li>
                  <li> Where committed to ensure your grand opening is a huge success and will provide the support you need</li>
                </ul>
              </div>
            </div>
          </div>
        </section>
			<style>
	

@media (max-width: 575px){
.onOrder2 {
    padding: 12px 15px 12px !important;
    min-width: 150px;
    font-size: 16px !important;
}
}
		</style>
		<section class="text-center">
		  <a href="{{ asset('front-assets/pdf/Finch_brew_cafe_franchise.pdf') }}" class="btn BtnTwo onOrder onOrder2 p-4" style="font-size:22px;" download><i class="fa fa-download" aria-hidden="true"></i> Download Franchises Brochure</a>
		</section>
        <section class="section7" id="sevenSection">
          <div class="contactSection">
            <div class="contactUs">
              <h1 class="text-white mb-3">Contact us </h1>
              <div class="contactNo mb-2">
                <a href="tel:+91 9136914858" class="text-decoration-none">
                <span><i class="fa fa-phone" aria-hidden="true"></i></span>
                <span class="ml-3">+91 9136914858 / +91 9820886707</span>
                </a>
              </div>
              <div class="emailid">
                <a href="javascript:void" class="text-decoration-none">
                <span><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                <span class="ml-3">info@finchbrewcafe.com </span>
                </a>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
@endsection
