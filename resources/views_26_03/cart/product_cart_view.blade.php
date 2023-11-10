        @if($product->type == 1)
                      @php
                        if(!empty($product->badge_file)){
                          $badge_icon = asset($product->BadgeFileId->file); 
                        }else{
                          $badge_icon = '';
                        }
                        if(!empty($product->file_id)){
                          $pimg = asset($product->FileId->file); 
                        }else{
                          $pimg = '';
                        }
                        
                      @endphp
                     
                        <a href="javascript:void(0);" class="d-block">
                          <div class="fbOrderDetails w-100 text-white">
                            <div class="row">
                              <div class="col-md-2 col-3 pr-0 text-center">
                                <div class="odrImg2 w-100">
                                  <img src="{{$pimg}}" class="img-fluid" alt="NO Image">
                                </div>
                              </div>
                              <div class="col-md-5 col-6">
                                <div class="OdrMiddleText w-100 mx-2">
                                  <h5 class="mb-md-3 one-line-text">{{$product->title}}</h5>
                                  <p class="mb-md-4 mb-2 clr_blue">{{$product->sub_title}}</p>
                                  <p class="mb-md-4 m-0 four-line-text">{{strtolower($product->short_description)}}</p>
                                </div>
                              </div>
                              <div class="col-3 pr-0 text-center HideOnMob">
                                <div class="odrImg3 w-100 d-table h-100">
                                  <div class="d-table-cell align-middle">
                                    <img src="{{ $badge_icon }}" class="img-fluid" alt="NO Image" width="175px" height="170px">
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-2 col-3">
                                <div class="OdrPriceDetails w-100 text-right">
                                  <h5><i class="fa fa-inr" aria-hidden="true"></i>
                                    <span>@if(empty($product->price)){{$product->total_price}}@else{{$product->price}}@endif</span>
                                  </h5>
                                    <div class="AddMoreBtn" style="<?php if(isset($cart[$product->id]) && $product->is_product_attr == 0){ echo 'display:none;';}?>"  id="addBtn_{{$product->id}}">
                  
                                    <p href="javascript:void(0);" class="btn m-0 onOrder onOrder2 drinkAdd" id="vproductBtn_{{$product->id}}" onclick="viewProduct(this,'{{$product->id}}'); return false;">Add</p>
                    </div>
                  <div class="QuntityCount pt-2 text-center" id="QuntityCount_{{$product->id}}" style="display: inline-table;<?php if(!isset($cart[$product->id]) || $product->is_product_attr == 1){ echo 'display:none;';}?>">
                  <div class="MngeQuntity">
                  <input type="hidden" name="id" value="{{$product->id}}">
                    <input type="button" value="-" class="qty-minus onOrder onOrder2" onclick="update_qty({{$product->id}},'{{ @$cart[$product->id]['row_id'] }}',0)">
                  <input type="number" name="qty" value="{{ @$cart[$product->id]['qty'] }}" class="qty" id="qty_{{$product->id}}">
                  <input type="button" value="+" class="qty-plus onOrder onOrder2" onclick="update_qty({{$product->id}},'{{ @$cart[$product->id]['row_id'] }}',1)"> 
                  </div>
                </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </a>
                     
                    @endif
        
        @if($product->type == 2)
                    @php
                      $pimg = asset($product->FileId->file); 
                    @endphp
                   
                      <a href="javascript:void(0);" class="d-block">
                        <div class="fbOrderDetails w-100 text-white">
                          <div class="row">
                            <div class="col-md-10 col-9">
                              <div class="row">
                                <div class="col-md-5 col-4 pr-0">
                                  <div class="odrImg w-100">
                                    <img src="{{$pimg}}" class="img-fluid" alt="NO Image">
                                  </div>
                                </div>
                                <div class="col-md-7 col-8">
                                  <div class="OdrMiddleText w-100 HideInMob">
                                    <h5 class="one-line-text">{{$product->title}}</h5>
                                    <p class="four-line-text">{{strtolower($product->short_description)}}</p>
                                  </div>
                                </div>
                                <div class="col-12 ShowInMob px-0">
                                  <div class="OdrMiddleText w-100">
                                    <p class="mb-0">{{strtolower($product->short_description)}}</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-2 col-3">
                              <div class="OdrPriceDetails w-100 text-right">
                                <h5><i class="fa fa-inr" aria-hidden="true"></i>
                                  <span>@if(empty($product->price)){{$product->total_price}}@else{{$product->price}}@endif</span>
                                </h5>
                
                <div class="AddMoreBtn" style="<?php if(isset($cart[$product->id])){ echo 'display:none;';}?>"  id="addBtn_{{$product->id}}">
                                <p href="javascript:void(0);" class="btn m-0 onOrder onOrder2" onclick="viewMealsProduct(this,'{{$product->id}}'); return false;">Add</p>
                </div>
                
                <div class="QuntityCount pt-2 text-center" id="QuntityCount_{{$product->id}}" style="<?php if(!isset($cart[$product->id])){ echo 'display:none;';}?>">
                  <div class="MngeQuntity">
                  <input type="hidden" name="id" value="{{$product->id}}">
                <input type="button" value="-" class="qty-minus onOrder onOrder2" onclick="update_qty({{$product->id}},'{{ @$cart[$product->id]['row_id'] }}',0)">
                  <input type="number" name="qty" value="{{ @$cart[$product->id]['qty'] }}" class="qty" id="qty_{{$product->id}}">
                  <input type="button" value="+" class="qty-plus onOrder onOrder2" onclick="update_qty({{$product->id}},'{{ @$cart[$product->id]['row_id'] }}',1)"> 
                  </div>
                </div>
                
                 
                              </div>
                            </div>
                          </div>
                        </div>
                      </a>
                 
                  @endif