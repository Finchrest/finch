@extends('restaurant.layouts.app')

@section('content')
<style>
   blink {
      animation: 1s linear infinite condemned_blink_effect;
   }




   @keyframes condemned_blink_effect {
      0% {
         visibility: hidden;
      }

      50% {
         visibility: hidden;
      }

      100% {
         visibility: visible;
      }
   }
</style>
<!-- Page-body start -->
<div class="page-header card">
   <div class="card-block caption-breadcrumb">
      <h6 class="m-b-20">Search User</h6>
      <div class="d-flex">
         <input type="text" class="form-control search_user allowno" name="search_user" palceholder="Search User">
         <a href="#!" class="btn btn-info" onclick="formSubmit()"><i class="fa fa-search" aria-hidden="true"></i></a>
      </div>
   </div>
</div>
<div class="page-header card">
   <div class="card-block caption-breadcrumb">
      <a href="{{ route('restaurant.add.order') }}" class="btn btn-primary"> Add Order </a>
   </div>
</div>
<div class="page-body">

   <div class="pb-3">
      <!-- <span  onclick="cheakorderView()" class="cheakorderView btn btn-md btn-primary">Click Here To View Orders <blink><b></b></blink></span> -->
      <input type="hidden" id="show_order" value="0">
      <input type="hidden" id="sound_active" value="0">
      <input type="hidden" id="last_count" value="0">
      <input type="hidden" id="new_count" value="0">
   </div>
   <div class="container">
      <button id="btn" class="btn d-none">Submit</button>
   </div>
   <div class="row" id="restOrder"></div>

   <div class="row d-none" id="not_found_box">
      <div class="col-sm-12">
         <div class="card text-center">
            <div class="card-block">
               <img class="img-fluid" src="{{ asset('front-assets/images/no_order_available.png') }}" alt="Theme-Logo">
            </div>
         </div>
      </div>
   </div>
</div>
</div>


<!-- Modal Header -->



<!-- Page-body end -->
@endsection
@section('page-js-script')
<script>
   $(document).ready(function() {

      $(".allowno").keypress(function(e) {
         if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            event.preventDefault();
         }
      });
      $('.allowno').on('paste', function(e) {
         if (e.originalEvent.clipboardData.getData('Text').match(/[^\d]/)) {
            e.preventDefault();
         }
      });
   });

   $('#modal-dshbored').modal({
      backdrop: 'static',
      keyboard: false
   })

   function cheakorderView() {
      $('#not_found_box').addClass('d-none');
      $('.cheakOrder').removeClass('d-none');
      $('.cheakorderView').addClass('d-none');
      var lst = $('#last_count').val();
      $('#show_order').val(1);
      $('#sound_active').val(1);
      $('#modal-dshbored').modal('hide');
      $('#modal-dshbored .modal-content').html('');

      getDashboredOrder();
      if (lst > 0) {
         flashVisible();
         sound();
      }
   }
   dasboredModel();

   function dasboredModel() {
      $('#modal-dshbored .modal-content').html('<div class="modal-header"><h4 class="modal-title">Modal Heading</h4> </div><div class="modal-body">Click Ok Button To View Order</div><div class="modal-footer"><button type="button" class="btn btn-danger"  onclick="cheakorderView()" >Ok</button></div>');
      $('#modal-dshbored').modal('show');
   }



   $(document).ready(function() {

      // $('#show_order').val(1);
      // getDashboredOrder();
      setInterval(function() {
         getDashboredOrder();
      }, 1000);


   });



   function sound() {
      var sound = '<?php echo $sound ?>';
      if (sound) {
         var audio = new Audio('/admin-assets/music/' + sound);
         audio.play();
      } else {
         var audio1 = new Audio('/admin-assets/music/bell.mp3');
         audio1.play();
      }
      $('#sound_active').val(0);
   }


   function getDashboredOrder() {
      var lst = $('#last_count').val();
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      $.ajax({
         url: "{{route('restaurant.getDashboredOrders')}}",
         method: "POST",
         dataType: "json",
         success: function(data) {
            //sound();
            // alert(data.ordercount);
            // alert(lst);
            if (data.ordercount == 0) {
               $('#restOrder').html('');
               $('#not_found_box').removeClass('d-none');
               $('.cheakorderView').addClass('d-none');
               $('#sound_active').val(0);
               $('#last_count').val(0);
            } else {

               if ($('#show_order').val() == 0) {
                  $('#restOrder').html('');
                  $('#sound_active').val(0);
                  $('#not_found_box').removeClass('d-none');
                  $('.cheakorderView').removeClass('d-none');
                  $('.cheakorderView b').html('<span class="badge badge-dark">' + data.ordercount + '</span>');
               } else {
                  $('#restOrder').html(data.view);
                  $('#not_found_box').addClass('d-none');
                  $('.cheakorderView').addClass('d-none');
                  if (parseInt(data.ordercount) !== parseInt(lst)) {
                     sound();
                     flashVisible();
                  }
                  sound();
               }


               $('#last_count').val(data.ordercount);

            }
         }
      });
   }


   function update_status(url, order_id, status) {
      // alert('sadasd');
      if (confirm('Are you sure you want to update this?')) {

         $.ajax({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: "POST",
            dataType: "json",
            data: {
               order_id: order_id,
               status: status
            },
            success: function(data) {
               if (data.success == 1) {
                  toastr.success(data.message, 'Success');
                  getDashboredOrder();

               } else if (data.success == 0) {
                  toastr.error(data.message, 'Error');

               }
            }
         });

      } else {
         return false;
      }
   }





   function update_status(url, order_id, status) {
      if (confirm('Are you sure you want to update this?')) {
         $.ajax({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: "POST",
            dataType: "json",
            data: {
               order_id: order_id,
               status: status
            },
            success: function(data) {
               if (data.success == 1) {
                  toastr.success(data.message, 'Success');


               } else if (data.success == 0) {
                  toastr.error(data.message, 'Error');

               }
               getDashboredOrder();

            }
         });
      } else {
         return false;
      }
   }

   function flashVisible() {
      // alert('dasdd');
      $('#modal-flash .modal-content').html('<div class="modal-header"><h4 class="modal-title">Modal Heading</h4> </div><div class="modal-body">New Order Recieved</div><div class="modal-footer"><button type="button" class="btn btn-danger"  onclick="inVisible()" >Ok</button></div>');
      $('#modal-flash').modal('show');
   }

   function inVisible() {
      // alert('test');
      $('#modal-flash').modal('hide');
      $('#modal-flash .modal-content').html('');
   }

   function formSubmit(e) {
      var search = $('.search_user').val();

      $(e).find('.st_loader').show();
      $.ajax({
         // url: $(e).attr('action'),
         url: "{{ route('admin.search') }}",
         data: {
            search_user: search,
         },
         success: function(data) {

            if (data.success == 1) {
               $('#modal-default').modal('show');
               $('#modal-default .modal-content').html(data.view);

            } else if (data.success == 0) {
               toastr.error(data.message, 'Error');
               $(e).find('.st_loader').hide();
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
</script>
@endsection