@if(!isset($row_id) && empty($row_id))
  @if($product->type == 1)
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <div class="modal-body p-md-5 p-4">
      <div class="FoodDetailsHere FoodBeerDetailsHere">
        <div class="fbWitWizard d-table w-100">
          <div class="d-table-cell align-middle">
            <div class="HeadingText HeadingText2 text-center mb-md-5 mb-3">
              <h3 class="mb-3">{{$product->title}}</h3>
              <p class="mb-0 pb-3">{{$product->sub_title}}</p>
            </div>
            <div class="fbWidthSet clearfix">
              <div class="clearfix fbWizards text-white d-lg-flex">
                <div class="fbMiddleData order-md-2">
                  <img src="{{$pimage}}" class="img-fluid" alt="No Images">
                </div>
                <div class="fbRightData order-md-1">
                  <div class="d-table h-100 w-100">
                    <ul class="list-unstyled GlassList d-table-cell align-middle">
                      <li class="my-3">
                        <p class="m-0 fbicon1"><img src="{{ asset('front-assets/images/icons/1.svg') }}" class="img-fluid"></p>
                        <p class="m-0">{{$product->quantity}}</p>
                      </li>
                      <li class="my-3">
                        <p class="m-0 fbicon1"><img src="{{ asset('front-assets/images/icons/2.svg') }}" class="img-fluid"></p>
                        <p class="m-0">{{$product->percentage}}</p>
                      </li>
                      <li class="my-3">
                        <p class="m-0 fbicon1"><img src="{{ asset('front-assets/images/icons/3.svg') }}" class="img-fluid"></p>
                        <p class="m-0">{{$product->orignal_gravity}}</p>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="fbLeftData order-3 <?php echo (is_array($attr) && !empty($attr) ? 'pt-0 ' : '');?>">
                  <div class="product-attr-options">
                    <?php 
                    if (is_array($attr) && !empty($attr)) {
                    $total_price = $attr[0]['total_price'];
                    $default_attr_id = $attr[0]['attr_id'];
                    $default_attr_name = $attr[0]['attr_name'];
                    $default_option_id = $attr[0]['option_id'];
                    $default_option_name = $attr[0]['option_name'];
                    $default_option_price = $attr[0]['regular_price'];
                    $default_option_tax = $attr[0]['tax'];
                    foreach ($attr as $key => $value) {
                      //$total_price = $value['total_price']; ?>
                      <input type="radio" id="attr_option_<?php echo $key;?>" name="attr_option" value="<?php echo $value['option_id'];?>" <?php echo ($key == 0 ? 'checked' : '');?> data-price="<?php echo $value['total_price'];?>" data-price_regular="<?php echo $value['regular_price'];?>" data-tax="<?php echo $value['tax'];?>" data-option_name="<?php echo $value['option_name'];?>" onchange="update_attr_price(this);">
                      <label for="attr_option_<?php echo $key;?>"><?php echo $value['option_name'];?></label>
                    <?php }
                    } else {
                      $total_price = $product->total_price;
                      $default_attr_id = $product->attribute_id;
                      $default_attr_name = '';
                      $default_option_id = $product->option_id;
                      $default_option_name = "";
                      $default_option_price = $product['price'];
                      $default_option_tax = $product['tax'];
                    } ?>
                  </div>
                  @php 
                    if(empty($product->price)){
                      $price = $product->total_price;
                    }else{
                      $price = $product->price;
                    }
                  @endphp
                  <p class="mb-md-4 clr_blue PriceCount"><i class="fa fa-inr" aria-hidden="true"></i> 
                    <span class="attr_price">{{number_format($price,2)}}</span></p>
                  <div class="row mb-4" style="display:none">
                    <div class="col-md-12">
                      <div class="fbbrDetails w-100">
                        <h6>Hops</h6>
                        <p class="mb-0 text-uppercase">Hallertau</p>
                        <p class="mb-0 text-uppercase">Mitteleruh</p>
                      </div>
                    </div>
                  </div>
                  <div class="fbbrDetails w-100 mb-md-5 mb-3">
                    <h6>Short Description</h6>
                    <p class="mb-0">{{$product->short_description}}</p>
                  </div>
                  <div class="fbbrDetails w-100">
                    <h6>Description</h6>
                    <p class="">{!! $product->description !!}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="OrderNowbtn text-center">
              <div class="FoodDetailsForm pt-md-5">
                <form id="cartForm" onsubmit="addToCart(this); return false;">
                  <div class="form-group mb-4">
                    <div class="QuntityCount">
                      <div class="MngeQuntity">
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <input type="button" value="-" class="qty-minus onOrder onOrder2">
                        <input type="number" name="qty" value="1" class="qty">
                        <input type="button" value="+" class="qty-plus onOrder onOrder2">
                      </div>
                    </div>
                  </div>
                  <div class="GrabBtn1">
                    <input type="hidden" name="attr_id" value="<?php echo $default_attr_id;?>">
                    <input type="hidden" name="attr_name" value="<?php echo $default_attr_name;?>">
                    <input type="hidden" name="option_id" value="<?php echo $default_option_id;?>">
                    <input type="hidden" name="option_name" value="<?php echo $default_option_name;?>">
                    <input type="hidden" name="price" value="<?php echo $default_option_price;?>">
                    <input type="hidden" name="tax" value="<?php echo $default_option_tax;?>">
                    <input type="hidden" name="total_price" value="<?php echo $total_price;?>">
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <input type="hidden" name="location_id" value="<?php echo (session('location') ? session('location') : 0);?>">
                    <button type="submit" class="btn m-0 onOrder onOrder2 w-100">Complete Order <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @elseif($product->type == 2)
    <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-body p-md-5 p-4">
          <div class="FoodDetailsHere">
            <div class="HeadingText HeadingText2 text-center mb-2">
              <h3 class="mb-md-4">{{$product->title}}</h3>
              <p class="mb-md-4">{{$product->sub_title}}</p>

              <div class="radio-button">
                <input type="radio" id="radio1" name="radios" value="all" checked>
                <label for="radio1">Books</label>
                <input type="radio" id="radio2" name="radios" value="false">
                <label for="radio2">Snippets</label>
                <input type="radio" id="radio3" name="radios" value="true">
                <label for="radio3">Quizzes</label>
              </div>

              @php 
                if(empty($product->price)){
                  $price = $product->total_price;
                }else{
                  $price = $product->price;
                }
              @endphp
              <p class="mb-md-4 clr_blue"><i class="fa fa-inr" aria-hidden="true"></i> {{number_format($price,2)}}</p>
            </div>
            <div class="FoodImage1 mt-md-5 mt-4">
              <img src="{{$pimage}}" class="img-fluid w-100" alt="No images">
            </div>
            <div class="FoodDetailsForm pt-4">
            <form id="cartForm" onsubmit="addToCart(this); return false;">
            <div class="form-group mb-md-5">
                  <label>Special Instruction</label>
                  <textarea class="form-control" rows="5" name="instruction" placeholder="Special Instruction" style="color:#fff !important;"></textarea>
                </div>
              <div class="form-group mb-4">
                <div class="QuntityCount">
                  <div class="MngeQuntity">
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <input type="button" value="-" class="qty-minus onOrder onOrder2">
                    <input type="number" name="qty" value="1" class="qty">
                    <input type="button" value="+" class="qty-plus onOrder onOrder2">
                  </div>
                </div>
              </div>
              <div class="GrabBtn1">
                <button type="submit" class="btn m-0 onOrder onOrder2 w-100">Complete Order <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
              </div>
            </form>
            </div>
          </div>
        </div>
  @endif
  
