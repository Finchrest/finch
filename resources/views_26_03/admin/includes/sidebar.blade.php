<nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="{{ route('admin.dashboard') }}"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">

                            <div class="pcoded-navigation-label">Navigation</div>
                            <ul class="pcoded-item pcoded-left-item">
								<li class="{{ (Route::currentRouteName() == 'admin.dashboard')? 'active': '' }}">
                                    <a href="{{ route('admin.dashboard') }}">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
								
								<li class="{{ (Route::currentRouteName() == 'admin.banners')? 'active': '' }}">
                                    <a href="{{ route('admin.banners') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>B</b></span>
                                        <span class="pcoded-mtext">Home Banners</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
								
								<li class="{{ (Route::currentRouteName() == 'admin.users')? 'active': '' }}">
                                    <a href="{{ route('admin.users') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>U</b></span>
                                        <span class="pcoded-mtext">Users</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                              

                                 


                                 <li class="pcoded-hasmenu {{ (Route::currentRouteName() == 'admin.coupons' || Route::currentRouteName() == 'admin.offers')? 'pcoded-trigger': '' }}">
                                    <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                    <span class="pcoded-mtext">Coupons/Offers</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                                    <ul class="pcoded-submenu">
                                        <li class="{{ (Route::currentRouteName() == 'admin.coupons')? 'active': '' }}">
                                    <a href="{{ route('admin.coupons') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
                                        <span class="pcoded-mtext">Coupons</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                 <li class="{{ (Route::currentRouteName() == 'admin.offers')? 'active': '' }}">
                                    <a href="{{ route('admin.offers') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
                                        <span class="pcoded-mtext">Offers</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                
                                    </ul>
                                </li>


								
								
								<li class="pcoded-hasmenu {{ (Route::currentRouteName() == 'admin.locations' || Route::currentRouteName() == 'admin.restaurants')? 'pcoded-trigger': '' }}">
                                    <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                    <span class="pcoded-mtext">Restaurants</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                                    <ul class="pcoded-submenu">
                                         <li class="{{ (Route::currentRouteName() == 'admin.locations')? 'active': '' }}">
                                    <a href="{{ route('admin.locations') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
                                        <span class="pcoded-mtext">Locations</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                 <li class="{{ (Route::currentRouteName() == 'admin.restaurants')? 'active': '' }}">
                                    <a href="{{ route('admin.restaurants') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>P</b></span>
                                        <span class="pcoded-mtext">Restaurants</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                
                                    </ul>
                                </li>

								<li class="{{ (Route::currentRouteName() == 'admin.attributes')? 'active': '' }}">
                                    <a href="{{ route('admin.attributes') }}">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Attributes</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
								
								<li class="pcoded-hasmenu {{ (Route::currentRouteName() == 'admin.hops' || Route::currentRouteName() == 'admin.malts' || Route::currentRouteName() == 'admin.categories' || Route::currentRouteName() == 'admin.products')? 'pcoded-trigger': '' }}">
                                    <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                    <span class="pcoded-mtext">Products</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                                    <ul class="pcoded-submenu">
									  <li class="{{ (Route::currentRouteName() == 'admin.hops')? 'active': '' }}">
                                    <a href="{{ route('admin.hops') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
                                        <span class="pcoded-mtext">Hops</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                               
                                 <li class="{{ (Route::currentRouteName() == 'admin.malts')? 'active': '' }}">
                                    <a href="{{ route('admin.malts') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
                                        <span class="pcoded-mtext">Malts</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
								
                                <li class="{{ (Route::currentRouteName() == 'admin.categories')? 'active': '' }}">
                                    <a href="{{ route('admin.categories') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>P</b></span>
                                        <span class="pcoded-mtext">Categories</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="{{ (Route::currentRouteName() == 'admin.sub_categories')? 'active': '' }}">
                                    <a href="{{ route('admin.sub_categories') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>P</b></span>
                                        <span class="pcoded-mtext">Sub Categories</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

								 <li class="{{ (Route::currentRouteName() == 'admin.products')? 'active': '' }}">
                                    <a href="{{ route('admin.products') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>P</b></span>
                                        <span class="pcoded-mtext">Products</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                
                                    </ul>
                                </li>
								
								
								
								<li class="pcoded-hasmenu {{ (Route::currentRouteName() == 'admin.passports' || Route::currentRouteName() == 'admin.passport_pages')? 'pcoded-trigger': '' }}">
                                    <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                    <span class="pcoded-mtext">Passport</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                                    <ul class="pcoded-submenu">
                                         <li class="{{ (Route::currentRouteName() == 'admin.passports')? 'active': '' }}">
                                    <a href="{{ route('admin.passports') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
                                        <span class="pcoded-mtext">Passports</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                 <li class="{{ (Route::currentRouteName() == 'admin.passport_pages')? 'active': '' }}">
                                    <a href="{{ route('admin.passport_pages') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
                                        <span class="pcoded-mtext">Passport Page</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                
                                    </ul>
                                </li>
								

                              

                                 <li class="{{ (Route::currentRouteName() == 'admin.orders')? 'active': '' }}">
                                    <a href="{{ route('admin.orders') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
                                        <span class="pcoded-mtext">Orders</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="{{ (Route::currentRouteName() == 'admin.refund_orders')? 'active': '' }}">
                                    <a href="{{ route('admin.refund_orders') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
                                        <span class="pcoded-mtext">Refunds</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
								
								  <li class="{{ (Route::currentRouteName() == 'admin.passport_orders')? 'active': '' }}">
                                    <a href="{{ route('admin.passport_orders') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
                                        <span class="pcoded-mtext">Passport Orders</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
								
								
								
                               
								  <li class="pcoded-hasmenu {{ (Route::currentRouteName() == 'admin.custom_passport_orders' || Route::currentRouteName() == 'admin.customorders')? 'pcoded-trigger': '' }}">
                                    <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                    <span class="pcoded-mtext">Custom User</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                                    <ul class="pcoded-submenu">
                                        <li class="{{ (Route::currentRouteName() == 'admin.custom_passport_orders')? 'active': '' }}">
											<a href="{{ route('admin.custom_passport_orders') }}">
												<span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
												<span class="pcoded-mtext">Custom Passport Orders</span>
												<span class="pcoded-mcaret"></span>
											</a>
										</li>
                                       <li class="{{ (Route::currentRouteName() == 'admin.customorders')? 'active': '' }}">
                                    <a href="{{ route('admin.customorders') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
                                        <span class="pcoded-mtext">Custom Order</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                    </ul>
                                </li>
								<li class="{{ (Route::currentRouteName() == 'admin.settings.general')? 'active': '' }}">
                                    <a href="{{route('admin.settings.general')}}">
                                        <span class="pcoded-micon"><i class="ti-settings"></i><b>S</b></span>
                                        <span class="pcoded-mtext">Site Setting</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
								<li class="{{ (Route::currentRouteName() == 'admin.user_enquiry')? 'active': '' }}">
                                    <a href="{{ route('admin.user_enquiry') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>U</b></span>
                                        <span class="pcoded-mtext">Users Enquiry</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
								<li class="">
                                    <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i><b>U</b></span>
                                        <span class="pcoded-mtext">Logout</span>
                                        <span class="pcoded-mcaret"></span>
										 <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
											@csrf
										</form>
                                    </a>
                                </li>
								
								
                            </ul>
                            
                        </div>
                    </nav>