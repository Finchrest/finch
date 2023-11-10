<div class="modal-header">
   <h4 class="modal-title">Message {{ $module }}</h4>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body py-3">
@csrf
<div class="row">
   <div class="col-md-12">
      <span> {{ $user->message }} </span>
   </div>
</div>
<div class="modal-footer">
   <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
</div>