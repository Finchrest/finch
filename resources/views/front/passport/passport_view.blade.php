
      <button type="button" class="close" data-dismiss="modal">&times;</button>
<div class="modal-body p-md-5 p-4">
  <div class=" PassportDetailsHere">
    <div class="HeadingText HeadingText2 text-center">
      <h3 class="">BEER PASSPORT</h3>
      <p class="mb-0">GET AMAZING BENEFITS AND SAVINGS</p>
    </div>
      <section class="insidepage-content-1 my-md-5 py-5 px-2 myOrderPage myPassportPage">
  <div class="container mt-md-5 myOrderContainer">
    <div class="HeadingText HeadingText2 text-center mb-3">
      <h3 class="mb-4">Finch Passport</h3>
    </div>
    <div class="YOurHistory">
      <div class="table-responsive" id="checkoutData">
        <table class="table table-border TableThree table-borderless checkout-table">
          <thead>
            <tr>
            <th class="text-left text-white">Name</th>
            <th class="text-left text-white">Price</th>
            <th class="text-left text-white">Value</th>
            <th class="text-white">Action</th>
            </tr>
          </thead>
          <tbody id="getUserdata">
          <?php foreach($passports as $passport){ ?>
            <tr id="">
            <td class="text-left text-white">{{ ucwords($passport->name) }}</td>
            <td class="text-left text-white">
            <p class="mb-1 text-left">
               <!-- <span class="span1">Price</span> -->
                <span class="span2">{{ number_format($passport->price,2) }}</span>
            </p>
            </td>
            <td class="text-left text-white">
            <p class="mb-1 text-left">
               <!-- <span class="span1">Value</span> -->
                <span class="span2">{{ number_format($passport->volume,2) }}</span>
            </p>
            </td>
            <td><a class="btn btn-warning w-100 text-white" href="javascript:void(0)" onclick="getPassportView(this,`{{ $passport->id }}`);">Get Your Passport</a><span><span><br>
            </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
</div>
</div>

      <?php }elseif(isset($passport_one)){ ?>
<button type="button" class="close" data-dismiss="modal">&times;</button>
<div class="modal-body p-md-5 p-4">
  <div class="FoodDetailsHere PassportDetailsHere">
    <div class="HeadingText HeadingText2 text-center">
      <h3 class="">BEER PASSPORT</h3>
      <p class="mb-0">GET UNLIMITED BENEFITS AND SAVINGS</p>
    </div>
    <div class="PassportDetails col-md-10 m-auto" style="background-image: url(images/bottom_pattern.png);">
      <div class="fbFtrLinks w-100">
        <ul class="list-unstyled fbFtrLists">
          <li>
            <a href="javascript:void(0);">Beer worth Rs. 12000.</a>
          </li> 
          <li>
            <a href="javascript:void(0);">Complimentary dessert Cake On your Birthday</a>
          </li>
          <li>
            <a href="javascript:void(0);">2 Complimentary Brunch Coupons for 2 Persons.</a>
          </li> 
          <li>
            <a href="javascript:void(0);">2 Complimentary Event Tickets</a>
          </li> 
          <li>
            <a href="javascript:void(0);">15% Discounts on Home delivery and Takeaway.</a>
          </li>
          <li>
            <a href="javascript:void(0);">20% Top-up referrals.</a>
          </li>
        </ul>
      </div>
      <div class="clGetYoursNow w-100 pt-5 text-center">
        <a href="javascript:void(0);" class="btn m-0 onOrder onOrder2 w-100 p-2" onclick="getPassportView(this,`{{ $passport_one->id }}`); return false;">Get Your Passport</a>
      </div>
      <div class="PassportAccordian mt-5">
        <div id="accordion">
          <div class="card">
            <div class="card-header px-0" id="headingOne">
              <h5 class="mb-0">
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                TERMS OF USE <i class="fa fa-caret-down float-right" aria-hidden="true"></i>
                </a>
              </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body px-0">
                <ul class="fbFtrLists pl-3">
                  <li>
                    <a href="javascript:void(0);">For consumption in both the restaurants</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">Valid on any available craft beers</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">12 month validity</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">Min. consumption half ltr in one transaction</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">Max consumption 4 ltrs in 1 day</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">This redemption can not be clubbed with any other discounts, offers or vouchers</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">This program is non-transferrable and money paid is non refundable and this can not be partly or wholly uncashed</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header px-0" id="headingTwo">
              <h5 class="mb-0">
                <a href="javascript:void(0);" class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                SEE ALL BENEFITS <i class="fa fa-caret-down float-right" aria-hidden="true"></i>
                </a>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body px-0">
                <ul class="fbFtrLists pl-3">
                  <li>
                    <a href="javascript:void(0);">Beer worth Rs. 12000/-</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">Complimentary bottles of house wine</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">Complimentary desert cake on your Birthday</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">Two complimentary brunch coupons for 2 persons</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">Two complimentary couple entries for paid gigs at the Finch</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">15% discount on take away and delivery of Foods & Beer</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">Exclusive invites to the beer league event</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">Exclusive invites for testing sessions</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">One free invite for Mixology / Food Workshop</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">Complimentary tour of our brewery</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">20% Top-up on referreals</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">10% redeemable points on food spends</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
</div>
    <?php }else{ ?>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
<div class="modal-body p-md-5 p-4">
  <div class="FoodDetailsHere PassportDetailsHere">
    <div class="HeadingText HeadingText2 text-center">
      <h3 class="">BEER PASSPORT</h3>
      <p class="mb-0">GET UNLIMITED BENEFITS AND SAVINGS</p>
    </div>
      <div><h3>No Passport Avaialable For These Location</h3></div>
      <div class="HeadingText HeadingText2 text-center">
      <!-- <h3 class="">BEER PASSPORT</h3> -->
      <p class="mb-0"><h3>No Passport Avaialable For These Location</h3></p>
    </div>
    </div>
</div>
    <?php } ?>


<script>
    
  function getPassportView(e,id){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({  
      url :"{{route('getPassportView')}}",  
      method:"POST",  
      dataType:"json",  
      data:{'id':id},
      success: function(data){ 
        if(data.success==0){
          toastr.error(data.message,'Error');
        }else if(data.success==1){
          $('#ModalOne .modal-content').html('');    
          $('#ModalOne .modal-content').html(data.view);    
        }
      }
    }); 
  }

</script>