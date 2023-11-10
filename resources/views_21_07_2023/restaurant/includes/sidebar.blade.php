<nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="{{ route('restaurant.dashboard') }}"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">

                            <div class="pcoded-navigation-label">Navigation</div>
                            <ul class="pcoded-item pcoded-left-item">
								<li class="{{ (Route::currentRouteName() == 'restaurant.dashboard')? 'active': '' }}">
                                    <a href="{{ route('restaurant.dashboard') }}">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
								
								
								<li class="{{ (Route::currentRouteName() == 'restaurant.products')? 'active': '' }}">
                                    <a href="{{ route('restaurant.products') }}">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Products</span>
										<span class="pcoded-badge label label-danger">{{ App\Models\Product::where('place',Auth::user()->id)->count() }}</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
																
                                 <li class="{{ (Route::currentRouteName() == 'restaurant.orders')? 'active': '' }}">
                                    <a href="{{ route('restaurant.r_orders') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
                                        <span class="pcoded-mtext">Orders</span>
										<span class="pcoded-badge label label-danger">{{ App\Models\Order::where('place_id',Auth::user()->id)->count() }}</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="{{ (Route::currentRouteName() == 'restaurant.refund_orders')? 'active': '' }}">
                                    <a href="{{ route('restaurant.refund_orders') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>H</b></span>
                                        <span class="pcoded-mtext">Refunds</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                
								<li class="{{ (Route::currentRouteName() == 'restaurant.settings')? 'active': '' }}">
                                    <a href="{{route('restaurant.settings')}}">
                                        <span class="pcoded-micon"><i class="ti-settings"></i><b>S</b></span>
                                        <span class="pcoded-mtext">User Setting</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
								<li class="">
                                    <a href="{{ route('restaurant.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i><b>U</b></span>
                                        <span class="pcoded-mtext">Logout</span>
                                        <span class="pcoded-mcaret"></span>
										 <form id="logout-form" action="{{ route('restaurant.logout') }}" method="POST" style="display: none;">
											@csrf
										</form>
                                    </a>
                                </li>
								
								
                            </ul>
                            
                        </div>
                    </nav>