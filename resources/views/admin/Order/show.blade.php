<?php //echo "<pre>";print_r($items);die; ?>
<div class="main-body">
   <div class="page-wrapper">
      <!-- Page-header start -->
      <div class="page-header card">
         <div class="card-block">
            <h5 class="m-b-10">Order #{{ $info->id }}</h5>
         </div>
      </div>
      <!-- Page-header end -->

      <!-- Page-body start -->
      <div class="page-body">

         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-header">
                     <h5 class="card-header-text">Shipping Address</h5>
                  </div>
                  <div class="card-block contact-details">
                     <?php
                     $shipping_address = '<small>';
                     $shipping_address .= $info->name . '<br>';
                     $shipping_address .= $info->phone . '<br>';
                     $shipping_address .= $info->address . '<br>';
                     $shipping_address .= $info->city . ', ' . $info->state . '<br>';
                     $shipping_address .= '</small>';

                     echo $shipping_address;
                     ?>

                  </div>
                  <div class="card-header">
                     <h5 class="card-header-text">Products</h5>
                  </div>
                  <div class="card-block contact-details">
                     <div class=" table-responsive dt-responsive">
                        <div id="simpletable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                           <div class="row">

                              <table id="simpletable" class="table table-striped table-bordered nowrap ">

                                 <tr>
                                    <th>S.No.</th>
                                    <th>Product</th>
                                    <th>Sub total</th>
                                    <th>Quanity</th>
                                    <th>Total</th>
                                    <th>Product Type</th>
                                    <th>Action</th>
                                 </tr>
                                 <?php
                                 if ($info->order_status == 0) {
                                    $i = 1;
                                  
                                    foreach ($items as $item) {   
                                    if($item['product']['for_passport'] == 1){
                                      $productType = "Free Product";
                                    }else{
                                      $productType = "Paid Product";
                                    }

                                    if($item['product']['for_passport'] == 1){
                                       $productTotal = "0";
                                     }else{
                                       $productTotal = $item['product']['total_price'];
                                     }

                                       $cancel_btn = '';
                                       if ($item['is_cancelled'] == 0) {
                                          $cancel_btn = '<a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick=update_item_status("' . $route->changeItemStatus . '","' . $item['id'] . '",1,this);>Cancel</a>';
                                       }
                                       ?>
                                       <tr>
                                          <td>{{ $i }}</td>
                                          <td>{{ $item['product']['title'] }}
                                          <?php if ($item['option_name']) { ?>
                                             <br>
                                             <div class="admin-order-atrr">{{ $item['attr_name'] }} : {{ $item['option_name'] }}</div>
                                          <?php } ?>
                                          </td>
                                          <td>{{ $productTotal }}</td>
                                          <td>{{ $item['qty'] }}</td>
                                          <td>₹{{ $item['sub_total'] }}</td>
                                          <td>{{ $productType }}</td>
                                          <td>{!! $cancel_btn !!}</td>
                                       </tr>
                                    <?php $i++;
                                    }
                                 } else {
                                    $i = 1;
                                    foreach ($items as $item) { ?>
                                       <tr>
                                          <td>{{ $i }}</td>
                                          <td>{{ $item['product']['title'] }}</td>
                                          <td>{{ $item['product']['total_price'] }}</td>
                                          <td>{{ $item['qty'] }}</td>
                                          <td>₹{{ $item['sub_total'] }}</td>
                                          <td></td>
                                       </tr>
                                 <?php $i++;
                                    }
                                 } ?>
                              </table>
                           </div>
                        </div>

                     </div>
                  </div>
                  <!-- contact data table card end -->
               </div>
            </div>
         </div>
         <!-- Page-body end -->
      </div>
   </div>
   <script>
   function update_item_status(url, item_id, status,e) {
      if(confirm('Are you sure you want to delete this?')) {
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