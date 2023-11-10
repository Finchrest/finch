@extends('layouts.app')

@section('content')
<section class="w-100 clearfix " id="">
      <div class="container">
  <div class=" ">
    <div class="HeadingText HeadingText2 text-center">
      <h3 class="">BEER PASSPORT</h3>
      <p class="mb-0">GET AMAZING BENEFITS AND SAVINGS</p>
    </div>
    <input type="hidden" id="auth_id" value="{{ @$auth_id }}">
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
            <th class="text-white">Benifits Of Passport</th>
            </tr>
          </thead>
          <tbody id="getUserdata">
          <?php foreach($passports as $passport){ ?>
            <tr id="">
            <td class="text-left text-white">{{ ucwords($passport->name) }}</td>
            <td><a class="btn btn-warning w-100 text-white" href="javascript:void(0)" onclick="getPassportView(this,`{{ $passport->id }}`);">More Info</a><span><span><br>
            </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
</section>
</div>
</div>
</div>
@endsection
@section('page-js-script')
<script>
function getPassportView(e,id){
    let auth_id = $('#auth_id').val();
    if(auth_id){
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
          $('#ModalOne').modal('show');
        }
      }
    }); 
    }else{
        toastr.error('Login First','Error');
        showLoginPage(this);
        var currentUrl = window.location.href;
        sessionStorage.setItem("lastname", "Smith");
    }
  }
</script>
  @endsection