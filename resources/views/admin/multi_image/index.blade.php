<?php 

foreach($files as $file){ 
    $destroy_url = $route->multiple_upload_delete;
    ?>
    <div class="mfile">
        <a href="#!" onclick="delete_multiple_image('{{ $destroy_url }}',this)" data-id="{{ $file->id }}"><i class="fa fa-trash"></i></a>
        <img src="{{ asset($file->file) }}"  class="img-thumbnail " alt="" width="100" height="100" style=""> 
    </div>
<?php } ?>