<style>
  .frame {
    height: 73px;
    width: 141px;
    background-position: center;
    background-size: contain;
    animation: image 3s infinite alternate;
    background-repeat: no-repeat;
  }

  @keyframes image {
    0% {}

    100% {
      background-image: url('{{ asset("front-assets/images/dark_logo2.png") }}');
    }
  }
</style>
<?php
$logo = Session::get('logo_image');

if (!empty($logo)) {
  $logo_image = asset(Session::get('logo_image'));
  $logo_image_main = 'd-block';
  $logo_class = '';
} elseif ($logo == 0) {
  $logo_image = asset('front-assets/images/site_logo/' . $getSiteSettings['site_image']->file);
  $logo_image_main = 'd-none';
  $logo_class = 'frame';
} else {
  $logo_image = asset('front-assets/images/site_logo/' . $getSiteSettings['site_image']->file);
  $logo_image_main = 'd-none';
  $logo_class = 'frame';
}
// echo "<pre>";
// print_r($logo_image);
// die;

?>
<!-------------------| Preloader |---------------------->
<section class="Preloader2" style="display:none;">
  <div class="LoaderSection text-center d-table-cell align-middle">
    <img src="{{ asset('front-assets/images/logo.png') }}" class="img-fluid">
  </div>
</section>
<!-------------------| Preloader |---------------------->
<header class="w-100 clearfix fbBeerHeader BottomHeader" id="fbBeerHeader">
  <div class="container-fluid">
    <nav class="navbar navbar-expand-md fbBeerNav" style="justify-content: space-between;">
      <a class="navbar-brand {{ $logo_class }}" href="{{url('/')}}" title="Finch Brew Cafe">

        <img src="{{ $logo_image }}" class="img-fluid {{ $logo_image_main }}" alt="No Image"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="navbar-nav d-none d-lg-flex navBarInMobile" style="align-items: center;">
        <li class="nav-item px-2  @if(Route::is('about')) navVisitNow @endif" title="About">
          <a class="nav-link text-white" href="{{route('about')}}">About Us</a>
        </li>
        <li class="nav-item px-2 @if(Route::is('our_services')) navVisitNow @endif" title="Our Services">
          <a class="nav-link text-white" href="{{route('our_services')}}">Our Services</a>
        </li>
        <li class="nav-item px-2 @if(Route::is('contact')) navVisitNow @endif" title="Contact Us">
          <a class="nav-link text-white" href="{{route('contact')}}">Contact Us</a>
        </li>
        <li class="nav-item px-2 @if(Route::is('privacy_policy')) navVisitNow @endif" title="Privacy Policy">
          <a class="nav-link text-white" href="{{route('privacy_policy')}}">Privacy Policy</a>
        </li>
        <li class="nav-item px-2 @if(Route::is('frenchises_web')) navVisitNow @endif" title="Franchise">
          <a class="nav-link text-white" href="{{route('frenchises_web')}}">Franchise</a>
        </li>
        <li class="nav-item" title="Visit Finch">
          <a class="nav-link text-white" href="https://thefinchinternational.com/" target="_blank">Visit Finch</a>
        </li>
      </ul>
      @guest
      @else
      <!-- <div class="collapse navbar-collapse d-none-mob" id="collapsibleNavbar">
            <ul class="navbar-nav insideNav">
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);" onclick="showPassportPage(this); return false;">Passports</a>
              </li>
              <li class="nav-item"><a class="nav-link position-relative" href="javascript:void(0)" onclick="changeLocations(); return false;">{{session('location_name')}} <span class="text-warning d-block position-absolute" style="font-size: 8px;min-width:100px;right:0px;left:0px;">Change Location</span></a>
              </li>
            </ul>
          </div> -->
      @endguest
      <ul class="navbar-nav d-mob-block" style="align-items: center;">
        @guest
        <li class="nav-item" title="Change Location">
          <button class="btn mag-btn-adj border-0 nav-link text-white" type="button" onclick="changeLocations(); return false;"><img src="{{ asset('front-assets/images/icons/icon2.png') }}" class="cartimcartim img-fluid" alt="">
            <span style="font-size: 12px;font-weight:600;" class="px-1 d-none d-lg-inline-block">{{session('location_name')}}</span>
          </button>
        </li>
        <li class="nav-item pr-5" title="Passport">
          <a href="{{ url('get-passport') }}" ><img src="{{ asset('front-assets/images/icons/pass.png') }}" class="cartimcartim img-fluid" alt=""></a>
        </li>
        <li class="nav-item" title="Login">
          <a class="nav-link btn m-0 onOrder onOrder2 px-3" style="min-width:100%;" href="javascript:void(0);" onclick="showLoginPage(this); return false;"><i class="fa fa-lock pr-1" aria-hidden="true"></i> Login</a>
        </li>
        @else
        <li class="nav-item" title="Change Location">
          <button class="btn mag-btn-adj border-0 nav-link text-white" type="button" onclick="changeLocations(); return false;"><img src="{{ asset('front-assets/images/icons/icon2.png') }}" class="cartimcartim img-fluid" alt="">
            <span style="font-size: 12px;font-weight:600;" class="px-1 d-none d-lg-inline-block top_location_name">{{session('location_name')}}</span>
          </button>
        </li>
        <!-- <li class="nav-item" title="Passport">
          <button class="btn mag-btn-adj border-0" type="button" onclick="showPassportPage(this); return false;"><img src="{{ asset('front-assets/images/icons/pass.png') }}" class="cartimcartim img-fluid" alt=""></button>
        </li> -->
        <li class="nav-item" title="Passport">
          <a href="{{ url('get-passport') }}" ><img src="{{ asset('front-assets/images/icons/pass.png') }}" class="cartimcartim img-fluid" alt=""></a>
        </li>
        <li class="nav-item dropdown btn-cart-menu" title="Cart">
          <button class="btn btn-secondary dropdown-toggle mag-btn-adj" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset('front-assets/images/icons/cart.png') }}" class="cartimcartim img-fluid" alt=""> <span class="badge badge-secondary cart_count" style="display:none">0</span>
          </button>
          <div id="cart_data" class="dropdown-menu" aria-labelledby="dropdownMenu2"></div>
        </li>
        <li class="nav-item d-none">
          <a class="btn fbBtn1 px-4" href="javascript:void(0);">Order Now</a>
        </li>
        <li class="nav-item dropdown btn-cart-menu userProfile" title="User">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span><img src="{{ asset('front-assets/images/icons/user.png') }}" class="cartimcartim img-fluid" alt=""> <span class="d-none-mob">@if(auth()->user()->name){{ucwords(auth()->user()->name)}}@else{{'User Name'}}@endif</span></span>
          </button>
          <div class="dropdown-menu">
            <a class="nav-link" href="javascript:void(0)" onclick="profileView_front(); return false;">My Profile</a>
            <a class="nav-link" href="{{route('my_orders')}}">My Orders</a>
            <a class="nav-link" href="{{route('my_passports')}}">My Passports</a>
            <a class="nav-link" href="{{ route('front/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="pcoded-mtext"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</span></a>
          </div>
        </li>
        <li class="nav-item d-none-mob" title="Logout">
          <a class="nav-link text-warning" href="{{ route('front/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off" aria-hidden="true"></i></a>
          <form id="logout-form" action="{{ route('front/logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          </a>
          <input type="hidden" id="isNew" value="{{ auth()->user()->is_new }}">
        </li>
        @endguest
      </ul>
      <input type="hidden" id="getLoc" value="{{session('location')}}">
      <input type="hidden" id="location_modal" value="{{session('location_modal')}}">
      <input type="hidden" id="isUserLogin" value="@if(!empty(auth()->user()->id)){{'yes'}}@else{{'no'}}@endif">
      <input type="hidden" id="user_age" value="@if(!empty(auth()->user()->age)){{auth()->user()->age}}@else{{session('age')}}@endif">
      <div class="franchMob d-block d-lg-none">
        <a class="nav-link text-white" href="{{route('frenchises_web')}}"><img src="{{ asset('front-assets/images/icons/franchise.png') }}" class="img-fluid"><span>Franchise</span></a>
      </div>
    </nav>
  </div>
</header>
<!--**********|| Header ||**********-->
<!--**********|| Back to Top ||**********-->
<div id="BackToTop" class="BackToTop">
  <i class="fa fa-angle-up" aria-hidden="true"></i>
</div>
<div class="position-fixed d-block d-lg-none FooterNav">
  <ul class="navbar-nav navBarInMobile" style="align-items: center;">
    <li class="nav-item px-2" title="About">
      <a class="nav-link text-white" href="{{route('about')}}">About Us</a>
    </li>
    <li class="nav-item px-2" title="Our Services">
      <a class="nav-link text-white" href="{{route('our_services')}}">Services</a>
    </li>
    <li class="nav-item px-2" title="Contact Us">
      <a class="nav-link text-white" href="{{route('contact')}}">Contact Us</a>
    </li>
    <li class="nav-item px-2" title="Privacy Policy">
      <a class="nav-link text-white" href="{{route('privacy_policy')}}">Policy</a>
    </li>
  </ul>
</div>
<!--**********|| Back to Top ||**********-->