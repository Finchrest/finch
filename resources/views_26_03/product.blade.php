@extends('layouts.app')

@section('content')
 <!--**********|| Order Section ||**********-->
 <style>
    /* ul.list-unstyled.DrinkBrad.w-100 li{
      border: 2px solid #685e44 !important;
      padding: 5px 10px !important;
      border-radius: 50px !important;
    } */
    .active {
      color: var(--yellow) !important;
    }
    .meals_show{
      display: none;
    }
 </style>

   
    <section class="w-100 clearfix fbBeerOrderMenus py-5 mt-md-5 " id="fbOrderMenus">
	 <input type="hidden" id="ptype" value="{{ $type }}">
  <input type="hidden" id="place" value="{{ $place }}">
   <input type="hidden" id="drink_count" value="{{ $drink_count }}">
   <input type="hidden" id="meals_count" value="{{ $meals_count }}">
      <div class="BgBannerImage1 position-absolute w-100"> 
        <img src="{{ asset('front-assets/images/banner1.png') }}" class="img-fluid BannerImg1 BannerImg6">
      </div>
      <div class="container py-md-5">
        <div class="bradcrump w-100 d-flex justify-content-between drinkBradcrump">
          <ul class="list-unstyled DrinkBrad">
            <?php if($drink_count > 0){?>
              <li><a href="javascript:void(0);" class="active drink_menu " onclick="showProduct(this,1,{{ $place }}); return false;">Drinks ({{ $drink_count }})</a></li>
			<?php } ?>
			 <?php if($meals_count > 0){?>
            <li><a href="javascript:void(0);" class="meal_menu" onclick="showProduct(this,2,{{ $place }}); return false;">Meals ({{ $meals_count }})</a></li>
			<?php } ?>
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
		<div class="p-5 product_loader" >
         <h2 class="text-center" style="color:#fff">Please Wait...</h2>
		 </div>
         <div id="fbOrderDrinks"></div>   
         
		  
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
<script>
$(document).ready(function(){
	if($('#ptype').val() == 1){
		$('.drink_menu').click();
	}else{
		$('.meal_menu').click();
	}
});

$(window).on("load", function() {
	setAge();  
});


function setAge(){
	 var user_age = $('#user_age').val();
	  if(user_age == ''){  
		 if($('#drink_count').val() > 0){ 
			//showAgeSiteModal();
		 }
      }else{
	  if(user_age > 21){
		$('.drinkAdd').show();
	  }else{
		  $('.drinkAdd').hide();
	  }
	  }
}
	
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

  function showProduct(e,type,place){
	$('#ptype').val(type);  
	
   $('.DrinkBrad a').removeClass('active');	  
   $(e).addClass('active');	  
   $('.product_loader').show();
   $('#fbOrderDrinks').hide();
  
   
   
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({  
      url :"{{route('get_products')}}",  
      method:"POST",  
      dataType:"json",  
      data:{type:type,place:place,drink_count:$('#drink_count').val(),meals_count:$('#meals_count').val(),_totalCurrentResult:0},
      success: function(data){ 
        if(data.success==1){
          $('#fbOrderDrinks').html(data.view);
		  setAge();  
		   $('#fbOrderDrinks').show();
		   $('.product_loader').hide();
		   if(data.view ==''){
			   $('.load-more').hide();
		   }else{ 
			 $('.load-more').show();
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
</script> 
@endsection