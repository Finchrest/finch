
<style type="text/css">
   .OrderShowModal .modal-content {
      width: 700px;
      margin: 0 auto;
   }

   .addrssDataHere label {
      position: relative;
      z-index: 100;
      width: 100%;
      padding: 11px;
      transition: color 0.2s;
      cursor: pointer;
      border: 2px solid transparent;
      margin-bottom: 0;
      background-color: #fff;
      height: 160px;
      overflow-x: hidden;
      overflow-y: scroll;
   }

   .addrssDataHere * {
      font-size: 11px;
      color: #000;
   }

   .addrssDataHere input[type=radio] {
      appearance: none;
   }

   .addrssDataHere input[type=radio]:checked+label {
      color: #FFF;
      background-color: var(--yellow);
      border: 2px solid #fff;
   }

   .addrssDataHere input[type=radio]:checked+.off-label+.selected {
      transform: translateX(100%);
   }

   .addrssDataHere label::-webkit-scrollbar {
      width: 2px;
      background-color: #fff;
   }

   .addrssDataHere label::-webkit-scrollbar-thumb {
      background-color: #000000;
   }

   .addrssDataHere input[type=radio]:checked+label::-webkit-scrollbar-track {
      background-color: var(--yellow);
   }

   .addrssDataHere label::-webkit-scrollbar-track {
      background-color: #fff;
   }
