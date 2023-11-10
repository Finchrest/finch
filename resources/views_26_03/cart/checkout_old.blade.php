@extends('layouts.app')
@section('content')
<style>
  th, td{
    color: #fff;
  }
  td img{
    width: 100px;
    height: 150px;
  }
  .passportcodeView, .couponcodeView{
    display: none;
  }
</style>
<section class="insidepage-content-1 my-5 pt-md-5 checkOutpage">
   <div class="container pt-md-5">
      <div class="row mb-5">
         <div class="col-md-12 text-center">
            <h1 class="sub-header-title text-warning" style="font-size: 30px;">Checkout</h1>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="full-width-white-strip">
               <div class="table-responsive" id="checkoutData">
                  <table class="table table-borderless checkout-table fbOrderDetails text-center">
                     <thead>
                      <tr>
                          <th class="text-left">Product Details</th>
                          <th>Quantity</th>
                          <th>Total</th>
                      </tr>
                     </thead>
                     <tbody>
                      <?php foreach($product_arr as $product){ ?>
                      <tr id="{{ $product['id'] }}">
                          <td class="text-left align-middle">
                            <div class="row">  
                          <div class="odrImg2 col-4 text-center">
                                <img src="{{ $product['image'] }}" class="img-fluid" alt="NO Image">
                              </div>
                              <div class="OdrMiddleText col-8">
                                <h5 class="mb-md-3">{{ $product['name'] }}</h5>
                                <a href="javascript:void(0)" onclick="removeItem('{{ $product['id'] }}','{{ $product['rowId'] }}'); return false;" class="text-danger">Remove</a>
                              </div>
                            </div>
                          </td>
                          <!-- <td>
                            <div class="con-checkout-strip">
                            </div>
                          </td> -->
                          <td class="align-middle">
                          <div class="submitBtn ml-2">
                          {{ $product['qty']}} &nbsp;
                          <button class="btn fbBtn1" style="min-width:150px;" onclick="viewProduct(this,`{{ $product['rowId']}}`,`{{ $product['qty']}}`); return false">Change Quantity</button>
                          </div> 
                        </td>

                          <!-- <td> -->
                          <td class="align-middle">
                          <div class="OdrPriceDetails w-100">
                                <h5><i class="fa fa-inr" aria-hidden="true"></i>
                                  <span>{{ $product['price'] }}</span>
                                </h5>

                              </div>
                            <!-- <div class="con-checkout-strip">
                                <p><i class='fa fa-inr' aria-hidden='true'></i> {{ $product['price'] }}</p>
                            </div> -->
                          </td>
                      </tr>
                      <?php } ?>
                     </tbody>
                  </table>
               </div>
               <div class="clearfix"></div>
               <div class="checkout-second-row">
                  <div class="row">
                     <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-12 fbUpperHeading">
                        <p class="add-text passportViewCode"><span> Passport Code</span> <a href="javascript:void(0)" class="text-warning" onclick="codeView(this,2,'passportcodeView'); return false;" title="Add Passport Code"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></p>
                        <p class="add-text passportcodeView"><span class=""></span> <a href="javascript:void(0)" class="text-danger" onclick="removeCode(this,'passportViewCode'); return false;" title="Remove Passport Code"><i class="fa fa-trash" aria-hidden="true"></i></i></p>
                        <p class="add-text couponViewCode"><span> Coupon Code</span> <a href="javascript:void(0)" class="text-warning" onclick="codeView(this,4,'couponcodeView'); return false;" title="Add Coupon Code"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></p>
                        <p class="add-text couponcodeView"><span class=""></span> <a href="javascript:void(0)" class="text-danger" onclick="removeCode(this,'couponViewCode'); return false;" title="Remove Coupon Code"><i class="fa fa-trash" aria-hidden="true"></i></a></p>

                        <p class="add-text"><span>Accepted Payment Methods</span></p>
                        <ul class="list-inline">
                           <li class="d-inline-block"><img src="{{ asset('front-assets/images/blogmastercard.png') }}" width="30" alt=""></li>
                           <li class="d-inline-block"><img src="{{ asset('front-assets/images/blogvisa.png') }}" width="30" alt=""></li>
                        </ul>
                     </div>
                     <!--col-md-6 col-lg-6 col-xl-6 col-sm-12 col-12-->
                     <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-12">
                     </div>
                     <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-12">
                        <table class="table table-borderless-5">
                           <tr>
                              <td class="border-0">SubTotal</td>
                              <td class="text-right border-0"><b> <i class='fa fa-inr' aria-hidden='true'></i> <span class="cat_sub_total">{{Cart::subtotal()}}</span></b></td>
                              <input type="hidden" id="subTotal" value="{{Cart::subtotal()}}">
                           </tr>
                           <tr>
                              <td>Passport Discount </td>
                              <td class="text-right"><i class='fa fa-inr' aria-hidden='true'></i> <b><span class="passport_discount"> 0.00</span></b></td>
                           </tr>
                           <tr>
                              <td>Coupon Discount </td>
                              <td class="text-right"><i class='fa fa-inr' aria-hidden='true'></i><b><span class="coupon_discount"> 0.00</span></b></td>
                           </tr>
                           <tr>
                              <td> Grand total</td>
                              <td class="text-right orange-text"><b ><i class='fa fa-inr' aria-hidden='true'></i> <span class="cat_total">{{Cart::subtotal()}} </span></b></td>
                           </tr>
                        </table>
                        <div class="cart-btn-group">
                           <?php if(Auth::check()) { ?>
                            <a class="btn fbBtn1 px-4 checkout-btn w-100" href="javascript:void(0);"onclick="cartProcess(this)"><i class="fa fa-lock" aria-hidden="true"></i> Secure Checkout <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></a>
                           <!-- <a href="javascript:void(0)" class="btn btn-block checkout-btn" onclick="cartProcess(this)"><i class="fa fa-lock" aria-hidden="true"></i> Secure Checkout <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></a> -->
                           <?php }else{ ?>
                            <a class="btn fbBtn1 px-4 checkout-btn w-100" href="{{ route('login') }}"><i class="fa fa-lock" aria-hidden="true"></i> Secure Checkout </a>


                           <!-- <a href="{{ route('login') }}" class="btn btn-block checkout-btn"><i class="fa fa-lock" aria-hidden="true"></i> Secure Checkout </a> -->
                           <?php } ?>
                           <a class="btn fbBtn1 px-4 w-100 my-4" href="javascript:void(0);">CONTINUE SHOPPING</a>
                           <!-- <a href="" class="btn btn-block continue">CONTINUE SHOPPING</a> -->
                        </div>
                     </div>
                     <!--col-md-6 col-lg-6 col-xl-6 col-sm-12 col-12-->
                  </div>
                  <!--row-->
               </div>
               <!--checkout-second-row-->
            </div>
            <!--full-width-white-strip-->
         </div>
         <!--col-md-12-->
      </div>
   </div>
   <!--container-->
