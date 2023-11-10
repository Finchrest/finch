<div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-header start -->
                                    <div class="page-header card">
                                        <div class="card-block">
                                            <h5 class="m-b-10">Order #{{ $info['order']['id'] }} <br><small>Passport Code {{ $info['order']['passport_code'] }}</small></h5>
                                            <div class="col-lg-12 text-center">
                                               <div class="row">                                            <div class="col-lg-4">
                                            <small>Volume <br> ₹{{ $info['order']['volume_amount'] }}</small>
                                            </div>
                                            <div class="col-lg-4">
                                            <small>Used <br> ₹{{ $info['order']['used_amount'] }}</small>
                                            </div>
                                            <div class="col-lg-4">
                                            <small>Remaining <br> ₹{{ $info['order']['remaining_amount'] }}</small>
                                            </div>
                                            </div>
                                            </div>
                                         </div>
                                    </div>
                                    <!-- Page-header end -->
									
									<?php if(isset($info['order']['items'])){ ?>
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                   <div class="card-header">
                                                      <h5 class="card-header-text">Orders</h5>
                                                   </div>
                                                   <div class="card-block contact-details">
                                                      <div class=" table-responsive dt-responsive">
                                                         <div id="simpletable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                            <div class="row">
                                                            
                                                            <table id="simpletable" class="table table-striped table-bordered nowrap " >

                                                            <tr>
                                                               <th>S.No.</th>
                                                               <th>Order Date</th>
                                                               <th>Amount</th>
                                                               <th>Order Type</th>
                                                            </tr>
                                                            <?php 
                                                            $i=1;
                                                            foreach($info['order']['items'] as $item){ ?>
                                                            <tr>
                                                               <td>{{ $i }}</td>
                                                               <td>{{ $item['order_date'] }}</td>
                                                                <td>₹{{ $item['amount'] }}</td>
                                                                <td>{{ $item['order_type'] }}</td>
                                                            </tr>
                                                            <?php  $i++;} ?>    
                                                            </table>
                                                      </div></div>
                                                      
                                                   </div>
                                             </div>
                                             <!-- contact data table card end -->
                                          </div>
                                       </div>
                                       </div>
                                    <!-- Page-body end -->
                                </div>
									<?php } ?>
                            </div>