@extends('layouts.app')
@section('content')
<!--**********|| Order Section ||**********-->
<style>
  .active {
  color: var(--yellow) !important;
  }
  .meals_show{
  display: none;
  }
</style>
<section class="w-100 clearfix fbBeerOrderMenus py-5 mt-md-5 " id="fbOrderMenus">
  <div class="BgBannerImage1 position-absolute w-100"> 
    <img src="{{ asset('front-assets/images/banner1.png') }}" class="img-fluid BannerImg1 BannerImg6">
  </div>
  <div class="container py-md-5">
    <div class="bradcrump w-100 d-flex align-items-center justify-content-between drinkBradcrump">
      <ul class="list-unstyled DrinkBrad">
        <li><a href="{{url('product/'.$slug_name.'/drinks')}}" class="drink_menu">Drinks ({{ $drink_count }})</a></li>
        <li><a href="{{url('product/'.$slug_name.'/meals')}}" class="active meal_menu">Meals ({{ $meals_count }})</a></li>
      </ul>
      <ul class="rightList d-flex align-items-center">
        <li>
          <div class="input-group searchInputGroup mb-0 pr-3">
            <input type="text" class="form-control" placeholder="Search">
            <div class="input-group-append">
              <button class="btn bgBtn" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
          </div>
        </li>
        <li>
          <dl class="dropdownSelect mb-0">
            <dt>
              <a href="javascript:void(0);">
                <span class="hida">Select Category <i class="fa fa-angle-down" aria-hidden="true"></i></span>    
                <p class="multiSel mb-0"></p>
              </a>
            </dt>
            <dd>
              <div class="mutliSelect">
                <ul>
                  <li>
                    <label class="mb-0"><input type="checkbox" value="Apple">Apple</label>
                  </li>
                  <li>
                    <label class="mb-0"><input type="checkbox" value="Blackberry">Blackberry</label>
                  </li>
                  <li>
                    <label class="mb-0"><input type="checkbox" value="HTC">HTC</label>
                  </li>
                  <li>
                    <label class="mb-0"><input type="checkbox" value="Sony Ericson">Sony Ericson</label>
                  </li>
                  <li>
                    <label class="mb-0"><input type="checkbox" value="Motorola">Motorola</label>
                  </li>
                  <li>
                    <label class="mb-0"><input type="checkbox" value="Nokia">Nokia</label>
                  </li>
                </ul>
              </div>
            </dd>
          </dl>
        </li>
      </ul>
      <?php if($place == 7){ ?>
      <ul class="list-unstyled DrinkBrad gotoWhatsapp">
        <li>
          <a href="https://wa.me/917304928954" target="_blank" style="background-color:#25D366;">
          <i aria-hidden="true" class="fa fa-whatsapp"></i>
          </a>
          <span>Whats app on this <br> for Home Delivery</span>
        </li>
      </ul>
      <?php } ?>
    </div>
    <div class="fbOrderMeals w-100 fbOrderDrinks position-relative">
      <!-- <div class="p-5 product_loader" >
        <h2 class="text-center" style="color:#fff">Please Wait...</h2>
        </div> -->
      <div id="fbOrderDrinks">
