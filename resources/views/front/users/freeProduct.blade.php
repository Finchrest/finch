<style>
  .Coupon .modal-content {
    width: 1000px;
    margin: 0 auto;
  }

  .OrderShowModal {
    width: 100%;
    margin: 0 auto;
  }
</style>
<div class="modal-header">
  <h5 class="modal-title text-white" id="staticBackdropLabel">Add Free Product<span class="otp_code"></span></h5>
  <!-- <h2 class="text-white">Passport/Coupon Code <span class="otp_code"></span></h2> -->
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <div class="row m-0 mx-sm-0">
    @foreach($products as $product)

    @php
    if(!empty($product->badge_file)){
    $badge_icon = asset($product->BadgeFileId->file);
    }else{
    $badge_icon = asset('images/no_image.jpg');
    }
    if(!empty($product->file_id)){
    $pimg = asset($product->FileId->file);
    }else{
    $pimg = asset('images/no_image.jpg');
    }
    @endphp

    <div class="col-md-12 px-sm-0 product-box 12312" id="product_{{$product->id}}">
      <a href="javascript:void(0);" class="d-block">
        <div class="fbOrderDetails w-100 text-white">
          <div class="row">
            <div class="col-md-2 col-3 pr-0 text-center">
              <div class="odrImg2 w-100">
                <img src="{{$pimg}}" class="img-fluid" alt="NO Image">
              </div>
            </div>
            <div class="col-md-5 col-6">
              <div class="OdrMiddleText w-100 mx-2">
                <h5 class="mb-md-3 one-line-text">{{$product->title}}</h5>
                <p class="mb-md-4 mb-2 clr_blue">{{$product->sub_title}}</p>
                <p class="mb-md-4 m-0 four-line-text">{{strtolower($product->short_description)}}</p>

              </div>
            </div>
            <div class="col-3 pr-0 text-center HideOnMob">
              <div class="odrImg3 w-100 d-table h-100">
                <div class="d-table-cell align-middle">
                  <img src="{{ $badge_icon }}" class="img-fluid" alt="NO Image" width="175px" height="170px">
                </div>
              </div>
            </div>
            <div class="col-md-2 col-3">
              <div class="OdrPriceDetails w-100 text-right">
                <h5><i class="fa fa-inr" aria-hidden="true"></i>
                  <span>0.00</span>
                </h5>

                <div class="AddMoreBtn <?php echo $product->location; ?>" style="<?php if (isset($cart[$product->id]) && $product->is_product_attr == 0) {
                                                                                    echo 'display:none;';
                                                                                  } ?>" id="addBtn_{{$product->id}}">
                  <?php if (isset($product->stock) && $product->stock == 1) { ?>
                    <p href="javascript:void(0);" class="btn m-0 onOrder onOrder2 drinkAdd" id="vproductBtn_{{$product->id}}" onclick="freeaddToCart(this,'{{$product->id}}','1'); return false;">Add</p>
                  <?php } else { ?>
                    <p href="javascript:void(0);" class="btn m-0 onOrder onOrder2 outOfStockDrink" id="vproductBtn_{{$product->id}}">Out of stock</p>
                  <?php } ?>
                </div>

                <div class="QuntityCount pt-2 text-center" id="QuntityCount_{{$product->id}}" style="display: inline-table;<?php if (!isset($cart[$product->id]) || $product->is_product_attr == 1) {
                                                                                                                              echo 'display:none;';
                                                                                                                            } ?>">
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

    @endforeach
  </div>
</div>
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

<script>
  function freeaddToCart(e, id, qty) {


    if (user_id == 'no') {
      toastr.error('Please login first!!', 'Error');
      showLoginPage();
      return false;
    }
    $(e).find('.st_loader').show();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var location_id = "<?php echo (session('location') ? session('location') : 0); ?>";
    if (location_id == 0) {
      location_id = "<?php echo isset($product) ? $product->location : 0; ?>";
      console.log(location_id);
      if (location_id > 0) {
        $.ajax({
          url: "{{route('setLocations')}}",
          method: "POST",
          dataType: "json",
          data: {
            location_id: location_id
          },
          success: function(data) {
            if (data.success == 1) {
              toastr.success(data.message, 'Success');
              //location.reload();
              setTimeout(function() {
                window.location.href = data.url;
              }, 3000);
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
            $('#OrderShowModal').modal('hide');
            $('#BeerOrderShowModal').modal('hide');
          }
        });
        return;
      }
    }

    if (location_id > 0) {
      $.ajax({
        url: "{{ route('freeaddToCart') }}",
        method: "POST",
        data: {
          'instruction': '',
          'id': id,
          'qty': qty,
        },
        success: function(data) {
          if (data.success == 1) {
            toastr.success(data.message, 'Success');
            $('.cart_count').html(data.cart_count);
            if (data.cart_count == 0) {
              $('.cart_count').hide();
            } else {
              $('.cart_count').show();
            }
            $('#cart_data').html(data.cart_view);
            $('#product_' + data.pid).html(data.product_view);
            $('.top_location_name').text(data.location_name);
            $(e).find('.st_loader').hide();
            $('#OrderShowModal').modal('hide');
            $('#BeerOrderShowModal').modal('hide');
            location.reload()
          } else if (data.success == 0) {
            toastr.error(data.message, 'Error');
            $(e).find('.st_loader').hide();
          } else if (data.success == 2) {
            toastr.error(data.message, 'Error');
            showLoginPage('login');
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

  function viewProduct(e, id) {
    var user_age = $('#user_age').val();
    // alert(id);
    if (user_age == '') {
      showAgeSiteModal(id);
    } else {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{route('freeproductView')}}",
        method: "POST",
        dataType: "json",
        data: {
          id: id
        },
        success: function(data) {
          if (data.success == 1) {
            $('#BeerOrderShowModal .modal-content').html(data.view);
            $('#BeerOrderShowModal').modal('show');
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
</script>