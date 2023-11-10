<nav class="pcoded-navbar">
  <div class="sidebar_toggle"><a href="{{ route('admin.dashboard') }}"><i class="icon-close icons"></i></a></div>
  <div class="pcoded-inner-navbar main-menu">
    <div class="pcoded-navigation-label">Navigation</div>
    <ul class="pcoded-item pcoded-left-item">
      <li class="{{ (Route::currentRouteName() == 'superadmin.dashboard')? 'active': '' }}">
        <a href="{{ route('superadmin.dashboard') }}">
          <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
          <span class="pcoded-mtext">Dashboard</span>
          <span class="pcoded-mcaret"></span>
        </a>
      </li>

      <li class="{{ (Route::currentRouteName() == 'superadmin.banners')? 'active': '' }}">
        <a href="{{ route('superadmin.banners') }}">
          <span class="pcoded-micon"><i class="ti-user"></i><b>B</b></span>
          <span class="pcoded-mtext">Home Banners</span>
          <span class="pcoded-mcaret"></span>
        </a>
      </li>
      <li class="{{ (Route::currentRouteName() == 'superadmin.users')? 'active': '' }}">
        <a href="{{ route('superadmin.users') }}">
          <span class="pcoded-micon"><i class="ti-user"></i><b>U</b></span>
          <span class="pcoded-mtext">Users</span>
          <span class="pcoded-mcaret"></span>
        </a>
      </li>
      <li class="{{ (Route::currentRouteName() == 'superadmin.admins')? 'active': '' }}">
        <a href="{{ route('superadmin.admins') }}">
          <span class="pcoded-micon"><i class="ti-user"></i><b>B</b></span>
          <span class="pcoded-mtext">Admin</span>
          <span class="pcoded-mcaret"></span>
        </a>
      </li>

      <li class="pcoded-hasmenu {{ (Route::currentRouteName() == 'superadmin.coupons' || Route::currentRouteName() == 'admin.offers')? 'pcoded-trigger': '' }}">
        <a href="javascript:void(0)">
          <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
          <span class="pcoded-mtext">Coupons/Offers</span>
          <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
          <li class="{{ (Route::currentRouteName() == 'superadmin.coupons')? 'active': '' }}">
            <a href="{{ route('superadmin.coupons') }}">
              <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
              <span class="pcoded-mtext">Coupons</span>
              <span class="pcoded-mcaret"></span>
            </a>
          </li>
          <li class="{{ (Route::currentRouteName() == 'superadmin.offers')? 'active': '' }}">
            <a href="{{ route('superadmin.offers') }}">
              <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
              <span class="pcoded-mtext">Offers</span>
              <span class="pcoded-mcaret"></span>
            </a>
          </li>
        </ul>
      </li>
      <li class="pcoded-hasmenu {{ (Route::currentRouteName() == 'superadmin.locations' || Route::currentRouteName() == 'admin.restaurants')? 'pcoded-trigger': '' }}">
        <a href="javascript:void(0)">
          <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
          <span class="pcoded-mtext">Restaurants</span>
          <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
          <li class="{{ (Route::currentRouteName() == 'superadmin.locations')? 'active': '' }}">
            <a href="{{ route('superadmin.locations') }}">
              <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
              <span class="pcoded-mtext">Locations</span>
              <span class="pcoded-mcaret"></span>
            </a>
          </li>
          <li class="{{ (Route::currentRouteName() == 'superadmin.restaurants')? 'active': '' }}">
            <a href="{{ route('superadmin.restaurants') }}">
              <span class="pcoded-micon"><i class="ti-user"></i><b>P</b></span>
              <span class="pcoded-mtext">Restaurants</span>
              <span class="pcoded-mcaret"></span>
            </a>
          </li>
        </ul>
      </li>
      <li class="{{ (Route::currentRouteName() == 'superadmin.attributes')? 'active': '' }}">
        <a href="{{ route('superadmin.attributes') }}">
          <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
          <span class="pcoded-mtext">Attributes</span>
          <span class="pcoded-mcaret"></span>
        </a>
      </li>
      <li class="pcoded-hasmenu {{ (Route::currentRouteName() == 'superadmin.hops' || Route::currentRouteName() == 'superadmin.malts' || Route::currentRouteName() == 'admin.categories' || Route::currentRouteName() == 'admin.products')? 'pcoded-trigger': '' }}">
        <a href="javascript:void(0)">
          <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
          <span class="pcoded-mtext">Products</span>
          <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
          <li class="{{ (Route::currentRouteName() == 'superadmin.hops')? 'active': '' }}">
            <a href="{{ route('superadmin.hops') }}">
              <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
              <span class="pcoded-mtext">Hops</span>
              <span class="pcoded-mcaret"></span>
            </a>
          </li>
          <li class="{{ (Route::currentRouteName() == 'superadmin.malts')? 'active': '' }}">
            <a href="{{ route('superadmin.malts') }}">
              <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
              <span class="pcoded-mtext">Malts</span>
              <span class="pcoded-mcaret"></span>
            </a>
          </li>
          <li class="{{ (Route::currentRouteName() == 'superadmin.categories')? 'active': '' }}">
            <a href="{{ route('superadmin.categories') }}">
              <span class="pcoded-micon"><i class="ti-user"></i><b>P</b></span>
              <span class="pcoded-mtext">Categories</span>
              <span class="pcoded-mcaret"></span>
            </a>
          </li>
          <li class="{{ (Route::currentRouteName() == 'superadmin.sub_categories')? 'active': '' }}">
            <a href="{{ route('superadmin.sub_categories') }}">
              <span class="pcoded-micon"><i class="ti-user"></i><b>P</b></span>
              <span class="pcoded-mtext">Sub Categories</span>
              <span class="pcoded-mcaret"></span>
            </a>
          </li>
          <li class="{{ (Route::currentRouteName() == 'superadmin.products')? 'active': '' }}">
            <a href="{{ route('superadmin.products') }}">
              <span class="pcoded-micon"><i class="ti-user"></i><b>P</b></span>
              <span class="pcoded-mtext">Products</span>
              <span class="pcoded-mcaret"></span>
            </a>
          </li>
        </ul>
      </li>
      <li class="pcoded-hasmenu {{ (Route::currentRouteName() == 'superadmin.passports' || Route::currentRouteName() == 'admin.passport_pages')? 'pcoded-trigger': '' }}">
        <a href="javascript:void(0)">
          <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
          <span class="pcoded-mtext">Passport</span>
          <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
          <li class="{{ (Route::currentRouteName() == 'superadmin.passports')? 'active': '' }}">
            <a href="{{ route('superadmin.passports') }}">
              <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
              <span class="pcoded-mtext">Passports</span>
              <span class="pcoded-mcaret"></span>
            </a>
          </li>
          <li class="{{ (Route::currentRouteName() == 'superadmin.passport_pages')? 'active': '' }}">
            <a href="{{ route('superadmin.passport_pages') }}">
              <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
              <span class="pcoded-mtext">Passport Page</span>
              <span class="pcoded-mcaret"></span>
            </a>
          </li>
          <li class="{{ (Route::currentRouteName() == 'admin.passport_confirm')? 'active': '' }}">
            <a href="{{ route('superadmin.passport_confirm') }}">
              <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
              <span class="pcoded-mtext">Passport Confirm</span>
              <span class="pcoded-mcaret"></span>
            </a>
          </li>
        </ul>
      </li>
      <li class="{{ (Route::currentRouteName() == 'superadmin.orders')? 'active': '' }}">
        <a href="{{ route('superadmin.orders') }}">
          <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
          <span class="pcoded-mtext">Orders</span>
          <span class="pcoded-mcaret"></span>
        </a>
      </li>
      <li class="{{ (Route::currentRouteName() == 'superadmin.refund_orders')? 'active': '' }}">
        <a href="{{ route('superadmin.refund_orders') }}">
          <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
          <span class="pcoded-mtext">Refunds</span>
          <span class="pcoded-mcaret"></span>
        </a>
      </li>
      <li class="{{ (Route::currentRouteName() == 'superadmin.passport_orders')? 'active': '' }}">
        <a href="{{ route('superadmin.passport_orders') }}">
          <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
          <span class="pcoded-mtext">Passport Orders</span>
          <span class="pcoded-mcaret"></span>
        </a>
      </li>
      <li class="pcoded-hasmenu {{ (Route::currentRouteName() == 'superadmin.custom_passport_orders' || Route::currentRouteName() == 'superadmin.customorders')? 'pcoded-trigger': '' }}">
        <a href="javascript:void(0)">
          <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
          <span class="pcoded-mtext">Custom User</span>
          <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
          <li class="{{ (Route::currentRouteName() == 'superadmin.custom_passport_orders')? 'active': '' }}">
            <a href="{{ route('superadmin.custom_passport_orders') }}">
              <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
              <span class="pcoded-mtext">Custom Passport Orders</span>
              <span class="pcoded-mcaret"></span>
            </a>
          </li>
          <li class="{{ (Route::currentRouteName() == 'superadmin.customorders')? 'active': '' }}">
            <a href="{{ route('superadmin.customorders') }}">
              <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
              <span class="pcoded-mtext">Custom Order</span>
              <span class="pcoded-mcaret"></span>
            </a>
          </li>
        </ul>
      </li>
      <li class="{{ (Route::currentRouteName() == 'superadmin.settings.general')? 'active': '' }}">
        <a href="{{route('superadmin.settings.general')}}">
          <span class="pcoded-micon"><i class="ti-settings"></i><b>S</b></span>
          <span class="pcoded-mtext">Site Setting</span>
          <span class="pcoded-mcaret"></span>
        </a>
      </li>
      <li class="{{ (Route::currentRouteName() == 'superadmin.user_enquiry')? 'active': '' }}">
        <a href="{{ route('superadmin.user_enquiry') }}">
          <span class="pcoded-micon"><i class="ti-user"></i><b>U</b></span>
          <span class="pcoded-mtext">Users Enquiry</span>
          <span class="pcoded-mcaret"></span>
        </a>
      </li>
      <li class="">
        <a href="{{ route('superadmin.reports') }}">
          <span class="pcoded-micon"><i class="ti-user"></i><b>U</b></span>
          <span class="pcoded-mtext">Reports</span>
          <span class="pcoded-mcaret"></span>
        </a>
      </li>
      <li class="">
        <a href="{{ route('superadmin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i><b>U</b></span>
          <span class="pcoded-mtext">Logout</span>
          <span class="pcoded-mcaret"></span>
          <form id="logout-form" action="{{ route('superadmin.logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </a>
      </li>
    </ul>
  </div>
</nav>