<div class="meals">
  <?php if($place == 7){ ?>
  <h5 class="showOnMeals offerCode">Food 15% off on Home Delivery</h5>
  <?php } ?>
  <div class="row px-3 px-md-0">
    @foreach($products as $product)
    @if($product->type == 2)
    @php
    $pimg = asset($product->FileId->file); 
    @endphp
    <div class="col-xl-6 product-box productListBox" id="product_{{$product->id}}">
      <a href="javascript:void(0);" class="d-block">
        <div class="fbOrderDetails w-100 text-white productListDetails">
          <div class="row">
            <div class="col-md-9 col-9">
              <div class="row px-md-3">
                <div class="col-md-5 col-4 p-0">
                  <div class="odrImg w-100">
                    <img src="{{$pimg}}" class="img-fluid" alt="NO Image">
                  </div>
                </div>
                <div class="col-md-7 col-8">
                  <div class="OdrMiddleText w-100 HideInMob">
                    <h5 class="one-line-text">{{$product->title}}</h5>
                    <p class="four-line-text">{{strtolower($product->short_description)}}</p>
                  </div>
                </div>
                <div class="col-12 ShowInMob px-0">
                  <div class="OdrMiddleText w-100">
                    <p class="mb-0">{{strtolower($product->short_description)}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-3 pl-0">
              <div class="OdrPriceDetails w-100 text-right">
                <h5><i class="fa fa-inr" aria-hidden="true"></i>
                  <span>@if(empty($product->price)){{$product->total_price}}@else{{$product->price}}@endif</span>
                </h5>
                <div class="AddMoreBtn" style="<?php if(isset($cart[$product->id])){ echo 'display:none;';}?>"  id="addBtn_{{$product->id}}">
                  <p href="javascript:void(0);" class="btn m-0 onOrder onOrder2" onclick="viewMealsProduct(this,'{{$product->id}}'); return false;">Add</p>
                </div>
                <div class="QuntityCount pt-2 text-center" id="QuntityCount_{{$product->id}}" style="<?php if(!isset($cart[$product->id])){ echo 'display:none;';}?>">
                  <div class="MngeQuntity">
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <input type="button" value="-" class="qty-minus onOrder onOrder2" onclick="update_qty({{$product->id}},'{{ @$cart[$product->id]['row_id'] }}',0)">
                    <input type="number" name="qty" value="{{ @$cart[$product->id]['qty'] }}" class="qty" id="qty_{{$product->id}}">
                    <input type="button" value="+" class="qty-plus onOrder onOrder2" onclick="update_qty({{$product->id}},'{{ @$cart[$product->id]['row_id'] }}',1)"> 
                  </div>
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
      <p class="text-center mt-4 mb-5"><button class="load-more btn btn-dark btn-lg onOrder2" onclick="load_more(this,{{ $place }})">Load More</button></p>
    </div>
  </div>
</section>
<!--**********|| Order Section ||**********-->
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
<!--**********|| Modal Section ||**********-->
<div class="OrderModalInside">
  <!-- The Modal -->
  <div class="modal OrderShowModal" id="OrderShowModal">
    <div class="modal-dialog">
      <div class="modal-content">
      </div>
    </div>
  </div>
</div>
@endsection
@section('page-js-script')
<script type="text/javascript">

    function viewProduct(e,id){
    var user_age = $('#user_age').val();
    
      if(user_age == ''){ 
        showAgeSiteModal(id);
      }else{    
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
    }
  
    function viewMealsProduct(e,id){
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
            $('#OrderShowModal .modal-content').html(data.view);    
            $('#OrderShowModal').modal('show');    
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
  function load_more(e,place){
     var type= $('#ptype').val();  
     $(e).text('Please wait..');
     var _totalCurrentResult=$(".product-box").length;
       $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({  
        url :"{{route('get_products')}}",  
        method:"POST",  
        dataType:"json",  
        data:{type:type,place:place,drink_count:$('#drink_count').val(),meals_count:$('#meals_count').val(),_totalCurrentResult:_totalCurrentResult},
        success: function(data){ 
          if(data.success==1){
            $('#fbOrderDrinks').append(data.view);
         
         if(data.view ==''){
           $('.load-more').hide();
         }
         $(e).text('Load More');
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
    
    
   function update_qty(pid,row_id,type){
     
       $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({  
        url :"{{route('updateQty')}}",  
        method:"POST",  
        dataType:"json",  
        data:{pid:pid,row_id:row_id,type:type},
        success: function(data){ 
          if(data.status==1){
               toastr.success(data.msg,'Success');
         $('.cart_count').html(data.cart_count);
            if(data.cart_count ==0){
              $('.cart_count').hide();
            }else{
              $('.cart_count').show();
            }
        
         $('#product_'+pid).html(data.cart_view);
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
  
    $(".dropdownSelect dt a").on('click', function () {
            $(".dropdownSelect dd ul").slideToggle('fast');
        });
  
        $(".dropdownSelect dd ul li a").on('click', function () {
            $(".dropdownSelect dd ul").hide();
        });
  
        function getSelectedValue(id) {
             return $("#" + id).find("dt a span.value").html();
        }
  
        $(document).bind('click', function (e) {
            var $clicked = $(e.target);
            if (!$clicked.parents().hasClass("dropdownSelect")) $(".dropdownSelect dd ul").hide();
        });
  
  
        $('.mutliSelect input[type="checkbox"]').on('click', function () {
          
            var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
                title = $(this).val() + ",";
          
            if ($(this).is(':checked')) {
                var html = '<span title="' + title + '">' + title + '</span>';
                $('.multiSel').append(html);
                $(".hida").hide();
            } 
            else {
                $('span[title="' + title + '"]').remove();
                var ret = $(".hida");
                $('.dropdownSelect dt a').append(ret);
                
            }
        });
  
        $(".dropdownSelect").click(function(){
          $(".dropdownSelect a span.hida").toggleClass("dropIcon");
        });
</script>
@endsection