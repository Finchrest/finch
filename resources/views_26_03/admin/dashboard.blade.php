@extends('admin.layouts.app')

@section('content')
 <!-- Page-body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <!-- order-card start -->
                                            <div class="col-md-6 col-xl-3">
                                                <div class="card bg-c-pink order-card">
                                                    <div class="card-block">
                                                        <h6 class="m-b-20">Banners</h6>
                                                        <h2 class="text-right"><i class="ti-wallet f-left"></i><span>{{ App\Models\Banner::all()->count() }}</span></h2>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-xl-3">
                                                <div class="card bg-c-blue order-card">
                                                    <div class="card-block">
                                                        <h6 class="m-b-20">Users</h6>
                                                        <h2 class="text-right"><i class="ti-shopping-cart f-left"></i><span>{{ App\Models\User::all()->count() }}</span></h2>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-3">
                                                <div class="card bg-c-green order-card">
                                                    <div class="card-block">
                                                        <h6 class="m-b-20">Hops</h6>
                                                        <h2 class="text-right"><i class="ti-tag f-left"></i><span>{{ App\Models\User::all()->count() }}</span></h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-3">
                                                <div class="card bg-c-yellow order-card">
                                                    <div class="card-block">
                                                        <h6 class="m-b-20">Malts</h6>
                                                        <h2 class="text-right"><i class="ti-reload f-left"></i><span>{{ App\Models\Malt::all()->count() }}</span></h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-3">
                                                <div class="card bg-c-blue order-card">
                                                    <div class="card-block">
                                                        <h6 class="m-b-20">Offers</h6>
                                                        <h2 class="text-right"><i class="ti-wallet f-left"></i><span>{{ App\Models\Offer::all()->count() }}</span></h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-3">
                                                <div class="card bg-c-yellow order-card">
                                                    <div class="card-block">
                                                        <h6 class="m-b-20">Places</h6>
                                                        <h2 class="text-right"><i class="ti-wallet f-left"></i><span>{{ App\Models\Place::all()->count() }}</span></h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-3">
                                                <div class="card bg-c-pink order-card">
                                                    <div class="card-block">
                                                        <h6 class="m-b-20">Categores</h6>
                                                        <h2 class="text-right"><i class="ti-wallet f-left"></i><span>{{ App\Models\Category::all()->count() }}</span></h2>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xl-3">
                                                <div class="card bg-c-green order-card">
                                                    <div class="card-block">
                                                        <h6 class="m-b-20">Products</h6>
                                                        <h2 class="text-right"><i class="ti-wallet f-left"></i><span>{{ App\Models\Product::all()->count() }}</span></h2>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- Page-body end -->
@endsection