</section>
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document" style="max-width:90%">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
         </div>
      </div>
   </div>
</div>
@endsection
<script> 
  //  $(document).ready(function(){ 
  //  //getCheckoutData()
  //  });
  function getCheckoutData(){  
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({  
      url :"{{ route('getCheckoutData') }}",  
      method:"GET",  
      data:{},
      success: function(data){ 
        $('#checkoutData').html(data.checkout_view);
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
   
   
   function removeItem(id,rowId){  
         
         $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({  
            url :"{{ route('removeItem') }}",  
            method:"POST",  
            data:{rowId:rowId},
            success: function(data){ 
   		 toastr.success(data.message,'Success');
   		 $('.cart_count').html(data.cart_count);
   		 if(data.cart_count ==0){
   			  $('.cart_count').hide();
   		  }else{
   			 $('.cart_count').show();
   		  }
   		  $('.cat_sub_total').html(data.cart_sub_total);
   		  $('.cat_total').html(data.cart_total);
   		  $('#cart_data').html(data.cart_view);
   		  $('#checkoutData tr#'+id).remove();
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
   
   
   function cartProcess(e,pid,type){  
          $(e).find('.st_loader').show();
   	
         $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({  
            url :"{{ route('cartProcess') }}",  
            method:"POST",  
            data:{pid:pid},
            success: function(data){ 
              if(data.success==1){
                toastr.success(data.message,'Success');
                $(e).find('.st_loader').hide();
                setTimeout(function(){
                  var url = '/';
                  // url = url.replace(':id', data.id);
                  window.location.href=url;
                }, 3000);
              }else if(data.success==0){
                toastr.error(data.message,'Error');
                $(e).find('.st_loader').hide();
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
   
  function codeView(e,type,id){  
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({  
      url :"{{route('codeView')}}",  
      method:"POST",  
      data:{type:type},
      success: function(res){ 
        if(res.success == 0){
          toastr.error(res.message,'Error');
        }else if(res.success == 1){
          $('#infoModal .modal-content').html(res.view);    
          $('#infoModal').modal('show');    
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

  function sendOtp(e,id,type){  
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({  
      url :"{{route('sendPassportOtp')}}",  
      method:"POST",  
      data:$('#'+id).serialize(),
      dataType:'json',
      success: function(res){ 
        if(res.success == 0){
          toastr.error(res.message,'Error');
        }else if(res.success == 1){
          toastr.success(res.message,'Success');
          $('.modal-header .otp_code').text(res.otp);  
          $('.otp').show();  
          $('.no_otp').hide();  
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

  function otpVerify(e,id,type){  
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({  
      url :"{{route('passportOtpVerify')}}",  
      method:"POST",  
      data:$('#'+id).serialize(),
      dataType:'json',
      success: function(res){ 
        if(res.success == 0){
          toastr.error(res.message,'Error');
        }else if(res.success == 1){ 
            toastr.success(res.message,'Success');
          $('#infoModal').modal('hide');  
          $('.passport_discount').text(res.coupon_amount);
          $('.cat_total').text(res.total_amt);
          $('.couponViewCode').hide();
          $('.passportViewCode').hide();
          $('.passportcodeView').show();
          $('.passportcodeView span').text(res.code);
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
   
  function applyCode(e,id,type){  
    var code = $('#'+id).val();
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({  
      url :"{{route('applyCouponCode')}}",  
      method:"POST",  
      data:{code:code,type:type},
      success: function(res){ 
        if(res.success == 0){
          toastr.error(res.message,'Error');
        }else if(res.success == 1){
          if(type == 2){
            toastr.success(res.message,'Success');
            $('#infoModal').modal('hide'); 
            $('.passport_discount').text(res.coupon_amount);
            $('.cat_total').text(res.total_amt);
            // $('.couponcodeView').hide();
          }else{
            toastr.success(res.message,'Success');
            $('#infoModal').modal('hide'); 
            $('.coupon_discount').text(res.coupon_amount);
            $('.cat_total').text(res.total_amt);
            $('.passportViewCode').hide();
            $('.couponViewCode').hide();
            $('.couponcodeView').show();
            $('.couponcodeView span').text(res.code);
          }
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

  function removeCode(e,cls){
    $(e).parent('h1').hide();
    $('.'+cls).show();
    
    $('.cat_total').text($('#subTotal').val());
    $('.passport_discount').text('0.00');
    $('.coupon_discount').text('0.00');
  }

  function viewProduct(e,row_id,qty){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({  
      url :"{{route('productView')}}",  
      method:"POST",  
      dataType:"json",  
      data:{row_id:row_id,qty:qty},
      success: function(data){ 
        if(data.success==1){
          $('#infoModal .modal-content').html(data.view);    
          $('#infoModal').modal('show');    
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

  //  function changeItem(id,rowId){  
         
  //        $.ajaxSetup({
  //             headers: {
  //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //             }
  //         });
  //         $.ajax({  
  //           url :"",  
  //           method:"POST",  
  //           data:{rowId:rowId},
  //           success: function(res){ 
  //  		  $('#productModal .modal-body').html(res.view);
  //              $('#productModal').modal('show');
  //           },
  //           error: function(data){ 
  //             if(typeof data.responseJSON.status !== 'undefined'){
  //               toastr.error(data.responseJSON.error,'Error');
  //             }else{
  //               $.each(data.responseJSON.errors, function( key, value ) {
  //                   toastr.error(value,'Error');
  //               });
  //             }
  //             $(e).find('.st_loader').hide();
  //           } 
             
  //         }); 
  //       } 
   
   
  //  function updateCart(e,type){  
  //         $(e).find('.st_loader').show();
   	
  //        $.ajaxSetup({
  //             headers: {
  //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //             }
  //         });
  //         $.ajax({  
  //           url :"",  
  //           method:"POST",  
  //           data:$('#productform').serialize(),
  //           success: function(data){ 
  //             if(data.success==1){
  //               toastr.success(data.message,'Success');
   		
  //  		   $('.cart_count').html(data.cart_count);
  //               if(data.cart_count ==0){
  //  			  $('.cart_count').hide();
  //  		  }else{
  //  			 $('.cart_count').show();
  //  		  }
  //  		  $('#cart_data').html(data.cart_view);
  //  		  $(e).find('.st_loader').hide();
  //  		   $('#productModal').modal('hide');
  //                $('#checkoutData').html(data.checkout_view);
  //             }else if(data.success==0){
  //               toastr.error(data.message,'Error');
  //               $(e).find('.st_loader').hide();
  //             }
  //           },
  //           error: function(data){ 
  //             if(typeof data.responseJSON.status !== 'undefined'){
  //               toastr.error(data.responseJSON.error,'Error');
  //             }else{
  //               $.each(data.responseJSON.errors, function( key, value ) {
  //                   toastr.error(value,'Error');
  //               });
  //             }
  //             $(e).find('.st_loader').hide();
  //           } 
             
  //         }); 
  //       } 
</script> 