
    <section class="">
        <div class="">
            <div class="row">
                <div class="col-md-9">
                    <div class="content-left-strip">
                        <h3 class="insidepage-title">{{ $product->title }}</h3>
                        <img src="{{ asset('front-assets/images/Line-570.png') }}" class="line-orange" alt="">
						 <form method="post"  id="productform" class="text-left d-none">
                             <input type="text"  name="rowID" id="rowID" value="{{ $items['rowID'] }}">
                            <input type="text"  name="id" id="id" value="{{ $items['pid'] }}">
						    <input type="text"  name="word_range_id" id="word_range_id" value="{{ $items['word_range'] }}">
						    <input type="text"  name="addons_ids" id="addons_ids" value="{{ $items['addons'] }}">
                            <input type="text"  name="qty" id="qty" value="1">
                            <input type="text"  name="price" id="price" value="{{ $items['price'] }}">
                             <input type="text"  name="product_type" id="product_type" value="{{ $items['product_type'] }}">
                        </form> 
						<hr>
                        {!! $product->description !!}

						<hr>
						<div class="clearfix"></div>
						<?php if($word_ranges) { ?>
                        <h3 class="insidepage-title2">Select word range:</h3>

                        <form class="expert-blog-form">
                            <div class="form-group">
                                <select class="form-control" id="wordRange" onchange="set_word_range(this)">
								<?php foreach($word_ranges as $word_range){ ?>
                                    <option value="{{ $word_range->id }}" <?php if($items['word_range'] == $word_range->id){echo 'selected';}?>>{{ $word_range['word_range_title'] }} - AED {{ $word_range->price }}</option>
								<?php } ?>
								 </select>
                            </div>
                        </form>
						<?php } ?>
						<div class="clearfix"></div>
                        <br>
						<?php if($addons) { ?>
                        <h3 class="insidepage-title2">Add Ons:</h3>

                        <div class="row">
						<?php foreach($addons as $addon){ ?>
                            <div class="col-md-3 addon_box">
                             <a href="javascript:void(0)" onclick="set_addons(this)">
                                <div class="add-strip <?php if(in_array($addon->id,$items['addons_arr'])){echo 'active';} ?>" data-id={{ $addon->id }}>
                               
                                   {{ $addon->addon_title }}
                                    <br> <b>AED {{ $addon->addon_price }}</b>
                                  
                                </div>
                                 </a> 
                            </div>
						<?php } ?>
                        </div>
						<?php } ?>
                        <!--row-->
                        <br>
                        <p class="text-justify black-text">{{ $product->short_description }} </p>

                    </div>
                    <!--content-left-strip-->



                </div>
                <!--col-md-9-->

                <div class="col-md-3">
                    <div class="content-right-strip">
                        <img src="{{ $file }}" class="img-responsive center-block d-block mx-auto content-right-strip-img" alt="">

                        <div class="clearfix"></div>
                        <br><br>
                        <div class="product_right_box">
						<?php 
						if($product->type == 0){
						$qty = 0;$price=$word_range_data['price'];?>
                        <table class="table table-borderless">
							
                            <tr>
                                <td colspan="2">Word range:</td>
                            </tr>
							
                            <tr>
                                <td>{{ $word_range_data['title'] }}</td>
                                <td><b>AED {{ $word_range_data['price'] }}</b></td>
                            </tr>
							
                            <tr>
                                <td>Quantity:</td>
                                <td>1</td>
                            </tr>
                        </table>

	
                        <hr>
						
						
						
                        <table class="table table-borderless">

                            <tr>
                                <td><b>Total:</b></td>
                                <td class="text-right"><b class="orange-text">AED {{ number_format((float)$price, 2, '.', '') }}</b></td>
                            </tr>
                        </table>

		
                        <div class="cart-btn-group">
                            <a href="javascript:void(0)" class="btn btn-block add-cart-btn add-cart-btn-border" onclick="updateCart(this,0)">Update Cart <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></a>
                        </div>
						<?php } ?>

                        </div>    



                    </div>
                    
                </div>
            </div>

        </div>
        <!--container-->
    </section>



<script> 
 $( document ).ready(function() {
    $('#wordRange').trigger('change');
});
 function set_word_range(e){
     $('#word_range_id').val($(e).val());
     getContentUpdatedata();
 }

 function set_addons(e){
    if($(e).find('.add-strip').hasClass('active')){
         $(e).find('.add-strip').removeClass('active');
    }else{
         $(e).find('.add-strip').addClass('active');
    } 
    var ids = [];
    $(".add-strip.active").each(function(){
         var id = $(this).attr('data-id'); 
         ids.push(id);
    });
   $('#addons_ids').val(ids.join());
   getContentUpdatedata();
 }

 function getContentUpdatedata(){
       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({  
          url :"{{ route('getContentUpdateCartdata') }}",  
          method:"POST",  
          data:$('#productform').serialize(),
          success: function(res){  
            if(res.success==1){
             // toastr.success(res.message,'Success');
              $('.product_right_box').html(res.data);
              $('#price').val(res.price); 
              $('#qty').val(res.qty);
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
           
          } 
           
        }); 
     
 }
 </script>

