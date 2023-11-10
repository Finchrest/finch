<style>
  .card-block * {
    font-size: 13px;
}
.first_part {
    border-bottom: 1px solid #c5c5c5;
    margin:15px 0px;
}

.restorent_box p{
  margin-bottom:4px !important;
  font-size:12px;
}
.restorent_box_inner {
    display: flex;
    gap: 15px;
    /* padding: 10px 10px 0;
    /* background: #f4f4f4; */
   
    margin:0 0 10px 0;
}
.circle_count {
    column-count: 2;
    width: 100%;
    column-gap: 20px;
}
.circle_count i {
    font-size: 10px;
    vertical-align: inherit;
}
</style>
<?php foreach($orders as $order){ 
  
  ?>
<div class="col-md-12 mb-4">
<div class="card h-100 position-relative restorent_box">
    <div class="card-block p-3">
      <div class="row">
      <div class="col-8" style="border-bottom: 1px solid #e0e0e0;margin-bottom:10px;">
        <div class="restorent_box_inner">
        <p class="">
        <b class="pr-2 text-primary"> #{{ $order->id }}</b>
       <b> {{ ucwords($order->name) }}</b></p>
        </div>
     </div>
     <div class="col-4" style="border-bottom: 1px solid #e0e0e0;margin-bottom:10px;">
      <div class="accpt_button text-right">
      <div class="d-flex justify-content-end">
        <div  class="pr-3"> 
      <a href="javascript:void(0)" class="btn btn-primary btn-sm pr-3 py-1" onclick="update_status(`<?= url('restaurant/order-change-status') ?>`,`<?= $order->id ?>`,`1`)"><small>Accept</small></a>  
      </div>
      <div> 
      <a class="btn btn-danger btn-sm  py-1" href="javascript:void(0)" onclick="update_status(`<?= url('restaurant/order-change-status') ?>`,`<?= $order->id ?>`,`2`)"><small>Decline</small></a>
      </div>
        
      </div>
      </div>
      </div>
     <div class="col-4">
      
     <p class=""><i class="fa fa-phone" aria-hidden="true"></i>  {{ ucwords($order->phone) }}</p>
     <p class=""><i class="fa fa-map-marker" aria-hidden="true"></i> {{ ucwords($order->address) }},  {{ ucwords($order->city) }}, {{ ucwords($order->state) }}</p>
     <?php if(!empty($order->passport_code)){ ?>
      <div class="">
      <p class="m-b-20 pr-2">
      <small> <b class="m-b-20 pr-2">Passport Code</b></small> 
        {{ ucwords($order->passport_code) }}</p>
      </div>
     <?php } ?>
     <div class="">
      <p class="m-b-20 pr-2">
      <small> <b class="m-b-20 pr-2">Order For :</b></small>
       
        <?php if($order->order_for == 1){
          echo"Dine In Order";
        } else{
          echo"Delivery Order";
        } ?></p>
      </div>
     
     </div>
        <div class="col-8">
        <div class="qty_box">
        <h6 class="m-b-15 pr-2">Product Name :-</h6>
    
          <div class="circle_count">
        <p class="pr-2"><i class="fa fa-circle" aria-hidden="true"></i>  
  {{ $order->qty }} X {{ ucwords($order->product_name) }} <b>*</b>  {{ ucwords($order->cat_name) }}  <img src="{{ url($order->image) }}" class="img-fluid" alt="NO Image" width="30px" height="30px"></p>
       
        </div>
        </div>
       
        
   
          </div>
      </div>
     
     
      </div>
      
    </div>
</div>
</div>
<?php } ?>
