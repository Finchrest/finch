@extends('layouts.app')

@section('content')
 <!--**********|| Order Section ||**********-->
 <style>
    ul.list-unstyled.DrinkBrad.w-100 li{
      border: 2px solid #685e44 !important;
      padding: 5px 10px !important;
      border-radius: 50px !important;
    }
    .active {
      color: var(--yellow) !important;
    }
 </style>
    <section class="w-100 clearfix fbBeerOrderMenus py-5 mt-md-5" id="fbOrderMenus">
      <div class="BgBannerImage1 position-absolute w-100"> 
        <img src="{{ asset('front-assets/images/banner1.png') }}" class="img-fluid BannerImg1 BannerImg6">
      </div>
      <div class="container pt-md-5">
        <div class="bradcrump w-100">
          <ul class="list-unstyled DrinkBrad w-100">
            <li><a href="javascript:void(0);" class="active" onclick="showProduct(this,'drinks','meals'); return false;">Drinks</a></li>
            <li><a href="javascript:void(0);" onclick="showProduct(this,'meals','drinks'); return false;">Meals</a></li>
          </ul>
        </div>
        <div class="fbOrderMeals w-100 fbOrderDrinks">
          <div class="row">
            <div class="drinks">
              @foreach($products as $product)
                  @if($product->type == 1)
                    @php
                      $pimg = asset($product->FileId->file); 
                    @endphp
                    <div class="col-md-12">
                      <a href="javascript:void(0);" class="d-block">
                        <div class="fbOrderDetails w-100 text-white">
                          <div class="row">
                            <div class="col-md-2 col-3 pr-0 text-center">
                              <div class="odrImg2 w-100">
                                <img src="{{$pimg}}" class="img-fluid" alt="NO Image">
                              </div>
                            </div>
                            <div class="col-md-8 col-6">
                              <div class="OdrMiddleText w-100">
                                <h5 class="mb-md-3">{{$product->title}}</h5>
                                <p class="mb-md-4 mb-2 clr_blue">{{$product->sub_title}}</p>
                                <p class="mb-md-4 m-0">{{$product->short_description}}</p>
                              </div>
                            </div>
                            <div class="col-3 pr-0 text-center HideOnMob d-none">
                              <div class="odrImg3 w-100 d-table h-100">
                                <div class="d-table-cell align-middle">
                                  <img src="{{ asset('front-assets/images/products/1.png') }}" class="img-fluid" alt="NO Image">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-2 col-6">
                              <div class="OdrPriceDetails w-100 text-right">
                                <h5><i class="fa fa-inr" aria-hidden="true"></i>
                                  <span>{{$product->total_price}}</span>
                                </h5>
                                <div class="AddMoreBtn">
                                  <p href="javascript:void(0);" class="btn m-0 onOrder onOrder2" onclick="viewProduct(this,'{{$product->id}}'); return false;">Add</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                  @endif
              @endforeach
            </div>
            <div class="meals" style="display:none;">
              @foreach($products as $product)
                @if($product->type == 2)
                  @php
                    $pimg = asset($product->FileId->file); 
                  @endphp
                  <div class="col-md-12">
                    <a href="javascript:void(0);" class="d-block">
                      <div class="fbOrderDetails w-100 text-white">
                        <div class="row">
                          <div class="col-md-2 col-3 pr-0 text-center">
                            <div class="odrImg2 w-100">
                              <img src="{{$pimg}}" class="img-fluid" alt="NO Image">
                            </div>
                          </div>
                          <div class="col-md-8 col-6">
                            <div class="OdrMiddleText w-100">
                              <h5 class="mb-md-3">{{$product->title}}</h5>
                              <p class="mb-md-4 mb-2 clr_blue">{{$product->sub_title}}</p>
                              <p class="mb-md-4 m-0">{{$product->short_description}}</p>
                            </div>
                          </div>
                          <div class="col-3 pr-0 text-center HideOnMob d-none">
                            <div class="odrImg3 w-100 d-table h-100">
                              <div class="d-table-cell align-middle">
                                <img src="{{ asset('front-assets/images/products/1.png') }}" class="img-fluid" alt="NO Image">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-2 col-3">
                            <div class="OdrPriceDetails w-100 text-right">
                              <h5><i class="fa fa-inr" aria-hidden="true"></i>
                                <span>{{$product->total_price}}</span>
                              </h5>
                              <div class="AddMoreBtn">
                                <p href="javascript:void(0);" class="btn m-0 onOrder onOrder2" onclick="viewProduct(this,'{{$product->id}}'); return false;">Add</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                @endif
            @endforeach
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--**********|| Order Section ||**********-->
    <!--**********|| Grab Discount Section ||**********-->
    <section class="w-100 clearfix fbGrabYourOrder pt-md-5" id="fbGrabYourOrder">
      <div class="container mb-md-5 pb-5">
        <div class="HeadingText HeadingText2 text-center mb-2">
          <h3 class="mb-3">What is Lorem Ipsum?</h3>
          <p class="mb-0 pb-3">Lorem Ipsum is simply.</p>
        </div>
        <div class="text-center GrabBtn w-100">
          <a href="javascript:void(0);" class="btn m-0 onOrder onOrder2">Grab The Offer</a>
        </div>
      </div>
      <img src="{{ asset('front-assets/images/banner2.png') }}" class="img-fluid BannerImg5">
    </section>
    <!--**********|| Grab Discount Section ||**********-->
    <!--**********|| Modal Section ||**********-->
    <div class="OrderModalInside">
      <!-- The Modal -->
      <div class="modal OrderShowModal" id="BeerOrderShowModal">
        <div class="modal-dialog">
          <div class="modal-content">
            
          </div>
        </div>
      </div>
    </div>
@endsection

<script>
  function viewProduct(e,id){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({  
      url :"{{route('productView')}}",  
      method:"POST",  
      dataType:"json",  
      data:{id:id},
      success: function(data){ 
        if(data.success==1){
          $('#BeerOrderShowModal .modal-content').html(data.view);    
          $('#BeerOrderShowModal').modal('show');    
        }
      },
      error: function(data){ 
        if(typeof data.responseJSON.status !== 'undefined'){
          toastr.error(data.responseJSON.error,'Error');
        }else{
          $.each(data.responseJSON.errors, function( key, value ) {
              toastr.error(value,'Error');
          });
        }
        $(e).find('.st_loader').hide();
      } 
    }); 
	}

  function showProduct(e,id,id2){
    $('.'+id).show();
    $('.'+id2).hide();
    $('ul li a').removeClass('active');
    $(e).addClass('active');
  }
	
</script> 