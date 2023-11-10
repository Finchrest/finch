<div class="modal-header">
  <h5 class="modal-title text-white" id="staticBackdropLabel">Set/Change Location</h5>
  <button type="button" class="close" onclick="cloaseLocationsModal(this)">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
<section class="w-100 clearfix fbEnjoyPrime fbEnjoyPrimeLocation" id="">
    <div class="container">
        <div class="PrimePlaces w-100 clearfix">
        <form action="" id="changeLcoationForm">
          <input type="hidden" id="getLoc" value="{{$setLocation}}">
          <div class="row">
          @foreach($locations as $location)
          @php
            $loc_image = asset($location->FileId->file);
          @endphp
            <div class="col-md-4 col-sm-6 p-lg-1 py-2">
              <div class="fbBestPlacer w-100 clearfix">
                <div class="PrimePlacesDetails w-100 text-center">
                  <div class="PlaceIcon p-2">
                    <img src="{{$loc_image}}" class="img-fluid" alt="No image">
                  </div>
                  
                  <div class="GrabBtn3 pt-2">
                    <label for="location_id_{{$location->id}}" class="btn m-0 onOrder onOrder2 position-relative <?php if($setLocation == $location->id){ echo 'checked'; } ?>">
                    <input type="radio" name="location_id" <?php if($setLocation == $location->id){ echo 'checked'; } ?> value="{{$location->id}}" onchange="setLocations(this,'changeLcoationForm'); return false;" id="location_id_{{$location->id}}" class="position-absolute">
                   {{$location->name}}
                    </label>
                    <!-- <a href="javascript:void(0);" class="btn m-0 onOrder onOrder2">Order Online</a> -->
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </form>
        </div>
      </div>
</section> 








  <form action="" id="changeLcoationForm" class="d-none">
    <input type="hidden" id="getLoc" value="{{$setLocation}}">
    <table class="table">
      <tbody>
        @foreach($locations as $location)
          @php
            $loc_image = asset($location->FileId->file);
          @endphp
          <tr>
            <td>
                <input type="radio" name="location_id" <?php if($setLocation == $location->id){ echo 'checked'; } ?> value="{{$location->id}}" onchange="setLocations(this,'changeLcoationForm'); return false;"> &nbsp; &nbsp; <img src="{{$loc_image}}" class="img-thumbnail bg-dark" alt="" width="50" height="50"> &nbsp; &nbsp; {{$location->name}}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </form>
</div>
<style>
  .fbEnjoyPrimeLocation .PlaceIcon img {
    max-height: 40px;
    min-height: 40px;
}
.OrderModalInside .OrderShowModal .modal-content {
      width: 700px;
  }
  .GrabBtn3 label.onOrder input[type=radio] {
    width: 100%;
    height: 100%;
    top: 0;
    right: 0;
    z-index: 1111;
    cursor: pointer;
    opacity: 0;
}
.GrabBtn3 label.checked.onOrder{
    border-color: var(--white) !important;
    background-color: var(--white) !important;
    color: var(--black) !important;
}
</style>