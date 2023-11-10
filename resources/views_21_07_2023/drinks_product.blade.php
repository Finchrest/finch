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
    <div class="bradcrump w-100 d-flex justify-content-between drinkBradcrump pb-3">
      <ul class="list-unstyled DrinkBrad">
        <?php if($drink_count > 0){?>
        <li><a href="{{url('product/'.$slug_name.'/drinks')}}" class="active drink_menu " onclick="showProduct(this,1,{{ $place }}); return false;">Drinks ({{ $drink_count }})</a></li>
        <?php } ?>
        <?php if($meals_count > 0){?>
        <li><a href="{{url('product/'.$slug_name.'/meals')}}" class="meal_menu">Meals ({{ $meals_count }})</a></li>
        <?php } ?>
      </ul>
      <ul class="rightList d-flex align-items-center FilterBarDrinks">
        <li>
          <form>
          <div class="input-group searchInputGroup mb-0 pr-3">
            <input type="text" id="searchFilter" class="form-control" placeholder="Search" name="search_filter" value="" onkeyup="searchCategory()"> 
            <div class="input-group-append">
              <span class="btn bgBtn"><i class="fa fa-search" aria-hidden="true"></i></span>
            </div>
          </div>
          </form>
        </li>
        <li>
          <dl class="dropdownSelect mb-0">
            <dt>
              <a href="javascript:void(0);">
                <span class="hida">Select Category <i class="fa fa-angle-down" aria-hidden="true"></i></span>    
                <p class="multiSel mb-0"></p>
                <input type="hidden" name="cat_value" value="" id="cat_value">
              </a>
            </dt>
            <dd>
              <div class="mutliSelect">
                <ul>
                   @foreach($categories as $cat)
                  <li>
                    <label class="mb-0" for="cat_{{$cat->id}}">
                      <input type="checkbox" value="{{$cat->id}}" class="catID" id="cat_{{$cat->id}}" onclick="selectCat(this,{{ $place }},{{ $cat->id }})"><input type="hidden" name="cat_name" value="{{$cat->name}}" id="catName">{{$cat->name}}
                    </label>
                  </li>
                  @endforeach
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
      <div class="p-5 product_loader" >
        <h2 class="text-center" style="color:#fff">Please Wait...</h2>
      </div>
      <div id="fbOrderDrinks"></div>
      <?php if($drink_count >= 12){?>
      <p class="text-center mt-4 mb-5"><button class="load-more btn btn-dark btn-lg onOrder2" onclick="load_more(this,{{ $place }})">Load More</button></p>
      <?php } ?>
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
    //setAge();  
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
     var cat_value = $('#cat_value').val();
     var search_text= $('#searchFilter').val();
     var _totalCurrentResult=$(".product-box").length;
       $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
       if(cat_value != '' || search_text != ''){
      $.ajax({  
        url :"{{route('getFilter')}}",  
        method:"POST",  
        dataType:"json",  
        data:{type:type,place:place,cat_value:cat_value},
        success: function(data){ 
          if(data.success==1){
            $('#fbOrderDrinks').html(data.view);
          
         $('#fbOrderDrinks').show();
         $('.product_loader').hide();
         if(data.view ==''){
           $('.load-more').hide();
         }else{ 
         $('.load-more').show();
         }
        }
        }
      });
    }else{
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
            
              var title = $(this).closest('.mutliSelect label').find('input[type="hidden"]').val();
                  //alert(title);
              if ($(this).is(':checked')) {
                  var html = '<span title="' + title + '">'+ title +',</span>';
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



  function selectCat(e,place,cat_id,type){
    var cat_id= $('.catID').val();
    var vals = $('input[type=checkbox]:checked').map(function(){ return $(this).val();})
    .get().join(',');
    $('#cat_value').val(vals);
    var type= $('#ptype').val();
    var cat_value = $('#cat_value').val();
    // alert(type);

       $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({  
        url :"{{route('getFilter')}}",  
        method:"POST",  
        dataType:"json",  
        data:{type:type,place:place,cat_value:cat_value},
        success: function(data){ 
          if(data.success==1){
            $('#fbOrderDrinks').html(data.view);
        
         $('#fbOrderDrinks').show();
         $('.product_loader').hide();
         if(data.view ==''){
           $('.load-more').hide();
         }else{ 
         $('.load-more').show();
         }
         
          }
        }
      });
    };


function searchCategory(e,place,type){
    var type= $('#ptype').val();
    var place= $('#place').val();
    var search_text= $('#searchFilter').val();
    $.ajax({  
        url :"{{route('getFilter')}}",  
        method:"POST",  
        dataType:"json",  
        data:{type:type,place:place,search_text:search_text},
        success: function(data){ 
          if(data.success==1){
            $('#fbOrderDrinks').html(data.view);
         
         $('#fbOrderDrinks').show();
         $('.product_loader').hide();
         if(data.view ==''){
           $('.load-more').hide();
         }else{ 
         $('.load-more').show();
         }
         
          }
        }
      }); 
};

</script> 
@endsection