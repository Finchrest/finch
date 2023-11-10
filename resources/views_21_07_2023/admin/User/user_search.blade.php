<?php
// echo "<pre>";
// print_r($info_data);
// die;
// foreach ($info_data as $item) {
//    echo "<pre>";
//    print_r($item->id);
// }
?>
<div class="main-body">
   <div class="page-wrapper">
      <!-- Page-header start -->
      <div class="page-header card">
         <div class="card-block">
            <h5 class="m-b-10">Passport Code #{{ $info->passport_code }}</h5>
         </div>
      </div>
      <!-- Page-header end -->

      <!-- Page-body start -->
      <div class="page-body">

         <div class="tab-pane active" id="Passports">
            <div class="container" id="subjQuestioon">
               <div class="YOurHistory myOrderTables">
                  <div class="table-responsive" id="checkoutData">
                     <table class="table table-border TableThree table-borderless checkout-table">
                        <thead>
                           <tr>
                              <th class="text-left">User Detail</th>
                              <th class="text-left">Amount Details</th>
                              <th class="text-left">Validity Details</th>
                           </tr>
                        </thead>
                        <tbody id="getUserdata">
                           <tr id="oid_255">

                              <td class="text-left">
                                 <p class="mb-1 text-left">
                                    <span class="span1">Name</span>
                                    : <span class="span2">{{ $info->name }}</span>
                                 </p>
                                 <p class="mb-1 text-left">
                                    <span class="span1">Email</span>
                                    : <span class="span2">{{ $info->email }}</span>
                                 </p>

                              </td>
                              <td class="text-left">
                                 <p class="mb-1 text-left">
                                    <span class="span1">Price</span>
                                    : <span class="span2">{{ $info->price }}</span>
                                 </p>
                                 <p class="mb-1 text-left">
                                    <span class="span1">Value</span>
                                    : <span class="span2">{{ $info->volume_amount }}</span>
                                 </p>
                                 <p class="mb-1 text-left">
                                    <span class="span1">Used</span>
                                    :<span class="span2">{{ $info->used_amount }}</span>
                                 </p>
                                 <p class="mb-1 text-left">
                                    <span class="span1">Remaining</span>
                                    : <span class="span2">{{ $info->remaining_amount }}</span>
                                 </p>
                              </td>
                              <td class="text-left">
                                 <p class="mb-1 text-left">
                                    <span class="span1">Start</span>
                                    : <span class="span2">{{ $info->start_date }}</span>
                                 </p>
                                 <p class="mb-1 text-left">
                                    <span class="span1">End</span>
                                    : <span class="span2">{{ $info->end_date }}</span>
                                 </p>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                     <?php if (!empty($info_data['order']['items'])) { ?>
                        <table id="simpletable" class="table table-striped table-bordered nowrap ">

                           <tr>
                              <th>S.No.</th>
                              <th>Order Date</th>
                              <th>Amount</th>
                              <th>Order Type</th>
                           </tr>
                           <?php
                           $i = 1;
                           foreach ($info_data['order']['items'] as $item) { ?>
                              <tr>
                                 <td>{{ $i }}</td>
                                 <td>{{ $item['order_date'] }}</td>
                                 <td>₹{{ $item['amount'] }}</td>
                                 <td>{{ $item['order_type'] }}</td>
                              </tr>
                           <?php $i++;
                           } ?>
                        </table>
                     <?php } ?>
                  </div>
               </div>
            </div>

         </div>
      </div>
      <!-- Page-body end -->

      <script>
         function update_item_status(url, item_id, status, e) {
            if (confirm('Are you sure you want to delete this?')) {
               $.ajax({
                  headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: url,
                  method: "POST",
                  dataType: "json",
                  data: {
                     item_id: item_id,
                     status: status
                  },
                  success: function(data) {
                     if (data.success == 1) {
                        toastr.success(data.message, 'Success');
                        $(e).remove();
                        dataTable.draw(false);

                     } else if (data.success == 0) {
                        toastr.error(data.message, 'Error');

                     }
                  }
               });
            } else {
               return false;
            }
         }
      </script>
   </div>
</div>
</div>