<button type="button" class="close" data-dismiss="modal">&times;</button>
<div class="modal-body p-md-5 p-4">
  <div class="FoodDetailsHere PassportDetailsHere UserDetails">
    <div class="PassportDetails3 col-md-10 m-auto p-0">
      <h4 class="text-center">Hi, {{ucwords($passportOrder->name)}}</h4>
      <div class="CansumerFormTable w-100 text-white">
        <table class="table TableOne">
          <tr>
            <td>{{$passportOrder->phone}}</td>
            <td class="text-right">AVAILABLE CREDIT</td>
          </tr>
          <tr>
            <td>{{$passportOrder->email}}</td>
            <td class="text-right"><b><i class="fa fa-inr" aria-hidden="true"></i> {{number_format($passportOrder->price,2)}}</b></td>
          </tr>
        </table>
        <div class="TableBorderBox mt-5">
          <form>
            <table class="table table-border TableTwo m-0">
              <tr>
                <th>Date:</th>
                <th>{{date('d M, Y',strtotime($passportOrder->order_date))}}</th>
              </tr>
              <tr>
                <th>Volume:</th>
                <th>{{number_format($passportOrder->volume_amount,2)}}</th>
              </tr>
            </table>
            <input type="hidden" name="id" value="{{$passportOrder->id}}">
            <input type="hidden" name="payment_id" value="{{$passportOrder->payment_id}}">
          </form>
        </div>
        <div class="YOurHistory pt-5">
          <h6>Your History</h6>
          <table class="table table-border TableThree">
            <tr>
              <td>21/09/2021</td>
              <td>1234</td>
              <td>1234</td>
              <td><a href="javascript:void(0);"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
              <td><a href="javascript:void(0);"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>