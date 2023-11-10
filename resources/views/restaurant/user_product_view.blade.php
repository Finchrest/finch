<div class="row">
  <div class="col-6">
  <section class="insidepage-content-1 my-md-5 pb-5 pt-3 px-2 myOrderPage myProductPage bg-primary">
  <div class="container  myOrderContainer">
  <div class="HeadingText HeadingText2 RemoveButton text-right mb-3">
      <h6 class="mb-4 text-danger" style="cursor:pointer">Remove</h6>
    </div>
    <div class="HeadingText HeadingText2 text-center mb-3">
      <h3 class="mb-4">My Product</h3>
    </div>
<div class="row">
<div class="col-md-12 px-sm-0 product-box 12312" id="product_243">
    
        <div class="fbOrderDetails w-100 text-white">
          <div class="row">

            <div class="col-md-5 col-6">
              <div class="OdrMiddleText w-100 mx-2">
                <h5 class="mb-md-3 one-line-text">Product Name :- </h5>
                <h5 class="mb-md-3 one-line-text">Price :- </h5>
              </div>
            </div>
            <div class="col-md-7 col-6">
              <div class="OdrPriceDetails w-100">   
                <p class="mb-md-4 m-0 four-line-text ProductTitle">{{$products->title}}</p>
                <h5><i class="fa fa-inr" aria-hidden="true"></i>
                                    <span>{{$products->price}}</span>
                                  </h5>
                <!-- <p class="mb-md-4 m-0 four-line-text">{{$products->price}}</p> -->
              </div>
            </div>
          <input type="hidden" value="{{$passport_code}}" class="passport_code">
          </div>
          <div class="row mt-4">
          <div class="col-3">
           <span>Quantity :- </span>
            </div>
           <div class="col-9">
            <div class="OdrPriceDetails w-100">   
               <input type="number" value="{{ $quantity }}" class="quantity form-control" >
               <input type="hidden" value="{{ $products->price }}" class="ProductPrice form-control" >
               <input type="hidden" value="{{ $products->total_price }}" class="ProductTotalPrice form-control" >
              </div>
            </div>
          </div>

          <div class="free_product">

          </div>


          <div class="row mt-4">
<div class="col-6">
  <div class="OdrPriceDetails w-100">   
    <h5> 
    <div class="submitBtn text-center pt-2">
              <a href="javascript:void(0);" class="btn fbBtn1 btn-warning" style="background-color: #f8bf00 !important;" onclick="addProductItem(this,`{{ $products->id }}`); return false;">CheckOut</a>
  </div>
    </h5>
  </div>
</div>
<div class="col-6">
  <div class="OdrPriceDetails w-100">   
    <h5> 
    <div class="submitBtn text-center pt-2">
              <a href="javascript:void(0);" class="btn fbBtn1 btn-warning" style="background-color: #f8bf00 !important;" onclick="getFreeItem(this,`{{$passport_code}}`); return false;">Free Product</a>
  </div>
    </h5>
  </div>
</div>
</div>

        </div>
   
    </div>
</div>
    </div>
</section>
  </div>
</div>


<script>
  
  function addProductItem(e,id){
   var passportId = $('.passport_code').val();
   var quantity = $('.quantity').val();
   var freeQuantity = $('.free_product_quantity').val();
   var freeProductId = $('.free_product_id').val();
   var ProductTitle = $('.ProductTitle').html();
   var freeProductTitle = $('.freeProductTitle').html();
   var ProductPrice = $('.ProductPrice').val();
   var FreeProductPrice = $('.FreeProductPrice').val();
   var ProductTotalPrice = $('.ProductTotalPrice').val();
   var FreeProductTotalPrice = $('.FreeProductTotalPrice').val();


      $('#modal-default .modal-content').html('');
      $.ajax({
         headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
         url: "{{ route('save.product.order') }}",
         dataType: "json",
         method: "POST",
         data: {
          id: {
      0: id,
      1: freeProductId
    },
          passport_code:passportId,
          quantities: {
      0: quantity,
      1: freeQuantity
    },
    title: {
      0: ProductTitle,
      1: freeProductTitle
    },    price: {
      0: ProductPrice,
      1: FreeProductPrice
    },    total_price: {
      0: ProductTotalPrice,
      1: FreeProductTotalPrice
    },
        },
         success: function(data) {
          if(data.success == 1){
            toastr.success(data.message,'Success');
            location.reload()
     }
       
         },
      });
   }

   function addFreeItem(e,id){
   var passportId = $('.passport_code').val();
   var quantity = $('.quantity').val();
      $('#modal-default .modal-content').html('');
      $.ajax({
         headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
         url: "{{ route('save.product.order') }}",
         dataType: "json",
         method: "POST",
         data: {
          id:id,
          passport_code:passportId,
          quantity:quantity,
        },
         success: function(data) {
          if(data.success == 1){
            toastr.success(data.message,'Success');
            location.reload()
     }
       
         },
      });
   }

   
   function getFreeItem(e,passportCode){
      $('#modal-default .modal-content').html('');
      $.ajax({
         headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
         url: "{{ route('restaurant.free.order') }}",
         dataType: "json",
         method: "POST",
         data: {
        
            passportCode:passportCode,
         },
         success: function(data) {
            $('#modal-default .modal-content').html(data.view);
			   $('#modal-default').modal('show');
         },
      });
   }

   $(document).ready(function(){
  $(".RemoveButton").click(function(){
   $('.myProductPage').hide();
  });
});
</script>