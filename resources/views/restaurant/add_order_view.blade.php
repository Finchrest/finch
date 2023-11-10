@extends('restaurant.layouts.app')

@section('content')

<!-- Page-body start -->
<div class="page-header card">
   <div class="card-block caption-breadcrumb">
      <h6 class="m-b-20">Enter Passport Code</h6>
      <div class="d-flex">
         <input type="text" class="form-control search_user allowno" name="search_user" palceholder="Search User">
         <a href="#!" class="btn btn-info" onclick="formSubmit()"><i class="fa fa-search" aria-hidden="true"></i></a>
      </div>
   </div>
</div>

<div class="page-body passportDetail">


</div>
<div class="page-body productDetail">


</div>
</div>


<!-- Modal Header -->



<!-- Page-body end -->
@endsection
@section('page-js-script')
<script>

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
  

   function formSubmit(e) {
      var search = $('.search_user').val();

      $(e).find('.st_loader').show();
      $.ajax({
         headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
         url: "{{ route('restaurant.passport.code') }}",
         dataType: "json",
         method: "POST",
         data: {passport_code: search,},
         success: function(data) {
            if(data.status == 0){
               toastr.error(data.message, 'Error');
            }else{
               $('.passportDetail').html('');
               $('.passportDetail').append(data.view);
           
            }
         },
      });
   }

   function getpassportItem(e,id,passportCode){
      $('#modal-default .modal-content').html('');
      $.ajax({
         headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
         url: "{{ route('get.passport.item') }}",
         dataType: "json",
         method: "POST",
         data: {
            id:id,
            passportCode:passportCode,
         },
         success: function(data) {
            $('#modal-default .modal-content').html(data.view);
			   $('#modal-default').modal('show');
         },
      });
   }
</script>
@endsection