<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $getSiteSettings = getSiteSettings(); ?>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="-1" />
  <title><?php echo $getSiteSettings['site_title']; ?></title>
  <meta name="description" content="<?php echo $getSiteSettings['meta_description']; ?>">
  <meta name="keywords" content="<?php echo $getSiteSettings['meta_keywords']; ?>">
  <link rel="icon" href="{{ asset('front-assets/images/logo2.png') }}" type="image/png" sizes="32x32">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="{{ asset('front-assets/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front-assets/css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('front-assets/css/owl.css') }}" rel="stylesheet">
  <link href="{{ asset('front-assets/css/simple-lightbox.css') }}" rel="stylesheet">
  <link href="{{ asset('front-assets/css/reset.css') }}?<?php echo time(); ?>" rel="stylesheet">
  <link href="{{ asset('front-assets/css/style.css') }}?<?php echo time(); ?>" rel="stylesheet">
  <link href="{{ asset('front-assets/css/style_2.css') }}?<?php echo time(); ?>" rel="stylesheet">
  <link href="{{ asset('front-assets/css/responsive.css') }}?<?php echo time(); ?>" rel="stylesheet">
  <link href="{{ asset('front-assets/toastr/toastr.css') }}" rel="stylesheet">
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-GBNZX0PJTY"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-GBNZX0PJTY');
  </script>
</head>

