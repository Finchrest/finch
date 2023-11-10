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
													$shipping_address .= $info->name.'<br>';
													$shipping_address .= $info->phone.'<br>';
													$shipping_address .= $info->address.'<br>';
													$shipping_address .= $info->city.', '.$info->state.'<br>';
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
                                                            
                                                            <table id="simpletable" class="table table-striped table-bordered nowrap " >

                                                            <tr>
                                                               <th>S.No.</th>
                                                               <th>Product</th>
                                                               <th>Sub total</th>
                                                               <th>Quanity</th>
                                                               <th>Total</th>
                                                            </tr>
                                                            <?php 
                                                            $i=1;
                                                            foreach($items as $item){ ?>
                                                            <tr>
                                                               <td>{{ $i }}</td>
                                                               <td>{{ $item['product']['title'] }}</td>
                                                                <td>{{ $item['product']['total_price'] }}</td>
                                                                <td>{{ $item['qty'] }}</td>
                                                                <td>₹{{ $item['sub_total'] }}</td>
                                                              
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
                            </div>