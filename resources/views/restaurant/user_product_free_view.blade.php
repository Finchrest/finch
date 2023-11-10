<div class="row">
  <div class="col-12">
  <section class="insidepage-content-1 mt-md-4 pt-3 px-2 myOrderPage myFreeProductPage bg-primary">
  <div class="container  myOrderContainer">
  <div class="HeadingText HeadingText2 RemoveButton text-right mb-3">
      <h6 class="mb-4 text-danger" style="cursor:pointer">Remove</h6>
    </div>
    <div class="HeadingText HeadingText2 text-center mb-3">
      <h3 class="mb-4">Free Product</h3>
    </div>
<div class="row">
<div class="col-md-12 px-sm-0 product-box 12312" id="product_243">
    
        <div class="fbOrderDetails w-100 text-white">
          <div class="row">
            <div class="col-md-5 col-6">
              <div class="OdrMiddleText w-100 mx-2">
                <h5 class="mb-md-3 one-line-text">Product Name :- </h5>
                <h5 class="mb-md-3 one-line-text">Price :- </h5>
                <h5 class="mb-md-3 one-line-text">Quantity :- </h5>
              </div>
            </div>
            <div class="col-md-7 col-6">
              <div class="OdrPriceDetails w-100">   
                <p class="mb-md-4 m-0 four-line-text freeProductTitle">{{$products->title}}</p>
                <h5><i class="fa fa-inr" aria-hidden="true"></i>
                  <span>0.00</span>
                </h5>
                 <h5 class="mt-3"></i>
                  <span>1</span>
                </h5>
              </div>
            </div>
          <input type="hidden" value="{{$passport_code}}" class="passport_code">
          <input type="hidden" value="1" class="free_product_quantity">
          <input type="hidden" value="{{$products->id}}" class="free_product_id">
          <input type="hidden" value="0" class="FreeProductPrice">
          <input type="hidden" value="0" class="FreeProductTotalPrice">
          </div>
        </div>
    </div>
  </div>
    </div>
</section>
  </div>
</div>


<script>


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
   $('.myFreeProductPage').hide();
  });
});
</script>