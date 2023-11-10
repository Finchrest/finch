@extends('admin.layouts.app')
@section('content')
<!-- Page-body start -->
<div class="page-header card">
   <div class="card-block caption-breadcrumb">
      <div class="breadcrumb-header">
         <h5>{{ $module }}s</h5>
      </div>
   </div>
</div>
<!-- Page-header end -->
<!-- Page-body start -->
<div class="page-body">
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-3">
               <!-- Profile Image -->
               <div class="card card-primary card-outline">
                  <div class="card-body box-profile p-2">
                     <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{ asset('front-assets/images/no_user.png ') }}" alt="User profile picture">
                     </div>
                     <h6 class="profile-username text-center pt-4">{{ ucwords($user->name) }}</h6>
                     <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item p-2">
                           <b>Phone:-<a class="float-right">{{ ucwords($user->phone) }}</b></a>
                        </li>
                        <li class="list-group-item p-2">
                           <b>Email:-<a class="float-right">{{ ucwords($user->email) }}</b></a>
                        <li class="list-group-item p-2">
                           <b>Age:-<a class="float-right">{{ ucwords($user->age) }}</b></a>
                        </li>
                     </ul>
                  </div>
                  <!-- /.card-body -->
               </div>
               <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
               <div class="card">
                  <div class="card-header p-2">
                     <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#Passports" data-toggle="tab">Passports</a></li>
                        <li class="nav-item"><a class="nav-link " href="#Orders" data-toggle="tab">Orders</a></li>
                        <li class="nav-item"><a class="nav-link " href="#Address" data-toggle="tab">Address</a></li>


                     </ul>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                     <div class="tab-content">
                        <div class="tab-pane " id="Orders">
                           <!-- Personal Info -->
                           <div class="YOurHistory myOrderTables">
                              <div class="table-responsive" id="checkoutData">
                                 <table class="table table-border TableThree table-borderless checkout-table">
                                    <?php if ($orders->toArray()) {  ?>
                                       <thead>
                                          <tr>
                                             <th>Name</th>
                                             <th>Quantity</th>
                                             <th>Sub Total</th>
                                             <th>Total Pay</th>
                                             <th>Status</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php foreach ($orders as $order) { ?>
                                             <tr id="oid_{{ $order['id'] }}">
                                                <td>{{ ucwords($order['name']) }}</td>
                                                <td>{{ $order['qty'] }}</td>
                                                <td>{{ number_format($order['sub_total'],2) }}</td>
                                                <td>{{ number_format($order['total_pay'],2) }}</td>
                                                <td><?php if ($order['order_status'] == 1) {
                                                         echo 'Accepted';
                                                      } elseif ($order['order_status'] == 2) {
                                                         echo 'Cancelled';
                                                      } else {
                                                         echo 'Pending';
                                                      } ?></td>
                                                <td><a href="javascript:void(0)" onclick="orderDetails(this,`{{ $order['id'] }}`); return false;"><i class="fa fa-eye text-warning" aria-hidden="true"></i></a></td>
                                             </tr>
                                          <?php }
                                       } else { ?>
                                          <tr class="text-center">
                                             <td>No data Available</td>
                                          </tr>
                                       <?php }  ?>
                                       </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                        <!-- tab-pane -->
                        <div class="tab-pane active" id="Passports">
                           <div class="container" id="subjQuestioon">
                              <div class="YOurHistory myOrderTables">
                                 <div class="table-responsive" id="checkoutData">
                                    <table class="table table-border TableThree table-borderless checkout-table">
                                       <?php if ($PassportOrder->toArray()) {  ?>
                                          <thead>
                                             <tr>
                                                <th class="text-left">Passport Code</th>
                                                <th class="text-left">Amount Details</th>
                                                <th class="text-left">Validity Details</th>
                                                <th class="text-left">Buttons</th>
                                             </tr>
                                          </thead>
                                          <tbody id="getUserdata">
                                             <?php foreach ($PassportOrder as $order) { ?>
                                                <tr id="oid_{{ $order['id'] }}">
                                                   <td class="text-left">{{ $order['passport_code'] }}</td>
                                                   <td class="text-left">
                                                      <p class="mb-1 text-left">
                                                         <span class="span1">Price</span>
                                                         : <span class="span2">{{ number_format($order['price'],2) }}</span>
                                                      </p>
                                                      <p class="mb-1 text-left">
                                                         <span class="span1">Value</span>
                                                         : <span class="span2">{{ number_format($order['volume_amount'],2) }}</span>
                                                      </p>
                                                      <p class="mb-1 text-left">
                                                         <span class="span1">Used</span>
                                                         :<span class="span2">{{ number_format($order['used_amount'],2) }}</span>
                                                      </p>
                                                      <p class="mb-1 text-left">
                                                         <span class="span1">Remaining</span>
                                                         : <span class="span2">{{ number_format($order['remaining_amount'],2) }}</span>
                                                      </p>
                                                   </td>
                                                   <td class="text-left">
                                                      <p class="mb-1 text-left">
                                                         <span class="span1">Start</span>
                                                         : <span class="span2">@if($order['start_date']){{ date('d M, Y',strtotime($order['start_date'])) }}@else{{'NA'}}@endif</span>
                                                      </p>
                                                      <p class="mb-1 text-left">
                                                         <span class="span1">End</span>
                                                         : <span class="span2">@if($order['end_date']){{ date('d M, Y',strtotime($order['end_date'])) }}@else{{'NA'}}@endif</span>
                                                      </p>

                                                   </td>
                                                   <td>
                                                      <p class="mb-1 text-left">
                                                         <a href="javascript:void(0)" onclick="passportDetails(this,`{{ $order['id'] }}`); return false;"><i class="fa fa-eye text-warning" aria-hidden="true"></i> View</a> <br>
                                                         <a href="javascript:void(0)" onclick="passportRedemed(this,`{{ $order['id'] }}`,`{{ $order['user_id'] }}`); return false;" class="btn btn-sm btn-primary">Passport Redeemed</a><br>
                                                      </p>
                                                   </td>

                                                </tr>
                                             <?php }
                                          } else { ?>
                                             <tr class="text-center">
                                                <td>No data Available</td>
                                             </tr>
                                          <?php }  ?>
                                          </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>

                        </div>
                        <div class="tab-pane " id="Address">
                           <!-- Personal Info -->
                           <div class="YOurHistory myOrderTables">
                              <div class="table-responsive" id="checkoutData">
                                 <a href="#!" class="btn btn-info mb-3 float-right" onclick="add_address(<?php echo $user->id ?>)"><i class="fa fa-plus"></i>Add Address</a>
                                 <table class="table table-border TableThree table-borderless checkout-table">
                                    <?php if ($orders->toArray()) {  ?>
                                       <thead>
                                          <tr>
                                             <th>Id</th>
                                             <th>Address Title</th>
                                             <th>City</th>
                                             <th>State</th>
                                             <th>Phone</th>
                                             <th>Address</th>
                                             <th>pincode</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php foreach ($Address as $address_es) { ?>
                                             <tr id="aid_{{ $address_es['id'] }}">
                                                <td>{{ ucwords($address_es['id']) }}</td>
                                                <td>{{ ucwords($address_es['title']) }}</td>
                                                <td>{{ $address_es['city'] }}</td>
                                                <td>{{ $address_es['state'] }}</td>
                                                <td>{{ $address_es['phone'] }}</td>
                                                <td>{{ $address_es['phone'] }}</td>
                                                <td>{{ $address_es['pincode'] }}</td>
                                                <td><a href="#!" class="text-danger" onclick="address_row('<?= $route->destroy_address  ?>','<?= $address_es['id'] ?>')"><i class=" text-danger fa fa-trash"></i> Delete</a></td>
                                             </tr>

                                          <?php }
                                       } else { ?>
                                          <tr class="text-center">
                                             <td>No data Available</td>
                                          </tr>
                                       <?php }  ?>
                                       </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                        <!-- /.tab-pane -->
                        <!-- tab Question -->
                     </div>
                  </div>
                  <!-- /.tab-content -->
               </div>
               <!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </section>
