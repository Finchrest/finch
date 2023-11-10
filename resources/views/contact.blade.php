@extends('layouts.app')
@section('content')
<!--**********|| Value Proposition Section ||**********-->
<section class="w-100 clearfix AboutUs ValueProposition ContactUs" id="ContactUs">
  <div class="BgBannerImage1 position-absolute w-100"> 
    <img src="{{ asset('front-assets/images/banner8.png') }}" class="img-fluid BannerImg1 BannerImg3">
    {{-- <img src="{{ asset('front-assets/images/banner2.png') }}" class="img-fluid BannerImg1 BannerImg4"> --}}
  </div>
  <div class="container">
    <div class="fbFinchInfoDetails">
      <div class="HeadingText HeadingText2 text-center mb-4">
        <h3 class="mb-3">Contact Us</h3>
      </div>
      <div class="FinchMegaInfo w-100">
        <div class="FbFinchBrefCafe w-100">
          <div class="row">
            <div class="col-lg-6">
              <div class="CansumerForm w-100">
                <form onsubmit="contact_form(this); return false;">
                  <div class="form-group mb-4">
                    <label>Name <sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="name" placeholder="Your Name" value="{{@$name}}">
                  </div>
                  <div class="form-group mb-4">
                    <label>Phone Number <sup class="text-danger">*</sup></label>
                    <input type="number" class="form-control" name="phone" placeholder="Mobile Number" value="{{@$phone}}">
                  </div>
                  <div class="form-group mb-4">
                    <label>Email ID <sup class="text-danger">*</sup></label>
                    <input type="email" class="form-control" name="email" placeholder="Enter Your Email ID" value="{{@$email}}">
                  </div>
                  <div class="form-group mb-4">
                    <label>Message <sup class="text-danger">*</sup></label>
                    <textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea>
                  </div>
                  <div class="clGetYoursNow w-100" style="padding: 0px !important;">
                    <button type="submit" class="btn m-0 onOrder onOrder2 w-100 p-3">Send Message</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-lg-6 contactDetails pt-5">
              <div class="d-flex mx-lg-3">
                <span class="icon ml-lg-0 ml-1"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                <div class="div1 pt-2">B2 Wing, Unit No. 403, Boomerang Building, Near Chandivali Studio, Chandivali Andheri East, Mumbai - 400072 India</div>
              </div>
              <div class="d-flex m-lg-3">
                <span class="icon ml-lg-1 ml-2"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                <div class="div1 pt-2">+91 9136914858 <br> +91 9820886707</div>
              </div>
              <!-- <div class="d-flex m-lg-3">
                <span class="icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                <div class="div1 mx-lg-4 ml-3 pt-2">example123@email.com</div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--**********|| see What Offer Section ||**********-->
<section class="w-100 clearfix SeeWhatOther py-5 position-relative d-none" id="SeeWhatOther" style="padding: 0px 0px 50px !important;">
      <div class="HeadingText HeadingText2 text-center mb-3">
        <h3 class="mb-3">Finch Brew Cafe Is On Social Media</h3>
          <p class="mb-0 pb-3">@FINCHBREWCAFE</p>
        </div>
      <div class="fbOtherShare w-100 clearfix">
         <div class=" fbShareLists" id="fbShareListsOwl1">
            <?php $count = 0; ?>
            @foreach($instaPosts as $instafeeds)
            <?php if($count == 9) break; ?>
              <a href="{{url($instafeeds->permalink)}}" class="" target="_blank">
                <img src="{{ $instafeeds->media_url }}" class="img-fluid lazy" alt="No Image">
             </a> 
             <?php $count++; ?>
            @endforeach
            </div>
            <div class="clGetYoursNow w-100 pt-5 text-center">
          <a href="{{route('instagram_feeds')}}" class="btn onOrder onOrder2 btn-lg py-3 px-5">See More</a>
        </div>
      </div>
    </section>
    <!--**********|| see What Other Section ||**********-->
    <footer>
      <div class="footer_class">
        <p class="pl-5 pt-5">Owned by :- Plutusone Hospitality Pvt. Ltd.</p>
         </div>
    </footer>
@endsection

<script>

  function contact_form(e){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({  
      url :"{{ route('contact_form') }}",  
      method:"POST",  
      data:$(e).serialize(),
      success: function(data){ 
        if(data.success==1){
          toastr.success(data.message,'Success');
          setTimeout(function() {location.reload(); },1500);
        }else{
          // toastr.error(data.message,'Error2');
        }
      },
      error: function(data){ 
        if(typeof data.responseJSON.status !== 'undefined'){
          toastr.error(data.responseJSON.error,'Error');
        }else{
          var err = '';
          $.each(data.responseJSON.errors, function( key, value ) {
            err += value+'<br>';
          });
          toastr.error(err,'Error');
        }
        $(e).find('.st_loader').hide();
      } 
    }); 
  }

</script>