@else
<!-- Update cart quantity -->
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <div class="modal-body p-md-5 p-4">
    <div class="FoodDetailsHere FoodBeerDetailsHere">
      <div class="fbWitWizard d-table w-100">
        <div class="d-table-cell align-middle">
          <div class="OrderNowbtn text-center">
            <div class="FoodDetailsForm pt-md-5" style="width:100%;">
              <form id="cartForm2" onsubmit="updateCartQuantity(this); return false;">
                <div class="form-group mb-4">
                  <div class="QuntityCount">
                    <div class="MngeQuntity">
                      <input type="hidden" name="id" value="{{$row_id}}">
                      <input type="button" value="-" class="qty-minus onOrder onOrder2">
                      <input type="number" name="qty" value="{{$qty}}" class="qty" readonly>
                      <input type="button" value="+" class="qty-plus onOrder onOrder2">
                    </div>
                  </div>
                </div>
                <div class="GrabBtn1">
                  <button type="submit" class="btn m-0 onOrder onOrder2 w-100">Update Quantity <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endif


<script>

  function addToCart(e){
    if(user_id == 'no'){
      toastr.error('Please login first!!','Error');
      showLoginPage();
      return false;
    }
    $(e).find('.st_loader').show();
		
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var location_id = "<?php echo (session('location') ? session('location') : 0);?>";
    if (location_id == 0) {
      location_id = "<?php echo isset($product) ? $product->location : 0;?>";
      console.log(location_id);
      if (location_id > 0) {
        $.ajax({  
          url :"{{route('setLocations')}}",  
          method:"POST",  
          dataType:"json",  
          data:{location_id:location_id},
          success: function(data){ 
            if(data.success==1){ 
              toastr.success(data.message,'Success');
              //location.reload();
              setTimeout(function(){
                window.location.href = data.url;  
              }, 3000);            
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
            $('#OrderShowModal').modal('hide');
            $('#BeerOrderShowModal').modal('hide');
          } 
        }); 
        return;
      }
    }

    if (location_id > 0) {
      $.ajax({  
        url :"{{ route('addToCart') }}",  
        method:"POST",  
        data:$(e).serialize(),
        success: function(data){ 
          if(data.success==1){
            toastr.success(data.message,'Success');
            $('.cart_count').html(data.cart_count);
            if(data.cart_count ==0){
              $('.cart_count').hide();
            }else{
              $('.cart_count').show();
            }
            $('#cart_data').html(data.cart_view);
            $('#product_'+data.pid).html(data.product_view);
         
            $(e).find('.st_loader').hide();
            $('#OrderShowModal').modal('hide');
            $('#BeerOrderShowModal').modal('hide');
          }else if(data.success==0){
            toastr.error(data.message,'Error');
            $(e).find('.st_loader').hide();
          }else if(data.success == 2){
            toastr.error(data.message,'Error');
            showLoginPage('login');
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

  function updateCartQuantity(e){
    $(e).find('.st_loader').show();
		
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({  
      url :"{{ route('changeCartQuantity') }}",  
      method:"POST",  
      data:$(e).serialize(),
      success: function(data){ 
        if(data.success==1){
          toastr.success(data.message,'Success');
          $(e).find('.st_loader').hide();
          $('#infoModal').modal('hide');
          setTimeout(function() {location.reload(); },500);
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

  function update_attr_price(e){
    $(e).find('.st_loader').show();
    var option_id = $(e).val();
    var option_name = $(e).attr('data-option_name');
    var price = $(e).attr('data-price');
    var price_regular = $(e).attr('data-price_regular');
    var tax_cost = $(e).attr('data-tax');
    var regular_price = parseFloat(price_regular).toFixed(2);
    var tax = parseFloat(tax_cost).toFixed(2);
    var total_price = parseFloat(price).toFixed(2);
    $('.PriceCount .attr_price').html(regular_price);
    $('input[name="option_id"]').val(option_id);
    $('input[name="option_name"]').val(option_name);
    $('input[name="total_price"]').val(total_price);
    $('input[name="price"]').val(regular_price);
    $('input[name="tax"]').val(tax);
    $(e).find('.st_loader').hide();
  }

</script>