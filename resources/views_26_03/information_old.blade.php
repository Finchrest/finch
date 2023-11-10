@extends('layouts.app')

@section('content')
 <!--**********|| Value Proposition Section ||**********-->
    <section class="w-100 clearfix ValueProposition" id="ValueProposition" style="padding-bottom:0px !important;">
      <div class="BgBannerImage1 position-absolute w-100"> 
        <img src="{{ asset('front-assets/images/banner8.png') }}" class="img-fluid BannerImg1 BannerImg3">
        <img src="{{ asset('front-assets/images/banner7.png') }}" class="img-fluid BannerImg1 BannerImg4">
      </div>
      <div class="container-fluid">
        <div class="HeadingText HeadingText2 text-center mb-4">
          <h3 class="mb-3">What is Lorem Ipsum?</h3>
          <p class="mb-0 text-capitalize">Lorem Ipsum is simply.</p>
        </div>
        <div class="w-100 clearfix FinchMegaCafe bdr_btm_1">
          <div class="row">
            @foreach($places as $place)
              <?php
                $images = get_place_image_explode($place->file_ids);
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
                        <li>Partt Place</li>
                        <li>Live Music</li>
                        <li>Classy Ambience</li>
                        <li>In-house brewery</li>
                        <li>Exotic Food</li>
                      </ul>
                    </div>
                  </a>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        @foreach($places as $k => $place2)
          @php
            $images2 = get_place_image_explode($place->file_ids);
            $image2 = asset($place2->FileId->file);
          @endphp
          @if($k%2!=0)
            <div class="fbFinchMegaFood w-100 clearfix bdr_btm_1">
              <div class="row">
                <div class="col-lg-4 col-sm-9 fbColSet order-1">
                  <div class="fbMegaImage fbMegaImage2 w-100">
                    <img src="{{$image2}}" class="img-fluid" alt="NO Image">
                  </div>
                </div>
                <div class="col-lg-8 fbColSet order-2 pl-5">
                  <div class="FinchMegaContent w-100 text-white">
                    <h3 class="mb-4">{{$place2->name}}</h3>
                    <div class="PtextHere pb-5">
                      <p class="">{{$place2->sub_description}}</p>
                    </div>
                    <h5>{{$place2->name}}</h5>
                    <p>Format : with micro-brewery <span>8000 sq.ft.</span></p>
                    <div class="fbMegaTexts w-100">
                      <ul class="list-unstyled megaTextLists m-0">
                        <li>Comfortable Environment</li>
                        <li>Partt Place</li>
                        <li>Live Music</li>
                        <li>Classy Ambience</li>
                        <li>In-house brewery</li>
                        <li>Exotic Food</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @else
          <div class="fbFinchMegaFood w-100 clearfix bdr_btm_1">
            <div class="row">
              <div class="col-lg-4 col-sm-9 fbColSet order-lg-2">
                <div class="fbMegaImage fbMegaImage2 w-100">
                  <img src="{{$image2}}" class="img-fluid" alt="NO Image">
                </div>
              </div>
              <div class="col-lg-8 fbColSet order-lg-1 pl-4">
                <div class="FinchMegaContent w-100 text-white">
                  <h3 class="mb-4">{{$place2->name}}</h3>
                  <div class="PtextHere pb-5">
                    <p class="">{{$place2->sub_description}}</p>
                  </div>
                  <h5>{{$place2->name}}</h5>
                  <p>Format : with micro-brewery <span>8000 sq.ft.</span></p>
                  <div class="fbMegaTexts w-100">
                    <ul class="list-unstyled megaTextLists m-0">
                      <li>Comfortable Environment</li>
                      <li>Partt Place</li>
                      <li>Live Music</li>
                      <li>Classy Ambience</li>
                      <li>In-house brewery</li>
                      <li>Exotic Food</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
        @endforeach
      </div>
    </section>
@endsection