</div>
<div class="modal fade OrderShowModal" id="productModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog h-100" style="min-width:90%;max-width:90%">
      <div class="d-table h-100 w-100">
         <div class="d-table-cell align-middle w-100">
            <div class="modal-content">

            </div>
         </div>
      </div>
   </div>
   <!-- <div class="modal-dialog d-table modal-lg h-100" role="document" style="min-width:90%;max-width:90%">
  <div class="d-table-cell align-middle w-100">
    <div class="modal-content">
    </div>
  </div>
  </div> -->
</div>
<!-- Page-body end -->
@endsection
@section('page-js-script')
<script>
   function orderDetails(e, id) {
      // alert('a');
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      $.ajax({
         url: "{{ route('admin.user.orderDetails') }}",
         method: "post",
         dataType: 'json',
         data: {
            id: id
         },
         success: function(data) {
            if (data.success == 1) {
               $('#productModal .modal-content').html(data.view);
               // $('.modal-content').css('background','#1e4b52');
               $('#productModal').modal('show');
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

   function passportDetails(e, id) {
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      $.ajax({
         url: "{{ route('admin.user.passportDetails') }}",
         method: "post",
         dataType: 'json',
         data: {
            id: id
         },
         success: function(data) {
            if (data.success == 1) {
               $('#productModal .modal-content').html(data.view);
               //   $('.modal-content').css('background','#1e4b52');
               $('#productModal').modal('show');
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

   function passportRedemed(e, id, uid) {
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      $.ajax({
         url: "{{ route('admin.get_all_coupons') }}",
         method: "post",
         dataType: 'json',
         data: {
            'id': id,
            'uid': uid
         },
         success: function(data) {
            if (data.success == 1) {
               $('#productModal .modal-content').html(data.view);
               //   $('.modal-content').css('background','#1e4b52');
               $('#productModal').modal('show');
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

   function add_address(id) {
      url = "{{ route('admin.add_address') }}";

      $('#modal-default .modal-content').html('');
      $.ajax({
         url: url,
         method: "GET",
         data: {
            id: id
         },
         success: function(res) {
            $('#modal-default .modal-content').html(res);
            $('#modal-default').modal('show');
         }
      });
   }

   function address_row(url, id) {
      url = url.replace(':id', id);
      // alert(url)
      if (confirm('Are you sure you want to delete this?')) {
         $.ajax({
            url: url,
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "GET",
            data: {},
            dataType: "JSON",
            success: function(data) {
               toastr.success(data.message, 'Success');
               location.reload();
            },

         });
      } else {
         return false;
      }
   }
</script>
@endsection