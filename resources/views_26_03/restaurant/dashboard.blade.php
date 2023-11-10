@extends('restaurant.layouts.app')

@section('content')
 <!-- Page-body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            
                                              <div class="col-md-6 col-xl-3">
                                                <div class="card bg-c-green order-card">
                                                    <div class="card-block">
                                                        <h6 class="m-b-20">Products</h6>
                                                        <h2 class="text-right"><i class="ti-wallet f-left"></i><span>{{ App\Models\Product::where('place',Auth::user()->id)->count() }}</span></h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-3">
                                                <div class="card bg-c-blue order-card">
                                                    <div class="card-block">
                                                        <h6 class="m-b-20">Order</h6>
                                                        <h2 class="text-right"><i class="ti-shopping-cart f-left"></i><span>{{ App\Models\Order::where('place_id',Auth::user()->id)->count() }}</span></h2>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            

                                        </div>
                                    </div>
                                    <!-- Page-body end -->
@endsection