</style>
<div class="modal-header" style="justify-content: center;">
   <div class="HeadingText HeadingText2 text-center">
      <h3 class="mb-3">Delivery Address</h3>
      <p class="d-none">Delivery will be dispatched in 20-30 minutes</p>
   </div>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body">
   <div class="container">
      <div class="fbFinchInfoDetails">
         <div class="FinchMegaInfo w-100">
            <div class="FbFinchBrefCafe w-100 border-0 py-5">
               <div class="CansumerForm w-100">
                  <form onsubmit="cartProcess(this); return false;">
                  <input type="hidden" name="order_for" value="{{ $user->orderType }}">

                  @if($user->orderType == 0)
                     <div class="form-group mb-3">
                        <label>Consumer Name</label>
                        <input type="text" class="form-control" name="consumer_name" placeholder="Your Name" value="{{auth()->user()->name}}">

                     </div>
                     <!-- <div class="form-group mb-3 ">
                        <div class="d-inline-block pr-5">
                           <label class="radio-inline"> Delivery Order </label>
                           <input type="radio" name="order_for" checked value="0">
                        </div>
                        <label class="radio-inline"> Dine-in Order </label>
                        <input type="radio" name="order_for" value="1">
                     </div> -->
                     <div class="userIncomeData pb-4 ">
                        <div class="row defaultaddress">
                           <div class="col-md-12">
                              <div class="text-right">
                                 <?php
                                 if (count($homeAddress) > 0) {
                                    $displayadd = 'd-inline-block';
                                 } else {
                                    $displayadd = 'd-none';
                                 }
                                 ?>
                                 <a href="javascript:void(0)" class="btn btn-sm btn-warning py-1 <?php echo $displayadd; ?>" onclick="newaddress()">Add New Address</a>
                              </div>
                           </div>
                           <div class="col-12">
                              <label class="text-warning font-weight-bolder <?php echo $displayadd; ?>">Address</label>
                           </div>
                           <?php foreach ($homeAddress as $key => $homeAddres) {

                              if ($key == 0) {
                                 $checked = 'checked';
                                 $onecheck = 'data-id="' . $homeAddres->id . '"';
                                 $value = 1;
                              } else {
                                 $checked = '';
                                 $onecheck = '';
                                 $value = 2;
                              }

                           ?>

                              <div class="col-xl-4 col-sm-6 py-3">
                                 <div class="addrssDataHere m-0 h-100">
                                    <input type="radio" onclick="changeaddress(this,<?= $homeAddres->id;  ?>)" class="radio_<?= $homeAddres->id;  ?>" <?= $checked ?> <?= $onecheck ?> id="radio_<?= $homeAddres->id;  ?>" value="<?= $homeAddres->id ?>" name="radio">
                                    <label for="radio_<?= $homeAddres->id;  ?>">
                                       <h6 class="mb-2 pb-2 border-bottom">{{ $homeAddres->title }}</h6>
                                       <p class=" m-0">{{ $homeAddres->address }} ,{{ $homeAddres->city }},{{ $homeAddres->state }}, India</p>
                                       <p class="m-0">+91-{{ $homeAddres->phone }}</p>
                                       <p class="m-0">Pincode - {{ $homeAddres->pincode }}</p>
                                    </label>
                                 </div>
                              </div>
                              <input type="hidden" class="pincode_<?= $homeAddres->id;  ?>" name="pincode_<?= $homeAddres->id;  ?>" value="<?= $homeAddres->pincode ?>">
                           <?php } ?>

                        </div>
                     </div>
                     <div>
                        <?php

                        if (count($homeAddress) > 0) {
                           $display = 'd-none';
                           $new_address = 0;
                        } else {
                           $display = 'd-block';
                           $new_address = 1;
                        }


                        // echo '<pre>'; print_r($display);die;
                        ?>
                        <div class="newAddress <?php echo $display; ?>">
                           <div class="text-right mt-3">
                              <a href="javascript:void(0)" onclick="defaultaddress()" class="btn btn-sm btn-warning py-1 <?php echo $displayadd; ?>">Address List</a>
                           </div>
                           <div class="form-group ">
                              <label>Pincode<sup class="text-danger">*</sup></label>
                              <select name="pincode" class="form-control">
                                 <option value="">Select</option>
                                 <?php
                                 foreach ($Location as $locations) {
                                 ?>
                                    <option value="<?php echo $locations ?>"><?php echo $locations ?></option>
                                 <?php
                                 }
                                 ?>
                              </select>
                           </div>
                           <div class="form-group mb-4">
                              <label>Address Title</label>
                              <input type="text" class="form-control phone" name="address_type" placeholder="Address Type" value="">
                           </div>
                           <div class="form-group mb-4">
                              <label>Phone Number</label>
                              <input type="text" class="form-control phone" name="phone" placeholder="Mobile Number" value="{{auth()->user()->phone}}">
                              <input type="hidden" class="form-control" id="new_address" name="new_address" value="<?php echo $new_address; ?>">
                           </div>

                           <div class="form-group mb-4">
                              <label>Address</label>
                              <input type="text" class="form-control address" name="address" value="" placeholder="Address">
                           </div>
                           <div class="form-group mb-4">
                              <label>City</label>
                              <input type="text" class="form-control city" name="city" value="" placeholder="City">
                           </div>
                           <div class="form-group mb-4">
                              <label>State</label>
                              <input type="text" class="form-control state" name="state" value="" placeholder="State">
                            
                           </div>
                        </div>
                     
                        <div class="form-group mb-4">
                           <input type="hidden" name="amount" value="{{@$amt}}">
                           <input type="hidden" name="codeType" value="{{@$codeType}}">
                           <input type="hidden" name="codeNum" value="{{@$codeNum}}">
                           <!-- <input type="hidden" name="passportcodeNum" value="{{@$codeNum}}"> -->
                           <input type="hidden" name="codeAmt" value="{{@$codeAmt}}">
                        </div>
                        </div>
                        <div class="clGetYoursNow w-100" style="padding: 0px !important;">
                           <button type="submit" class="btn m-0 onOrder onOrder2 w-100 p-3"><b><i class='fa fa-inr' aria-hidden='true'></i> <span class="cat_total"> {{@$amt}} </span></b> Continue To Payment</button>
                        </div>
                        <input type="hidden" class="pincode_id_data" name="pincode_id_data" value="{{@$codeAmt}}">     
                        @else
                       <?php 
                        if (count($homeAddress) > 0) {
                           $display = 'd-none';
                           $new_address = 0;
                        } else {
                           $display = 'd-block';
                           $new_address = 1;
                        }
                        ?>
                     <div class="form-group mb-3">
                        <label>Consumer Name</label>
                        <input type="text" class="form-control" name="consumer_name" placeholder="Your Name" value="{{auth()->user()->name}}">
                     </div>
                     <div class="form-group mb-4">
                        <label>Phone Number</label>
                        <input type="text" class="form-control phone" name="phone" placeholder="Mobile Number" value="{{auth()->user()->phone}}">
                        <input type="hidden" class="form-control" id="new_address" name="new_address" value="<?php echo $new_address; ?>">
                     </div>
                     <div class="form-group mb-4">
                        <input type="hidden" name="amount" value="{{@$amt}}">
                        <input type="hidden" name="codeType" value="{{@$codeType}}">
                        <input type="hidden" name="codeNum" value="{{@$codeNum}}">
                        <input type="hidden" name="codeAmt" value="{{@$codeAmt}}">
                        <!-- <input type="hidden" name="passportcodeNum" value="{{@$codeAmt}}"> -->
                     </div>
                     <div class="clGetYoursNow w-100" style="padding: 0px !important;">
                        <button type="submit" class="btn m-0 onOrder onOrder2 w-100 p-3"><b><i class='fa fa-inr' aria-hidden='true'></i> <span class="cat_total"> {{@$amt}} </span></b> Continue To Payment</button>
                     </div>
                     <input type="hidden" class="pincode_id_data" name="pincode_id_data" value="{{@$codeAmt}}">
                        @endif
                       
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   $(document).ready(function() {
      var addtext = $('.addrssDataHere  input[type="radio"]:checked').attr('data-id');

      changeaddress($('.addrssDataHere  input[type="radio"]:checked'), addtext);
   });

   function changeaddress(e, id) {

      // alert(pincode);
      var phone = $('#hiddPhone_' + id).val();
      var address = $('#hiddAddress_' + id).val();
      var city = $('#hiddCity_' + id).val();
      var state = $('#hiddState_' + id).val();
      var pincode = $('.pincode_' + id).val();

      $('.phone').val(phone);
      $('.address').val(address);
      $('.city').val(city);
      $('.state').val(state);
      $('.pincode_id_data').val(pincode);

   }

   function newaddress() {
      $('.newAddress').removeClass('d-none');
      $('.defaultaddress').addClass('d-none');
      $('.phone').val('');
      $('.address').val('');
      $('.city').val('');
      $('.state').val('');
      $('#new_address').val(1);

   }

   function defaultaddress() {

      $('.newAddress').addClass('d-none');
      $('.defaultaddress').removeClass('d-none');
      $('#new_address').val(0);
   }
</script>