@extends('layouts.app')
@section('content')



<style>
  th,
  td {
    color: #fff;
  }

  td img {
    width: 100px;
    height: 150px;
  }

  .passportcodeView,
  .couponcodeView {
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
                <tr style="white-space: nowrap;">
                  <th class="text-left">Product Details</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>

                @php

                $subTotal = $total_tax = $total_vat = $final_total = 0;
                @endphp
                @foreach($product_arr as $product)
                <?php if (empty($product['freeProduct'])) {
                  $product_price = $product['product_price'];
                } else {
                  $product_price = 0;
                }
                ?>


                @php
                if(!empty($product['product_price'])){
                $subTotal += $product['qty'] * $product_price;

                if($product['product_type'] == 1){
                $total_vat += $product['qty'] * ($product_price * $product['product_tax'] / 100);
                }else{
                $total_tax += $product['qty'] * ($product_price * $product['product_tax'] / 100);
                }
                $final_total += $product['qty'] * $product_price +$total_vat;
                }else{
                $subTotal += $product['qty'] * $product['price'];
                }

                @endphp
                <tr id="{{ $product['id'] }}">
                  <td class="text-left align-middle">
                    <div class="row">
                      <div class="odrImg2 col-4 text-center">
                        <img src="{{ $product['image'] }}" class="img-fluid" alt="NO Image">
                      </div>
                      <div class="OdrMiddleText col-8">
                        <h5 class="<?php echo (!empty($product['option_name']) ? 'mb-md-1' : 'mb-md-3'); ?>">{{ $product['name'] }}</h5>
                        <?php if (!empty($product['option_name'])) { ?>
                          <div class="cart_attr_option mb-md-3">{{ $product['attr_name'] }} : {{ $product['option_name'] }}</div>
                        <?php } ?>
                        <a href="javascript:void(0)" onclick="removeItem('{{ $product['id'] }}','{{ $product['rowId'] }}'); return false;" class="text-danger">Remove</a>
                      </div>
                    </div>
                  </td>
                  <?php if (empty($product['freeProduct'])) {

                  ?>
                    <td>

                      <div class="con-checkout-strip">
                        <i class="fa fa-inr" aria-hidden="true"></i>
                        @if(!empty($product['product_price']))
                        {{ number_format($product['product_price'],2) }}
                        @else
                        {{ number_format($product['price'],2) }}
                        @endif
                      </div>
                    </td>
                  <?php } else {

                  ?>
                    <td>
                      <div class="con-checkout-strip">
                        <i class="fa fa-inr" aria-hidden="true"></i>
                        0.00
                      </div>
                    </td>
                  <?php } ?>
                  <td class="align-middle">
                    <div class="submitBtn ml-2">
                      {{ $product['qty'] }} &nbsp;
                      <button class="btn fbBtn1 mt-1 mt-md-0" style="min-width:100px;" onclick="viewProduct(this,`{{ $product['rowId']}}`,`{{ $product['qty'] }}`); return false">Quantity</button>
                    </div>
                  </td>

                  <!-- <td> -->
                  <?php if (empty($product['freeProduct'])) { ?>
                    <td class="align-middle" style="white-space: nowrap;">
                      <div class="OdrPriceDetails w-100">
                        <h5><i class="fa fa-inr" aria-hidden="true"></i>
                          @if(!empty($product['product_price']))
                          <span>{{ number_format($product['qty'] * $product['product_price'],2) }}</span>
                          @else
                          <span>{{ number_format($product['qty'] * $product['price'],2) }}</span>
                          @endif
                        </h5>


                      </div>
                      <!-- <div class="con-checkout-strip">
                                <p><i class='fa fa-inr' aria-hidden='true'></i> {{ $product['price'] }}</p>
                            </div> -->

                    </td>

                  <?php } else { ?>
                    <td>
                      <div class="con-checkout-strip">
                        <i class="fa fa-inr" aria-hidden="true"></i>
                        0.00
                      </div>
                    </td>
                  <?php } ?>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="clearfix"></div>
          <div class="checkout-second-row">
            <div class="row">
              <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-12 fbUpperHeading">
                <?php
                if ($user->passport_order != Null) {
                ?>
                  <p class="add-text passportViewCode"><span>Free Product</span> <a href="javascript:void(0)" class="text-warning" onclick="freeProduct(this,<?php echo $user->passport_order ?>); return false;" title="Add Passport Code"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></p>
                  <?php
                } else {
                  if (session('orderType') == 1) {
                  ?>
                    <p class="add-text passportViewCode"><span> Passport Code</span> <a href="javascript:void(0)" class="text-warning" onclick="codeView(this,2,'passportcodeView'); return false;" title="Add Passport Code"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></p>
                    <p class="add-text passportcodeView"><span class=""></span> <a href="javascript:void(0)" class="text-danger" onclick="removeCode(this, 'passportViewCode', 'couponViewCode'); return false;" title="Remove Passport Code"><i class="fa fa-trash" aria-hidden="true"></i></a></p>
                    <p class="add-text couponViewCode"><span>Coupon Code</span> <a href="javascript:void(0)" class="text-warning" onclick="codeView(this,4,'couponcodeView'); return false;" title="Add Coupon Code"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></p>

                    <p class="add-text couponcodeView"><span class=""></span> <a href="javascript:void(0)" class="text-danger" onclick="removeCode(this, 'passportViewCode', 'couponViewCode'); return false;" title="Remove Coupon Code"><i class="fa fa-trash" aria-hidden="true"></i></a></p>
                  <?php
                  } else {
                  ?>
                    <p class="add-text couponViewCode"><span>Coupon Code</span> <a href="javascript:void(0)" class="text-warning" onclick="codeView(this,4,'couponcodeView'); return false;" title="Add Coupon Code"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></p>

                    <p class="add-text couponcodeView"><span class=""></span> <a href="javascript:void(0)" class="text-danger" onclick="removeCode(this, 'passportViewCode', 'couponViewCode'); return false;" title="Remove Coupon Code"><i class="fa fa-trash" aria-hidden="true"></i></a></p>
                <?php

                  }
                }

                ?>
                <!-- <p class="add-text couponViewCode">
                        <span> Delivery Order 
                        <input type="radio" class="order_for" onchange="checkOrdertype(this.value);return false;" name="order_for" checked value="0">
                        </span> 
                        <span> Takeaway Order 
                        <input type="radio" class="order_for" onchange="checkOrdertype(this.value);return false;" name="order_for"  value="1"></span> </p> -->
                <p class="add-text d-none"><span>Accepted Payment Methods</span></p>
                <!-- <ul class="list-inline">
                           <li class="d-inline-block"><img src="{{ asset('front-assets/images/blogmastercard.png') }}" width="30" alt=""></li>
                           <li class="d-inline-block"><img src="{{ asset('front-assets/images/blogvisa.png') }}" width="30" alt=""></li>
                        </ul> -->

              </div>

              <!--col-md-6 col-lg-6 col-xl-6 col-sm-12 col-12-->
              <div class="col-md-2 col-lg-4 col-xl-4 col-sm-12 col-12">
              </div>
              <div class="col-md-6 col-lg-4 col-xl-4 col-sm-12 col-12">
                <table class="table table-borderless-5 checkoutCalculation">
                  <tr>
                    <td class="border-0">SubTotal</td>
                    <td class="text-right border-0"><b> <i class='fa fa-inr' aria-hidden='true'></i> <span class="cat_sub_total">{{ number_format($subTotal,2) }}</span></b></td>
                    <input type="hidden" id="sub_Total" name="sub_Total" value="{{Cart::subtotal()}}">
                    <input type="hidden" id="codeType" name="code_type" value="">
                    <input type="hidden" id="codeNum" name="code_num" value="">
                    <input type="hidden" id="codeAmt" name="code_amt" value="">

                  </tr>
                  <tr>
                    <td class="position-relative">Tax <a href="javascript:void(0)" class="HoverToolTip position-relative"><i class="fa fa-info-circle" aria-hidden="true"></i>
                        <p class="position-absolute">According to goverment tax are include in all meals products.</p>
                      </a></td>
                    <td class="text-right"><i class='fa fa-inr' aria-hidden='true'></i> <b><span class="total_tax"> {{ number_format($total_tax,2) }}</span></b></td>
                  </tr>
                  <tr>
                    <td class="position-relative">Vat <a href="javascript:void(0)" class="HoverToolTip position-relative"><i class="fa fa-info-circle" aria-hidden="true"></i>
                        <p class="position-absolute">According to goverment vat are include in all liquor products.</p>
                      </a></td>
                    <td class="text-right"><i class='fa fa-inr' aria-hidden='true'></i> <b><span class="total_vat"> {{ intval($total_vat) }}</span></b></td>
                  </tr>
                  <tr>
                    <td>Passport Discount </td>
                    <td class="text-right"><i class='fa fa-inr' aria-hidden='true'></i> <b><span class="passport_discount"> 0.00</span></b></td>
                  </tr>
                  <tr>
                    <td>Coupon Discount </td>
                    <td class="text-right"><i class='fa fa-inr' aria-hidden='true'></i><b><span class="coupon_discount"> 0.00</span></b></td>
                  </tr>
                  <?php if ($delivery_tax != 0) { ?>
                    <tr>
                      <td>Delivery Charges</td>
                      <td class="text-right"><i class='fa fa-inr' aria-hidden='true'></i>
                        <b><span class="delivery_charge"><?php if (session('orderType') == 0) {
                                                            echo number_format($dCharges, 2);
                                                          } else {
                                                            echo '0.00';
                                                          } ?></span></b>
                      </td>
                    </tr>
                    <tr>
                      <td>Delivery Tax</td>
                      <td class="text-right"><i class='fa fa-inr' aria-hidden='true'></i>
                        <b><span class="delivery_tax"><?php if (session('orderType') == 0) {
                                                        echo number_format($delivery_tax, 2);
                                                      } else {
                                                        echo '0.00';
                                                      } ?></span></b>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                  <td> Grand total</td>
                  <td class="text-right orange-text"><b><i class='fa fa-inr' aria-hidden='true'></i> <span class="cat_total">{{ number_format($final_total,2) }} </span></b>
                    <input type="hidden" name="subtotal" id="final_total" value="{{ number_format($final_total,2) }}">
                  </td>
                  </tr>
                </table>
                <div class="cart-btn-group">
                  <?php if (Auth::check()) { ?>
                    <a class="btn fbBtn1 px-4 checkout-btn w-100" href="javascript:void(0);" onclick="cart_checkout_view(this)"><b><i class='fa fa-inr' aria-hidden='true'></i> <span class="cat_total">{{ number_format($final_total,2) }} </span></b> GO TO CHECKOUT <i class="fa fa-lock" aria-hidden="true"></i><i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></a>
                    <!-- <a href="javascript:void(0)" class="btn btn-block checkout-btn" onclick="cartProcess(this)"><i class="fa fa-lock" aria-hidden="true"></i> Secure Checkout <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></a> -->
                  <?php } else { ?>
                    <a class="btn fbBtn1 px-4 checkout-btn w-100" href="{{ route('login') }}"><i class="fa fa-lock" aria-hidden="true"></i> Secure Checkout </a>


                    <!-- <a href="{{ route('login') }}" class="btn btn-block checkout-btn"><i class="fa fa-lock" aria-hidden="true"></i> Secure Checkout </a> -->
                  <?php } ?>
                  @if(!empty($product_arr[0]['place_id']))
                  <a class="btn fbBtn1 px-4 w-100 my-4" href="{{url('product/'.$product_arr[0]['place_id'])}}">CONTINUE SHOPPING</a>
                  @else
                  <a class="btn fbBtn1 px-4 w-100 my-4" href="{{route('home')}}">CONTINUE SHOPPING</a>
                  @endif
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
<div class="modal fade PassportModal1 OrderShowModal" id="productModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="max-width:90%">
    <div class="modal-content">

    </div>
  </div>
</div>
@endsection


<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="{{ asset('front-assets/js/jquery.min.js') }}"></script>
<script>
  $(document).ready(function() {
    // window.location.href = "{{url('/')}}";
    let id = $('.order_for:checked').val();

    checkOrdertype(id);
  });


  function checkOrdertype(val) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{ route('checkout.total.view') }}",
      method: "POST",
      data: {
        'orderType': val
      },
      success: function(data) {
        $('#codeType').val('passport');
        $('.checkoutCalculation').html(data.view);
        $('.passport_discount').text(data.coupon_amount);
        $('.cat_total').text(data.total_amt);
        $("[name='subtotal']").val(data.total_amt);

        $('.passportcodeView span').text(data.code);

      },
      error: function(data) {
        if (typeof data.responseJSON.status !== 'undefined') {
          toastr.error(data.responseJSON.error, 'Error');
        } else {
          $.each(data.responseJSON.errors, function(key, value) {
            toastr.error(value, 'Error');
          });
        }
        // $(e).find('.st_loader').hide();
      }

    });
  }

  function getCheckoutData() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{ route('getCheckoutData') }}",
      method: "GET",
      data: {},
      success: function(data) {
        $('#checkoutData').html(data.checkout_view);
      },
      error: function(data) {
        if (typeof data.responseJSON.status !== 'undefined') {
          toastr.error(data.responseJSON.error, 'Error');
        } else {
          $.each(data.responseJSON.errors, function(key, value) {
            toastr.error(value, 'Error');
          });
        }
        $(e).find('.st_loader').hide();
      }

    });
  }


  function removeItem(id, rowId) {
    if (confirm('Are you sure want to remove this item from cart?')) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{ route('removeItem') }}",
        method: "POST",
        data: {
          id: id,
          rowId: rowId
        },
        success: function(data) {
          toastr.success(data.message, 'Success');
          $('.cart_count').html(data.cart_count);
          if (data.cart_count == 0) {
            window.location.href = "{{url('/')}}";
          } else {
            $('.cart_count').show();
            $('.cat_sub_total').html(data.cart_sub_total);
            $('.cat_total').html(data.cart_total);
            $("[name='subtotal']").val(data.cart_total);
            $('#cart_data').html(data.cart_view);
            $('#checkoutData tr#' + id).remove();
            location.reload();
          }

        },
        error: function(data) {
          if (typeof data.responseJSON.status !== 'undefined') {
            toastr.error(data.responseJSON.error, 'Error');
          } else {
            $.each(data.responseJSON.errors, function(key, value) {
              toastr.error(value, 'Error');
            });
          }
          $(e).find('.st_loader').hide();
        }

      });
    }
  }


  function cart_checkout_view(e) {
    var amt = $("[name='subtotal']").val();
    var codeType = $('#codeType').val();
    var codeNum = $('#codeNum').val();
    var codeamta = $('#codeAmt').val();
    if (codeamta === '') {
      var codeAmt = $(".passport_discount").html();
    } else {
      var codeAmt = codeamta;
    }

    var order_for = $('.order_for:checked').val();
    $(e).find('.st_loader').show();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{ route('cart_checkout_view') }}",
      method: "POST",
      data: {
        amt: amt,
        codeType: codeType,
        codeNum: codeNum,
        codeAmt: codeAmt,
        'order_for': order_for
      },
      success: function(data) {
        if (data.status == 1) {
          $('#productModal .modal-content').html(data.view);
          $('#productModal').modal({
            backdrop: 'static'
          });
        } else if (data.status == 0) {
          toastr.error(data.message, 'Error');
          $(e).find('.st_loader').hide();
        }
      },
      error: function(data) {
        if (typeof data.responseJSON.status !== 'undefined') {
          toastr.error(data.responseJSON.error, 'Error');
        } else {
          $.each(data.responseJSON.errors, function(key, value) {
            toastr.error(value, 'Error');
          });
        }
        $(e).find('.st_loader').hide();
      }

    });
  }

  function cartProcess(e) {

    $(e).find('.st_loader').show();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{ route('cartProcess') }}",
      method: "POST",
      data: $(e).serialize(),
      success: function(data) {
        if (data.success == 1) {
          toastr.info(data.message, 'Info');
          $('.st_loader').hide();
          razorpay_payment_view(data.id);
          // setTimeout(function(){
          //   var url = '/';
          //   // url = url.replace(':id', data.id);
          //   window.location.href=url;
          // }, 3000);
        } else if (data.success == 0) {
          toastr.error(data.message, 'Error');
          $(e).find('.st_loader').hide();
        }
      },
      error: function(data) {
        if (typeof data.responseJSON.status !== 'undefined') {
          toastr.error(data.responseJSON.error, 'Error');
        } else {
          $.each(data.responseJSON.errors, function(key, value) {
            toastr.error(value, 'Error');
          });
        }
        $(e).find('.st_loader').hide();
      }

    });
  }

  function codeView(e, type, id) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{route('codeView')}}",
      method: "POST",
      data: {
        type: type
      },
      success: function(res) {
        if (res.success == 0) {
          toastr.error(res.message, 'Error');
        } else if (res.success == 1) {
          $('#infoModal .modal-content').html(res.view);
          $('#infoModal').modal('show');
        }
      },
      error: function(data) {
        if (typeof data.responseJSON.status !== 'undefined') {
          toastr.error(data.responseJSON.error, 'Error');
        } else {
          $.each(data.responseJSON.errors, function(key, value) {
            toastr.error(value, 'Error');
          });
        }
        $(e).find('.st_loader').hide();
      }

    });
  }

  function freeProduct(e, id) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{route('freeProduct')}}",
      method: "POST",
      data: {
        id: id
      },
      success: function(res) {
        if (res.success == 0) {
          toastr.error(res.message, 'Error');
        } else if (res.success == 1) {
          $('#infoModal .modal-content').html(res.view);
          $('#infoModal').modal('show');
        }
      },
      error: function(data) {
        if (typeof data.responseJSON.status !== 'undefined') {
          toastr.error(data.responseJSON.error, 'Error');
        } else {
          $.each(data.responseJSON.errors, function(key, value) {
            toastr.error(value, 'Error');
          });
        }
        $(e).find('.st_loader').hide();
      }

    });
  }

  function sendOtp(e, id, type) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{route('sendPassportOtp')}}",
      method: "POST",
      data: $('#' + id).serialize(),
      dataType: 'json',
      success: function(res) {
        if (res.success == 0) {
          toastr.error(res.message, 'Error');
        } else if (res.success == 1) {
          toastr.success(res.message, 'Success');
          // $('.modal-header .otp_code').text(res.otp);  
          $('.otp_div').show();
          $('.no_otp').hide();
        }
      },
      error: function(data) {
        if (typeof data.responseJSON.status !== 'undefined') {
          toastr.error(data.responseJSON.error, 'Error');
        } else {
          $.each(data.responseJSON.errors, function(key, value) {
            toastr.error(value, 'Error');
          });
        }
        $(e).find('.st_loader').hide();
      }

    });
  }

  function otpVerify(e, id, type) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{route('passportOtpVerify')}}",
      method: "POST",
      data: $('#' + id).serialize(),
      dataType: 'json',
      success: function(res) {
        if (res.success == 0) {
          toastr.error(res.message, 'Error');
        } else if (res.success == 1) {
          $('#codeType').val('passport');
          // console.log(res);
          toastr.success(res.message, 'Success');
          $('#infoModal').modal('hide');
          $('.passport_discount').text(res.coupon_amount);
          $('.cat_total').text(res.total_amt);
          $("[name='subtotal']").val(res.total_amt);
          $('.couponViewCode').hide();
          $('.passportViewCode').hide();
          $('.passportcodeView').show();
          $('.passportcodeView span').text(res.code);
          $('#codeNum').val(res.code);
          $('#codeAmt').val(res.coupon_amount);
          location.reload()
        }
      },
      error: function(data) {
        if (typeof data.responseJSON.status !== 'undefined') {
          toastr.error(data.responseJSON.error, 'Error');
        } else {
          $.each(data.responseJSON.errors, function(key, value) {
            toastr.error(value, 'Error');
          });
        }
        $(e).find('.st_loader').hide();
      }

    });
  }

  function applyCode(e, id, type) {

    var code = $('#' + id).val();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{route('applyCouponCode')}}",
      method: "POST",
      data: {
        code: code,
        type: type
      },
      success: function(res) {
        if (res.success == 0) {
          toastr.error(res.message, 'Error');
        } else if (res.success == 1) {
          if (type == 2) {
            toastr.success(res.message, 'Success');
            $('#infoModal').modal('hide');
            $('.passport_discount').text(res.coupon_amount);
            $('.cat_total').text(res.total_amt);
            $("[name='subtotal']").val(res.total_amt);
            $('#codeType').val('passport');
            $('#codeNum').val(res.code);
            $('#codeAmt').val(res.coupon_amount);
            // $('.couponcodeView').hide();
          } else {
            toastr.success(res.message, 'Success');
            $('#infoModal').modal('hide');
            $('.coupon_discount').text(res.coupon_amount);
            $('.cat_total').text(res.total_amt);
            $("[name='subtotal']").val(res.total_amt);
            $('.passportViewCode').hide();
            $('.couponViewCode').hide();
            $('.couponcodeView').show();
            $('.couponcodeView span').text(res.code);
            $('#codeType').val('coupon');
            $('#codeNum').val(res.code);
            $('#codeAmt').val(res.coupon_amount);
          }
        }
      },
      error: function(data) {
        if (typeof data.responseJSON.status !== 'undefined') {
          toastr.error(data.responseJSON.error, 'Error');
        } else {
          $.each(data.responseJSON.errors, function(key, value) {
            toastr.error(value, 'Error');
          });
        }
        $(e).find('.st_loader').hide();
      }

    });
  }

  function removeCode(e, cls1, cls2) {
    $(e).parent('p').hide();
    $('.' + cls1).show();
    $('.' + cls2).show();
    var orderType = "<?php echo session('orderType'); ?>";
    var sub_Total = parseFloat($('#sub_Total').val().replace(/\,/g, ''));
    var total_tax = parseFloat($('.total_tax').text().replace(/\,/g, ''));
    var total_vat = parseFloat($('.total_vat').text().replace(/\,/g, ''));
    var deliveryCharge = parseFloat($('.delivery_charge').text().replace(/\,/g, ''));
    var delivery_tax = parseFloat($('.delivery_tax').text().replace(/\,/g, ''));
    var passport_discount = parseFloat($('.passport_discount').text());
    var coupon_discount = parseFloat($('.coupon_discount').text());
    if (orderType == 0) {
      var final_total = sub_Total + total_tax + total_vat + deliveryCharge + delivery_tax;
    } else {
      var final_total = sub_Total + total_tax + total_vat;
    }
    final_total = final_total.toFixed(2);

    // alert(orderType)
    //console.log('sub_Total = '+sub_Total+' total_tax= '+total_tax+' total_vat= '+total_vat+' final_total='+final_total);

    $('.cat_total').text(final_total);
    $("[name='subtotal']").val(final_total);
    $('.passport_discount').text('0.00');
    $('.coupon_discount').text('0.00');
  }


  function viewProduct(e, row_id, qty) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{route('productView')}}",
      method: "POST",
      dataType: "json",
      data: {
        row_id: row_id,
        qty: qty
      },
      success: function(data) {
        if (data.success == 1) {
          $('#infoModal .modal-content').html(data.view);
          $('#infoModal').modal('show');
        }
      },
      error: function(data) {
        if (typeof data.responseJSON.status !== 'undefined') {
          toastr.error(data.responseJSON.error, 'Error');
        } else {
          $.each(data.responseJSON.errors, function(key, value) {
            toastr.error(value, 'Error');
          });
        }
        $(e).find('.st_loader').hide();
      }
    });
  }


  function razorpay_payment_view(ord_id) {

    window.your_route = "{{ route('paymentSuccessRedirect') }}";
    var val = $("[name='subtotal']").val().replace(/,/g, '');
    $("[name='subtotal']").val(val);
    var amt_val = $("[name='subtotal']").val() * 100;
    amt_val = amt_val.toFixed(2)
    if (amt_val == 0) {

      $.ajax({
        url: "{{ route('cart.payment_submit') }}",
        method: "POST",
        dataType: "json",
        data: {
          id: ord_id,
          pay_method: 'direct_payment',
          status: 1
        },
        success: function(res) {
          if (res.status == 0) {
            var err = JSON.parse(res.msg);
            var er = '';
            $.each(err, function(k, v) {
              er += v + '<br>';
            });
            toastr.error(er, 'Error');
            $('#copatiblity_form_data .submitBtn').removeAttr('disabled');
          } else if (res.status == 1) {
            toastr.success(res.msg, 'Success');
            setTimeout(function() {
              paymentSuccessRedirect(this, ord_id);
            }, 500);
          }
          $('.st_loader').hide();
        }
      });

    } else {
      var options = {
        "key": "{{ env('RAZORPAY_KEY') }}", // Enter the Key ID generated from the Dashboard

        "amount": amt_val, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "INR",
        "name": "Finch Brew",
        "description": "Passport Transaction",
        "image": "https://finchbrewcafe.com/front-assets/images/logo.png",
        "partial_payment": 1, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        'custom_branding': true,
        "handler": function(response) {
          // console.log('success - '+response.razorpay_payment_id);
          // console.log('success status - '+response.status);
          // return false;

          $.ajax({
            url: "{{ route('cart.payment_submit') }}",
            method: "POST",
            dataType: "json",
            data: {
              id: ord_id,
              pay_id: response.razorpay_payment_id,
              res: response,
              status: 1
            },
            success: function(res) {
              if (res.status == 0) {
                var err = JSON.parse(res.msg);
                var er = '';
                $.each(err, function(k, v) {
                  er += v + '<br>';
                });
                toastr.error(er, 'Error');
                $('#copatiblity_form_data .submitBtn').removeAttr('disabled');
              } else if (res.status == 1) {
                toastr.success(res.msg, 'Success');
                setTimeout(function() {
                  paymentSuccessRedirect(this, ord_id)
                }, 300);
              }
              $('.st_loader').hide();
            }
          });
        },
        "prefill": {
          "name": "{{auth()->user()->name}}",
          "email": "{{auth()->user()->email}}",
          "contact": "{{auth()->user()->phone}}",
          "order_id": ord_id
        },
        "notes": {
          "address": "Razorpay Corporate Office"
        },
        "theme": {
          "color": "#3399cc"
        }
      };
      var rzp1 = new Razorpay(options);
      rzp1.on('payment.failed', function(response) {
        // console.log('failed - '+response);
        // return false;

        $.ajax({
          url: "{{ route('cart.payment_submit') }}",
          method: "POST",
          dataType: "json",
          data: {
            id: ord_id,
            pay_id: response.error.metadata.payment_id,
            res: response,
            status: 2
          },
          success: function(res) {
            if (res.status == 0) {
              var err = JSON.parse(res.msg);
              var er = '';
              $.each(err, function(k, v) {
                er += v + '<br>';
              });
              toastr.error(er, 'Error');
              $('#copatiblity_form_data .submitBtn').removeAttr('disabled');
            } else if (res.status == 2) {
              toastr.error(res.msg, 'Error');
              //location.reload();
            }
            $('.st_loader').hide();
          }
        });
        // alert(response.error.code);

      });
      rzp1.open();
      event.preventDefault();
    }

  }

  function paymentSuccessRedirect(e, orderId) {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{route('paymentSuccessRedirect')}}",
      method: "POST",
      dataType: "json",
      data: {
        id: orderId
      },
      success: function(data) {
        if (data.success == 0) {
          toastr.error
        } else if (data.success == 1) {

          $('#infoModal .modal-content').html(data.view);
          $("#infoModal").modal({
            backdrop: "static"
          });
          $('#infoModal').modal('show');

        }
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