<body>
  @include('includes.top-navbar')
  @yield('content')
  <!--**********|| Footer Section ||**********-->
  <script src="{{ asset('front-assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('front-assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('front-assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('front-assets/js/owl.carousel.js') }}"></script>
  <script src="{{ asset('front-assets/js/lazyload.min.js') }}"></script>
  <script src="{{ asset('front-assets/js/simple-lightbox.js') }}"></script>
  <script src="{{ asset('front-assets/js/custom.js') }}?<?php echo time(); ?>"></script>
  <script src="{{ asset('front-assets/toastr/toastr.min.js') }}"></script>
  <script>
    (function() {
      var $gallery = new SimpleLightbox('.gallery a', {});
    })();
  </script>
  <!--**********|| Modal Section ||**********-->
  <div class="OrderModalInside">
    <!-- The Modal -->
    <div class="modal OrderShowModal Coupon" id="infoModal">
      <div class="modal-dialog h-100">
        <div class="d-table h-100 w-100">
          <div class="d-table-cell align-middle w-100">
            <div class="modal-content">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--**********|| Modal Section ||**********-->

  <!--*****|| Modal One ||*****-->
  <div class="modal PassportModal1 OrderShowModal" id="ModalOne">
    <div class="modal-dialog h-100">
      <div class="d-table h-100 w-100">
        <div class="d-table-cell align-middle w-100">
          <div class="modal-content">

          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade show" id="modal-dshbored">
    <div class="modal-dialog modal-lg">
      <div class="d-table w-100 h-100">
        <div class="d-table-cell w-100 h-100 align-middle">
          <div class="modal-content">

          </div>
        </div>
      </div>
    </div>
  </div>
  <!--*****|| Modal One ||*****-->





  <script>
    // rememberAmount();
    // $('#modal-dshbored').modal({

    //         backdrop: 'static',
    //         keyboard: false
    //     })

    toastr.options = {
      "closeButton": true,
      "progressBar": true,
      "showDuration": "1000",
      "hideDuration": "1000",
      "timeOut": "2000",
    };

    var user_id = $('#isUserLogin').val();

    $(document).ready(function() {
      var len = $('#isNew').length;
      var val = $('#isNew').val();
      if (val == 1) {
        profileView();
      }

      var getLoc = $('#getLoc').val();
      if (getLoc == '') {
        //changeLocations();
      }



      setCartData();

    });


    function changeLocations() {
      var content = $('.setlocation').html();

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{route('changeLocations')}}",
        method: "POST",
        dataType: "json",
        data: {},
        success: function(data) {
          if (data.success == 1) {
            $('#infoModal .modal-content').html(data.view);
            $('#infoModal').modal({
              backdrop: 'static'
            });
          }
        },
      });
    }

    function setLocations(e, id, type = '') {
      if (type == 'find') {
        var l_val = $('#find_location').val();
      } else {
        var l_val = $(e).val();
      }

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{route('setLocations')}}",
        method: "POST",
        dataType: "json",
        data: {
          location_id: l_val
        },
        success: function(data) {
          if (data.success == 1) {
            $('#infoModal').modal('hide');
            toastr.success(data.message, 'Success');
            //location.reload();

            window.location.href = data.url;
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

    function cloasemodel(e, id) {
      // alert(id);
      $('#' + id).modal('hide');
      $('#' + id + '.modal-content').html('');

    }

    function cloaseLocationsModal() {

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{route('cloaseLocationsModal')}}",
        method: "POST",
        dataType: "json",
        data: {},
        success: function(data) {
          if (data.success == 1) {
            $('#infoModal').modal('hide');
            $('#location_modal').val(1);
          }
        },

      });
    }


    function showAgeSiteModal(id = 0) {
      $('#age_product_id').val(id);
      $('#ageSiteModal').modal({
        backdrop: 'static'
      });
    }

    function ageSubmit(e) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{route('ageSubmit')}}",
        method: "POST",
        dataType: "json",
        data: $(e).serialize(),
        success: function(data) {
          if (data.success == 1) {
            $('#user_age').val(data.age);
            $('#ageSiteModal').modal('hide');
            toastr.success(data.message, 'Success');
            setTimeout(function() {
              if (data.age > 21) {
                if ($('#vproductBtn_' + data.pid).length > 0) {
                  $('#vproductBtn_' + data.pid).click();
                }
                $('.drinkAdd').show();
              } else {
                $('.drinkAdd').hide();
                toastr.error('You age not under 21 for buy drink', 'Error');
              }
            }, 500);
            //location.reload();
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

    function showLoginPage(e) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{route('showLoginPage')}}",
        method: "POST",
        dataType: "json",
        success: function(data) {
          if (data.success == 0) {
            toastr.error
          } else if (data.success == 1) {
            $('#infoModal .modal-content').html(data.view);
            $('#infoModal').modal('show');
            
          }
        }
      });
    }

    function showOrderTypePage(e) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{route('showOrderTypePage')}}",
        method: "POST",
        dataType: "json",
        success: function(data) {
          if (data.success == 0) {
            toastr.error
          } else if (data.success == 1) {
            $('#infoModal .modal-content').html(data.view);
            $('#infoModal').modal('show');
            
          }
        }
      });
    }

    function showOrderTypeHomePage(e) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{route('showOrderTypeHomePage')}}",
        method: "POST",
        dataType: "json",
        success: function(data) {
          if (data.success == 0) {
            toastr.error
          } else if (data.success == 1) {

            $('#OrdrTypeModel .modal-content').html(data.view);
            $("#OrdrTypeModel").modal({backdrop: "static"});
            $('#OrdrTypeModel').modal('show');
            
          }
        }
      });
    }

    function loginSubmit(e) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{route('submitLoginDetails')}}",
        method: "POST",
        dataType: "json",
        data: $(e).serialize(),
        success: function(data) {
          if (data.success == 0) {
            var er = '';
            $.each(data.error, function(key, value) {
              //   toastr.error(value,'Error');
              er += value + '<br>';
            });
            toastr.error(data.message, 'Error');
          } else if (data.success == 1) {
            toastr.success(data.message);
          } else if (data.success == 2) {
            toastr.success(data.message);


            viewOtp(data.email, data.otp);
          } else if (data.success == 3) {
            viewPin(data.email);
           
          }
        },
        error: function(data) {
          if (typeof data.responseJSON.status !== 'undefined') {
            toastr.error(data.responseJSON.error, 'Error');
          } else {
            var er = data.responseJSON.message;
            $.each(data.responseJSON.errors, function(key, value) {
              //   toastr.error(value,'Error');
              er += value + '<br>';
            });
            toastr.error(er, 'Error');
          }
          $(e).find('.isActive').attr('disabled', false);
          $(e).find('.isLoader').hide();
        }
      });
    }

    function viewOtp(email, otp) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{route('viewOtpPage')}}",
        method: "POST",
        dataType: "json",
        data: {
          email: email,
          otp: otp
        },
        success: function(data) {
          if (data.success == 0) {
            toastr.error
          } else if (data.success == 1) {
            $('#infoModal .modal-content').html(data.view);
            $('#infoModal').modal({
              backdrop: 'static'
            });
          }
        }
      });
    }

    function viewPin(email) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{route('viewPinPage')}}",
        method: "POST",
        dataType: "json",
        data: {
          email: email,
        },
        success: function(data) {
          if (data.success == 0) {
            toastr.error
          } else if (data.success == 1) {
            $('#infoModal .modal-content').html(data.view);
            $('#infoModal').modal({
              backdrop: 'static'
            });
          }
        }
      });
    }

    function otpSubmit(e) {
   
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{ route('otpSubmit') }}",
        method: "POST",
        dataType: "json",
        data: $(e).serialize(),
        success: function(data) {
          if (data.success == 1) {
            toastr.success(data.message, 'Success');
            location.reload();
            var lastUrl = sessionStorage.getItem("lastUrl");
            if(lastUrl){
              window.location.href = lastUrl;
              sessionStorage.setItem("lastUrl", '');
            }else{
              var surl =  "{{ route('home') }}";
              window.location.href = surl;
            }
          } else if (data.success == 0) {
            toastr.error(data.message, 'Error');
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
        }
      });
    }

    function pinSubmit(e) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{ route('pinSubmit') }}",
        method: "POST",
        dataType: "json",
        data: $(e).serialize(),
        success: function(data) {
          if (data.success == 1) {
            toastr.success(data.message, 'Success');
            location.reload();
            var lastUrl = sessionStorage.getItem("lastUrl");
            if(lastUrl){
              window.location.href = lastUrl;
              sessionStorage.setItem("lastUrl", '');
            }else{
              var surl =  "{{ route('home') }}";
              window.location.href = surl;
            }
          } else if (data.success == 0) {
            toastr.error(data.message, 'Error');
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
        }
      });
    }






    function confrm() {

      // setTimeout(function() {
      location.reload();
      // }, 1000);

    }

    function resendOtp(email) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{ route('resendOtp') }}",
        method: "POST",
        data: {
          email: email
        },
        success: function(data) {
          if (data.success == 1) {
            toastr.success(data.message, 'Success');
          } else if (data.success == 0) {
            toastr.error(data.message, 'Error');
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

        }

      });
    }

    function profileView_front() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{route('profileView')}}",
        method: "POST",
        dataType: "json",
        success: function(data) {
          if (data.success == 0) {
            toastr.error
          } else if (data.success == 1) {
            $('#infoModal .modal-content').html(data.view);
            $('#infoModal').modal({
              backdrop: 'static'
            });
          }
        }
      });
    }

    function setCartData() {
      if (user_id == 'no') {
        return false;
      }
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{ route('setCartData') }}",
        method: "GET",
        data: {},
        success: function(data) {
          $('.cart_count').html(data.cart_count);
          if (data.cart_count == 0) {
            $('.cart_count').hide();
          } else {
            $('.cart_count').show();
          }
          $('#cart_data').html(data.cart_view);
        },
        error: function(data) {
          if (typeof data.responseJSON.status !== 'undefined') {
            toastr.error(data.responseJSON.error, 'Error');
          } else {
            $.each(data.responseJSON.errors, function(key, value) {
              toastr.error(value, 'Error');
            });
          }

        }

      });
    }

    function showPassportPage(e) {
      if (user_id == 'no') {
        toastr.error('Please login first!!', 'Error');
        showLoginPage();
        return false;
      }
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{route('showPassportPage')}}",
        method: "POST",
        dataType: "json",
        success: function(data) {
          if (data.success == 0) {
            toastr.error(data.message, 'Error');
            showLoginPage();
          } else if (data.success == 1) {
            $('#ModalOne .modal-content').html('');
            $('#ModalOne .modal-content').html(data.view);
            $('#ModalOne').modal('show');
          }
        }
      });
    }
  </script>


  <!--*****|| Age Modal Page ||*****-->
  <div class="modal PassportModal1 OrderShowModal" id="ageSiteModal">
    <div class="modal-dialog h-100">
      <div class="d-table h-100 w-100">
        <div class="d-table-cell align-middle w-100">
          <div class="modal-content" style="background-color: var(--yellow);">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <div class="modal-body">
              <div class="cnfrmAge w-100 clearfix">
                <form action="" onsubmit="ageSubmit(this); return false;">
                  <input type="hidden" id="age_product_id" name="age_product_id" value="0">
                  <div class="cnfrmHeading text-center">
                    <h5>Confirm Your Age</h5>
                    <p>We require users to be 21 years old.</p>
                  </div>
                  <div class="cnfrmData w-100 py-5 text-center">
                    <div class="table-responsive w-100">
                      <table class="table table-borderless">
                        <thead>
                          <tr>
                            <?php for ($i = 15; $i <= 60; $i++) { ?>
                              <th>
                                <label for="age_{{$i}}">
                                  <input type="radio" class="form-control" name="age[]" id="age_{{$i}}" value="{{$i}}"><span>{{$i}}</span>
                                </label>
                              </th>
                            <?php } ?>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                  <div class="text-center submitBtn">
                    <button type="submit" class="btn m-0 onOrder" style="width: 150px;padding:6px 20px;font-size:14px;">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--*****|| Age Modal Page ||*****-->

  @yield('page-js-script')
</body>

</html>