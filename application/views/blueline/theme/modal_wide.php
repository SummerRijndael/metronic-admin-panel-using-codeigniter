<script type="text/javascript" src="<?=base_url()?>assets/blueline/js/ajax.js"></script>
<script>$(document).ready(function(){ 
  $("form").validator();

});
$.ajaxSetup ({
    cache: false
});
</script>

 <div class="modal-dialog wide" style='width: 68%;'>
    <div class="modal-content">
      
      <div class="modal-body">
                    
        <?=$yield?>         

     
    </div>
  </div>
