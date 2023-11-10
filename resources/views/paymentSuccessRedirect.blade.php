<div class="modal-content"><style>
  .colorModel{
    color:#f8bf00 !important;
    font-weight: 700;
  }

.addressData{
    font-size: 16px; 
    padding-right:10px
}

</style>
<div class="modal-header border-0 pb-0 ">
    <h5 class="modal-title colorModel m-auto" id="staticBackdropLabel" style="font-weight: 700;">ORDER CONFIRMATION</h5><br>
</div>
<div class="modal-body">
<p class="text-white mb-0 text-center" style="
">Thank you for placing order</p>

<section class="w-100  AboutUs mt-5" id="AboutUs">
      <div class="mt-3">
        <div class="fbLocate w-100 text-white">
          <div class="row">
        <div class="col-12">
            <div class="float-left fw-bolder" style="font-size:20px;">
                <div class="float-left addressData ">
              <p class="invoice-pdf-view"><span class="colorModel">Consumer Name :</span> {{ $orderData->name }}</p>
                <p class="invoice-pdf-view"><span class="colorModel">Phone :</span> {{ $orderData->phone }}</p>
                <p class="invoice-pdf-view"><span class="colorModel" >Order Id :</span> {{ $orderData->id }}</p>
                <p class="invoice-pdf-view"><span class="colorModel">Payment Id :</span> {{ $orderData->payment_id }}</p>
                <p class="invoice-pdf-view"><span class="colorModel">Amount :</span> {{ $orderData->total_pay }}</p>
                </div>
            </div>
        </div>
        </div>
        </div>
      </div>

    </section>
    <div class="row">
        <div class="col-12">
      <a href="{{ route('home') }}" class="btn btn-success rounded-pill" style="margin-left: 258px;">Back To Home</a>
        </div>
    </div>
</div>
<style>
    .OrderModalInside .OrderShowModal .modal-content {
        width: 700px;
    }
</style>

</div>